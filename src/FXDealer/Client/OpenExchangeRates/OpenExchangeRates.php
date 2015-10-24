<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client\OpenExchangeRates;

use FXDealer\Client\Client;
use FXDealer\Client\Rating;
use GuzzleHttp\Exception\ClientException;
use DateTime;

class OpenExchangeRates extends Client implements Rating {

    protected $appId;

    public function __construct($app_id, array $options = array()) {
        $this->endpointUrl = 'openexchangerates.org/api';
        $this->appId = $app_id;
        parent::__construct($options);
    }

    public function getLatest($base = 'EUR') {
        try {
            $response = $this->webClient->request(
                'GET',
                $this->getUrl('latest.json', ['base' => $base, 'app_id' => $this->appId])
            );
            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
            throw $ex;
        }
    }

    public function getHistorical(DateTime $day, $base = 'EUR') {
        try {
            $response = $this->webClient->request(
                'GET',
                $this->getUrl($day->format(self::DAY_FORMAT).'.json', ['base' => $base, 'app_id' => $this->appId])
            );
            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
            throw $ex;
        }
    }

}