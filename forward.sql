-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Set-2018 às 02:27
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forward`
--
CREATE DATABASE IF NOT EXISTS `forward` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE forward;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE IF NOT EXISTS "fotos" (
"id" int(11) NOT NULL,
  "id_user" int(11) NOT NULL,
  "nome" varchar(255) NOT NULL,
  "legenda" varchar(255) NOT NULL
);

--
-- Extraindo dados da tabela `fotos`
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
-- Estrutura da tabela `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS "posts" (
"id" int(11) NOT NULL,
  "id_user" int(11) NOT NULL,
  "post" varchar(140) NOT NULL,
  "nome_user" varchar(255) NOT NULL,
  "login_user" varchar(255) NOT NULL,
  "data" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  "profile_user" tinyint(1) NOT NULL
);

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `post`, `nome_user`, `login_user`, `data`, `profile_user`) VALUES
(34, 5, 'bora fuma crak\r\n', 'Yaguin meno da favela', 'yago83', '2018-09-01 15:07:39', 1),
(36, 1, 'se fude\r\n', 'Trump', 'trump', '2018-09-13 22:03:08', 1),
(37, 9, 'Tenho críticas relativas a esta rede social. Não é funcional e há muitos bugs, não recomendo. 5 estrelas', 'Renanzin rx vrau', 'Unkybr', '2018-08-30 22:17:56', 1),
(38, 10, 'Tenho uma certa crítica. Não tenho visto nenhum outro anão nesta rede. Isso é PRECONCEITO, VAI TODO MUNDO TOMAR NO CU SEUS FODIDOS', 'Edu', 'Edu', '2018-08-30 22:30:54', 1),
(41, 10, 'TA APAGANDO MEU COMENTÁRIO PQ??? DEIXA EU EXPOR A VERDADE. SE NÃO GOSTOU MAMA A MINHA PICA QUEIMADA', 'Edu', 'Edu', '2018-08-30 22:26:10', 1),
(50, 5, 'é nois neguin', 'Yaguin meno da favela', 'yago83', '2018-09-01 15:07:39', 1),
(51, 2, 'comam drogas', 'Ronald', 'ronald', '2018-09-01 13:56:13', 1),
(55, 1, 'bosta', 'Trump', 'trump', '2018-09-13 22:03:08', 1),
(59, 5, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Yaguin meno da favela', 'yago83', '2018-09-03 22:21:30', 1),
(68, 6, 'fdfsa', 'Germano', 'germano', '2018-09-04 23:39:59', 0),
(70, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:18:56', 1),
(71, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:18:58', 1),
(72, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:18:59', 1),
(73, 5, 'aa', 'Yaguin meno da favela', 'yago83', '2018-09-13 22:19:02', 1),
(74, 12, 'cu\r\n', 'leandro', 'leandro', '2018-09-13 22:27:58', 1),
(75, 11, 'Puruca na área', 'Puruca', 'purucas', '2018-09-13 22:29:38', 1),
(76, 11, 'Calem a boca', 'Puruca', 'purucas', '2018-09-13 23:52:31', 1),
(77, 2, 'cu', 'Ronald', 'ronald', '2018-09-18 21:35:38', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao`
--

DROP TABLE IF EXISTS `relacao`;
CREATE TABLE IF NOT EXISTS "relacao" (
"id" int(11) NOT NULL,
  "id_segue" int(11) NOT NULL,
  "id_seguido" int(11) NOT NULL,
  "aut" varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS "usuarios" (
"id" int(11) NOT NULL,
  "login" varchar(255) NOT NULL,
  "senha" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL,
  "nome" varchar(255) NOT NULL,
  "profile" tinyint(1) NOT NULL
);

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `email`, `nome`, `profile`) VALUES
(1, 'trump', '123', 'trump@gmail.com', 'Trump', 1),
(2, 'ronald', '123', 'ronald@123', 'Ronald', 1),
(5, 'yago83', '111', 'yago_rj@hotmail.com', 'Yaguin meno da favela', 1),
(6, 'germano', '123', 'germano@gmail.com', 'Germano', 0),
(7, 'bruno', '123', 'bruno007@gmail.com', 'Bruno', 1),
(9, 'Unkybr', '123', 'xrenan@gmail.com', 'Renanzin rx vrau', 1),
(10, 'Edu', 'edu', 'edu@gmail.com', 'Edu', 1),
(11, 'purucas', '123', 'puruca@email.com', 'Puruca', 1),
(12, 'leandro', '', 'leandro@gmail.com', 'leandro', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
 ADD PRIMARY KEY ("id");

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY ("id");

--
-- Indexes for table `relacao`
--
ALTER TABLE `relacao`
 ADD PRIMARY KEY ("id");

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY ("id");

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
MODIFY "id" int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY "id" int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relacao`
--
ALTER TABLE `relacao`
MODIFY "id" int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY "id" int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
