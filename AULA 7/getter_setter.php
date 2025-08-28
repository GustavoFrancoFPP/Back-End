<?php

class Pessoa {
    private $nome;
    private $cpf;
    private $telefone;
    private $idade;
    private $email;
    private $senha;
    public function __construct($nome, $cpf, $telefone, $idade, $email, $senha) {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setTelefone( $telefone);
        $this->setIdade($idade);
        $this->email = $email;
        $this->senha = $senha;
    }

    // Getter e Setter para $nome
    public function setNome($nome) {
        $this->nome= ucwords(strtolower ($nome));
    }

    public function getNome() {
        return $this->nome;
    }
    public function setCpf($cpf) {
        $this->cpf = preg_replace('/\D/', '', $cpf); 
        // preg_replace altera a estrutura de uma string
        //pattern: /\D/ significa qualquer caracter que não seja digito
        // /\d/ captura somente numeros
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function setTelefone($telefone) {
        $this->telefone = preg_replace('/\D/', '', $telefone);
    }
    public function getTelefone() {
        return $this->telefone;
}
public function setIdade($idade) {
    $this->idade = abs( (int)$idade);
}
public function getIdade() {
    return $this->idade;
}

public function exibirInfo() {
    return "Nome do aluno: " . $this->getNome() . "\nCPF: " . $this->getCpf() . 
    "\nTelefone: " . $this->getTelefone() . "\nIdade: " . $this->Idade() . "\nEmail: " . $this->email . 
    "\nSenha: " . $this->senha;
}
}

$aluno1 = new Pessoa( "gUSTavo fRANco peReIRa", "480.738.485-45", "(19)94584-3885",
 -16, "rocamboss49@gmail.com", "jorgedasilva44");
 
 echo $aluno1->getNome();
?>

