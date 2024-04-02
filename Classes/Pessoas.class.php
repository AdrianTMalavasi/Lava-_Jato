<?php
// Definindo a classe Pessoas
class Pessoas {
    // Atributos privados da classe Pessoas
    private $id;
    private $nome;
    private $cpf;
    private $email;

    // Construtor da classe Pessoas
    function __construct($nome = "", $cpf = "", $email = "")
    {
        // Inicializando os atributos da classe Pessoas
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    // Métodos getters e setters para os atributos privados
    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        return $this->email = $email;
    }

    function getNome()
    {
        return $this->nome;
    }

    function setNome($nome)
    {
        return $this->nome = $nome;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function setCpf($cpf)
    {
        return $this->cpf = $cpf;
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

    // Método para gerar uma representação em string do objeto
    function toString()
    {
        return " Nome: " . $this->nome . " || CPF: " . $this->cpf . " || Email: " . $this->email;
    }

    // Método para imprimir a representação em string do objeto
    function toPrint()
    {
        echo $this->toString();
    }
}
?>
