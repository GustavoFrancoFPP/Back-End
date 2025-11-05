<?php
// CORRIGIR ESTAS LINHAS:
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

    public function criar($nome, $categoria, $volume, $valor, $qtde) {
        $bebida = new Bebida($nome, $categoria, $volume, $valor, $qtde);
        $this->dao->criarBebida($bebida);
    }

    public function atualizar($nome, $valor, $qtde) {
        $this->dao->atualizarBebida($nome, $valor, $qtde);
    }

    public function deletar($nome) {
        $this->dao->excluirBebida($nome);
    }
}