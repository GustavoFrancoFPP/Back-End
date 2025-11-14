<?php
require_once __DIR__ . '/../Controller/BebidaController.php';

$controller = new BebidaController();

// Variáveis para o formulário de edição
$editando = false;
$bebidaEditando = null;

// Primeiro verifica se está editando via GET
if (isset($_GET['editar'])) {
    $editando = true;
    $bebidaEditando = $controller->getBebida($_GET['editar']);
}

// Verificar se está cancelando edição
if (isset($_GET['cancelar'])) {
    $editando = false;
    $bebidaEditando = null;
}

// Processar POST - deve vir DEPOIS da verificação do GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
    } elseif ($_POST['acao'] === 'atualizar') {
        $success = $controller->atualizar($_POST['nome_antigo'], $_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
        // Se atualizou com sucesso, volta para modo de cadastro
        if ($success) {
            $editando = false;
            $bebidaEditando = null;
        }
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
    <title>Bar Management - Sistema de Bebidas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #8B4513; /* Marrom madeira */
            --secondary: #D4AF37; /* Dourado */
            --accent: #C41E3A; /* Vermelho vinho */
            --light: #F5F5DC; /* Bege */
            --dark: #2C1810; /* Marrom escuro */
            --success: #27AE60; /* Verde */
            --danger: #E74C3C; /* Vermelho */
            --text: #2C1810;
            --text-light: #8C7B6B;
        }

        body {
            font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .header h1 {
            color: var(--secondary);
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
            letter-spacing: 2px;
        }

        .header-subtitle {
            color: var(--light);
            font-size: 1.2rem;
            font-weight: 300;
            opacity: 0.9;
        }

        .header-decoration {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            opacity: 0.7;
        }

        .header-decoration span {
            font-size: 2rem;
            color: var(--secondary);
        }

        /* Card Styles */
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            margin: 30px 0;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            border: 1px solid rgba(212, 175, 55, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--accent), var(--primary));
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light);
        }

        .section-header h2 {
            color: var(--primary);
            font-size: 2.2rem;
            font-weight: 600;
            margin: 0;
        }

        .section-icon {
            font-size: 2rem;
            color: var(--secondary);
        }

        /* Edit Mode Header */
        .edit-header {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            border: 2px solid var(--secondary);
            position: relative;
            animation: pulse 2s infinite;
        }

        .edit-header h2 {
            color: var(--secondary);
            font-size: 2rem;
            margin: 0;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        /* Form Styles */
        .form-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-input {
            position: relative;
        }

        .form-input input, 
        .form-input select {
            width: 100%;
            padding: 18px 20px;
            border: 2px solid #E8E8E8;
            border-radius: 12px;
            font-size: 16px;
            font-family: inherit;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-input input:focus, 
        .form-input select:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
            transform: scale(1.02);
        }

        .form-input label {
            position: absolute;
            left: 20px;
            top: -10px;
            background: white;
            padding: 0 10px;
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 500;
        }

        /* Button Styles */
        .button-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 18px 35px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary), #B8860B);
            color: var(--dark);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--primary), #654321);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #C0392B);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #229954);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, var(--primary), var(--dark));
        }

        th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border-bottom: 3px solid var(--secondary);
        }

        td {
            padding: 20px;
            border-bottom: 1px solid #F0F0F0;
            transition: all 0.3s ease;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.1), transparent);
            transform: scale(1.01);
        }

        .category-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-refrigerante { background: #3498DB; color: white; }
        .badge-cerveja { background: #F39C12; color: white; }
        .badge-vinho { background: #C41E3A; color: white; }
        .badge-destilado { background: #8B4513; color: white; }
        .badge-agua { background: #85C1E9; color: white; }
        .badge-suco { background: #27AE60; color: white; }
        .badge-energético { background: #E74C3C; color: white; }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 10px 16px;
            font-size: 0.85rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-small.btn-primary {
            background: linear-gradient(135deg, var(--secondary), #B8860B);
            color: var(--dark);
        }

        .btn-small.btn-danger {
            background: linear-gradient(135deg, var(--danger), #C0392B);
            color: white;
        }

        .btn-small:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--text-light);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .form-group {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 12px 8px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .card {
                padding: 25px;
                margin: 20px 0;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .form-input input, 
            .form-input select {
                padding: 15px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark);
        }

        /* Status indicators */
        .stock-high { color: var(--success); font-weight: 600; }
        .stock-medium { color: #F39C12; font-weight: 600; }
        .stock-low { color: var(--danger); font-weight: 600; }

        /* Form styles for inline forms */
        form[style*="display: inline"] {
            display: inline !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🍷 Bar Management</h1>
        <p class="header-subtitle">Sistema profissional de gerenciamento de bebidas</p>
        <div class="header-decoration">
            <span>🍺</span>
            <span>🥃</span>
            <span>🍸</span>
            <span>🍹</span>
            <span>🍷</span>
        </div>
    </div>

    <?php if ($editando && $bebidaEditando): ?>
        <div class="edit-header pulse">
            <h2>✏️ Editando: <?= htmlspecialchars($bebidaEditando->getNome()) ?></h2>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="section-header">
            <span class="section-icon"><?= $editando ? '✏️' : '➕' ?></span>
            <h2><?= $editando ? 'Editar Bebida' : 'Cadastrar Nova Bebida' ?></h2>
        </div>

        <form method="POST">
            <?php if ($editando && $bebidaEditando): ?>
                <input type="hidden" name="acao" value="atualizar">
                <input type="hidden" name="nome_antigo" value="<?= htmlspecialchars($bebidaEditando->getNome()) ?>">
            <?php else: ?>
                <input type="hidden" name="acao" value="salvar">
            <?php endif; ?>

            <div class="form-group">
                <div class="form-input">
                    <label for="nome">Nome da Bebida</label>
                    <input type="text" name="nome" id="nome" placeholder="Ex: Whisky Johnnie Walker" required
                           value="<?= $editando ? htmlspecialchars($bebidaEditando->getNome()) : '' ?>">
                </div>
                
                <div class="form-input">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria" required>
                        <option value="">Selecione a categoria</option>
                        <option value="Refrigerante" <?= ($editando && $bebidaEditando->getCategoria() == 'Refrigerante') ? 'selected' : '' ?>>Refrigerante</option>
                        <option value="Cerveja" <?= ($editando && $bebidaEditando->getCategoria() == 'Cerveja') ? 'selected' : '' ?>>Cerveja</option>
                        <option value="Vinho" <?= ($editando && $bebidaEditando->getCategoria() == 'Vinho') ? 'selected' : '' ?>>Vinho</option>
                        <option value="Destilado" <?= ($editando && $bebidaEditando->getCategoria() == 'Destilado') ? 'selected' : '' ?>>Destilado</option>
                        <option value="Água" <?= ($editando && $bebidaEditando->getCategoria() == 'Água') ? 'selected' : '' ?>>Água</option>
                        <option value="Suco" <?= ($editando && $bebidaEditando->getCategoria() == 'Suco') ? 'selected' : '' ?>>Suco</option>
                        <option value="Energético" <?= ($editando && $bebidaEditando->getCategoria() == 'Energético') ? 'selected' : '' ?>>Energético</option>
                    </select>
                </div>
                
                <div class="form-input">
                    <label for="volume">Volume</label>
                    <input type="text" name="volume" id="volume" placeholder="Ex: 750ml, 1L, 350ml" required
                           value="<?= $editando ? htmlspecialchars($bebidaEditando->getVolume()) : '' ?>">
                </div>
                
                <div class="form-input">
                    <label for="valor">Valor (R$)</label>
                    <input type="number" name="valor" id="valor" step="0.01" placeholder="0.00" required
                           value="<?= $editando ? $bebidaEditando->getValor() : '' ?>">
                </div>
                
                <div class="form-input">
                    <label for="qtde">Quantidade em Estoque</label>
                    <input type="number" name="qtde" id="qtde" placeholder="0" required
                           value="<?= $editando ? $bebidaEditando->getQtde() : '' ?>">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn <?= $editando ? 'btn-success' : 'btn-primary' ?>">
                    <?= $editando ? '💾 Atualizar Bebida' : '✅ Cadastrar Bebida' ?>
                </button>
                
                <?php if ($editando): ?>
                    <a href="?cancelar=1" class="btn btn-secondary">❌ Cancelar Edição</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="section-header">
            <span class="section-icon">📋</span>
            <h2>Estoque de Bebidas</h2>
        </div>

        <?php if (!empty($lista)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Bebida</th>
                            <th>Categoria</th>
                            <th>Volume</th>
                            <th>Valor</th>
                            <th>Estoque</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista as $bebida): 
                            $stockClass = '';
                            if ($bebida->getQtde() > 50) $stockClass = 'stock-high';
                            elseif ($bebida->getQtde() > 10) $stockClass = 'stock-medium';
                            else $stockClass = 'stock-low';
                        ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($bebida->getNome()) ?></strong></td>
                            <td>
                                <span class="category-badge badge-<?= strtolower($bebida->getCategoria()) ?>">
                                    <?= htmlspecialchars($bebida->getCategoria()) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($bebida->getVolume()) ?></td>
                            <td><strong>R$ <?= number_format($bebida->getValor(), 2, ',', '.') ?></strong></td>
                            <td class="<?= $stockClass ?>"><?= htmlspecialchars($bebida->getQtde()) ?> unidades</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="?editar=<?= urlencode($bebida->getNome()) ?>" class="btn-small btn-primary">
                                        ✏️ Editar
                                    </a>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="acao" value="deletar">
                                        <input type="hidden" name="nome" value="<?= htmlspecialchars($bebida->getNome()) ?>">
                                        <button type="submit" class="btn-small btn-danger" 
                                                onclick="return confirm('Tem certeza que deseja excluir <?= htmlspecialchars($bebida->getNome()) ?>?')">
                                            🗑️ Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="icon">🍷</div>
                <h3>Nenhuma bebida cadastrada</h3>
                <p>Comece adicionando sua primeira bebida ao estoque</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Adiciona uma animação suave ao carregar a página
    document.addEventListener('DOMContentLoaded', function() {
        // Animação para os cards
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Efeito de foco nos inputs
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    });
</script>
</body>
</html>