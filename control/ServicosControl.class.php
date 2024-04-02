<?php
// Incluindo as classes necessárias
require_once "../control/FuncionarioControl.class.php";
require_once "../control/ClientesControl.class.php";
require_once "../Classes/Servicos.class.php";

// Definindo a classe ServicoControl
class ServicoControl {
    // Propriedade para armazenar a conexão com o banco de dados
    private $conexao;
    // Propriedades para armazenar instâncias de FuncionarioControl e ClienteControl
    public FuncionarioControl $funcionarioControl;
    public ClienteControl $clienteControl;

    // Construtor da classe ServicoControl
    function __construct($conexao, $funcionarioControl, $clienteControl) {
        $this->conexao = $conexao;
        $this->funcionarioControl = $funcionarioControl;
        $this->clienteControl = $clienteControl;
    }

    // Método para listar dados da tabela de serviços
    public function listar() {
        $sql = "SELECT * FROM servicos";
        $result = $this->conexao->query($sql);

        $vetServicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vetServicos[] = $row;
            }
        }

        return $vetServicos;
    }

    // Método para listar objetos de serviços
    public function listarObj() {
        $sql = "SELECT * FROM servicos";
        $result = $this->conexao->query($sql);
        $servicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $servicos[] = $row;
            }
        }
        
        if (count($servicos) != 0) {
            $vetServicos = array();
            for ($i = 0; $i < count($servicos); $i++) { 
                $vetServicos[$i] = new Servico(
                    $servicos[$i]['descricao'],
                    $servicos[$i]['valor'], 
                    $servicos[$i]['data'], 
                    $servicos[$i]['duracao'], 
                    $this->funcionarioControl->buscarPorId($servicos[$i]['funcionario']), 
                    $this->clienteControl->buscarPorId($servicos[$i]['cliente'])
                );
                $vetServicos[$i]->setId($servicos[$i]['id_servico']);
            }
            return $vetServicos;
        }
        return null;
    }

    // Método para atualizar um objeto Servico no banco de dados
    public function atualizar($obj) {    
        if ($obj instanceof Servico) {
            $sql = "UPDATE servicos SET descricao='".$obj->getDescricao()."', valor='".$obj->getValor()."', data='".$obj->getData()."', duracao='".$obj->getDuracao()."', funcionario='".$obj->getFuncionario()->getId()."', cliente='".$obj->getCliente()->getId()."' WHERE id_servico='".$obj->getId()."'";

            $result = $this->conexao->query($sql);
            return true;   
        }
        return false;
    }

    // Método para deletar um objeto Servico do banco de dados
    public function deletar($obj) { 
        if ($obj instanceof Servico) {
            $sql = "DELETE FROM servicos WHERE id_servico='".$obj->getId()."'";
            $result = $this->conexao->query($sql);
            echo "Serviço Deletado com sucesso";
            return true;
        }
        echo "Erro ao Deletar Serviço";
        return false;
    }

    // Método para cadastrar um novo objeto Servico no banco de dados
    public function cadastrar($obj) { 
        $sql = "SELECT id_cliente FROM clientes  WHERE id_cliente =".$obj->cliente->getId()."";
        $resultIdCliente = $this->conexao->query($sql);
        
        $sql = "SELECT id_funcionario FROM funcionarios WHERE id_funcionario = ".$obj->funcionario->getId()."";
        $resultIdFuncionarios = $this->conexao->query($sql);
        
        if ($resultIdCliente != "" && $resultIdFuncionarios != "") {
            $sql = "INSERT INTO servicos (`descricao`, `valor`, `data`, `duracao`, `funcionario`, `cliente`) VALUES ('".$obj->getDescricao()."', '".$obj->getValor()."', ".$obj->getData().", '".$obj->getDuracao()."', '".$obj->funcionario->getId()."', '".$obj->cliente->getId()."')";
            $result = $this->conexao->query($sql);
            return true;              
        } else {
            echo "Erro ao Cadastrar";
            return false;
        }
    }

    // Método para buscar um objeto Servico por ID
    public function buscarPorId($id) {
        // Buscando dados da tabela de serviços
        $sql = "SELECT * FROM servicos WHERE id_servico = $id";
        $result = $this->conexao->query($sql);
        $dadosServico = "";

        if ($result->num_rows > 0) {
            $dadosServico = $result->fetch_assoc();
        }

        // Criando o serviço com todos os dados
        if ($dadosServico != "") {
            $servico = new Servico(
                $dadosServico['descricao'], 
                $dadosServico['valor'], 
                $dadosServico['data'], 
                $dadosServico['duracao'], 
                $this->funcionarioControl->buscarPorId($dadosServico['funcionario']),
                $this->clienteControl->buscarPorId($dadosServico['cliente'])
            );
            $servico->setId($dadosServico['id_servico']);
            return $servico;
        }
        return null;
    }

    // Método para filtrar objetos de serviços
    public function FiltrarObj() {
        $sql = "SELECT * FROM servicos";
        $result = $this->conexao->query($sql);
        $servicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $servicos[] = $row;
            }
        }
        
        if (count($servicos) != 0) {
            $vetServicos = array();
            for ($i = 0; $i < count($servicos); $i++) { 
                $vetServicos[$i] = new Servico(
                    $servicos[$i]['descricao'],
                    $servicos[$i]['valor'], 
                    $servicos[$i]['data'], 
                    $servicos[$i]['duracao'], 
                    $this->funcionarioControl->buscarPorId($servicos[$i]['funcionario']), 
                    $this->clienteControl->buscarPorId($servicos[$i]['cliente'])
                );
                $vetServicos[$i]->setId($servicos[$i]['id_servico']);
            }
            return $vetServicos;
        }
        return null;
    }

    // Método para filtrar objetos de serviços por funcionário
    public function FiltrarServicosPorFuncionario($idFuncionario) {
        $sql = "SELECT * FROM servicos WHERE funcionario = $idFuncionario";
        // WHERE funcionario = $idFuncionario
        $result = $this->conexao->query($sql);
        $servicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $servicos[] = $row;
            }
        }
        
        if (count($servicos) != 0) {
            $vetServicos = array();
            for ($i = 0; $i < count($servicos); $i++) { 
                $vetServicos[$i] = new Servico(
                    $servicos[$i]['descricao'],
                    $servicos[$i]['valor'], 
                    $servicos[$i]['data'], 
                    $servicos[$i]['duracao'], 
                    $this->funcionarioControl->buscarPorId($servicos[$i]['funcionario']), 
                    $this->clienteControl->buscarPorId($servicos[$i]['cliente'])
                );
                
                $vetServicos[$i]->setId($servicos[$i]['id_servico']);
            }
            return $vetServicos;
        }
        return null;
    }

    // Método para filtrar objetos de serviços por cliente
    public function FiltrarServicosPorClientes($idCliente) {
        $sql = "SELECT * FROM servicos WHERE cliente = $idCliente";
        $result = $this->conexao->query($sql);
        $servicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $servicos[] = $row;
            }
        }
        
        if (count($servicos) != 0) {
            $vetServicos = array();
            for ($i = 0; $i < count($servicos); $i++) { 
                $vetServicos[$i] = new Servico(
                    $servicos[$i]['descricao'],
                    $servicos[$i]['valor'], 
                    $servicos[$i]['data'], 
                    $servicos[$i]['duracao'], 
                    $this->funcionarioControl->buscarPorId($servicos[$i]['funcionario']), 
                    $this->clienteControl->buscarPorId($servicos[$i]['cliente'])
                );
                $vetServicos[$i]->setId($servicos[$i]['id_servico']);
            }
            return $vetServicos;
        }
        return null;
    }

    // Método para filtrar objetos de serviços por descrição
    public function FiltrarServicosPorServicos($idServico) {
        $sql = "SELECT * FROM servicos WHERE descricao ='$idServico'";
        $result = $this->conexao->query($sql);
        $servicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $servicos[] = $row;
            }
        }
        
        if (count($servicos) != 0) {
            $vetServicos = array();
            for ($i = 0; $i < count($servicos); $i++) { 
                $vetServicos[$i] = new Servico(
                    $servicos[$i]['descricao'],
                    $servicos[$i]['valor'], 
                    $servicos[$i]['data'], 
                    $servicos[$i]['duracao'], 
                    $this->funcionarioControl->buscarPorId($servicos[$i]['funcionario']), 
                    $this->clienteControl->buscarPorId($servicos[$i]['cliente'])
                );
                $vetServicos[$i]->setId($servicos[$i]['id_servico']);
            }
            return $vetServicos;
        }
        return null;
    }
}

?>
