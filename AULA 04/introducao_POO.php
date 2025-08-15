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
$marca_carro1="Porsche";
$ano_carro1=2026;
$revisao_carro1=false;
$Ndonos_carro3=1;

$modelo_carro4="Dolphin";
$marca_carro4="BYD";
$ano_carro4=2023;
$revisao_carro4=true;
$Ndonos_carro4=1;


function passouRevisao ($revisaoF): bool{
    $revisaoF=false;
    return $revisaoF;
}
$revisao_carro4 = passouRevisao(revisaoF: $revisao_carro4);

function novoDono($donos): int{                 
    return $donos + 1;
}

$Ndonos_carro4 = novoDono($Ndonos_carro4)

?>