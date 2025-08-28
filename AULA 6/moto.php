<?php
// Exercício 1
class Moto {
    public $marca;
    public $modelo;
    public $ano;
    public $cor;
}

// Exercício 2
$moto1 = new Moto();
$moto1->marca = "Honda";
$moto1->modelo = "CG 160";
$moto1->ano = 2020;
$moto1->cor = "Preta";

$moto2 = new Moto();
$moto2->marca = "Yamaha";
$moto2->modelo = "Fazer 250";
$moto2->ano = 2022;
$moto2->cor = "Azul";

$moto3 = new Moto();
$moto3->marca = "Suzuki";
$moto3->modelo = "Yes 125";
$moto3->ano = 2018;
$moto3->cor = "Vermelha";


/* 
Exercício 3

    // 1_construtor: dia, mes, ano
    function __construct($dia, $mes, $ano) {
        $this->dia = $dia;
        $this->mes = $mes;
        $this->ano = $ano;
    }

    // 2_construtor: nome, idade, cpf, telefone, endereco, estado_civil, sexo
    function __construct2($nome, $idade, $cpf, $telefone, $endereco, $estado_civil, $sexo) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->estado_civil = $estado_civil;
        $this->sexo = $sexo;
    } 

    // 3_construtor: marca, nome, categoria, data_fabricacao, data_venda
    function __construct3($marca, $nome, $categoria, $data_fabricacao, $data_venda) {
        $this->marca = $marca;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->data_fabricacao = $data_fabricacao;
        $this->data_venda = $data_venda;
    }
}
*/
?>
