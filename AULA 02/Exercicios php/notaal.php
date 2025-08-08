<?php
// Classificar Nota
$nota1 = (float) readline (prompt: "Digite sua primeira nota: ");
$nota2 = (float) readline (prompt: "Digite sua segunda nota: ");
$media = ($nota1 * $nota2) / 2;
if ($media >= 9) {
    echo "Excelente";
} elseif ($media >= 7) {
    echo "Nota boa: $media";
} else {
 echo "Reprovado: $media";
}