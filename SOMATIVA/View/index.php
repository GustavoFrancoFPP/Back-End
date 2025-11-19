<?php
require_once __DIR__ . '/../Controller/LivroController.php';

$controller = new LivroController();

// Ações da página
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['titulo'], $_POST['autor'], $_POST['ano'], $_POST['genero'], $_POST['quantidade']);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif ($_POST['acao'] === 'deletar') {
        $controller->deletar($_POST['titulo']);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif ($_POST['acao'] === 'atualizar') {
        $controller->atualizar(
            $_POST['tituloOriginal'],
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['ano'],
            $_POST['genero'],
            $_POST['quantidade']
        );
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$livroParaEditar = null;
if (isset($_POST['acao']) && $_POST['acao'] === 'editar') {
    foreach ($controller->ler() as $livro) {
        if ($livro->getTitulo() === $_POST['titulo']) {
            $livroParaEditar = $livro;
            break;
        }
    }
}

$lista = $controller->ler();
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
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        padding: 40px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
        background-size: cover;
    }

    header h1 {
        font-size: 2.5em;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        position: relative;
    }

    header p {
        font-size: 1.2em;
        opacity: 0.9;
        position: relative;
    }

    .content {
        padding: 40px;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 40px;
    }

    @media (max-width: 768px) {
        .content {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }

    .form-container {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        height: fit-content;
    }

    .form-container h2 {
        color: #2c3e50;
        margin-bottom: 25px;
        font-size: 1.5em;
        border-bottom: 3px solid #3498db;
        padding-bottom: 10px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    input, select {
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: white;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        transform: translateY(-2px);
    }

    label {
        font-weight: 600;
        color: #495057;
        margin-bottom: -10px;
    }

    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .btn-editar {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        color: white;
    }

    .btn-editar:hover {
        background: linear-gradient(135deg, #219a52, #27ae60);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
    }

    .btn-excluir {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
    }

    .btn-excluir:hover {
        background: linear-gradient(135deg, #c0392b, #a93226);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #95a5a6, #7f8c8d);
        color: white;
    }

    .btn-cancelar:hover {
        background: linear-gradient(135deg, #7f8c8d, #6c7b7d);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(149, 165, 166, 0.4);
    }

    .lista-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .lista-container h2 {
        background: linear-gradient(135deg, #34495e, #2c3e50);
        color: white;
        padding: 20px 25px;
        margin: 0;
        font-size: 1.5em;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #f8f9fa;
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }

    td {
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        color: #495057;
    }

    tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .acoes {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .acoes form {
        display: inline;
    }

    .vazio {
        text-align: center;
        padding: 40px;
        color: #6c757d;
        font-style: italic;
    }

    .vazio p {
        font-size: 1.1em;
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

    .form-container, .lista-container {
        animation: fadeIn 0.6s ease-out;
    }

    /* Scroll personalizado */
    .lista-container {
        max-height: 600px;
        overflow-y: auto;
    }

    .lista-container::-webkit-scrollbar {
        width: 8px;
    }

    .lista-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .lista-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .lista-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Responsividade para tabela */
    @media (max-width: 600px) {
        table {
            display: block;
            overflow-x: auto;
        }
        
        .acoes {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <header>
        <h1>Biblioteca Escolar</h1>
        <p>Sistema de Cadastro e Gerenciamento de Livros</p>
    </header>
    
    <div class="content">
        <div class="form-container">
            <?php if ($livroParaEditar): ?>
                <h2> Editar Livro</h2>
                <form method="POST">
                    <input type="hidden" name="acao" value="atualizar">
                    <input type="hidden" name="tituloOriginal" value="<?php echo htmlspecialchars($livroParaEditar->getTitulo()); ?>">
                    <input type="text" name="titulo" placeholder="Título:" value="<?php echo htmlspecialchars($livroParaEditar->getTitulo()); ?>" required>
                    <input type="text" name="autor" placeholder="Autor:" value="<?php echo htmlspecialchars($livroParaEditar->getAutor()); ?>" required>
                    <input type="number" name="ano" placeholder="Ano de Publicação:" value="<?php echo htmlspecialchars($livroParaEditar->getAnoPublicacao()); ?>" required>
                    <?php
                        $generos = ['Ficção','Não-ficção','Fantasia','Romance','Aventura','Biografia','Infantil'];
                    ?>
                    <label for="genero">Gênero</label>
                    <select name="genero" id="genero" required>
                        <option value="">Selecione o gênero</option>
                        <?php foreach ($generos as $g): ?>
                            <option value="<?php echo htmlspecialchars($g); ?>" <?php echo ($livroParaEditar && $livroParaEditar->getGenero() === $g) ? 'selected' : ''; ?>><?php echo htmlspecialchars($g); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="quantidade" placeholder="Quantidade em estoque:" value="<?php echo htmlspecialchars($livroParaEditar->getQuantidade()); ?>" required>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <button type="submit" class="btn btn-editar">✓ Atualizar</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-cancelar">✕ Cancelar</a>
                    </div>
                </form>
            <?php else: ?>
                <h2> Cadastrar Novo Livro</h2>
                <form method="POST">
                    <input type="hidden" name="acao" value="salvar">
                    <input type="text" name="titulo" placeholder="Título:" required>
                    <input type="text" name="autor" placeholder="Autor:" required>
                    <input type="number" name="ano" placeholder="Ano de Publicação:" required>
                    <?php
                        $generos = ['Ficção','Não-ficção','Fantasia','Romance','Aventura','Biografia','Infantil'];
                    ?>
                    <label for="genero">Gênero</label>
                    <select name="genero" id="genero" required>
                        <option value="">Selecione o gênero</option>
                        <?php foreach ($generos as $g): ?>
                            <option value="<?php echo htmlspecialchars($g); ?>"><?php echo htmlspecialchars($g); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="quantidade" min="0" placeholder="Quantidade em estoque:" required>
                    <button type="submit" class="btn btn-editar"> Cadastrar</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="lista-container">
            <h2> Lista de Livros</h2>
            <?php if (empty($lista)): ?>
                <div class="vazio">
                    <p>Nenhum livro cadastrado. Comece adicionando um novo!</p>
                </div>
            <?php else: ?>
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
                        <td><?php echo htmlspecialchars($livro->getTitulo()); ?></td>
                        <td><?php echo htmlspecialchars($livro->getAutor()); ?></td>
                        <td><?php echo htmlspecialchars($livro->getAnoPublicacao()); ?></td>
                        <td><?php echo htmlspecialchars($livro->getGenero()); ?></td>
                        <td><?php echo htmlspecialchars($livro->getQuantidade()); ?></td>
                        <td>
                            <div class="acoes">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="acao" value="editar">
                                    <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>">
                                    <button type="submit" class="btn btn-editar">Editar</button>
                                </form>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                    <input type="hidden" name="acao" value="deletar">
                                    <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>">
                                    <button type="submit" class="btn btn-excluir">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>