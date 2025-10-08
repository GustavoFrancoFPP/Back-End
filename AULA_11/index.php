<!-- Exercicos extraçao de classes e metodos -->

<?php

// Cenário 1 – Viagem pelo Mundo



// Um grupo de turistas vai visitar o Japão, o Brasil e o Acre. Em cada lugar da
// Terra, eles poderão comer comidas típicas e nadar em rios ou praias.

// class Turista {
//     public $pais;
//     public $comida;
//     public $local;

//     public function viajar() {
//         echo "O turista foi viajar para $this->pais\n";
//     }

//     public function comer() {
//         echo "O turista está comendo $this->comida\n";
//     }

//     public function nadar() {
//         echo "O turista está nadando em $this->local\n";
//     }
// }

//     class Japao extends Turista {
//         public function viajar() {
//             echo "O turista foi viajar para o Japão \n";
//         }
//         public function comer() {
//             echo "O turista está comendo sushi \n";
//         }
//         public function nadar() {
//             echo "O turista está nadando em Kamakura";
//         }
//     }

//     class Brasil extends Turista {
//     public function viajar() {
//         echo "O turista foi viajar para o Brasil \n";
//     }
//     public function comer() {
//         echo "O turista está comendo feijoada \n";
//     }
//     public function nadar() {
//         echo "O turista está nadando em Copacabana";
//     }
// }

// class Acre extends Turista {
//     public function viajar() {
//         echo "O turista foi viajar para o Acre \n";
//     }
//     public function comer() {
//         echo "O turista está comendo tacacá \n";
//     }
//     public function nadar() {
//         echo "O turista está nadando no Rio Acre";
//     }
// }

// $japao = new Japao();
// $japao->viajar();
// $japao->comer();
// $japao->nadar();

// echo "\n";

// $brasil = new Brasil();
// $brasil->viajar();
// $brasil->comer();
// $brasil->nadar();

// echo "\n";

// $acre = new Acre();
// $acre->viajar();
// $acre->comer();
// $acre->nadar();

// O Batman, o Superman e o Homem-Aranha estão em uma missão. Eles precisam
// fazer treinamentos especiais no Cotil e, depois, irão ao shopping para doar
// brinquedos às crianças.

// Cenário 2 – Missão dos Herói
// class Heroi {
//     public $nome;

//     public function treinar() {
//         echo "$this->nome está treinando no Cotil\n";
//     }

//     public function doar() {
//         echo "$this->nome está doando brinquedos às crianças no shopping\n";
//     }
// }

// class Batman extends Heroi {
//     public function __construct() {
//         $this->nome = "Batman";
//     }

//     public function treinar() {
//         echo "$this->nome está treinando artes marciais e tecnologia no Cotil\n";
//     }

//     public function doar() {
//         echo "$this->nome está doando brinquedos da Wayne Enterprises no shopping\n";
//     }
// }

// class Superman extends Heroi {
//     public function __construct() {
//         $this->nome = "Superman";
//     }

//     public function treinar() {
//         echo "$this->nome está treinando voo e força no Cotil\n";
//     }

//     public function doar() {
//         echo "$this->nome está doando brinquedos super-resistentes no shopping\n";
//     }
// }

// class HomemAranha extends Heroi {
//     public function __construct() {
//         $this->nome = "Homem-Aranha";
//     }

//     public function treinar() {
//         echo "$this->nome está treinando com suas teias no Cotil\n";
//     }

//     public function doar() {
//         echo "$this->nome está doando brinquedos com tema de aranha no shopping\n";
//     }
// }

// // --- Teste das classes ---
// $batman = new Batman();
// $batman->treinar();
// $batman->doar();

// echo "\n";

// $superman = new Superman();
// $superman->treinar();
// $superman->doar();

// echo "\n";

// $aranha = new HomemAranha();
// $aranha->treinar();
// $aranha->doar();

// Cenário 3 – Fantasia e Destino
// John Snow, Papai Smurf, Deadpool e Dexter estão em uma jornada. Durante o
// caminho, começa a chover, e eles precisam amar uns aos outros para superar as
// dificuldades. No fim da jornada, eles celebram ao comer juntos.

// class Personagem {
//     public $nome;

//     public function caminhar() {
//         echo "$this->nome está na missão\n";
//     }

//     public function amar() {
//         echo "$this->nome está amando ao outro\n";
//     }

//     public function celebrar() {
//         echo "$this->nome está celebrando ao comer junto com os amigos\n";
//     }
// }

// class JohnSnow extends Personagem {
//     public function __construct() {
//         $this->nome = "John Snow";
//     }

//     public function caminhar() {
//         echo "$this->nome está caminhando sob a neve em direção ao seu destino\n";
//     }

//     public function amar() {
//         echo "$this->nome demonstra lealdade e amor à sua equipe\n";
//     }

//     public function celebrar() {
//         echo "$this->nome celebra comendo um banquete nórdico com os amigos\n";
//     }
// }

// class PapaiSmurf extends Personagem {
//     public function __construct() {
//         $this->nome = "Papai Smurf";
//     }

//     public function caminhar() {
//         echo "$this->nome está guiando o grupo com sabedoria durante a chuva\n";
//     }

//     public function amar() {
//         echo "$this->nome espalha amor e esperança para o grupo\n";
//     }

//     public function celebrar() {
//         echo "$this->nome celebra comendo frutas silvestres com os amigos\n";
//     }
// }

// class Deadpool extends Personagem {
//     public function __construct() {
//         $this->nome = "Deadpool";
//     }

//     public function caminhar() {
//         echo "$this->nome está reclamando da chuva enquanto segue a jornada\n";
//     }

//     public function amar() {
//         echo "$this->nome demonstra amor de um jeito todo estranho e engraçado\n";
//     }

//     public function celebrar() {
//         echo "$this->nome celebra comendo tacos e fazendo piadas\n";
//     }
// }

// class Dexter extends Personagem {
//     public function __construct() {
//         $this->nome = "Dexter";
//     }

//     public function caminhar() {
//         echo "$this->nome está analisando cada passo com precisão científica\n";
//     }

//     public function amar() {
//         echo "$this->nome aprende a sentir empatia pelos companheiros\n";
//     }

//     public function celebrar() {
//         echo "$this->nome celebra comendo em silêncio e observando os outros\n";
//     }
// }

// // --- Testando as classes ---
// $john = new JohnSnow();
// $john->caminhar();
// $john->amar();
// $john->celebrar();

// echo "\n";

// $smurf = new PapaiSmurf();
// $smurf->caminhar();
// $smurf->amar();
// $smurf->celebrar();

// echo "\n";

// $deadpool = new Deadpool();
// $deadpool->caminhar();
// $deadpool->amar();
// $deadpool->celebrar();

// echo "\n";

// $dexter = new Dexter();
// $dexter->caminhar();
// $dexter->amar();
// $dexter->celebrar();

// // Desafio 4

// class SerHumano {
//     public $nome;

//     public function engravidar() {
//         echo "$this->nome pode engravidar e gerar uma nova vida\n";
//     }

//     public function nascer() {
//         echo "$this->nome está nascendo e iniciando seu ciclo de vida\n";
//     }

//     public function crescer() {
//         echo "$this->nome está crescendo e aprendendo sobre o mundo\n";
//     }

//     public function escolher() {
//         echo "$this->nome está fazendo escolhas que definem seu destino\n";
//     }

//     public function doarSangue() {
//         echo "$this->nome está doando sangue para ajudar outras pessoas\n";
//     }
// }

// class Pessoa extends SerHumano {
//     public function __construct($nome) {
//         $this->nome = $nome;
//     }
// }

// $pessoa = new Pessoa("Maria");
// $pessoa->engravidar();
// $pessoa->nascer();
// $pessoa->crescer();
// $pessoa->escolher();
// $pessoa->doarSangue();

// // Desafio 5
// class Usuario {
//     public $nome;
//     public $tipo;

//     public function emprestar($item) {
//         echo "$this->tipo $this->nome fez um empréstimo de $item\n";
//     }
// }

// class Aluno extends Usuario {
//     public function __construct($nome) {
//         $this->nome = $nome;
//         $this->tipo = "Aluno";
//     }
// }

// class Professor extends Usuario {
//     public function __construct($nome) {
//         $this->nome = $nome;
//         $this->tipo = "Professor";
//     }
// }

// $aluno = new Aluno("João");
// $aluno->emprestar("livro de Matemática");

// $professor = new Professor("Carlos");
// $professor->emprestar("revista científica");

// // Desafio 6
// class Cliente {
//     public $nome;

//     public function comprarIngresso($filme, $sessao) {
//         echo "$this->nome comprou um ingresso para o filme '$filme' na sessão das $sessao\n";
//     }
// }

// class Filme {
//     public $titulo;
//     public $horario;

//     public function __construct($titulo, $horario) {
//         $this->titulo = $titulo;
//         $this->horario = $horario;
//     }
// }

// $filme = new Filme("Batman vs Superman", "20:30");
// $cliente = new Cliente();
// $cliente->nome = "Lucas";
// $cliente->comprarIngresso($filme->titulo, $filme->horario);