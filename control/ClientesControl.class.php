<?php
// Incluindo a classe Cliente para utilização no código
require_once "../Classes/Clientes.class.php";

// Definindo a classe ClienteControl
class ClienteControl {
    // Propriedade para armazenar a conexão com o banco de dados
    private $conexao;

    // Construtor da classe ClienteControl
    function __construct($conexao) {
        // Inicializando a propriedade de conexão
        $this->conexao = $conexao;
        // Criando uma instância da classe Cliente (talvez seja necessário corrigir isso)
        $conexao = new Cliente();
    }

    // Método para listar objetos de clientes e pessoas
    public function listarObj() {
        // Consulta SQL para obter todos os clientes
        $sql = "SELECT * FROM clientes";
        // Executando a consulta
        $result = $this->conexao->query($sql);
        // Inicializando um array para armazenar dados dos clientes
        $clientes = array();

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Iterando sobre os resultados e armazenando no array de clientes
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
        }

        // Consulta SQL para obter todas as pessoas
        $sql = "SELECT * FROM pessoas";
        // Executando a consulta
        $result = $this->conexao->query($sql);
        // Inicializando um array para armazenar dados das pessoas
        $pessoas = array();

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Iterando sobre os resultados
            while ($row = $result->fetch_assoc()) {
                // Iterando sobre os clientes e comparando IDs para relacionar pessoas a clientes
                foreach ($clientes as $cliente) {
                    if ($row['id_pessoa'] == $cliente['id_cliente']) {
                        $pessoas[] = $row;
                    }
                }
            }
        }

        // Verificando se há dados tanto de clientes quanto de pessoas
        if (count($clientes) != 0 && count($pessoas) != 0) {
            // Inicializando um array para armazenar objetos Cliente com dados de pessoas e clientes
            $clientesPessoas = array();
            // Iterando sobre as pessoas para criar objetos Cliente
            for ($i = 0; $i < count($pessoas); $i++) {
                // Criando um objeto Cliente com dados de pessoas e clientes
                $clientesPessoas[$i] = new Cliente($pessoas[$i]['nome'], $pessoas[$i]['cpf'], $pessoas[$i]['email'], $clientes[$i]['enderecoCobranca'], $clientes[$i]['formaPagamento']);
                // Configurando o ID do objeto Cliente
                $clientesPessoas[$i]->setId($pessoas[$i]['id_pessoa']);
            }
    
            // Retornando o array de objetos Cliente
            return $clientesPessoas;
        }
        // Retornando null se não houver dados
        return null;
    }

    // Método para atualizar um objeto Cliente no banco de dados
    public function atualizar($obj) {        
        // Verificando se o objeto passado é uma instância de Cliente
        if ($obj instanceof Cliente) {
            // Consulta SQL para atualizar dados na tabela de pessoas
            $sql = "UPDATE pessoas SET nome='".$obj->getNome()."', cpf='".$obj->getCpf()."', email='".$obj->getEmail()."' WHERE id_pessoa='".$obj->getId()."'";
            // Executando a consulta
            $result = $this->conexao->query($sql);

            // Verificando se a atualização foi bem-sucedida
            if ($result) {
                // Consulta SQL para atualizar dados na tabela de clientes
                $sql = "UPDATE clientes SET enderecoCobranca='".$obj->getEnderecoCobranca()."',formaPagamento='".$obj->getFormaPagamento()."' WHERE id_cliente='".$obj->getId()."'";
                // Executando a consulta
                $result = $this->conexao->query($sql);
                // Retornando true se a atualização foi bem-sucedida
                return true;   
            }
        }
        // Retornando false se o objeto não for uma instância de Cliente
        return false;
    }

    // Método para deletar um objeto Cliente do banco de dados
    public function deletar($obj) { 
        // Verificando se o objeto passado é uma instância de Cliente
        if ($obj instanceof Cliente) {
            // Consulta SQL para excluir dados da tabela de clientes
            $sql = "DELETE FROM clientes WHERE id_cliente='".$obj->getId()."'";
            // Executando a consulta
            $result = $this->conexao->query($sql);
    
            // Verificando se a exclusão foi bem-sucedida
            if ($result) {
                // Consulta SQL para excluir dados da tabela de pessoas
                $sql = "DELETE FROM pessoas WHERE id_pessoa='".$obj->getId()."'";
                // Executando a consulta
                $result = $this->conexao->query($sql);
                // Retornando true se a exclusão foi bem-sucedida
                return true;
            }
        }
        // Retornando false se o objeto não for uma instância de Cliente
        return false;
    }

    // Método para cadastrar um novo objeto Cliente no banco de dados
    public function cadastrar($obj) {  
        // Verificando se o objeto passado é uma instância de Cliente
        if ($obj instanceof Cliente) {      
            // Consulta SQL para inserir dados na tabela de pessoas
            $sql = "INSERT INTO pessoas (nome, cpf,email) VALUES ('".$obj->getNome()."', '".$obj->getCpf()."', '".$obj->getEmail()."')";
            // Executando a consulta
            $result = $this->conexao->query($sql);

            // Verificando se a inserção foi bem-sucedida
            if ($result) {
                // Consulta SQL para obter o último ID inserido
                $sql = "SELECT id_pessoa FROM pessoas WHERE cpf = '".$obj->getCpf()."'";
                // Executando a consulta
                $result = $this->conexao->query($sql);
                // Obtendo o último ID inserido
                $lastAdd = $result->fetch_assoc();

                // Consulta SQL para inserir dados na tabela de clientes
                $sql = "INSERT INTO clientes (id_cliente, enderecoCobranca, formaPagamento) VALUES ('".$lastAdd['id_pessoa']."', '".$obj->getEnderecoCobranca()."', '".$obj->getFormaPagamento()."')";
                // Executando a consulta
                $result = $this->conexao->query($sql);
                // Retornando true se a inserção foi bem-sucedida
                return true;
            }
        }
        // Retornando false se o objeto não for uma instância de Cliente
        return false;
    }

    // Método para buscar um objeto Cliente por ID
    public function buscarPorId($id) {
        // Buscando dados da tabela de pessoas
        $sql = "SELECT * FROM pessoas WHERE id_pessoa = $id";
        $result = $this->conexao->query($sql);
        $dadosPessoa = "";

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            $dadosPessoa = $result->fetch_assoc();
        }

        // Buscando dados da tabela de clientes
        $sql = "SELECT * FROM clientes WHERE id_cliente = $id";
        $result = $this->conexao->query($sql);
        $dadosCliente= "";

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            $dadosCliente = $result->fetch_assoc();
        }

        // Criando um objeto Cliente com todos os dados
        if ($dadosPessoa != "" && $dadosCliente != "") {
            $cliente = new Cliente ($dadosPessoa['nome'], $dadosPessoa['cpf'], $dadosPessoa['email'], $dadosCliente['enderecoCobranca'], $dadosCliente['formaPagamento']);
            $cliente->setId($dadosPessoa['id_pessoa']);
            return $cliente;
        }
        // Retornando null se não houver dados
        return null;
    }
}
?>
