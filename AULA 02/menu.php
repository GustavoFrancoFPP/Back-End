<?php

// Menu interativo
for ($i = 0; $i < 6; $i++) {
echo "Escolha uma opção:";
echo "1.";
echo "2.";
echo "3.";

switch (readline (prompt: "Digite sua opção: ")) {
    case 1:
        echo "Olá";
        break;
    case 2:
        echo date('d/m/Y');
        break;
    case 3:
        echo "Sair";

} 
}