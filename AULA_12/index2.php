
<?php
require_once 'produtos.php';
require_once 'produtosCRUD.php';

$DAO = new ProdutosDAO();

$DAO->criarProduto(new Produtos(rand(1000, 9999), "Tomate", 5.99));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Maça", 3.99));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Queijo Brie", 25.90));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Iogurte Grego", 8.50));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Guaraná Jesus", 6.99));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Bolacha Bono", 4.50));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Desinfetante Urca", 12.99));
$DAO->criarProduto(new Produtos(rand(1000, 9999), "Prestobarba Bic", 15.90));

foreach ($DAO->lerProdutos() as $produto) {
    if ($produto->getNome() === "Desinfetante Urca") {
        $DAO->atualizarProduto($produto->getCodigo(), "Desinfetante Barbarex", 14.99);
    }
    if ($produto->getNome() === "Queijo Brie") {
        $DAO->atualizarProduto($produto->getCodigo(), $produto->getNome(), 29.90);
    }
    if ($produto->getNome() === "Iogurte Grego") {
        $DAO->atualizarProduto($produto->getCodigo(), $produto->getNome(), 7.99);
    }
}

foreach ($DAO->lerProdutos() as $produto) {
            echo "{$produto->getCodigo()} - {$produto->getNome()} - {$produto->getPreco()} \n";
        }

foreach ($DAO->lerProdutos() as $produto) {
    if ($produto->getNome() === "Maça" ) {
        $DAO->excluirProduto($produto->getCodigo());
    }
    if ($produto->getNome() === "Tomate") {
        $DAO->excluirProduto($produto->getCodigo());
}
}