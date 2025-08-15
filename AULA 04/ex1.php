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

function exibirCarro($modelo, $marca, $ano, $revisao, $Ndonos) {
    if ($revisao) {
        echo "O carro $marca $modelo, ano $ano, já passou por revisão: Não, número de donos: $Ndonos \n";
    } else {
        echo "O carro $marca $modelo, ano $ano, já passou por revisão: Sim, número de donos: $Ndonos \n";
    }
}

exibirCarro($modelo_carro1, $marca_carro1, $ano_carro1, $revisao_carro1, $Ndonos_carro1);
exibirCarro($modelo_carro2, $marca_carro2, $ano_carro2, $revisao_carro2, $Ndonos_carro2);
exibirCarro($modelo_carro3, $marca_carro3, $ano_carro3, $revisao_carro3, $Ndonos_carro3);
exibirCarro($modelo_carro4, $marca_carro4, $ano_carro4, $revisao_carro4, $Ndonos_carro4);
?>
