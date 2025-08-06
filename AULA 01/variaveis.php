
<?php 
$exerc2= "Programação em php";
echo "\nMinúsculo: ", $exerc2;
$exerc2= strtoupper(string: $exerc2);
echo "\nMaiúsculo: ", $exerc2;
$exerc2= strtolower(string: $exerc2);
echo "\nMinúsculo", $exerc2;
?>

/* 3.
<?php
$exerc3 = "O PHP foi criado em mil novecentos e noventa e cinco";
echo "\nAntes do comando replace: \n", $exerc3;
$exerc3 = str_replace(search: ['o', 'a', 'i'], replace: ['0', '4', '1'], subject: $exerc3);
echo "\nApós o comando replace: \n", $exerc3;
?>