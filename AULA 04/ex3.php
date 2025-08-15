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

function precisaRevisao($revisao, $ano) {
    if ($revisao == false && $ano < 2022) {
        return "Precisa de revisão";
    } else {
        return "Revisão em dia";
    }
}

echo "O carro $marca_carro1 $modelo_carro1, ano $ano_carro1, " . precisaRevisao($revisao_carro1, $ano_carro1) . "\n";
echo "O carro $marca_carro2 $modelo_carro2, ano $ano_carro2, " . precisaRevisao($revisao_carro2, $ano_carro2) . "\n";
echo "O carro $marca_carro3 $modelo_carro3, ano $ano_carro3, " . precisaRevisao($revisao_carro3, $ano_carro3) . "\n";
echo "O carro $marca_carro4 $modelo_carro4, ano $ano_carro4, " . precisaRevisao($revisao_carro4, $ano_carro4) . "\n";