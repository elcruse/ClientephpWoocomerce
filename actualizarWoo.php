<?php

require __DIR__ . '/vendor/autoload.php';
use Automattic\WooCommerce\Client;

// Conexión WooCommerce API destino
// ================================
$url_API_woo = 'http://c1830079.ferozo.com/';
$ck_API_woo = 'ck_9ce8ebcdc48a49dcf939cffab01d8f3fdd04a417';
$cs_API_woo = 'cs_67c552e86a3dcd9ca40d878cb11131c45d679647';

$woocommerce = new Client(
    $url_API_woo,
    $ck_API_woo,
    $cs_API_woo,
    ['version' => 'wc/v3']
);

$data = [
    'regular_price' => '77.77'
  
];

print_r($woocommerce->put('products/9519', $data));

$data = [
    'stock_quantity'=> '95'
  
];

print_r($woocommerce->put('products/9519', $data));
