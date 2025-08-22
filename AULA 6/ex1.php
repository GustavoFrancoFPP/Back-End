<?php

class produto {
    public $nome;
    public $categoria;
    public $fornecedor;
    public $qtde_estoque;
}
$bolacha = new produto();
$bolacha1 -> nome = "Nikito";
$bolacha1 -> fornecedor = "Vitarella";
$bolacha1 -> qtde_estoque = 220;

$feijao = new produto();
$feijao1 -> nome = "Oliron";
$feijao1 -> categoria = "Mantimentos";
$feijao1 -> fornecedor = "Reserva Nobre";
$feijao1 -> qtde_estoque = 123;

$refrigerante = new produto();
$refrigerante1 -> nome = "Pepsi";
$refrigerante1 -> categoria = "Mantimentos";
$refrigerante1 -> fornecedor = "PepsiCo";
$refrigerante1 -> qtde_estoque = 5000;
