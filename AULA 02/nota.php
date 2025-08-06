<?php
$aluno = 'Enzo Enrico';
$nota1 = 2;
$nota2 = 3;
$presenca = 48;
$media = ($nota1 + $nota2) / 2;
if ($media >= 7 && $presenca >= 75) {
    echo "O aluno foi aprovado com média: $media e presença: $presenca%";
} else if ($aluno == "Enzo Enrico") {
        echo "O aluno foi aprovado com média: $media e presença: $presenca% por ser filho do professor";
    } else {
        echo "O aluno foi reprovado com média: $media e presença: $presenca%";
    }
?>
