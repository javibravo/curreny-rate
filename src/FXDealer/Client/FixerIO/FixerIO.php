<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client\FixerIO;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use DateTime;

class FixerIO {

        const DAY_FORMAT = 'Y-m-d';

        private $endpointUrl = 'api.fixer.io';
        private $protocol;
        private $client;

        public function __construct(array $options = array()) {
            $this->protocol = 'http';
            if (array_key_exists('protocol', $options))
                $this->protocol = $options['protocol'];
            $this->client = new Client();
        }

        protected function getUrl($endpointPath, array $parameters = array()) {
            return $this->protocol.'://'.$this->endpointUrl.'/'.$endpointPath.'?'.http_build_query($parameters);
        }

        public function getLatest($base = 'EUR') {
            try {
                $response = $this->client->request('GET', $this->getUrl('latest', ['base' => $base]));
                return json_decode($response->getBody(), true);
            } catch (ClientException $ex) {
                throw $ex;
            }
        }

        public function getHistorical(DateTime $day, $base = 'EUR') {
            try {
                $response = $this->client->request('GET', $this->getUrl($day->format(self::DAY_FORMAT), ['base' => $base]));
                return json_decode($response->getBody(), true);
            } catch (ClientException $ex) {
                throw $ex;
            }
        }



}