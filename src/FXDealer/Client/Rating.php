<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client;

use DateTime;

interface Rating {
    public function getLatest($base = 'EUR');
    public function getHistorical(DateTime $day, $base = 'EUR');
}