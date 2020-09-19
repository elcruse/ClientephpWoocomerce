<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://c1830079.ferozo.com/', 
    'ck_9ce8ebcdc48a49dcf939cffab01d8f3fdd04a417', 
    'cs_67c552e86a3dcd9ca40d878cb11131c45d679647',
    [
        'version' => 'wc/v3',
    ]
);

print_r($woocommerce->get('orders'));