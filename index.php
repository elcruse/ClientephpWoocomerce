<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

Jimmy Coa
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      
        <?php
        
        
       require __DIR__ . '/vendor/autoload.php';

       use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://c1830079.ferozo.com', 
    'ck_f071a20f6af2ddf679445b736a8d08771c980ffb', 
    'cs_bc71db83ce8ab7574a78298e733f3cb148e51d62',
    [
        'version' => 'wc/v3',
    ]
);
// ================================
/*
   $data = [
    'regular_price' => '22.57'
];

print_r($woocommerce->put('products/9494', $data));
*/
 
// ================================
$url_API="http://localhost/ClientephpWoocomerce/DataJson/DataOrigen.json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url_API);

echo "➜ Obteniendo datos origen ... \n";
$items_origin = curl_exec($ch);
curl_close($ch);

if ( ! $items_origin ) {
    exit('❗Error en API origen');
}
// ===================
$items_origin = json_decode($items_origin, true); 
// ===================
$param_sku ='';
foreach ($items_origin as $item){
    $param_sku .= $item['sku'] . ',';
}

echo "➜ Obteniendo los ids de los productos... \n";
// ===================
$products = $woocommerce->get('products/?sku='. $param_sku);
// ===================
$item_data = [];
foreach($products as $product){

    $sku = $product->sku;
    $search_item = array_filter($items_origin, function($item) use($sku) {
        return $item['sku'] == $sku;
    });
    $search_item = reset($search_item);

// ===================   
    $item_data[] = [
        'id' => $product->id,
        'regular_price' => $search_item['price'],
        'stock_quantity' => $search_item['qty'],
    ];

}

// ===================
$data = [
    'update' => $item_data,
];

echo "➜ Actualización en lote ... \n";
// ===================
$result = $woocommerce->post('products/batch', $data);

if (! $result) {
    echo("❗Error al actualizar productos \n");
} else {
    print("✔ Productos actualizados correctamente \n");
}
        ?>
    
    </body>
</html>
