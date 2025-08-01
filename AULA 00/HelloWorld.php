<?php
echo "Salve, parças!\n";

date_default_timezone_set("America/Sao_Paulo");
$hora = date("H:i");
echo "Agora são $hora horas no rolê!\n";

$nome = "Papaizinho";
echo "Seja bem-vindo, $nome! Cola com nóis que é sucesso! 🔥\n";

$frases = [
    "Nunca foi sorte, sempre foi código! 💻\n",
    "Quem não corre, rasteja. 🚀\n",
    "Código limpo, mente tranquila.\n",
    "Se falhou hoje, amanhã compila!\n",
    "Errar é humano, debugar é divino.\n"
];

$fraseAleatoria = $frases[array_rand($frases)];
echo "Dica do dia:   $fraseAleatoria";
?>
