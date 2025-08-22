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
// ex5
    public function latir() {
        echo "O cachorro $this->nome está latindo!\n";
    }
// ex6
    public function marcarTerritorio() {
        echo"O cachorro $this->nome e this->raça está marcando território!\n";
    }

}
$cachorro1 = new Cachorro("Rex", 5, "Labrador", true, "Macho");
$cachorro2 = new Cachorro("Bela", 3, "Poodle", false, "Fêmea");
$cachorro3 = new Cachorro("Max", 2, "Bulldog", true, "Macho");
$cachorro4 = new Cachorro("Luna", 4, "Beagle", false, "Fêmea");
$cachorro5 = new Cachorro("Toby", 6, "Golden Retriever", true, "Macho");
$cachorro6 = new Cachorro("Bella", 1, "Chihuahua", false, "Fêmea");
$cachorro7 = new Cachorro("Charlie", 3, "Cocker Spaniel", true, "Macho");
$cachorro8 = new Cachorro("Daisy", 2, "Shih Tzu", false, "Fêmea");
$cachorro9 = new Cachorro("Rocky", 4, "Boxer", true, "Macho");
$cachorro10 = new Cachorro("Lola", 5, "Salsicha", false, "Fêmea");

$cachorro1->latir();
$cachorro2->marcarTerritorio();
?>