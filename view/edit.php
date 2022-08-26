<?php

use Thiago\Crud\Infrastructure\Persistence\ConnectionFactory;
use Thiago\Crud\Infrastructure\Repository\PdoProductRepository;

require_once "../vendor/autoload.php";

$connection = ConnectionFactory::CreateConnection();
$pdo = new PdoProductRepository($connection);

if(isset($_GET["id"])){
    $id = $_GET['id'];

    $product = $pdo->returnProduct($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>
        <form action="../actions/save.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $product->getName();?>">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $product->getDescription();?>">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado">
                    <option value="novo">Novo</option>
                    <option value="usado">Usado</option>
                    <option value="lacrado">Lacrado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" step="0.01" min="0" id="preco" name="preco" value="<?= $product->getPrice();?>">
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= $product->getTheAmount();?>">
            </div>
            <input type="hidden" name="id" id="id" value="<?= $product->getId();?>">
            <button type="submit" class="btn btn-primary">Salvar Edição de Produto</button>
            <a href="../index.php">
                <button type="button" class="btn btn-danger">Voltar</button>
            </a>
        </form>
    </div>
</body>
</html>






