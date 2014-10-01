<?php
header('Content-Type: application/json');
require_once('PSWebServiceLibrary.php');

$products = array();
$searchText = "";
$arr = array();
$opt = array();

if (isset($_POST['searchText']))
    $searchText = $_POST['searchText'];


if ($searchText) {
    /*
         * $opt['resource'] = 'products';
$opt['display'] = 'full';
$xml = $webService->get($opt);
$productNodes = $xml->products->children();
$products = array();
foreach ($productNodes as $product) {
  $nameLanguage = $product->xpath('name/language[@id=1]');
  $name = (string) $nameLanguage[0];
  $idImage = (string) $product->id_default_image;
  $image = '/img/p/';
  for ($i = 0; $i < strlen($idImage); $i++) {
    $image .= $idImage[$i] . '/';
  }
  $image .= $idImage . '.jpg';
  $id = (int) $product->id;
  $descriptionLanguage = $product->xpath('description/language[@id=1]');
  $description = (string) $descriptionLanguage[0];
  $path = '/index.php?controller=product&id_product=' . $product->id;
  $products[] = array('name' => $name, 'image' => $image, 'id' => $id, 'description' => $description, 'path' => $path);
*/
/*
      try {
        // creating web service access
        $webService = new PrestaShopWebservice('http://ihuong.com/', '7798XS4HWRIEG9FHI0ZBR6RBC3G6IPFQ', false);


        if (is_numeric($searchText)) {
            $opt = array(
                'resource'   => 'products',
                'display' => 'full',
                'filter[ean13]' => '%['.$searchText.']%');
        } else {
            $opt = array(
                'resource'   => 'products',
                'display' => 'full',
                'filter[name]' => '%['.$searchText.']%');
        }

        $xml = $webService->get($opt);

        $productNodes = $xml->products->children();
        foreach ($productNodes as $product) {
            $nameLanguage = $product->xpath('name/language[@id=1]');
            $name = (string) $nameLanguage[0];
            $idImage = (string) $product->id_default_image;
            $image = '/img/p/';

            for ($i = 0; $i < strlen($idImage); $i++) {
                $image .= $idImage[$i] . '/';
            }
            $image .= $idImage . '.jpg';
            $id = (int) $product->id;
            $price = (int) $product->price;
            $stock_available_id = (int)$product->associations->stock_availables->stock_available->id;
            $quantity = get_product_quantity($stock_available_id, $webService);
            $path = '/index.php?controller=product&id_product=' . $product->id;
            $products[] = array('name' => $name, 'image' => $image, 'id' => $id, 'path' => $path, 'price' => $price, 'quantity' => $quantity);
        }
    }
    catch (PrestaShopWebserviceException $ex) {
        // Shows a message related to the error
        $html = 'Other error: <br />' . $ex->getMessage();
    }
*/

    try {
        // creating web service access
        $config = simplexml_load_file("xml/config.xml");
        $APIKey = $config->key;
        $webService = new PrestaShopWebservice('http://ihuong.com/', $APIKey, false);


        if (is_numeric($searchText)) {
            $opt = array(
                'resource'   => 'products',
                'display' => '[id, name, price, id_default_image]',
                'filter[ean13]' => '%['.$searchText.']%');
        } else {
            $opt = array(
                'resource'   => 'products',
                'display' => '[id, name, price, id_default_image]',
                'filter[name]' => '%['.$searchText.']%');
        }

        $xml = $webService->get($opt);

        $productNodes = $xml->products->children();
        foreach ($productNodes as $product) {
            $nameLanguage = $product->xpath('name/language[@id=1]');
            $name = (string) $nameLanguage[0];
            $price = (int) $product->price;
            $idImage = (string) $product->id_default_image;
            $image = '/img/p/';
            $id = (int) $product->id;
            $path = '/index.php?controller=product&id_product=' . $product->id;

            for ($i = 0; $i < strlen($idImage); $i++) {
                $image .= $idImage[$i] . '/';
            }
            $image .= $idImage . '.jpg';

            $products[] = array('image' => $image, 'name' => $name, 'price' => $price, 'path' => $path);
        }
    }
    catch (PrestaShopWebserviceException $ex) {
        // Shows a message related to the error
        $html = 'Other error: <br />' . $ex->getMessage();
    }

    $arr = array(
        "products" => $products
    );
}
echo json_encode($arr);

?>

<?php
    function get_product_quantity( $stock_available_id, $webService ) {
        $opt = array(
            'resource'   => 'stock_availables',
            'id' => $stock_available_id
        );

        $xml = $webService->get($opt);
        $quantity = (int)$xml->stock_available->quantity;

        return $quantity;
    }
?>