<?php

//Polimorfismo

// O termo Polimorfismo significa "várias formas". Associando isso a Programmação orientada a objetos, o conceito se tratade varias classes e suas instâncias (objetos) respondendo a um mesmo método de formas diferentes. No exemplo do Interface da Aula_09, temos um método calcularArea() que corresponde de forma diferente á classe quadrado, pentago e circulo. Isso quer dizer que a função é a mesma - clacular a area da forma geométrica - mas a operação muda de acordo com a figura

// Crie um metodo mover(), onde ele responde de varias formas diferentes, para as classes: Carro, Avião, Barco e Elevador

namespace AULA_10;

interface polimorfismo
{
    public function mover();

}
class Carro implements polimorfismo
{
    public $nome;
    public function mover()
    {
        echo "O carro {$this->nome} está andando em Limeira City!!\n";
    }    
}

class Aviao implements polimorfismo
{
    public function mover()
    {
        echo "O avião está voando em direção as torres gêmeas!!\n";
    }
}

class Barco implements polimorfismo
{
    public function mover()
    {
        echo "O barco está navegando!!\n";
    }
}

class Elevador implements polimorfismo
{
    public function mover()
    {
        echo "O elevador está subindo e descendo!!\n";
    }
}

// crie ao menos objetos para testar cada classe
$carro1 = new Carro();
$carro1->nome = "Chevette";
$carro1->mover();
$aviao = new Aviao();
$aviao->mover();
$barco = new Barco();
$barco->mover();
$elevador = new Elevador();
$elevador->mover();