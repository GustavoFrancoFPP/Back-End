<?php
$modelo_carro1="versa";
$marca_carro1="nissan";
$ano_carro1=2020;
$revisao_carro1=true;
$Ndonos_carro1=2;
$vbase_carro1=70000;

$modelo_carro2="M5";
$marca_carro2="BMW";
$ano_carro2=2018;
$revisao_carro2=false;
$Ndonos_carro2=2;
$vbase_carro2= 300000;

$modelo_carro3=911;
$marca_carro3="Porsche";
$ano_carro3=2026;
$revisao_carro3=false;
$Ndonos_carro3=1;
$vbase_carro3= 300000;

$modelo_carro4="Dolphin";
$marca_carro4="BYD";
$ano_carro4=2023;
$revisao_carro4=true;
$Ndonos_carro4=1;
$vbase_carro4= 150000;

function calcularValor($vbase, $ano, $Ndonos) {
    $anoAtual = date("Y");
    $anosDeUso = $anoAtual - $ano;
    $valorFinal = $vbase - ($anosDeUso * 3000);

    if ($Ndonos >= 1) {
        $desconto = $Ndonos * 0.05; // Se o primeiro dono não contar para desconto basta usar ($Ndonos - 1) * 0.05
        $valorFinal -= $valorFinal * $desconto;
    }

    return $valorFinal;
}

echo "O carro $marca_carro1 $modelo_carro1, ano $ano_carro1, valor: R$" . calcularValor($vbase_carro1, $ano_carro1, $Ndonos_carro1) . "\n";
echo "O carro $marca_carro2 $modelo_carro2, ano $ano_carro2, valor: R$" . calcularValor($vbase_carro2, $ano_carro2, $Ndonos_carro2) . "\n";
echo "O carro $marca_carro3 $modelo_carro3, ano $ano_carro3, valor: R$" . calcularValor($vbase_carro3, $ano_carro3, $Ndonos_carro3) . "\n";
echo "O carro $marca_carro4 $modelo_carro4, ano $ano_carro4, valor: R$" . calcularValor($vbase_carro4, $ano_carro4, $Ndonos_carro4) . "\n";
