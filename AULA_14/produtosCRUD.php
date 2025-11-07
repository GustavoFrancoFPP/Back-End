<?php
// Crie uma classe 'produtos' com os atributos: código, nome e preco. Após isso faça a ProdutosDAO para a utilização dos métodos CRUD. Por último faça um index.php para testar a criação e manipulação dos objetos.  Implemente a persistencia de dados com o arquivo 'produtos.json'

// Crie 8 objetos: Tomate, maça, queijo brie, iogurte grego, Guaraná Jesus, Bolacha Bono, Desinfetante Urca e Prestobarba Bic. Determine os preços por conta e os códigos de forma aleatória.

// Modifique o Desinfetante Urca para Desinfetante Barbarex; E ao menos 2 valores dos preços que voce determinou.

// Apague a maça e o Tomate dos produtos (aqui nao somos saudaveis).
class Produtos {
    private $codigo;
    private $nome;
    private $preco;

public function __construct($codigo, $nome, $preco) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
}