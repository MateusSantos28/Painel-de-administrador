-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/09/2025 às 13:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `users` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cod` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id`, `users`, `password`, `email`, `cod`) VALUES
(35, 'dudu', '$2y$10$mA6k28LQgV3UOw7iEg3VXu8wh/A8xM3UkoCivHgaPYDrTeJ6mBuvK', '', '1538'),
(46, 'gabrielle', '$2y$10$9V8IpF7d6FnYtGGvtL2Wru5di7DeoB0jpX6Lh4eszfz2NIBQ/uWFm', '', '9430'),
(57, 'loccaliza a acao', '$2y$10$Yv7o//0CkpSeCqtbSZw6/OTCixtd/WsIfxMEI1ey3O3EDqP.MU1j.', 'loccalizasao@gmail.com', '8039'),
(65, 'rodigo', '$2y$10$jEkGSiksb8VeKUBLAGOfLOLMoUYfWJ9/tJNoTWFCT8sZE9NQ9Sh/O', 'mateus.bento@aluno.escolajaimealencar.com.br', '7759'),
(66, 'mateus', '$2y$10$QDSYUYM43Pc3SlzpPZfVuO7CQGmUu/Q0OW0nA2kfQ.nYWr74r8J.e', 'martetyhdf6uy6r7@gmail.com', '8882');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
