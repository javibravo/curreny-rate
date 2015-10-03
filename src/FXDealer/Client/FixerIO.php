<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use DateTime;

class FixerIO {

        const DAY_FORMAT = 'Y-m-d';

        private $baseUrl;
        private $client;

        public function __construct(array $options = array()) {
            $this->baseUrl = 'http://api.fixer.io';
            $this->client = new Client();
        }

        public function getLatest($base = 'EUR') {
            try {
                $response = $this->client->request('GET', $this->baseUrl.'/latest?base='.$base);
                return json_decode($response->getBody(), true);
            } catch (ClientException $ex) {
                throw $ex;
            }
        }

        public function getHistorical(DateTime $day, $base = 'EUR') {
            try {
                $response = $this->client->request('GET', $this->baseUrl.'/'.$day->format(self::DAY_FORMAT).'?base='.$base);
                return json_decode($response->getBody(), true);
            } catch (ClientException $ex) {
                throw $ex;
            }
        }



}