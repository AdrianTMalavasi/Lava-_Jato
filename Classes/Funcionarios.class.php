<?php
// Incluindo a classe base Pessoas
require_once "Pessoas.class.php";

// Definindo a classe Funcionario, que herda de Pessoas
class Funcionario extends Pessoas
{
    // Atributos privados da classe Funcionario
    private $salario;
    private $cargo;
    private $dataContratacao;

    // Construtor da classe Funcionario
    function __construct($nome = "", $cpf = "", $email = "", $salario = "", $cargo = "", $dataContratacao = "")
    {
        // Chamando o construtor da classe base (Pessoas)
        parent::__construct($nome, $cpf, $email);

        // Inicializando os atributos específicos da classe Funcionario
        $this->salario = $salario;
        $this->cargo = $cargo;
        $this->dataContratacao = $dataContratacao;
    }

    // Métodos getters e setters para os atributos privados
    function getSalario()
    {
        return $this->salario;
    }

    function setSalario($novo_valor)
    {
        $this->salario = $novo_valor;
        return $this->salario;
    }

    function getCargo()
    {
        return $this->cargo;
    }

    function setCargo($novo_valor)
    {
        $this->cargo = $novo_valor;
        return $this->cargo;
    }

    function getDataContratacao()
    {
        return $this->dataContratacao;
    }

    function setDataContratacao($novo_valor)
    {
        $this->dataContratacao = $novo_valor;
        return $this->dataContratacao;
    }

    // Método para gerar uma representação em string do objeto
    function toString()
    {
        return parent::toString() .
            " Salario: " . $this->salario .
            " Cargo: " . $this->cargo .
            " Data de Contratação: " . $this->dataContratacao;
    }

    // Método para imprimir a representação em string do objeto
    function toPrint()
    {
        echo $this->toString();
    }

    // Método para obter uma representação em string da classe base sem os atributos específicos
    function toStringF()
    {
        return parent::toString();
    }
}
?>

