<?php
// Incluindo a classe base Pessoas
require_once "Pessoas.class.php";

// Definindo a classe Cliente, que herda de Pessoas
class Cliente extends Pessoas {
    // Atributos privados da classe Cliente
    private $enderecoCobranca;
    private $formaPagamento;

    // Construtor da classe Cliente
    function __construct($nome = "", $cpf = "", $email = "", $enderecoCobranca = "", $formaPagamento = "") {
        // Chamando o construtor da classe base (Pessoas)
        parent::__construct($nome, $cpf, $email);

        // Inicializando os atributos específicos da classe Cliente
        $this->enderecoCobranca = $enderecoCobranca;
        $this->formaPagamento = $formaPagamento;
    }

    // Métodos getters e setters para os atributos privados
    function getEnderecoCobranca() {
        return $this->enderecoCobranca;
    }

    function setEnderecoCobranca($novo_valor) {
        $this->enderecoCobranca = $novo_valor;
        return $this->enderecoCobranca;
    }

    function getFormaPagamento() {
        return $this->formaPagamento;
    }

    function setFormaPagamento($novo_valor) {
        $this->formaPagamento = $novo_valor;
        return $this->formaPagamento;
    }

    // Método para gerar uma representação em string do objeto
    function toString() {
        return parent::toString() .
            "Endereço de Cobrança: " . $this->enderecoCobranca .
            "Forma de Pagamento: " . $this->formaPagamento;
    }

    // Método para imprimir a representação em string do objeto
    function toPrint() {
        echo $this->toString();
    }

    // Método para obter uma representação em string da classe base sem os atributos específicos
    function toStringC() {
        return parent::toString();
    }
}
?>
