<?php
class Carro1 {
    private $marca;
    private $modelo;


    public function __construct($marca, $modelo) {
        $this->setMarca($marca);
        $this->setModelo($modelo);
}

public function setMarca($marca) {
        $this->marca= ucwords(strtolower ($marca));
    }

    public function setModelo($modelo) {
        $this->modelo= ucwords(strtolower ($modelo));
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

}

$carro = new Carro1("fiat", "uno");

echo "Marca: " . $carro->getMarca() ;
echo "Modelo: " . $carro->getModelo() ;

?>