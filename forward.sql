-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2018 at 10:57 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
USE forward;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE "comentarios" ;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_post`, `id_user`, `comentario`, `data`) VALUES
(1, 91, 2, 'Seu vacilao', '2018-09-23 20:21:42'),
(3, 91, 1, 'hue', '2018-09-23 20:36:31'),
(5, 91, 1, 'fodase', '2018-09-23 20:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE "fotos" ;

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
CREATE TABLE "posts" ;

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
(85, 1, 'dasfadhfasud', 'Trump', 'trump', '2018-09-22 18:14:35', 1),
(89, 13, 'cu', 'Camila', 'santanacah', '2018-09-22 21:12:02', 1),
(91, 1, 'Teste comentarios', 'Trump', 'trump', '2018-09-23 19:54:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `relacao`
--

DROP TABLE IF EXISTS `relacao`;
CREATE TABLE "relacao" ;

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
(41, 11, 13, '1');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE "usuarios" ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `email`, `nome`, `bio`, `profile`) VALUES
(1, 'trump', '123', 'trump@gmail.com', 'Trump', '45th President of the United States of My Ass', 1),
(2, 'ronald', '123', 'ronald@123', 'Ronald', 'McDonalds caralhooooooooo', 1),
(5, 'yago83', '111', 'yago_rj@hotmail.com', 'Yaguin meno da favela', 'que isso', 1),
(6, 'germano', '123', 'germano@gmail.com', 'Germano', '', 0),
(7, 'bruno', '123', 'bruno007@gmail.com', 'Bruno', '', 1),
(9, 'Unkybr', '123', 'xrenan@gmail.com', 'Renanzin rx vrau', '', 1),
(10, 'Edu', 'edu', 'edu@gmail.com', 'Edu', 'hueheuhe', 1),
(11, 'purucas', '123', 'puruca@email.com', 'Puruca', 'ta nervoso', 1),
(12, 'leandro', '123', 'leandro@gmail.com', 'leandro', '', 1),
(13, 'santanacah', '111', 'camila@gmail.com', 'Camila', 'kakakaka', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
