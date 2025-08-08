<?php

// Contagem regressiva

$contagem = (int) readline (prompt: "DIgite um número");
for ($i = $contagem; $i >= 0; $i--) {
    echo "$i ";
}