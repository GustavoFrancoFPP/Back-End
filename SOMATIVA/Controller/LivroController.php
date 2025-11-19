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

    public function criar($titulo, $autor, $ano, $genero, $quantidade) {
        $livro = new Livro($titulo, $autor, $ano, $genero, $quantidade);
        $this->dao->criarLivro($livro);
    }

    public function atualizar($tituloAntigo, $novoTitulo, $autor, $ano, $genero, $quantidade) {
        return $this->dao->atualizarLivro($tituloAntigo, $novoTitulo, $autor, $ano, $genero, $quantidade);
    }

    public function deletar($titulo) {
        return $this->dao->excluirLivro($titulo);
    }
}