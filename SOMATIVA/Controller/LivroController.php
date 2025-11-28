<?php
require_once __DIR__ . '/../Model/LivroDAO.php';
require_once __DIR__ . '/../Model/Livros.php';

class LivroController {
    private $dao;

    public function __construct() {
        $this->dao = new LivroDAO();
    }

public function ler() {
    return $this->dao->lerLivros();
}

    public function getLivro($titulo) {
        return $this->dao->getLivroPorNome($titulo);
    }

    /**
     * Cria um novo livro no sistema
     */
    public function criar($titulo, $autor, $ano, $genero, $quantidade) {
        try {
            $livro = new Livro($titulo, $autor, $ano, $genero, $quantidade);
            $this->dao->criarLivro($livro);
            return ['success' => true, 'message' => 'Livro cadastrado com sucesso!'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Atualiza os dados de um livro existente
     */
    public function atualizar($tituloAntigo, $novoTitulo, $autor, $ano, $genero, $quantidade) {
        try {
            $this->dao->atualizarLivro($tituloAntigo, $novoTitulo, $autor, $ano, $genero, $quantidade);
            return ['success' => true, 'message' => 'Livro atualizado com sucesso!'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Remove um livro do sistema
     */
    public function deletar($titulo) {
        try {
            $this->dao->excluirLivro($titulo);
            return ['success' => true, 'message' => 'Livro excluído com sucesso!'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}