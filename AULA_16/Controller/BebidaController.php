<?php
require_once __DIR__ . '/../Model/BebidaDAO.php';
require_once __DIR__ . '/../Model/Bebidas.php';

class BebidaController {
    private $dao;

    public function __construct() {
        $this->dao = new BebidaDAO();
    }

    public function ler() {
        return $this->dao->lerBebidas();
    }

    public function getBebida($nome) {
        return $this->dao->getBebidaPorNome($nome);
    }

    public function criar($nome, $categoria, $volume, $valor, $qtde) {
        $bebida = new Bebida($nome, $categoria, $volume, $valor, $qtde);
        $this->dao->criarBebida($bebida);
    }

    public function atualizar($nomeAntigo, $novoNome, $categoria, $volume, $valor, $qtde) {
        return $this->dao->atualizarBebida($nomeAntigo, $novoNome, $categoria, $volume, $valor, $qtde);
    }

    public function deletar($nome) {
        return $this->dao->excluirBebida($nome);
    }
}