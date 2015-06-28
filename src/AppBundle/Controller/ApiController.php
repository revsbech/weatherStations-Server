<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController {
	/**
	 * @Route("/api/submit")
	 */
	public function submitAction() {
		$number = rand(0, 100);
		$client = new \Elasticsearch\Client();
		$params = array();
		$params['body'] = array('testField' => 'abc');
		$params['index'] = 'weather_station';
		$params['type'] = 'weatherStationLog';
		$ret = $client->index($params);
		return new JsonResponse(array('status' => 'OK'));
	}
}