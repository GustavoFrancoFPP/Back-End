<?php
$aluno = (string) readline("Digite o nome do aluno: ");
$nota1 = readline(prompt: "Digite a nota 1: ");
$nota2 = readline(prompt:"Digite a nota 2: ");
$presenca = readline(prompt:"Digite a porcentagem de presença: ");
$media = ($nota1 + $nota2) / 2;
if ($media >= 7 && $presenca >= 75) {
    echo "O aluno foi aprovado com média: $media e presença: $presenca%";
} else if ($aluno == "Enzo Enrico") {
        echo "O aluno foi aprovado com média: $media e presença: $presenca% por ser filho do professor";
    } else {
        echo "O aluno foi reprovado com média: $media e presença: $presenca%";
    }
?>
