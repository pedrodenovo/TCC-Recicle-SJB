-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Fev-2023 às 21:14
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aarj`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda_funcionario`
--

CREATE TABLE `agenda_funcionario` (
  `id_agendamento` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `horario_inicio` datetime NOT NULL,
  `horario_fim` datetime NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `funcao` varchar(20) NOT NULL,
  `motorista` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome`, `telefone`, `funcao`, `motorista`) VALUES
(4, 'Pedro henrique', '16991948936', 'agenteR', 1),
(5, 'tiaguinho', '98', 'coordenador', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `func` varchar(10) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `id_funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_login`, `login`, `senha`, `func`, `data_hora`, `id_funcionario`) VALUES
(7, 'admin', 'admin', 'admin', '2023-02-05 15:53:48', 0),
(8, 'pedro', 'pedro', 'agenteR', '2023-02-05 16:06:21', 4),
(9, 'best', 'best', 'coordenado', '2023-02-05 16:07:21', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_coleta`
--

CREATE TABLE `pedidos_coleta` (
  `id_pedido` int(11) NOT NULL,
  `nome` varchar(65) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `material` varchar(40) NOT NULL,
  `telefone` varchar(60) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `dataDesejada` datetime DEFAULT NULL,
  `horaDesejada` datetime NOT NULL,
  `aceita` tinyint(1) NOT NULL DEFAULT 0,
  `enderecoURL` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos_coleta`
--

INSERT INTO `pedidos_coleta` (`id_pedido`, `nome`, `endereco`, `descricao`, `material`, `telefone`, `data_hora`, `dataDesejada`, `horaDesejada`, `aceita`, `enderecoURL`) VALUES
(46, 'Pedro henrique camargo de lima', 'Pedro Francisco, 04, Morada do sol, são joaquim da barra, SP', '', 'Papel, plastico, ', '16991948936', '2023-02-05 16:18:00', '2023-02-05 00:00:00', '0000-00-00 00:00:00', 0, 'Pedro+Francisco%2C+04%2C+sao+joaquim+da+barra%2C+SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `placa_veiculo` varchar(25) NOT NULL,
  `estado_veiculo` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `placa_veiculo`, `estado_veiculo`, `modelo`, `tipo`) VALUES
(4, 'kiler-2012', 0, 'canoa furada', 'Van');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda_funcionario`
--
ALTER TABLE `agenda_funcionario`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `fk_id_funcionario` (`id_funcionario`),
  ADD KEY `fk_id_veiculo` (`id_veiculo`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices para tabela `pedidos_coleta`
--
ALTER TABLE `pedidos_coleta`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda_funcionario`
--
ALTER TABLE `agenda_funcionario`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pedidos_coleta`
--
ALTER TABLE `pedidos_coleta`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agenda_funcionario`
--
ALTER TABLE `agenda_funcionario`
  ADD CONSTRAINT `fk_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `fk_id_veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id_veiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
