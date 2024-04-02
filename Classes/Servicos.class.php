<?php
// Incluindo as classes base Funcionarios e Clientes
require_once "Funcionarios.class.php";
require_once "Clientes.class.php";

// Definindo a classe Servico
class Servico
{
    private $id;
    private $descricao;
    private $valor;
    private $data;
    private $duracao;
    public Funcionario $funcionario;
    public Cliente $cliente;

    // Construtor da classe Servico
    function __construct($descricao = "", $valor = "", $data = "", $duracao = "1:00 HRS", $funcionario, $cliente)
    {
        // Inicializando os atributos da classe Servico
        $this->descricao = $descricao;
        $this->valor = $valor;

        // Verificando se a data foi fornecida; caso contrário, usa o valor padrão (NOW())
        if ($data == "") {
            $this->data = 'NOW()';
        } else {
            $this->data = $data;
        }

        $this->duracao = $duracao;
        $this->funcionario = $funcionario;
        $this->cliente = $cliente;
    }

    // Métodos getters e setters para o atributo privado 'id'
    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        return $this->id = $id;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function setDescricao($novoValor)
    {
        $this->descricao = $novoValor;
        return $this->descricao;
    }

    function getValor()
    {
        return $this->valor;
    }

    function setValor($novoValor)
    {
        $this->valor = $novoValor;
        return $this->valor;
    }

    function getData()
    {
        return $this->data;
    }

    function setData($novaData)
    {
        $this->data = $novaData;
        return $this->data;
    }

    function getDuracao()
    {
        return $this->duracao;
    }

    function setDuracao($novoValor)
    {
        $this->duracao = $novoValor;
        return $this->duracao;
    }

    function getFuncionario()
    {
        return $this->funcionario;
    }

    function setFuncionario($novoValor)
    {
        $this->funcionario = $novoValor;
        return $this->funcionario;
    }

    function getCliente()
    {
        return $this->cliente;
    }

    function setCliente($novoValor)
    {
        $this->cliente = $novoValor;
        return $this->cliente;
    }

    // Método para gerar uma representação em string do objeto
    function toString()
    {
        return "Descricao " . $this->descricao .
            " Valor: " . $this->valor .
            " Data: " . $this->data .
            " Duracao: " . $this->duracao .
            " Funcionario: " . $this->funcionario .
            " Cliente: " . $this->cliente;
    }

    // Método para imprimir a representação em string do objeto
    function toPrint()
    {
        echo $this->toString();
    }
}
?>
