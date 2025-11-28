<?php
// DEIXE SEMPRE ESTAS LINHAS NO TOPO PARA DEBUG
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// PATHS CORRETOS
require_once __DIR__ . '/../Model/Connection.php';
require_once __DIR__ . '/../Model/Livros.php';
require_once __DIR__ . '/../Model/LivroDAO.php';
require_once __DIR__ . '/../Controller/LivroController.php';

$controller = new LivroController();
$mensagem = '';
$tipoMensagem = ''; // success ou error

// Processa as ações POST do formulário (CRUD operations)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trata o campo de gênero (select ou input personalizado)
    $genero = $_POST['genero'];
    if ($genero === 'Outro' && !empty($_POST['outroGenero'])) {
        $genero = $_POST['outroGenero'];
    }
    
    if ($_POST['acao'] === 'salvar') {
        // Cria um novo livro
        $resultado = $controller->criar($_POST['titulo'], $_POST['autor'], $_POST['ano'], $genero, $_POST['quantidade']);
        if ($resultado['success']) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=' . urlencode($resultado['message']));
            exit;
        } else {
            $mensagem = $resultado['message'];
            $tipoMensagem = 'error';
        }
    } elseif ($_POST['acao'] === 'deletar') {
        // Remove um livro existente
        $resultado = $controller->deletar($_POST['titulo']);
        if ($resultado['success']) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=' . urlencode($resultado['message']));
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?error=' . urlencode($resultado['message']));
        }
        exit;
    } elseif ($_POST['acao'] === 'atualizar') {
        // Atualiza os dados de um livro
        $resultado = $controller->atualizar(
            $_POST['tituloOriginal'],
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['ano'],
            $genero,
            $_POST['quantidade']
        );
        if ($resultado['success']) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=' . urlencode($resultado['message']));
            exit;
        } else {
            $mensagem = $resultado['message'];
            $tipoMensagem = 'error';
        }
    }
}

// Verifica mensagens via GET (após redirect)
if (isset($_GET['success'])) {
    $mensagem = $_GET['success'];
    $tipoMensagem = 'success';
} elseif (isset($_GET['error'])) {
    $mensagem = $_GET['error'];
    $tipoMensagem = 'error';
}

// Prepara livro para edição quando acionado o botão editar
$livroParaEditar = null;
if (isset($_POST['acao']) && $_POST['acao'] === 'editar') {
    foreach ($controller->ler() as $livro) {
        if ($livro->getTitulo() === $_POST['titulo']) {
            $livroParaEditar = $livro;
            break;
        }
    }
}

// Carrega a lista de livros para exibição
$lista = $controller->ler();
$categorias = Livro::getCategorias();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro e Gerenciamento de Livros da Biblioteca Escolar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            padding: 20px;
        }

        /* Estilos para mensagens de alerta */
.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .card h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5rem;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input, .form-group select {
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-edit {
            background: #ffc107;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-edit:hover, .btn-delete:hover, .btn-cancel:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        .actions form {
            margin: 0;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 10px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Sistema de Biblioteca Escolar</h1>
            <p>Cadastro e gerenciamento de acervo literário</p>
        </div>

        <?php if ($mensagem): ?>
            <div class="alert alert-<?php echo $tipoMensagem; ?>" id="mensagemAlerta">
                <?php echo htmlspecialchars($mensagem); ?>
            </div>
            <script>
                // Remove a mensagem automaticamente após o tempo apropriado
                const tempoRemocao = <?php echo $tipoMensagem === 'success' ? 5000 : 0; ?>;
                if (tempoRemocao > 0) {
                    setTimeout(function() {
                        const alerta = document.getElementById('mensagemAlerta');
                        if (alerta) {
                            alerta.style.transition = 'opacity 0.5s ease-out';
                            alerta.style.opacity = '0';
                            setTimeout(function() {
                                alerta.remove();
                            }, 500);
                        }
                    }, tempoRemocao);
                }
            </script>
        <?php endif; ?>

        <!-- Formulário de Cadastro/Edição -->
        <div class="card">
            <h2><?php echo $livroParaEditar ? '✏️ Editar Livro' : '➕ Cadastrar Novo Livro'; ?></h2>
            <form method="POST" id="livroForm">
                <?php if ($livroParaEditar): ?>
                    <input type="hidden" name="tituloOriginal" value="<?php echo $livroParaEditar->getTitulo(); ?>">
                    <input type="hidden" name="acao" value="atualizar">
                <?php else: ?>
                    <input type="hidden" name="acao" value="salvar">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="titulo">Título do Livro</label>
                        <input type="text" id="titulo" name="titulo" 
                               value="<?php echo $livroParaEditar ? $livroParaEditar->getTitulo() : ''; ?>" 
                               required placeholder="Digite o título">
                    </div>
                    
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" id="autor" name="autor" 
                               value="<?php echo $livroParaEditar ? $livroParaEditar->getAutor() : ''; ?>" 
                               required placeholder="Nome do autor">
                    </div>
                    
                    <div class="form-group">
                        <label for="ano">Ano de Publicação</label>
                        <input type="number" id="ano" name="ano" 
                               value="<?php echo $livroParaEditar ? $livroParaEditar->getAnoPublicacao() : ''; ?>" 
                               required min="1000" max="2030" placeholder="Ex: 2024">
                    </div>
                    
                    <div class="form-group">
                        <label for="genero">Gênero/Categoria</label>
                        <select id="genero" name="genero" required>
                            <option value="">Selecione uma categoria</option>
                            <?php
                            $generoAtual = $livroParaEditar ? $livroParaEditar->getGenero() : '';
                            $isOutro = !in_array($generoAtual, $categorias) && $generoAtual;
                            
                            foreach ($categorias as $categoria): 
                                $selected = ($generoAtual === $categoria) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $categoria; ?>" <?php echo $selected; ?>>
                                    <?php echo $categoria; ?>
                                </option>
                            <?php endforeach; ?>
                            
                            <option value="Outro" <?php echo $isOutro ? 'selected' : ''; ?>>
                                Outro
                            </option>
                        </select>
                    </div>
                    
                    <!-- Campo para categoria personalizada -->
                    <div class="form-group" id="outroGeneroGroup" style="display: <?php echo $isOutro ? 'block' : 'none'; ?>;">
                        <label for="outroGenero">Especifique a categoria</label>
                        <input type="text" id="outroGenero" name="outroGenero" 
                               value="<?php echo $isOutro ? $generoAtual : ''; ?>" 
                               placeholder="Digite a categoria personalizada">
                    </div>
                    
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" id="quantidade" name="quantidade" 
                               value="<?php echo $livroParaEditar ? $livroParaEditar->getQuantidade() : ''; ?>" 
                               required min="1" placeholder="Ex: 5">
                    </div>
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $livroParaEditar ? '📝 Atualizar Livro' : '💾 Cadastrar Livro'; ?>
                    </button>
                    
                    <?php if ($livroParaEditar): ?>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-cancel">❌ Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Lista de Livros -->
        <div class="card">
            <h2>📖 Acervo de Livros (<?php echo count($lista); ?>)</h2>
            
            <?php if (count($lista) > 0): ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Ano</th>
                                <th>Gênero</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista as $livro): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($livro->getTitulo()); ?></strong></td>
                                    <td><?php echo htmlspecialchars($livro->getAutor()); ?></td>
                                    <td><?php echo $livro->getAnoPublicacao(); ?></td>
                                    <td><?php echo htmlspecialchars($livro->getGenero()); ?></td>
                                    <td><?php echo $livro->getQuantidade(); ?></td>
                                    <td>
                                        <div class="actions">
                                            <form method="POST">
                                                <input type="hidden" name="acao" value="editar">
                                                <input type="hidden" name="titulo" value="<?php echo $livro->getTitulo(); ?>">
                                                <button type="submit" class="btn btn-edit">✏️ Editar</button>
                                            </form>
                                            <form method="POST">
                                                <input type="hidden" name="acao" value="deletar">
                                                <input type="hidden" name="titulo" value="<?php echo $livro->getTitulo(); ?>">
                                                <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este livro?')">🗑️ Excluir</button>
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
                    <div>📚</div>
                    <h3>Nenhum livro cadastrado</h3>
                    <p>Comece cadastrando o primeiro livro no formulário acima.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Mostra/oculta campo de categoria personalizada
        document.getElementById('genero').addEventListener('change', function() {
            const outroGroup = document.getElementById('outroGeneroGroup');
            const outroInput = document.getElementById('outroGenero');
            
            if (this.value === 'Outro') {
                outroGroup.style.display = 'block';
                outroInput.required = true;
            } else {
                outroGroup.style.display = 'none';
                outroInput.required = false;
                outroInput.value = '';
            }
        });

        // Validação do formulário
        document.getElementById('livroForm').addEventListener('submit', function(e) {
            const generoSelect = document.getElementById('genero');
            const outroInput = document.getElementById('outroGenero');
            
            // Se selecionou "Outro" mas não preencheu o campo
            if (generoSelect.value === 'Outro' && !outroInput.value.trim()) {
                e.preventDefault();
                alert('Por favor, especifique a categoria personalizada.');
                outroInput.focus();
            }
        });
    </script>
</body>
</html>