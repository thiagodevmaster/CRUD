<?php

namespace Thiago\Crud\Infrastructure\Repository;

use PDO;
use PDOStatement;
use Thiago\Crud\Domain\Model\Product;
use Thiago\Crud\Domain\Repository\ProductRepository;

class PdoProductRepository implements ProductRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    private function hydrateProductList(PDOStatement $statement): array
    {  
        $productDataList = $statement->fetchAll();
        $productList = [];

        foreach ($productDataList as $productData) {
            $productList[] = new Product(
                $productData['id'],
                $productData['nome'],
                $productData['descricao'],
                $productData['estado'],
                $productData['preco'],
                $productData['quantidade']
            );

        }

        return $productList;
    }

    public function allProducts(): array
    {
        $query = $this->connection->query("SELECT * FROM produtos;");
        
        return $this->hydrateProductList($query);
    }

    public function saveProducts(Product $product): bool
    {
        // se o produto não existir no banco quero inseri-lo
        // caso já exista vamos altera-lo

        if($product->getId() === null)
            return $this->insertProduct($product);

        return $this->updateProduct($product);
        
    }

    public function returnProduct(int $id): Product
    {   
        $productData = $this->allProducts();

        foreach($productData as $product){
            if($product->getId() === $id){
                return $product;
            }
        }
        
    }

    public function insertProduct(Product $product): bool
    {
        $query = $this->connection->prepare("INSERT INTO produtos 
                                                        (nome, 
                                                        descricao, 
                                                        estado, 
                                                        preco, 
                                                        quantidade) 
                                                VALUES (:nome, 
                                                        :descricao,
                                                        :estado,
                                                        :preco,
                                                        :quantidade);
                                            ");
        
        $sucess = $query->execute([
            ':nome' => $product->getName(),
            ':descricao'=> $product->getDescription(),
            ':estado' => $product->getStatus(),
            ':preco' => $product->getPrice(),
            ':quantidade' => $product->getTheAmount()
        ]);

        if ($sucess) {
            $product->setID($this->connection->lastInsertId());
        }

        return $sucess;
    }

    public function updateProduct(Product $product): bool
    {

        $query = $this->connection->prepare("UPDATE produtos 
                                                SET nome = :nome,
                                                    descricao = :descricao,
                                                    estado = :estado, 
                                                    preco = :preco, 
                                                    quantidade = :quantidade
                                              WHERE id = :id;");

                                              
        $query->bindValue(":nome", $product->getName());
        $query->bindValue(":descricao", $product->getDescription());
        $query->bindValue(":estado", $product->getStatus());
        $query->bindValue(":preco", $product->getPrice());
        $query->bindValue(":quantidade", $product->getTheAmount()) ;
        $query->bindValue(":id", $product->getId(), PDO::PARAM_INT);

        return $query->execute();
    }

    public function removeProducts(Product $product): bool
    {
        $query = $this->connection->prepare("DELETE FROM produtos WHERE id=?;");
        $query->bindValue(1, $product->getId(), PDO::PARAM_INT);
        
        return $query->execute();
    }
}