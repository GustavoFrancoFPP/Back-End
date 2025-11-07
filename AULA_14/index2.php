
<?php
require_once 'produtos.php';
require_once 'produtosCRUD.php';

$DAO = new ProdutosDAO();

$DAO->criarProduto(new Produtos(1, "Tomate", 5.99));
$DAO->criarProduto(new Produtos(2, "Maça", 3.99));
$DAO->criarProduto(new Produtos(3, "Queijo Brie", 25.90));
$DAO->criarProduto(new Produtos(4, "Iogurte Grego", 8.50));
$DAO->criarProduto(new Produtos(5, "Guaraná Jesus", 6.99));
$DAO->criarProduto(new Produtos(6, "Bolacha Bono", 4.50));
$DAO->criarProduto(new Produtos(7, "Desinfetante Urca", 12.99));
$DAO->criarProduto(new Produtos(8, "Prestobarba Bic", 15.90));

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