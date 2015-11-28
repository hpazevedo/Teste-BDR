-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 28-Nov-2015 às 15:29
-- Versão do servidor: 5.5.42-cll
-- versão do PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `hpacombr_wee`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE IF NOT EXISTS `tarefas` (
  `codigo` int(6) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `descricao` text NOT NULL,
  `prioridade` int(2) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`codigo`, `titulo`, `descricao`, `prioridade`) VALUES
(1, 'ativar usuario', 'ativacao de usuario beta1', 1),
(2, 'Deletar usuario', 'apagar usuario beta3', 2),
(3, 'Alterar nome ', 'Alteração de nome de usuario do ID 3', 2),
(4, 'Ativacao de usuario', 'ativar uhsuario ID 34', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
