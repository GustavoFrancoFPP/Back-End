<?php

class Aluno {
    private $nome;
    private $nota;

    public function __construct($nome, $nota) {
    $this->setNome($nome);
    $this->setNota($nota);
}

public function setNome($nome) {
        $this->nome= ucwords(strtolower ($nome));
    }

    public function setNota($nota) {
        if ($nota >= 0 && $nota <= 10) {
            $this->nota = $nota;
        } else {
            $this->nota = 0;
        }
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNota() {
        return $this->nota;
    }
}

$aluno1 = new Aluno("Jefferson", 3.5);
$aluno2 = new Aluno("Robsvaldo", -22);
$aluno3 = new Aluno("Fernanda", 11);


echo $aluno1->getNome(), ", ", $aluno1->getNota();
echo $aluno2->getNome(), ", ", $aluno2->getNota();
echo $aluno3->getNome(), ", ", $aluno3->getNota();