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
		if ($dataRaw === NULL) {
			exit("Error");
		}
		
		$client = new \Elasticsearch\Client();
		$params = array();
		$params['body'] = json_decode($dataRaw);
		$params['index'] = 'weather_station';
		$params['type'] = 'weatherStationLog';
		$ret = $client->index($params);
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