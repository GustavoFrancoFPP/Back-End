<?php

require_once "CRUD.php";
require_once "AlunoDAO.php";

// Objeto da classe AlunoDAO para gerenciar os métodos do CRUD

    $dao = new AlunoDAO();

    //CREATE
        $dao-> criarAluno(new Aluno (1, "Maria", "Design"));

        $dao-> criarAluno(new Aluno (2, "Gabriel", "Moda"));

        $dao-> criarAluno(new Aluno (3, "Eduardo", "Manicure"));

        // Crie mais 5 objetos obedecendo a seguinte lista:

        $dao-> criarAluno(new Aluno(4, "Aurora", "Arquitetura"));

        $dao-> criarAluno(new Aluno(5, "Oliver", "Director"));

        $dao-> criarAluno(new Aluno(6, "Amanda", "Lutadora"));

        $dao-> criarAluno(new Aluno(7, "Geysa", "Engenheira"));

        $dao-> criarAluno(new Aluno(8, "Joab", "Professor"));

        $dao-> criarAluno(new Aluno(9, "Bernardo", "Streamer"));

        // READ

        echo "Listagem Inicial:\n";
        foreach ($dao->lerAluno() as $aluno) {
            echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";
        }

        // UPDATE 
        $dao->atualizarAluno(3, "Viviane", "Eletricista");
        $dao->atualizarAluno(7, "Clotilde", "Engenheira");
        $dao->atualizarAluno(8, "Joana", "Professor");
        $dao->atualizarAluno(9, "Bernardo", "Dev");
        $dao->atualizarAluno(6, "Amanda", "Logistica");
        $dao->atualizarAluno(5, "Oliver", "Eletrica");


        echo "Após Atualização:\n";
        foreach ($dao->lerAluno() as $aluno) {
            echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";
        }

        // DELETE 
        $dao->excluirAluno(2);
        $dao->excluirAluno(7);
        $dao->excluirAluno(4);

        echo "Após exlusão:\n";
        foreach ($dao->lerAluno() as $aluno) {
            echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";


require_once 'produtos.php';

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
        }