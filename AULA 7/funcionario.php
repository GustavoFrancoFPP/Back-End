<?php

class Funcionario {
    private $nome;
    private $salario;

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }

    public function getSalario() {
        return $this->salario;
    }
}

$funcionario = new Funcionario();
$funcionario->setNome("Carlão");
$funcionario->setSalario(50000.00);

echo "Nome ",$funcionario->getNome(), ", Salário R$ ", $funcionario->getSalario();

$funcionario->setNome("Ana");
$funcionario->setSalario(1500.00);

echo "Nome ",$funcionario->getNome(), ", Salário de R$ ", $funcionario->getSalario();