<?php
// Incluindo a classe Pessoas para utilização no código
require_once "./classes/Pessoas.class.php";

// Definindo a classe PessoaControl
class PessoaControl {
    // Propriedade para armazenar a conexão com o banco de dados
    private $conexao;

    // Construtor da classe PessoaControl
    function __construct($conexao) {
        // Inicializando a propriedade de conexão
        $this->conexao = $conexao;
    }

    // Método para listar dados da tabela de pessoas
    public function listar() {
        // Consulta SQL para obter todas as pessoas
        $sql = "SELECT * FROM pessoas";
        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Inicializando um array para armazenar as pessoas
        $vetClientes = array();

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Iterando sobre os resultados e armazenando no array de pessoas
            while ($row = $result->fetch_assoc()) {
                $vetClientes[] = $row;
            }
        }

        // Retornando o array de pessoas
        return $vetClientes;
    }

    // Método para listar objetos de pessoas
    public function listarObj() {
        // Consulta SQL para obter todas as pessoas
        $sql = "SELECT * FROM pessoas";
        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Inicializando um array para armazenar objetos Pessoas
        $vetPessoas = array();

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Iterando sobre os resultados
            while ($row = $result->fetch_assoc()) {
                // Criando um objeto Pessoas com dados do banco
                $pessoas = new Pessoas($row["nome"], $row["cpf"], $row["email"]);
                // Configurando o ID do objeto Pessoas
                $pessoas->setId($row["id_pessoa"]);
                // Armazenando o objeto Pessoas no array
                $vetPessoas[] = $pessoas;
            }
        }

        // Retornando o array de objetos Pessoas
        return $vetPessoas;
    }

    // Método para atualizar um objeto Pessoas no banco de dados
    public function atualizar($obj) {        
        // Consulta SQL para atualizar dados na tabela de pessoas
        $sql = "UPDATE pessoas SET nome='".$obj->getNome()."', cpf='".$obj->getCpf()."', email='".$obj->getEmail()."' WHERE id=".$obj->getId();

        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Verificando se a atualização foi bem-sucedida
        if ($result) {
            echo "Objeto atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o objeto.";
        }
    }

    // Método para deletar um objeto Pessoas do banco de dados
    public function deletar($obj) {      
        // Consulta SQL para excluir dados da tabela de pessoas
        $sql = "DELETE FROM pessoas WHERE id=".$obj->getId();

        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Verificando se a exclusão foi bem-sucedida
        if ($result) {
            echo "Objeto excluído com sucesso!";
            return true;
        } else {
            echo "Erro ao excluir o objeto.";
            return false;
        }
    }

    // Método para cadastrar um novo objeto Pessoas no banco de dados
    public function cadastrar($obj) {   
        // Consulta SQL para inserir dados na tabela de pessoas
        $sql = "INSERT INTO pessoas (nome, cpf, email) VALUES ('".$obj->getNome()."', '".$obj->getCpf()."','".$obj->getEmail()."')";

        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Verificando se a inserção foi bem-sucedida
        if ($result) {
            echo "Objeto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar objeto: ".$this->conexao->error;
        }
    }

    // Método para buscar um objeto Pessoas por ID
    public function buscarPorId($id) {
        // Consulta SQL para obter dados da tabela de pessoas
        $sql = "SELECT * FROM pessoas WHERE id = $id";
        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Obtendo os dados da pessoa
            $row = $result->fetch_assoc();
            // Criando um objeto Pessoas com dados do banco
            $obj = new Pessoas($row["nome"], $row["cpf"], $row["email"]);
            // Configurando o ID do objeto Pessoas
            $obj->setId($row["id_pessoas"]);
            // Retornando o objeto Pessoas
            return $obj;
        } else {
            echo "Nao encontrou o id: ".$id;
            return null;
        }
    }
}

?>
