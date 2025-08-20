<?php
// Crie uma classe (molde de objetos) chamada 'Cachorro' com os seguintes atributos: Nome,
// idade, raça, castrado, e sexo

class Cachorro {
    public $nome;
    public $idade;
    public $raça;
    public $castrado;
    public $sexo;

    public function __construct($nome, $idade, $raça, $castrado, $sexo) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->raça = $raça;
        $this->castrado = $castrado;
        $this->sexo = $sexo;


    }
}
$carro1 = new Carro("Porsche", "911", 2020, false, 3);
$carro2 = new Carro("Mitsubishi", "Lancer", 1945, true, 1);
$carro3 = new Carro("Volkswagen", "Fusca", 1960, true, 3);
$carro4 = new Carro("Fiat", "Uno", 1985, false, 2);
$carro5 = new Carro("Chevrolet", "Logus", 2018, true, N_Donos: 4);
$carro6 = new Carro("Toyota", "Corolla", 2021, false, 5);
?>