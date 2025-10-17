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
        }