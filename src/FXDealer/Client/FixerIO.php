<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client;

use GuzzleHttp\Client;

class FixerIO {


        private $baseUrl;
        private $client;

        public function __construct(array $options = array()) {
            $this->baseUrl = 'http://api.fixer.io';
            $this->client = new Client();
        }

        public function getLatest($base = 'EUR') {
            $response = $this->client->request('GET', $this->baseUrl.'/latest?base='.$base);
            return json_decode($response->getBody(), true);
        }
}