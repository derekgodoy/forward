-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2018 at 12:26 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forward`
--
CREATE DATABASE IF NOT EXISTS `forward` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `forward`;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_post`, `id_user`, `comentario`, `data`) VALUES
(1, 91, 2, 'Seu vacilao', '2018-09-23 20:21:42'),
(3, 91, 1, 'hue', '2018-09-23 20:36:31'),
(5, 91, 1, 'fodase', '2018-09-23 20:45:03'),
(6, 91, 1, 'ggggg', '2018-09-23 21:06:27'),
(7, 89, 1, 'oi linda', '2018-09-23 21:07:12'),
(8, 92, 1, 'aeuhaeuh', '2018-09-26 00:22:37'),
(9, 93, 15, 'teste', '2018-09-26 02:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `legenda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fotos`
--

INSERT INTO `fotos` (`id`, `id_user`, `nome`, `legenda`) VALUES
(35, 6, 'galeria6-1536703669', 'porrraaaaaaa'),
(36, 6, 'galeria6-1536703675', 'asdfasdf'),
(37, 6, 'galeria6-1536703683', 'asdfadsf'),
(39, 1, 'galeria1-1536711063', '1'),
(41, 1, 'galeria1-1536711198', '2'),
(43, 5, 'galeria5-1536877006', 'aaa'),
(44, 5, 'galeria5-1536877024', 'janela'),
(45, 5, 'galeria5-1537220891', 'eu lindo');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `post` varchar(140) NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `login_user` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profile_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `post`, `nome_user`, `login_user`, `data`, `profile_user`) VALUES
(34, 5, 'bora fuma crak\r\n', 'Yaguin meno da favela', 'yago83', '2018-09-01 15:07:39', 1),
(37, 9, 'Tenho críticas relativas a esta rede social. Não é funcional e há muitos bugs, não recomendo. 5 estrelas', 'Renanzin rx vrau', 'Unkybr', '2018-08-30 22:17:56', 1),
(38, 10, 'Tenho uma certa crítica. Não tenho visto nenhum outro anão nesta rede. Isso é PRECONCEITO, VAI TODO MUNDO TOMAR NO CU SEUS FODIDOS', 'Edu', 'Edu', '2018-08-30 22:30:54', 1),
(41, 10, 'TA APAGANDO MEU COMENTÁRIO PQ??? DEIXA EU EXPOR A VERDADE. SE NÃO GOSTOU MAMA A MINHA PICA QUEIMADA', 'Edu', 'Edu', '2018-08-30 22:26:10', 1),
(50, 5, 'é nois neguin', 'Yaguin meno da favela', 'yago83', '2018-09-01 15:07:39', 1),
(51, 2, 'Boa tarde', 'Ronald', 'ronald', '2018-09-22 17:31:01', 1),
(59, 5, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Yaguin meno da favela', 'yago83', '2018-09-03 22:21:30', 1),
(68, 6, 'fdfsa', 'Germano', 'germano', '2018-09-04 23:39:59', 0),
(70, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:18:56', 1),
(71, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:18:58', 1),
(72, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:18:59', 1),
(73, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:19:02', 1),
(74, 12, 'cu\r\n', 'leandro', 'leandro', '2018-09-13 22:27:58', 1),
(75, 11, 'Puruca na área', 'Puruca', 'purucas', '2018-09-13 22:29:38', 1),
(76, 11, 'Calem a boca', 'Puruca', 'purucas', '2018-09-13 23:52:31', 1),
(85, 1, 'dasfadhfasud', 'Trump', 'trump', '2018-09-25 01:22:29', 1),
(89, 13, 'cu', 'Camila', 'santanacah', '2018-09-22 21:12:02', 1),
(91, 1, 'Teste comentarios', 'Trump', 'trump', '2018-09-25 01:22:29', 1),
(92, 1, 'kkkkkkk', 'Trump', 'trump', '2018-09-25 01:22:29', 1),
(93, 14, 'Primeiro post oficial desta experiência', 'Derek', 'derek', '2018-09-26 00:32:03', 0),
(96, 15, 'teste\r\n', 'teste', 'teste', '2018-09-26 02:07:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `relacao`
--

DROP TABLE IF EXISTS `relacao`;
CREATE TABLE `relacao` (
  `id` int(11) NOT NULL,
  `id_segue` int(11) NOT NULL,
  `id_seguido` int(11) NOT NULL,
  `aut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relacao`
--

INSERT INTO `relacao` (`id`, `id_segue`, `id_seguido`, `aut`) VALUES
(14, 1, 2, '1'),
(22, 13, 5, '1'),
(24, 1, 9, '1'),
(27, 13, 1, '1'),
(30, 13, 11, '1'),
(31, 13, 6, '1'),
(32, 13, 9, '1'),
(35, 1, 5, '1'),
(38, 11, 2, '1'),
(39, 11, 1, '1'),
(40, 11, 10, '1'),
(41, 11, 13, '1'),
(42, 1, 13, '1'),
(43, 15, 14, '1');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `profile` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `email`, `nome`, `bio`, `profile`) VALUES
(14, 'derek', 'MTIz', 'derekgodoy@gmail.com', 'Derek', 'Criador deste site e melhor usuário', 0),
(15, 'teste', 'dGVzdGU=', 'teste@teste', 'teste', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relacao`
--
ALTER TABLE `relacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `relacao`
--
ALTER TABLE `relacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
