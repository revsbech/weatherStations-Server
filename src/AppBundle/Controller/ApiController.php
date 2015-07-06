<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Measurement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller {
	/**
	 * @Route("/api/submit")
	 *
	 * Testing:
	 * curl -XPOST --data "data={\"humidityOutside\":78.2,\"temperatureOutside\":15.9}" "http://weather.dev/api/submit"
	 */
	public function submitAction(Request $request) {
		$dataRaw = $request->request->get('data');

		$clientIP = $request->getClientIp();
		$currentDate = new \DateTime();
		if ($dataRaw === NULL) {
			exit("Error " . $dataRaw);
		}
		$incomingData = json_decode($dataRaw, true);

		$measurement = new Measurement();
		$measurement->setMeasurementTime(new \DateTime());
		if (array_key_exists('temperatureOutside', $incomingData)) {
			$measurement->setTemperatureOutside(floatval($incomingData['temperatureOutside']));
		}
		if (array_key_exists('temperatureInside', $incomingData)) {
			$measurement->setTemperatureInside(floatval($incomingData['temperatureInside']));
		}
		if (array_key_exists('humidityOutside', $incomingData)) {
			$measurement->setHumidityOutside(floatval($incomingData['humidityOutside']));
		}
		if (array_key_exists('humidityInside', $incomingData)) {
			$measurement->setHumidityInside(floatval($incomingData['humidityInside']));
		}
		if (array_key_exists('luminosity', $incomingData)) {
			$measurement->setLuminosity(floatval($incomingData['luminosity']));
		}

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($measurement);
		$em->flush();
		return new JsonResponse(array('status' => 'OK'));
	}

	/**
	 * @Route("/api/latest")
	 */
	public function latestReading() {
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('AppBundle:Measurement');

		/** @var Measurement $measurement */
		$measurement = $repo->findOneBy(array(), array('measurementTime' => 'DESC'),1);
		$icon = "wi-day-sunny";
		$data = array(
			"availableStations" => array("Drivhus"),
			"selectedStation" => array(
				'name' => 'Drivhus',
				'icon' => $icon,
				'temperature' => array(
					'inside' => $measurement->getTemperatureInside(),
					'outside' => $measurement->getTemperatureOutside()
				),
				'humidity' => array(
					'inside' => $measurement->getHumidityInside(),
					'outside' => $measurement->getHumidityOutside()
				)
			)
		);
		return new JsonResponse($data);
	}

}