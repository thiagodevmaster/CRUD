<?php

namespace Thiago\Crud\Domain\Repository;

use Thiago\Crud\Domain\Model\Product;

interface ProductRepository
{
    public function allProducts(): array;
    public function returnProduct(int $id): Product;
    public function saveProducts(Product $product): bool;
    public function removeProducts(Product $product): bool;
}