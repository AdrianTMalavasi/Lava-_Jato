<?php
// Definindo a classe Database
class Database
{
    // Atributos privados que armazenam as informações de conexão
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    // Construtor da classe que recebe os parâmetros necessários para a conexão
    public function __construct($host, $username, $password, $database)
    {
        // Inicializando os atributos com os valores fornecidos
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // Chamando o método connect para estabelecer a conexão ao criar uma instância da classe
        $this->connect();
    }

    // Método privado que estabelece a conexão com o banco de dados
    private function connect()
    {
        // Utilizando a classe mysqli para criar uma nova conexão
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Verificando se a conexão foi estabelecida com sucesso
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Método público que executa uma consulta SQL no banco de dados
    public function query($sql)
    {
        // Utilizando o método query da conexão para executar a consulta
        return $this->connection->query($sql);
    }

    // Método público que fecha a conexão com o banco de dados
    public function close()
    {
        // Utilizando o método close da conexão para encerrar a conexão
        $this->connection->close();
    }
}
?>
