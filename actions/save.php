<?php

use Thiago\Crud\Domain\Model\Product;
use Thiago\Crud\Infrastructure\Persistence\ConnectionFactory;
use Thiago\Crud\Infrastructure\Repository\PdoProductRepository;

require_once "../vendor/autoload.php";

$connection = ConnectionFactory::CreateConnection();
$pdoRepository = new PdoProductRepository($connection);



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = $_POST['nome'];
    $description = $_POST['descricao'];
    $status = $_POST['estado'];
    $price = $_POST['preco'];
    $theAmount = $_POST['quantidade'];
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $product = new Product(
            $id,
            $name,
            $description,
            $status,
            $price,
            $theAmount
        );
    }else{
        $product = new Product(
            null,
            $name,
            $description,
            $status,
            $price,
            $theAmount
        );
    }

    
    
    $pdoRepository->saveProducts($product);
   
    

    header("Location: http://localhost/crud/");
    die();

}