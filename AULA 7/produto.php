<?php

class Produto {
    private $nome;
    private $preco;
    private $estoque;

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getEstoque() {
        return $this->estoque;
    }
}

$produto = new Produto();
$produto->setNome("Notebook");
$produto->setPreco(3500.00);
$produto->setEstoque(15);

echo "O produto ", $produto->getNome() , " custa R$ ",$produto->getPreco(), " e possui " ,$produto->getEstoque(), " no estoque" ;