<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client;

use GuzzleHttp\Client as GuzClient;
use GuzzleHttp\ClientInterface;

class Client {

    const DAY_FORMAT = 'Y-m-d';

    protected $endpointUrl;
    protected $protocol;
    protected $webClient;

    public function __construct(array $options = array()) {
        $this->protocol = 'http';
        if (array_key_exists('protocol', $options))
            $this->protocol = $options['protocol'];
        $this->webClient = new GuzClient();
    }

    public function setWebClient(ClientInterface $webClient) {
        $this->webClient = $webClient;
    }

    protected function getUrl($endpointPath, array $parameters = array()) {
        return $this->protocol.'://'.$this->endpointUrl.'/'.$endpointPath.'?'.http_build_query($parameters);
    }

}