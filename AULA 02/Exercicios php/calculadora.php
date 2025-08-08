<?php

// Calculadora Simples com switch case

$numero1 = (float) readline("Digite o primeiro número: ");
$numero2 = (float) readline("Digite o segundo número: ");
$operacao = readline("Digite a operação (+, -, *, /): ");
switch ($operacao) {
    case '+':
        $resultado = $numero1 + $numero2;
        echo "Resultado: $resultado";
        break;
    case '-':
        $resultado = $numero1 - $numero2;
        echo "Resultado: $resultado";
        break;
    case '*':
        $resultado = $numero1 * $numero2;
        echo "Resultado: $resultado";
        break;
    case '/':
}



