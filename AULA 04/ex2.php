<?php
$modelo_carro1="versa";
$marca_carro1="nissan";
$ano_carro1=2020;
$revisao_carro1=true;
$Ndonos_carro1=2;

$modelo_carro2="M5";
$marca_carro2="BMW";
$ano_carro2=2018;
$revisao_carro2=false;
$Ndonos_carro2=2;

$modelo_carro3=911;
$marca_carro3="Porsche";
$ano_carro3=2026;
$revisao_carro3=false;
$Ndonos_carro3=1;

$modelo_carro4="Dolphin";
$marca_carro4="BYD";
$ano_carro4=2023;
$revisao_carro4=true;
$Ndonos_carro4=1;

    function ehSeminovo($ano) {
        $dataAtual = date("Y");
        if ($ano < $dataAtual - 3) {
            return "False";
        } else {
            return "True";
        }
    }
    echo "O carro $marca_carro1 $modelo_carro1 é seminovo? " . ehSeminovo($ano_carro1) . "\n";
    echo "O carro $marca_carro2 $modelo_carro2 é seminovo? " . ehSeminovo($ano_carro2) . "\n";
    echo "O carro $marca_carro3 $modelo_carro3 é seminovo? " . ehSeminovo($ano_carro3) . "\n";
    echo "O carro $marca_carro4 $modelo_carro4 é seminovo? " . ehSeminovo($ano_carro4) . "\n";
?>
