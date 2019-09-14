-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 14/09/2019 às 17:23
-- Versão do servidor: 5.7.27-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `busca_curso`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `COD_curso` int(10) UNSIGNED NOT NULL,
  `nome_curso` varchar(100) NOT NULL,
  `preco` decimal(10,2) DEFAULT '0.00',
  `tipo` varchar(50) NOT NULL DEFAULT 'EAD',
  `categoria` varchar(50) NOT NULL DEFAULT 'Agroecologia',
  `contato` varchar(100) DEFAULT 'Sem Contato',
  `path_miniatura` varchar(255) DEFAULT NULL,
  `localizacao` varchar(1024) DEFAULT 'Sem Localização',
  `detalhes` varchar(1024) NOT NULL DEFAULT 'Sem Detalhes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cursos`
--

INSERT INTO `cursos` (`COD_curso`, `nome_curso`, `preco`, `tipo`, `categoria`, `contato`, `path_miniatura`, `localizacao`, `detalhes`) VALUES
(1, 'Curso Exemplo', '19.90', 'EAD', '\r\nAgroecologia', 'DEFAULT', '_imgs/41cc38bc2f77800940bc1ccb8b039faa.png', 'DEFAULT', 'Teste '),
(2, 'Curso Exemplo2', '0.00', 'PODCAST', 'Esporte e Lazer', 'DEFAULT', '_imgs/f697c2ae0d63acba56ca5d7e559a6f4d.png', 'DEFAULT', ' teste2'),
(3, 'Curso Exemplo3', '0.00', 'PRESENCIAL', 'Esporte e Lazer', 'teste3@gmail.com', '_imgs/55da3b656a836c39043de3aa29c8e763.png', 'lfhjhjdjfhl', 'teste 3'),
(4, 'Curso Exemplo4', '19.90', 'PRESENCIAL', 'Esporte e Lazer', 'teste4@gmail.com', '_imgs/49ba08a4373b090f9b8aa79f94dd3d0c.png', 'n235 rua x bairro y', 'teste4'),
(5, 'Curso Exemplo5', '0.00', 'PRESENCIAL', 'Esporte e Lazer', 'teste5@gmail.com', '_imgs/68475c7308b2130410acc32db59c3a29.png', 'n452, rua x, bairro y', 'teste 5');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_aderidos`
--

CREATE TABLE `cursos_aderidos` (
  `COD_adesao` int(10) UNSIGNED NOT NULL,
  `COD_usuario` int(10) UNSIGNED NOT NULL,
  `COD_curso` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_categorias`
--

INSERT INTO `tb_categorias` (`categoria`) VALUES
('\r\nAgroecologia'),
('Agroindustria'),
('Analise e Desenvolvimento de Sistemas'),
('Aquacultura'),
('Biocombustiveis'),
('Biotecnologia'),
('Cafeicultura'),
('Ciencias Aeronauticas'),
('Construcao de Edificios'),
('Construcao Naval'),
('Cosmetologia'),
('Design de Jogos Digitais'),
('Design grafico'),
('Esporte e Lazer'),
('Eventos'),
('Fotografia'),
('Fruticultura'),
('Gestao Comercial'),
('Gestao da Qualidade'),
('Gestao de Petroleo e Gas'),
('Gestao de Seguranca Privada'),
('Manutencao Industrial'),
('Meliponicultura'),
('Mercadologia'),
('Mineracao'),
('Oftalmica'),
('Processamento de Dados'),
('Processos Escolares'),
('Producao Sucroalcooeira'),
('Radiologia'),
('Recursos Humanos'),
('Redes de Computadores'),
('Redes de Telecomunicacoes'),
('Secretariado'),
('Seguranca da Informacao'),
('Seguranca no Trabalho'),
('Sistemas para Internet'),
('Telematica'),
('Transporte Aereo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_de_curso`
--

CREATE TABLE `tipos_de_curso` (
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tipos_de_curso`
--

INSERT INTO `tipos_de_curso` (`tipo`) VALUES
('EAD'),
('PRESENCIAL'),
('PODCAST');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `COD_Usuario` int(10) UNSIGNED NOT NULL,
  `perm_acesso` int(10) DEFAULT '0',
  `cpf` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `path_avatar` varchar(1024) DEFAULT '_imgs\\avatar.png',
  `informacoes` varchar(1024) DEFAULT 'Sem Informações'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`COD_Usuario`, `perm_acesso`, `cpf`, `nome`, `login`, `senha`, `email`, `path_avatar`, `informacoes`) VALUES
(1, 1, '000.000.000-00', 'administrador', 'admin', '12345', 'admin@admin.com', '_imgs\\admin.png', 'Sem Informações'),
(2, 0, '222.222.222-22', 'JoÃ£o da silva', 'joao', '12345', 'aaaaaaaaaaaaaa@aaaaaaaa.com', '_imgs\\avatar.png', 'Sem Informações');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`COD_curso`);

--
-- Índices de tabela `cursos_aderidos`
--
ALTER TABLE `cursos_aderidos`
  ADD PRIMARY KEY (`COD_adesao`),
  ADD KEY `COD_usuario_fk` (`COD_usuario`),
  ADD KEY `COD_curso_fk` (`COD_curso`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`COD_Usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `COD_curso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `cursos_aderidos`
--
ALTER TABLE `cursos_aderidos`
  MODIFY `COD_adesao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `COD_Usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cursos_aderidos`
--
ALTER TABLE `cursos_aderidos`
  ADD CONSTRAINT `cursos_aderidos_ibfk_1` FOREIGN KEY (`COD_usuario`) REFERENCES `usuarios` (`COD_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_aderidos_ibfk_2` FOREIGN KEY (`COD_curso`) REFERENCES `cursos` (`COD_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
