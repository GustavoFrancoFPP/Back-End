<?php

    // Modificadores de acesso:
    
    //Existem 3 tipos: Public, Private e Protected
    
    // pùblic nomedoatributo: métodos e atributos publlicos

    // Privae nome do atributo: metodos e atributos privados para acesso somente dentro da classe. Utilizamos os getters e setters para acesalos
   
    // Protected nome do atributo: metodos e atributos protegidos para somente da classes e de suas classes filhas 
    
    //Pacotes: sintaxe log no inicio do codigo, que atribui de onde os arquivos pertencem, ou seja, o caminho da pastta em ele esta contido ex:
    
    // namespace AULA09;
    
    // caso tenham mais arquivos que formam o BackEnd de uma pagina web e possuem a mesma raiz, o name space será o mesmo

    namespace AULA_09;

interface Pagamento {
    public function pagar($valor);
}

class CartaoDeCredito implements Pagamento {
    public function pagar($valor) {
        echo "pagamento realizado com cartao de crédito no valor: $valor\n";
    }
}

class PIX implements Pagamento {
    public function pagar($valor) {
        echo "Pagamento realizado via PIX, valor: $valor/n";
    }
}

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


class Circulo implements Forma {
    private $raio;
    public function __construct($raio) {
        $this->raio = $raio;
    }
    public function calcularArea() {
        return pi() * ($this->raio * $this->raio);
    }
}


class Pentagono {
    private $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea() {
        $area = (sqrt(5 * (5 + 2 * sqrt(5))) * pow($this->lado, 2)) / 4;
        return $area;
    }
}

class Hexagono implements Forma {
    private $lado;
    public function __construct($lado) {
        $this->lado = $lado;   
    }

    public function calcularArea() {
        $area = (3 * sqrt(3) * ($this->lado * $this->lado)) / 2;
        return number_format($area, 2);
    }
}

$lado = readline("Digite o lado do quadrado: ");
$quadrado = new Quadrado($lado);

$raio = readline("Digite o raio do círculo: ");
$circulo = new Circulo($raio);

echo "A área do quadrado é: " . $quadrado->calcularArea() . "\n";
echo "A área do círculo é: " . $circulo->calcularArea() . "\n";

$pentagono = new Pentagono(10);
$hexagono = new Hexagono(8);

$areaPentagono = $pentagono->calcularArea();
echo "Área do Pentágono: " . number_format($areaPentagono, 2) . "\n";

$areaHexagono = $hexagono->calcularArea();
echo "Área do Hexágono: " . $areaHexagono . "\n";