<?php

class Carro {
    public $marca;
    public $modelo;
    public $ano;
    public $revisao;
    public $N_Donos;

    public function __construct( $marca, $modelo, $ano, $revisao, 
    $N_Donos) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->revisao = $revisao;
        $this->N_Donos = $N_Donos;
    }

    public function exibirInfo() {
        echo "Marca: $this->marca - Modelo; $this->modelo - Ano: $this->ano\n";                                                                                                                                                                                      
    }
    public function ligar() {
        echo "O carro $this->modelo está ligado!\n ";
    }
}

$carro1 = new Carro("Porsche", "911", 2020, false, 3);
$carro2 = new Carro("Mitsubishi", "Lancer", 1945, true, 1);
$carro3 = new Carro("Volkswagen", "Fusca", 1960, true, 3);
$carro4 = new Carro("Fiat", "Uno", 1985, false, 2);
$carro5 = new Carro("Chevrolet", "Logus", 2018, true, N_Donos: 4);
$carro6 = new Carro("Toyota", "Corolla", 2021, false, 5);

$carro2 -> ligar();
$carro4 -> exibirInfo();
?>
