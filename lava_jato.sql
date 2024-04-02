-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Dez-2023 às 03:56
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lava_jato`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `enderecoCobranca` varchar(255) NOT NULL,
  `formaPagamento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `enderecoCobranca`, `formaPagamento`) VALUES
(1, 'Rua das Flores, 123, Bairro Alegre', 'Cartão de Crédito'),
(2, 'Avenida Central, 456, Bairro Tranquilo', 'Boleto Bancário'),
(3, 'Travessa do Sol, 789, Bairro Sossegado', 'Transferência Bancária'),
(4, ' Alameda da Paz, 567, Bairro Harmonia', 'PayPal'),
(5, 'Praça da Liberdade, 678, Bairro', 'Cartão de Débito'),
(12, 'Rua das Flores, 123', 'Cartão de Crédito'),
(13, ' Avenida Principal, 456', 'Boleto Bancário'),
(14, 'Alameda das Praias, 654', 'Pix'),
(15, 'Rua dos Estudantes, 987', 'PayPal'),
(16, 'Travessa das Árvores', 'Transferência Bancária');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `salario` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `dataContratacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `salario`, `cargo`, `dataContratacao`) VALUES
(6, 'R$ 2.500,00', 'Lavador de Carros', '2023-03-10'),
(7, 'R$ 2.200,00', 'Atendente de Caixa', '2023-05-17'),
(8, 'R$ 2.800,00', 'Gerente de Serviços', '2023-04-05'),
(9, 'R$ 2.400,00', 'Atendente de Vendas', '2023-05-23'),
(10, 'R$ 2.600,00', 'Lavador de Carros', '2023-06-15'),
(17, 'R$ 7.500,00', 'Gerente de Projetos', '2020-11-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id_pessoa`, `nome`, `cpf`, `email`) VALUES
(1, 'Katiane Nascimento', '123.456.789-01', 'katiane@email.com'),
(2, 'Julio Cesar Rodrigues', '234.567.890-12', 'julio@email.com'),
(3, 'Heitor Matias', '345.678.901-23', 'heitor@email.com'),
(4, 'Rickelmy Freitas', '456.789.012-34', ' rickelmy@email.com'),
(5, 'Geovane Brandemburg ', '567.890.123-45', 'geovane@email.com'),
(6, 'João Zanotti', '678.901.234-56', ' joao@email.com'),
(7, 'André Boecker', '789.012.345-67', 'andre@email.com'),
(8, 'Emilfrann Barbosa ', '890.123.456-78', 'emilfrann@email.com'),
(9, 'Isabelly Zanotti', '901.234.567-89', 'isabelly@email.com'),
(10, 'Davi dos Reis', '012.345.678-90', 'davi@email.com'),
(11, 'Pedro Henrique', '123.456.789-01', 'pedro@email.com'),
(12, 'Êndrio Gabriel', '987.654.321-09', 'endrio@email.com'),
(13, 'Igor Massi', '876.543.210-98', 'igor@email.com'),
(14, 'Sindy Catalunha', '543.210.987-65', 'sindy@email.com'),
(15, 'Lucas Ronconi ', '654.321.098-76', 'lucas@email.com'),
(16, 'Laélio Onofre', '765.432.109-87', 'laelio@email.com'),
(17, 'Ádrian Malavasi', '444.555.666-77', 'adrian@email.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `duracao` varchar(255) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id_servico`, `descricao`, `valor`, `data`, `duracao`, `funcionario`, `cliente`) VALUES
(1, 'Lavagem Simples', 'R$ 80,00', '2023-12-13 16:00:00', ' 45 minutos', 6, 5),
(2, 'Lavagem Simples C/Cera', 'R$ 120,00', '2023-12-14 08:50:00', '2 horas', 7, 4),
(3, 'Lavagem Chassis', 'R$ 160,00', '2023-12-13 10:00:00', '1 hora e 30 minutos', 8, 3),
(4, 'Lavagem de Motor', 'R$ 220,00', '2023-12-13 08:40:00', '1 hora e 15 minutos', 9, 2),
(5, 'Proteção de Pintura', 'R$ 175,00', '2023-12-14 10:40:00', '3 horas', 10, 1),
(6, 'Lavagem Simples', 'R$ 80,00', '2023-12-12 12:50:00', '45 min', 6, 4),
(7, 'Polimento Cristalizado', 'R$300,00', '2023-12-13 14:00:00', '3 horas', 7, 2),
(8, 'Lavagem Simples', '80,00', '2023-12-13 15:00:00', '45 minutos', 17, 13),
(9, 'Proteção de Pintura', 'R$ 175,00', '2023-12-10 10:15:00', '3 horas', 10, 14),
(10, 'Lavagem de Motor', 'R$ 220,00', '2023-12-01 17:50:00', '1 hora e 15 minutos', 6, 15),
(11, 'Lavagem de Banco', 'R$ 155,00', '2023-12-01 15:20:00', '1 hora e 30 minutos', 17, 16),
(12, 'Lavagem Teto a Seco', 'R$ 200,00', '2023-12-05 14:20:00', '1 hora e 15 minutos', 17, 12);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`),
  ADD KEY `id_cliente_fk` (`cliente`),
  ADD KEY `id_funcionario_fk` (`funcionario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `id_clientes_pfk` FOREIGN KEY (`id_cliente`) REFERENCES `pessoas` (`id_pessoa`);

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `id_funcionario_pfk` FOREIGN KEY (`id_funcionario`) REFERENCES `pessoas` (`id_pessoa`);

--
-- Limitadores para a tabela `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `id_cliente_fk` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `id_funcionario_fk` FOREIGN KEY (`funcionario`) REFERENCES `funcionarios` (`id_funcionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
