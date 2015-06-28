<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ApiController {
	/**
	 * @Route("/api/submit")
	 */
	public function submitAction(Request $request) {
		$dataRaw = $request->request->get('data');
		$clientIP = $request->getClientIp();
		$currentDate = new \DateTime();
		if ($dataRaw === NULL) {
			exit("Error");
		}

		$storedData = json_decode($dataRaw, true);
		$storedData['timestamp'] = $currentDate->format('d/m-Y H:i:s');
		$storedData['clientIp'] = $clientIP;
		$client = new \Elasticsearch\Client();
		$params = array();
		$params['body'] = $storedData;
		$params['index'] = 'weather_station';
		$params['type'] = 'weatherStationLog';
		$client->index($params);
		return new JsonResponse(array('status' => 'OK'));
	}

	/**
	 * @param int $limit
	 */
	public function readAction($limit = 100) {
		$client = new \Elasticsearch\Client();

		$searchParams['body']['query']['match']['testField'] = 'abc';
	}
}