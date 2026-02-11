-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/06/2025 às 21:41
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
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id`, `users`, `password`) VALUES
(35, 'dudu', '$2y$10$mA6k28LQgV3UOw7iEg3VXu8wh/A8xM3UkoCivHgaPYDrTeJ6mBuvK'),
(41, 'maryanne', '$2y$10$4gAwmSPTxIBUyXdsmmljVOYflF5cqKE9sbXqFWInjTVqVJKBpeOqG'),
(42, 'alisson', '$2y$10$HsLdUtmCnQ/GrFjyujBRc.8vYAOvF4Z3cUdpo6GIi4w7qWt5dKF.i'),
(44, 'mateus', '$2y$10$VAliGaDVkDCQ3iErBG7X4OK8lCaNg2DjiHNGKFP5w2BuS3qa816ci'),
(47, 'lucas', '$2y$10$tTFxb9SDGGjgI9Q2keCrvuqCiBujiK6FMKmrvgzYfBG2r.Ut/NSxq'),
(48, 'eduardo', '$2y$10$DS/l3PZEgh2Kw.Q3peyaC.IUws140DsHW6InxXGErMc0F/.SqDS3i'),
(49, 'gabriel', '$2y$10$eo7FT6EG30HpBDEbYiPB/O1ThqMD94jnLEyfaNdN9J.vgLhsCZ6Z6'),
(52, 'novo_cadastro', '$2y$10$1ZAttleamGl2zLij8TJ3DOt01Lnkrc3gWvClUYhY/en//03Wnfv02');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
