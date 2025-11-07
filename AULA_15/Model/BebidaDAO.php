<?php
require_once 'Bebidas.php';

class BebidaDAO {
    private $bebidasArray = [];
    private $arquivoJson = 'bebidas.json';

    public function __construct(){
        if(file_exists($this->arquivoJson)){
            $conteudoArquivo = file_get_contents($this->arquivoJson);
            $dadosArquivoEmArray = json_decode($conteudoArquivo, true);

            if ($dadosArquivoEmArray){
                foreach ($dadosArquivoEmArray as $nome => $info){
                    $this->bebidasArray[$nome] = new Bebida(
                        $info['nome'],
                        $info['categoria'],
                        $info['volume'],
                        $info['valor'],
                        $info['qtde']
                    );
                }
            }
        }
    }

    private function salvarArquivo(){
        $dadosParaSalvar=[];
        foreach ($this->bebidasArray as $nome => $bebida){
            $dadosParaSalvar[$nome]=[
                'nome'=>$bebida->getNome(),
                'categoria'=>$bebida->getCategoria(),
                'volume'=>$bebida->getVolume(),
                'valor'=>$bebida->getValor(),
                'qtde'=>$bebida->getQtde()
            ];
        }
        file_put_contents($this->arquivoJson, json_encode($dadosParaSalvar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    // CREATE
    public function criarBebida(Bebida $bebida){
        $this->bebidasArray[$bebida->getNome()] = $bebida;
        $this->salvarArquivo();
    }

    // READ
    public function lerBebidas(){
        return $this->bebidasArray;
    }

    // GET BY NAME
    public function getBebidaPorNome($nome){
        return isset($this->bebidasArray[$nome]) ? $this->bebidasArray[$nome] : null;
    }
    
    // UPDATE COMPLETO
    public function atualizarBebida($nomeAntigo, $novoNome, $categoria, $volume, $valor, $qtde){
        if(isset($this->bebidasArray[$nomeAntigo])){
            // Se mudou o nome, precisa remover o antigo e criar novo
            if($nomeAntigo !== $novoNome){
                $bebida = $this->bebidasArray[$nomeAntigo];
                unset($this->bebidasArray[$nomeAntigo]);
                
                $bebida->setNome($novoNome);
                $bebida->setCategoria($categoria);
                $bebida->setVolume($volume);
                $bebida->setValor($valor);
                $bebida->setQtde($qtde);
                
                $this->bebidasArray[$novoNome] = $bebida;
            } else {
                // Se não mudou o nome, só atualiza os dados
                $this->bebidasArray[$nomeAntigo]->setCategoria($categoria);
                $this->bebidasArray[$nomeAntigo]->setVolume($volume);
                $this->bebidasArray[$nomeAntigo]->setValor($valor);
                $this->bebidasArray[$nomeAntigo]->setQtde($qtde);
            }
            $this->salvarArquivo();
            return true;
        }
        return false;
    }

    // DELETE
    public function excluirBebida($nome){
        if(isset($this->bebidasArray[$nome])){
            unset($this->bebidasArray[$nome]);
            $this->salvarArquivo();
            return true;
        }
        return false;
    }
}