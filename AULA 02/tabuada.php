<?php

// Tabuada

$numero = (int) readline(prompt: "Digite um numero para ver a tabuada: ");
for ($i = 1; $i <= 10; $i++) {
    $resultado = $numero * $i;
    echo "$numero x $i = $resultado\n";
}