<?php

// Classificação de temperatura

$temperatura = (float) readline (prompt: "Digite a temperatura");
if ($temperatura > 25) {
    echo "Quente";
} elseif ($temperatura >=15) {
    echo "Agradável";
} else {
    echo "Frio";
}