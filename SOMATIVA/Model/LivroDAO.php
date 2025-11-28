<?php
require_once 'Livros.php';
require_once 'Connection.php';

class LivroDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS Livro (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(200) NOT NULL UNIQUE,
                autor VARCHAR(150) NOT NULL,
                ano INT NOT NULL,
                genero VARCHAR(100) NOT NULL,
                quantidade INT NOT NULL
            )
        ");
    }

    // ✅ ADICIONE ESTE MÉTODO QUE ESTÁ FALTANDO:
    public function lerLivros() {
        $stmt = $this->conn->query("SELECT * FROM Livro ORDER BY titulo");
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Livro(
                $row['titulo'],
                $row['autor'],
                $row['ano'],
                $row['genero'],
                $row['quantidade']
            );
        }
        return $result;
    }

    // MÉTODO PARA VERIFICAR SE LIVRO JÁ EXISTE
    public function livroExiste($titulo, $tituloOriginal = null) {
        // Se estiver editando e o título não mudou, não precisa validar
        if ($tituloOriginal && $titulo === $tituloOriginal) {
            return false;
        }
        
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM Livro WHERE titulo = :titulo");
        $stmt->execute([':titulo' => $titulo]);
        return $stmt->fetchColumn() > 0;
    }

    // CREATE - Insere um novo livro no banco
    public function criarLivro(Livro $livro) {
        // Verifica se já existe antes de inserir
        if ($this->livroExiste($livro->getTitulo())) {
            throw new Exception("⚠️ Já existe um livro cadastrado com o nome \"" . $livro->getTitulo() . "\"!");
        }
        
        $stmt = $this->conn->prepare("
            INSERT INTO Livro (titulo, autor, ano, genero, quantidade)
            VALUES (:titulo, :autor, :ano, :genero, :quantidade)
        ");
        $stmt->execute([
            ':titulo' => $livro->getTitulo(),
            ':autor' => $livro->getAutor(),
            ':ano' => $livro->getAnoPublicacao(),
            ':genero' => $livro->getGenero(),
            ':quantidade' => $livro->getQuantidade()
        ]);
    }

    // UPDATE - Atualiza os dados de um livro existente
    public function atualizarLivro($tituloOriginal, $novoTitulo, $autor, $ano, $genero, $quantidade) {
        // Verifica se o novo título já existe (exceto se for o próprio livro)
        if ($this->livroExiste($novoTitulo, $tituloOriginal)) {
            throw new Exception("Já existe outro livro com este título!");
        }
        
        $stmt = $this->conn->prepare("
            UPDATE Livro
            SET titulo = :novoTitulo, autor = :autor, ano = :ano, genero = :genero, quantidade = :quantidade
            WHERE titulo = :tituloOriginal
        ");
        $stmt->execute([
            ':novoTitulo' => $novoTitulo,
            ':autor' => $autor,
            ':ano' => $ano,
            ':genero' => $genero,
            ':quantidade' => $quantidade,
            ':tituloOriginal' => $tituloOriginal
        ]);
    }

    // DELETE - Remove um livro do banco de dados
    public function excluirLivro($titulo) {
        $stmt = $this->conn->prepare("DELETE FROM Livro WHERE titulo = :titulo");
        $stmt->execute([':titulo' => $titulo]);
    }

    // BUSCAR POR NOME - Encontra um livro específico pelo título
    public function buscarPorNome($titulo) {
        $stmt = $this->conn->prepare("SELECT * FROM Livro WHERE titulo = :titulo LIMIT 1");
        $stmt->execute([':titulo' => $titulo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Livro(
                $row['titulo'],
                $row['autor'],
                $row['ano'],
                $row['genero'],
                $row['quantidade']
            );
        }
        return null;
    }

    // Método de compatibilidade para o controller
    public function getLivroPorNome($titulo) {
        return $this->buscarPorNome($titulo);
    }
}