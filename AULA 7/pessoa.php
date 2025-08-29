<?php
class Pessoa {
    private $nome;
    private $idade; 
    private $email;

    public function __construct($nome, $idade, $email) {
        $this->setNome($nome);
        $this->setIdade($idade);
        $this->setEmail($email);
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getEmail() {
        return $this->email;
    }

    public function exibirInfo() {
    echo "O nome é " . $this->getNome() . ", tem " . $this->getIdade() . 
    " anos e o email é " . $this->getEmail();
}
}

// Exemplo de uso:
$pessoa = new Pessoa("Samuel", 22, "samuel@exemplo.com");
$pessoa->exibirInfo();