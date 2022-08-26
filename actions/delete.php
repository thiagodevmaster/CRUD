<?php

use Thiago\Crud\Infrastructure\Persistence\ConnectionFactory;
use Thiago\Crud\Infrastructure\Repository\PdoProductRepository;

require_once "../vendor/autoload.php";

$connection = ConnectionFactory::CreateConnection();
$productRepository = new PdoProductRepository($connection);
$productDataList = $productRepository->allProducts();


if($_SERVER['REQUEST_METHOD'] === "POST"){

    $id = $_POST['id'];

    foreach ($productDataList as $product) {
        if($product->getId() == $id){
            $productRepository->removeProducts($product);
        }
    }


    header("Location: http://localhost/crud/");
    die();
}


?>