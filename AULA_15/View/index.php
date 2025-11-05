<?php
require_once __DIR__ . '/../Controller/BebidaController.php';

$controller = new BebidaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
    } elseif ($_POST['acao'] === 'deletar') {
        $controller->deletar($_POST['nome']);
    }
}

$lista = $controller->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de bebidas</title>
     <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: white;
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }
            to {
                text-shadow: 2px 2px 20px rgba(255,255,255,0.4);
            }
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }

        .form-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        input, select {
            padding: 15px;
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: scale(1.02);
        }

        button[type="submit"] {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        button[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s ease;
        }

        tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .btn-excluir {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
        }

        .btn-excluir:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.5);
        }

        .empty-message {
            text-align: center;
            color: #666;
            font-size: 1.2rem;
            padding: 40px;
            background: white;
            border-radius: 15px;
            margin: 20px 0;
        }

        hr {
            border: none;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
            margin: 30px 0;
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.6s ease-out;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .form-group {
                grid-template-columns: 1fr;
            }
            
            table {
                font-size: 14px;
            }
            
            th, td {
                padding: 10px 5px;
            }
        }

        /* Efeitos de partículas no fundo */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    </style>
</head>
<body>
<h1>Gerenciamento de bebidas</h1>
<br>
<hr>

<h2>Cadastrar Nova Bebida</h2>
<form method="POST">
    <input type="hidden" name="acao" value="salvar">
    <input type="text" name="nome" placeholder="Nome da bebida:" required>
    <select name="categoria" required>
        <option value="">Selecione a categoria</option>
        <option value="Refrigerante">Refrigerante</option>
        <option value="Cerveja">Cerveja</option>
        <option value="Vinho">Vinho</option>
        <option value="Destilado">Destilado</option>
        <option value="Água">Água</option>
        <option value="Suco">Suco</option>
        <option value="Energético">Energético</option>
    </select>
    <input type="text" name="volume" placeholder="Volume (ex: 300ml):" required>
    <input type="number" name="valor" step="0.01" placeholder="Valor em Reais (R$):" required>
    <input type="number" name="qtde" placeholder="Quantidade em estoque:" required>
    <button type="submit">Cadastrar</button>
</form>

<hr>
<h2>Bebidas Cadastradas</h2>
<?php if (!empty($lista)): ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Volume</th>
                <th>Valor (R$)</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $bebida): ?>
            <tr>
                <td><?= htmlspecialchars($bebida->getNome()) ?></td>
                <td><?= htmlspecialchars($bebida->getCategoria()) ?></td>
                <td><?= htmlspecialchars($bebida->getVolume()) ?></td>
                <td>R$ <?= number_format($bebida->getValor(), 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($bebida->getQtde()) ?></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="nome" value="<?= ($bebida->getNome()) ?>">
                        <button type="submit" class="btn-excluir" 
                                onclick="return confirm('Tem certeza que deseja excluir <?= ($bebida->getNome()) ?>?')">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma bebida cadastrada.</p>
<?php endif; ?>

</body>
</html>