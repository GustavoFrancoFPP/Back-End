<?php 

class AlunoDAO {
    private $alunos = [];

        public function criarAluno(Aluno $aluno) {
            $this->alunos[$aluno->getId()] = $aluno;
        }

        public function lerAluno() {
            return $this->alunos;
        }

        public function atualizarAluno() {
            //prx aula
        }

        public function excluirAluno($id) {
            unset($this->alunos[$id]);
        }
}