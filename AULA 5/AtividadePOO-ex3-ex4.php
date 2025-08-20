<?php
Class Usuario {

    public $nome;
    public $cpf;
    public $sexo;
    public $email;
    public $estadocivil;
    public $cidade;
    public $estado;
    public $endereco;
    public $cep;

    public function __construct($nome, $cpf, $sexo, $email, $estadocivil, $cidade, $estado, $endereco, $cep) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->estadocivil = $estadocivil;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->endereco = $endereco;
        $this->cep = $cep;
    }}

    $usuario1 = new Usuario("Josenildo Afonso Souza", "100.200.300-40", "Masculino", 
    "josenewdo.souza@gmail.com", "Casado", "Xique-Xique", "Bahia", "Rua da amizade,99,
     0", "40123-98");
    $usuario2 = new Usuario("Valentina Passos Scherrer", "070.070.060-70", "Feminino",
    "scherrer.valen@outlook.com","Divorciada","Iracemapolis","São Paulo","Avenida da saudade, 1942","23456-24");
    $usuario3 = new Usuario("Claudio Braz Nepumoceno", "575.575.242-32", "Masculino", 
    "Clauclau.nepumoceno@gmail.com", "Solteiro", "Piripiri", "Piauí", "Estrada 3, 33", "12345-99");
?>
