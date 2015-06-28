<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController {
	/**
	 * @Route("/api/submit")
	 * @param array $data The data to index
	 */
	public function submitAction(array $data) {
		$number = rand(0, 100);
		$client = new \Elasticsearch\Client();
		$params = array();
		$params['body'] = array($data);
		$params['index'] = 'weather_station';
		$params['type'] = 'weatherStationLog';
		$ret = $client->index($params);
		return new JsonResponse(array('status' => 'OK'));
	}
}