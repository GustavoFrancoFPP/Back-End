<?php
// Exercício Extra

namespace AULA_10;

interface Movel {
    public function Mover();
}

interface Abastecivel {
    public function Abastecer($quantidade);
}

interface Manutenivel {
    public function FazerManutencao();
}

class Carro implements Movel, Abastecivel {
    public function Mover() {
        echo "O carro está se movimentando ";
    }
    public function Abastecer($quantidade) {
        echo "O carro foi abastecido com {$quantidade} litros \n";
    }
}

class Bicicleta implements Movel, Manutenivel {
    public function Mover() {
        echo "A bicicleta está pedalando ";
    }
    public function FazerManutencao() {
        echo "A bicicleta foi lubrificada \n";
    }
}
class Onibus implements Movel, Abastecivel, Manutenivel {
    public function Mover() {
        echo "O ônibus está transportando passageiros ";
    }
    public function Abastecer($quantidade) {
        echo "O ônibus foi abastecido com {$quantidade} litros ";
}
public function FazerManutencao() {
    echo "O ônibus está passando por revisão \n";
}
}

$carro1 = new Carro();
$carro1->mover();
$carro1->abastecer(77);

$bicicleta1 = new Bicicleta();
$bicicleta1->mover();   
$bicicleta1->fazerManutencao();

$onibus1 = new Onibus();
$onibus1->mover();
$onibus1->abastecer(220);
$onibus1->fazerManutencao();


