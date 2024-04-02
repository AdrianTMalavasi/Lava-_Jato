<?php
// Incluindo a classe Funcionarios para utilização no código
require_once "../Classes/Funcionarios.class.php";

// Definindo a classe FuncionarioControl
class FuncionarioControl {
    // Propriedade para armazenar a conexão com o banco de dados
    private $conexao;

    // Construtor da classe FuncionarioControl
    function __construct($conexao) {
        // Inicializando a propriedade de conexão
        $this->conexao = $conexao;
    }

    // Método para listar dados da tabela de funcionários
    public function listar() {
        // Consulta SQL para obter todos os funcionários
        $sql = "SELECT * FROM funcionarios";
        // Executando a consulta
        $result = $this->conexao->query($sql);

        // Inicializando um array para armazenar os funcionários
        $vetFuncionarios = array();

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Iterando sobre os resultados e armazenando no array de funcionários
            while ($row = $result->fetch_assoc()) {
                $vetFuncionarios[] = $row;
            }
        }

        // Retornando o array de funcionários
        return $vetFuncionarios;
    }

    // Método para listar objetos de funcionários e pessoas
    public function listarObj() {
        // Consulta SQL para obter todos os funcionários
        $sql = "SELECT * FROM funcionarios";
        // Executando a consulta
        $result = $this->conexao->query($sql);
        // Inicializando um array para armazenar dados dos funcionários
        $funcionarios = array();

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Iterando sobre os resultados e armazenando no array de funcionários
            while ($row = $result->fetch_assoc()) {
                $funcionarios[] = $row;
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
                // Iterando sobre os funcionários e comparando IDs para relacionar pessoas a funcionários
                foreach ($funcionarios as $funcionario) {
                    if ($row['id_pessoa'] == $funcionario['id_funcionario']) {
                        $pessoas[] = $row;
                    }
                }
            }
        }

        // Verificando se há dados tanto de funcionários quanto de pessoas
        if (count($funcionarios) != 0 && count($pessoas) != 0) {
            // Inicializando um array para armazenar objetos Funcionario com dados de pessoas e funcionários
            $funcionariosPessoas = array();
            // Iterando sobre as pessoas para criar objetos Funcionario
            for ($i = 0; $i < count($pessoas); $i++) {
                // Criando um objeto Funcionario com dados de pessoas e funcionários
                $funcionariosPessoas[$i] = new Funcionario($pessoas[$i]['nome'], $pessoas[$i]['cpf'], $pessoas[$i]['email'], $funcionarios[$i]['salario'], $funcionarios[$i]['cargo'], $funcionarios[$i]['dataContratacao']);
                // Configurando o ID do objeto Funcionario
                $funcionariosPessoas[$i]->setId($pessoas[$i]['id_pessoa']);
            }
    
            // Retornando o array de objetos Funcionario
            return $funcionariosPessoas;
        }
        // Retornando null se não houver dados
        return null;
    }

    // Método para atualizar um objeto Funcionario no banco de dados
    public function atualizar($obj) {        
        // Verificando se o objeto passado é uma instância de Funcionario
        if ($obj instanceof Funcionario) {
            // Consulta SQL para atualizar dados na tabela de pessoas
            $sql = "UPDATE pessoas SET nome='".$obj->getNome()."', cpf='".$obj->getCpf()."', email='".$obj->getEmail()."' WHERE id_pessoa='".$obj->getId()."'";
            // Executando a consulta
            $result = $this->conexao->query($sql);

            // Verificando se a atualização foi bem-sucedida
            if ($result) {
                // Consulta SQL para atualizar dados na tabela de funcionários
                $sql = "UPDATE funcionarios SET salario='".$obj->getSalario()."', cargo='".$obj->getCargo()."', dataContratacao='".$obj->getDataContratacao()."' WHERE id_funcionario='".$obj->getId()."'";
                // Executando a consulta
                $result = $this->conexao->query($sql);
                // Retornando true se a atualização foi bem-sucedida
                return true;   
            }
        }
        // Retornando false se o objeto não for uma instância de Funcionario
        return false;
    }

    // Método para deletar um objeto Funcionario do banco de dados
    public function deletar($obj) { 
        // Verificando se o objeto passado é uma instância de Funcionario
        if ($obj instanceof Funcionario) {
            // Consulta SQL para excluir dados da tabela de funcionários
            $sql = "DELETE FROM funcionarios WHERE id_funcionario='".$obj->getId()."'";
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
        // Retornando false se o objeto não for uma instância de Funcionario
        return false;
    }

    // Método para cadastrar um novo objeto Funcionario no banco de dados
    public function cadastrar($obj) {  
        // Verificando se o objeto passado é uma instância de Funcionario
        if ($obj instanceof Funcionario) {      
            // Consulta SQL para inserir dados na tabela de pessoas
            $sql = "INSERT INTO pessoas (nome, cpf, email) VALUES ('".$obj->getNome()."', '".$obj->getCpf()."', '".$obj->getEmail()."')";
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

                // Consulta SQL para inserir dados na tabela de funcionários
                $sql = "INSERT INTO funcionarios (id_funcionario, salario, cargo, dataContratacao) VALUES ('".$lastAdd['id_pessoa']."', '".$obj->getSalario()."', '".$obj->getCargo()."', '" .$obj->getDataContratacao()."')";
                // Executando a consulta
                $result = $this->conexao->query($sql);
                // Exibindo mensagem e retornando true se a inserção foi bem-sucedida
                echo "Cadastrado com Sucesso";
                return true;
            }
            
        } else {
            // Exibindo mensagem de erro e retornando false se o objeto não for uma instância de Funcionario
            echo "Erro ao Cadastrar";
            return false;
        }
    }

    // Método para buscar um objeto Funcionario por ID
    public function buscarPorId($id) {
        // Consulta SQL para obter dados da tabela de pessoas
        $sql = "SELECT * FROM pessoas WHERE id_pessoa = $id";
        // Executando a consulta
        $result = $this->conexao->query($sql);
        // Inicializando variável para armazenar dados da pessoa
        $dadosPessoa = "";

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Armazenando os dados da pessoa
            $dadosPessoa = $result->fetch_assoc();
        }

        // Consulta SQL para obter dados da tabela de funcionários
        $sql = "SELECT * FROM funcionarios WHERE id_funcionario = $id";
        // Executando a consulta
        $result = $this->conexao->query($sql);
        // Inicializando variável para armazenar dados do funcionário
        $dadosFuncionario = "";

        // Verificando se há resultados na consulta
        if ($result->num_rows > 0) {
            // Armazenando os dados do funcionário
            $dadosFuncionario = $result->fetch_assoc();
        }

        // Criando um objeto Funcionario com todos os dados
        if ($dadosPessoa != "" && $dadosFuncionario != "") {
            // Criando um objeto Funcionario com dados da pessoa e do funcionário
            $funcionario = new Funcionario($dadosPessoa['nome'], $dadosPessoa['cpf'], $dadosPessoa['email'], $dadosFuncionario['salario'], $dadosFuncionario['cargo'], $dadosFuncionario['dataContratacao']);
            // Configurando o ID do objeto Funcionario
            $funcionario->setId($dadosPessoa['id_pessoa']);
            // Retornando o objeto Funcionario
            return $funcionario;
        }
        // Retornando null se não houver dados
        return null;
    }
}
?>
