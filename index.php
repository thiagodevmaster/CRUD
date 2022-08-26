<?php

use Thiago\Crud\Infrastructure\Persistence\ConnectionFactory;
use Thiago\Crud\Infrastructure\Repository\PdoProductRepository;

require_once "vendor/autoload.php";

$conection = ConnectionFactory::CreateConnection();
$productRepository = new PdoProductRepository($conection);
$productsData = $productRepository->allProducts(); 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    
    <main>
        <div class="container">
            <h1 class="titulo">Lista de Produtos:</h1>

            <!-- Button trigger modal adicionar-->
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Adicionar Produto
            </button>

            <!-- Modal adicionar-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form adicionar-->
                    <form action="actions/save.php" method="POST" id="addForm">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao">
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" form="addForm">
                                <option value="novo">Novo</option>
                                <option value="usado">Usado</option>
                                <option value="lacrado">Lacrado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço</label>
                            <input type="number" class="form-control" step="0.01" min="0" id="preco" name="preco">
                        </div>
                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Produto</button>
                    </form>

                </div>
                </div>
            </div>
            </div>

            <!-- Table -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>DESCRIÇÂO</th>
                        <th>ESTADO</th>
                        <th>PREÇO</th>
                        <th>QNT</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productsData as $produto):?>
                    <tr>
                        <td><?= $produto->getName();?></td>
                        <td><?= $produto->getDescription();?></td>
                        <td><?= $produto->getStatus();?></td>
                        <td><?= $produto->getPrice();?></td>
                        <td><?= $produto->getTheAmount();?></td>
                        <td>
                            <a href="view/edit.php?id=<?= $produto->getId();?>">
                                <button type="button" class="btn btn-secondary btn-sm">
                                Editar
                                </button>
                            </a>
                            <form action="actions/delete.php" method="POST">
                                <input type="hidden" id="id" name="id" value="<?= $produto->getId();?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="Deletar">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>