<?php

namespace Thiago\Crud\Domain\Model;

use DomainException;

class Product
{
    private ?int $id;
    private string $nome;
    private string $descricao;
    private string $estado;
    private float $preco;
    private int $quantidade;

    public function __construct(?int $id,string $nome, string $descricao, string $estado, float $preco, int $quantidade)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->estado = $estado;
        $this->preco = $this->setPrice($preco);
        $this->quantidade = $quantidade;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getName(): string{
        return $this->nome;
    }


    public function getDescription(): string{
        return $this->descricao;
    }

    public function getStatus(): string{
        return $this->estado;
    }

    public function getPrice(): float{
        return $this->preco;
    }

    public function getTheAmount(): int{
        return $this->quantidade;
    }

    private function setPrice(float $price): float {
        if($price < 0){
            return 0.0;
        }else{
            return $price;
        }
    }

    public function setId(int $id): void{
        if(!is_null($this->id)){
            throw new DomainException('Você só pode definir o id 1 única vez.');
        }

        $this->id = $id;
    }


}

?>