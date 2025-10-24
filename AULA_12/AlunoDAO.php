<?php
// DAO = Data Access Object 
// CRUD = Create, Read, Update, Delete

class AlunoDAO {
    private $alunos = []; // armazenamento temporário dos objetos
    private $arquivo = "alunos.json"; // arquivo JSON para persistência

    // Construtor AlunoDAO --> carrega os dados do arquivo ao iniciar a aplicação
    public function __construct() {
        if (file_exists($this->arquivo)) {
            // Lê o conteúdo do arquivo caso ele já exista
            $conteudo = file_get_contents($this->arquivo);
            $dados = json_decode($conteudo, true); // converte JSON para array associativo

            if ($dados) {
                foreach ($dados as $id => $info) {
                    $this->alunos[$id] = new Aluno(
                        $info['id'],
                        $info['nome'],
                        $info['curso']
                    );
                }
            }
        }
    }

    // Método auxiliar -> salva o array de alunos no arquivo
    private function salvarEmArquivo() {
        $dados = [];

        // Transforma os objetos em arrays convencionais
        foreach ($this->alunos as $id => $aluno) {
            $dados[$id] = [
                'id'    => $aluno->getId(),
                'nome'  => $aluno->getNome(),
                'curso' => $aluno->getCurso()
            ];
        }

        //Converte para JSON formatado e grava o arquivo
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // CREATE
    public function criarAluno(Aluno $aluno) {
        $this->alunos[$aluno->getId()] = $aluno;
        $this->salvarEmArquivo();
    }

    // READ
    public function lerAluno() {
        return $this->alunos;
    }

    // UPDATE
    public function atualizarAluno($id, $novoNome, $novoCurso) {
        if (isset($this->alunos[$id])) {
            $this->alunos[$id]->setNome($novoNome);
            $this->alunos[$id]->setCurso($novoCurso);
            $this->salvarEmArquivo();
        }
    }

    // DELETE
    public function excluirAluno($id) {
        if (isset($this->alunos[$id])) {
            unset($this->alunos[$id]);
            $this->salvarEmArquivo();
        }
    }
}
