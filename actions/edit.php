<?php

use Thiago\Crud\Domain\Model\Product;
use Thiago\Crud\Infrastructure\Persistence\ConnectionFactory;
use Thiago\Crud\Infrastructure\Repository\PdoProductRepository;

require_once "../vendor/autoload.php";

$connection = ConnectionFactory::CreateConnection();
$pdo = new PdoProductRepository($connection);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $name = $_POST['nome'];
    $description = $_POST['descricao'];
    $status = $_POST['estado'];
    $price = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $produto = new Product($id, $name, $description, $status, $price, $quantidade);

    $pdo->saveProducts($produto);

    echo $id;

    header("Location: http://localhost/crud/");
    die();
    
}