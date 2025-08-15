
<?php
$valor1 = readline (prompt: "DIgite o primeiro valor: ");
$valor2 = readline (prompt:"Digite o segundo valor: ");
if (gettype($valor1) === gettype($valor2)) {
    echo "Variáveis de tipos iguais! Primeiro valor do tipo " . gettype($valor1) .
     " e segundo valor do tipo " . gettype($valor2) . ".";
} else {
    echo "ERRO! Variáveis de tipos diferentes. Primeiro valor do tipo " .
     gettype($valor1) . " e segundo valor do tipo " . gettype($valor2) . ".";
}
?>
