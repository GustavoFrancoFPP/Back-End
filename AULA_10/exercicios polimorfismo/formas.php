<?php

namespace AULA_10;

interface Forma {
    public function calcularArea();
}

class Quadrado implements Forma {
    private $lado;
    public function __construct($lado) {
        $this-> lado = $lado;
    }
    public function calcularArea() {
        return $this->lado * $this->lado;
    }

}

class Retangulo implements Forma {
    private $base;
    private $altura;

    public function __construct($base, $altura) {
        $this->base = $base;
        $this->altura = $altura;
    }

    public function calcularArea() {
        return $this->base * $this->altura;
    }
}

class Circulo implements Forma {
    private $raio;
    public function __construct($raio) {
        $this->raio = $raio;
    }
    public function calcularArea() {
        return pi() * ($this->raio * $this->raio);
    }
}

$lado = readline("Digite o lado do quadrado: ");
$quadrado = new Quadrado($lado);


$base = readline("Digite a base do retângulo: ");
$altura = readline("Digite a altura do retângulo: ");
$retangulo = new Retangulo($base, $altura);

$raio = readline("Digite o raio do círculo: ");
$circulo = new Circulo($raio);

echo "A área do quadrado é: " . $quadrado->calcularArea() . "\n";
echo "A área do retangulo é: " . $retangulo->calcularArea() . "\n";
echo "A área do círculo é: " . $circulo->calcularArea() . "\n";


//Exercício 2 – Animais e Sons

// interface Animal {
//     public function fazersom();
// }
// class Cachorro implements Animal {
//     public function fazersom() {
//         return "Au Au!";
//     }
// }
// class Gato implements Animal {
//     public function fazersom() {
//         return "Miau!";
//     }
// }
// class Vaca implements Animal {
//     public function fazersom() {
//         return "Muuu!";
//     }
// }
class Animal {
    public function fazerSom() {
        return "Som genérico de animal.";
    }
}

class Cachorro extends Animal {
    public function fazerSom() {
        return "Au au!";
    }
}

class Gato extends Animal {
    public function fazerSom() {
        return "Miau!";
    }
}

class Vaca extends Animal {
    public function fazerSom() {
        return "Muuu!";
    }
}

$cachorro = new Cachorro();
$gato = new Gato();
$vaca = new Vaca();

echo $cachorro->fazerSom() . "\n";
echo $gato->fazerSom() . "\n";
echo $vaca->fazerSom() . "\n";

// Exercício 3 – Meios de Transporte

interface Transporte
{
    public function mover();

}
class Carro implements Transporte
{
    public function mover()
    {
        echo "O carro está andando em Limeira City!!\n";
    }    
}

class Aviao implements Transporte
{
    public function mover()
    {
        echo "O avião está voando!\n";
    }
}

class Barco implements Transporte
{
    public function mover()
    {
        echo "O barco está navegando!!\n";
    }
}

class Elevador implements Transporte
{
    public function mover()
    {
        echo "O elevador está subindo e descendo!!\n";
    }
}


// Exercício 4 – Notificações

interface Notificacao {
    public function enviar();
}
class Email implements Notificacao {
    public function enviar() {
        return "Enviando Email...";
    }}
    class Sms implements Notificacao {
        public function enviar() {
            return "Enviando SMS...";
        }
    }
    function notificar($meio) {
        echo $meio->enviar();
    }
    $email = new Email();
    $sms = new Sms();
    notificar($email);
    echo "\n";
    notificar($sms);
    echo "\n";

//Exercício 5 – Calculadora com Sobrecarga Simulada 
// Ajuda de IA
interface CalculadoraSimulada {
    public function somar($numeros);
}

class CalculadoraDoisNumeros implements CalculadoraSimulada {
    public function somar($numeros) {
        if (count($numeros) == 2) {
            return "Soma de 2 números: " . ($numeros[0] + $numeros[1]);
        } else {
            return "Informe exatamente 2 números.";
        }
    }
}

class CalculadoraTresNumeros implements CalculadoraSimulada {
    public function somar($numeros) {
        if (count($numeros) == 3) {
            return "Soma de 3 números: " . ($numeros[0] + $numeros[1] + $numeros[2]);
        } else {
            return "Informe exatamente 3 números.";
        }
    }
}


$calc2 = new CalculadoraDoisNumeros();
echo $calc2->somar([2, 3]) . "\n"; 

$calc3 = new CalculadoraTresNumeros();
echo $calc3->somar([1, 2, 3]) . "\n";
