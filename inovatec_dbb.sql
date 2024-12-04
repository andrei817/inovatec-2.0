-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2024 às 02:52
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
-- Banco de dados: `inovatec_dbb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `buffet`
--

CREATE TABLE `buffet` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `buffet`
--

INSERT INTO `buffet` (`id`, `nome`, `descricao`, `criado_em`, `tipo_id`) VALUES
(27, 'Maça do Amor', 'Culinária de festa junina', '2024-11-26 23:09:19', NULL),
(31, 'Comida baiana', 'Culinária baiana', '2024-11-27 00:07:20', NULL),
(34, 'Comida mexicana', 'tacos e nachos', '2024-11-27 12:05:37', NULL),
(35, 'Comida americana', 'Fast food', '2024-11-27 12:05:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome`) VALUES
(11, 'Faxineiro'),
(12, 'recepcionista'),
(13, 'Garçom'),
(14, 'Segurança'),
(15, 'Porteiro'),
(18, 'Barmen');

-- --------------------------------------------------------

--
-- Estrutura para tabela `escolaridades`
--

CREATE TABLE `escolaridades` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `escolaridades`
--

INSERT INTO `escolaridades` (`id`, `descricao`) VALUES
(1, 'Ensino Fundamental'),
(2, 'Ensino Medio'),
(3, 'Ensino Superior');

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `local` varchar(255) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `lotacao` varchar(45) DEFAULT NULL,
  `duracao` time DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `tema_id` int(11) DEFAULT NULL,
  `objetivo_id` int(11) DEFAULT NULL,
  `buffet_id` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status_do_evento_id` int(11) DEFAULT NULL,
  `faixa_etaria_id` int(11) DEFAULT NULL,
  `escolaridades_id` int(11) DEFAULT NULL,
  `status_social_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `data`, `local`, `hora`, `lotacao`, `duracao`, `descricao`, `criado_em`, `tema_id`, `objetivo_id`, `buffet_id`, `imagem`, `status_do_evento_id`, `faixa_etaria_id`, `escolaridades_id`, `status_social_id`) VALUES
(46, 'Dia das Mulheres', '2025-03-08', 'FAETEC CVT Nilópolis', '12:10:00', '800', '19:00:00', 'Dia das guerreiras', '2024-11-23 18:47:25', NULL, NULL, NULL, 'Mulheres.jpeg', 1, 4, 2, 1),
(47, 'Dia das crianças', '2024-10-12', 'FAETEC CVT  Nilópolis', '11:00:00', '120', '15:30:00', 'Muita diversão', '2024-11-23 18:48:30', NULL, NULL, NULL, 'dia_das_criancas.jpg', 1, 4, 1, 2),
(48, 'Páscoa', '2024-03-20', 'FAETEC CVT Nilópolis', '13:30:00', '550', '16:00:00', 'Chocolate', '2024-11-23 18:49:37', NULL, NULL, NULL, 'pascoa-546x364.jpg', 1, 4, 1, 1),
(49, 'Consciência negra', '2024-11-20', 'FAETEC CVT Nilópolis', '13:00:00', '500', '18:00:00', 'VIDAS NEGRAS IMPORTAM', '2024-11-23 18:50:58', NULL, NULL, NULL, 'evento_67422412b00075.33762759_consciencia_negra.png', 1, 4, 1, 2),
(66, 'Halloween', '2024-10-31', 'FAETEC CVT Nilópolis', '15:00:00', '129', '17:00:00', 'Dia das bruxas', '2024-11-30 18:49:08', NULL, NULL, NULL, 'evento_674b5e24b8c439.36893788_evento_674b42d3e33512.91695459_evento_674a4a996c84a3.42274448_evento_6747df1a592416.82720923_evento_674219a22a1430.28935556_Halloween_eventos.jpg', 1, 5, 2, 1),
(67, 'Festa Junina', '2024-07-30', 'FAETEC CVT Nilópolis', '14:00:00', '156', '17:00:00', 'Arráia da faetec', '2024-12-01 23:22:33', 23, 7, 27, 'evento_674cefb9465666.74744990_evento_6747dfa878de31.77109973_evento_67421abb367807.90235256_festa_junina.jpg', 1, 4, 2, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_buffet`
--

CREATE TABLE `evento_buffet` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `buffet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `evento_buffet`
--

INSERT INTO `evento_buffet` (`id`, `evento_id`, `buffet_id`) VALUES
(30, 49, 27),
(32, 48, 35),
(35, 67, 27),
(40, 66, 27),
(42, 46, 27),
(43, 47, 27);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_objetivo`
--

CREATE TABLE `evento_objetivo` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `objetivo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `evento_objetivo`
--

INSERT INTO `evento_objetivo` (`id`, `evento_id`, `objetivo_id`) VALUES
(25, 49, 7),
(27, 48, 7),
(30, 67, 7),
(35, 66, 21),
(37, 46, 7),
(38, 47, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_staff`
--

CREATE TABLE `evento_staff` (
  `id` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `evento_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `evento_staff`
--

INSERT INTO `evento_staff` (`id`, `criado_em`, `evento_id`, `staff_id`) VALUES
(6, '2024-11-25 01:33:08', 46, 17),
(8, '2024-11-26 23:15:33', 47, 30),
(9, '2024-12-02 02:02:26', 66, 26),
(10, '2024-12-02 02:02:49', 67, 33);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_tema`
--

CREATE TABLE `evento_tema` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `evento_tema`
--

INSERT INTO `evento_tema` (`id`, `evento_id`, `tema_id`) VALUES
(29, 49, 14),
(31, 48, 27),
(34, 67, 23),
(39, 66, 14),
(41, 46, 14),
(42, 47, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `faixa_etaria`
--

CREATE TABLE `faixa_etaria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `faixa_etaria`
--

INSERT INTO `faixa_etaria` (`id`, `descricao`) VALUES
(4, 'Livre'),
(5, 'Maior'),
(6, 'Menor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `numero` int(45) DEFAULT NULL,
  `responsavel` varchar(100) DEFAULT NULL,
  `função` varchar(100) DEFAULT NULL,
  `pronome` varchar(100) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cep` varchar(50) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `instituicao`
--

INSERT INTO `instituicao` (`id`, `nome`, `endereco`, `email`, `telefone`, `numero`, `responsavel`, `função`, `pronome`, `cnpj`, `estado`, `cidade`, `bairro`, `cep`, `criado_em`) VALUES
(70, 'faetec', '470 estrada general olimpio da fonseca', 'faetec@gmail.com', '2126919015', NULL, 'Patrícia', NULL, 'esta intituição', '31608763002563', 'rj', 'nilopolis', 'paiol', '26545470', '2024-12-04 01:02:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `objetivo`
--

CREATE TABLE `objetivo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `objetivo`
--

INSERT INTO `objetivo` (`id`, `nome`, `descricao`, `criado_em`) VALUES
(7, 'Arrecadação', 'Just Dance', '2024-11-13 02:35:39'),
(19, 'just dance', 'venha dançar', '2024-11-29 14:57:02'),
(20, 'Formatura ', 'formandos 2024', '2024-11-29 14:57:20'),
(21, 'Desfile', 'desfile', '2024-11-29 14:57:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `problemas_evento`
--

CREATE TABLE `problemas_evento` (
  `id` int(11) NOT NULL,
  `nome_evento` varchar(255) NOT NULL,
  `data_evento` date NOT NULL,
  `descricao_problema` text NOT NULL,
  `data_reportada` timestamp NOT NULL DEFAULT current_timestamp(),
  `contato` varchar(255) NOT NULL,
  `evento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `problemas_evento`
--

INSERT INTO `problemas_evento` (`id`, `nome_evento`, `data_evento`, `descricao_problema`, `data_reportada`, `contato`, `evento_id`) VALUES
(6, '', '2024-10-12', 'Houve um pequeno atraso ', '2024-11-25 00:40:35', 'nicolle@gmail.com', 47),
(7, '', '2024-11-20', 'motivos de imprevistos', '2024-11-25 00:47:51', 'erica@gmail.com', 49),
(8, '', '2024-07-31', 'Alguêm se Machucou', '2024-12-02 23:08:49', 'caua@gmail.com', 47);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtor`
--

CREATE TABLE `produtor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `pergunta_seg` varchar(255) DEFAULT NULL,
  `resposta_seg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `produtor`
--

INSERT INTO `produtor` (`id`, `nome`, `email`, `telefone`, `senha`, `cpf`, `criado_em`, `pergunta_seg`, `resposta_seg`) VALUES
(20, 'nicolle', 'nicollevitoria@gmail.com', '97856357', 'e7f02c8a6a5305271a508b8ab3e9034c', '227.897.685-98', '2024-11-06 04:31:36', NULL, NULL),
(30, 'erica', 'ericasouza@gmail.com', '987658788', 'a8698009bce6d1b8c2128eddefc25aad', '227.435.765-08', '2024-11-15 16:06:31', NULL, NULL),
(32, 'admin', 'admin@admin', '', '21232f297a57a5a743894a0e4a801fc3', '', '2024-11-19 19:09:25', NULL, NULL),
(33, 'andrei', 'andreiluiz@gmail.com', '21983442525', '72c7fa2e96912023150c1d82d06d2100', '22725987709', '2024-11-30 03:12:43', 'qual a cor do céu?', 'azul'),
(36, 'caua', 'cauafelipe@gmail.com', '98574633', '240cf8cac0a6cfb9ef0c56a050a2c5c6', '231.504.776-09', '2024-12-01 02:23:32', 'qual é  a minha cor favorita', 'verde');

-- --------------------------------------------------------

--
-- Estrutura para tabela `staffs_eventos`
--

CREATE TABLE `staffs_eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `cargo` varchar(100) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `staffs_eventos`
--

INSERT INTO `staffs_eventos` (`id`, `nome`, `telefone`, `email`, `criado_em`, `cargo`, `cargo_id`) VALUES
(17, 'nicolle', '97856357', 'nicollevitoria@gmail.com', '2024-11-20 13:58:13', NULL, NULL),
(26, 'andrei', '983442525', 'andreieluiz234@gmail.com', '2024-11-24 03:10:20', NULL, 12),
(30, 'erica', '98574633', 'ericasouza@gmail.com', '2024-11-24 04:01:35', NULL, 14),
(31, 'nicolle', '987056643', 'nicollevitoria@gmail.com', '2024-12-01 17:49:46', NULL, NULL),
(32, 'nicolle', '987056643', 'nicollevitoria@gmail.com', '2024-12-01 18:15:17', NULL, 13),
(33, 'caua', '97856357', 'cauafelipe@gmail.com', '2024-12-01 18:17:32', NULL, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `staff_cargo`
--

CREATE TABLE `staff_cargo` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `data_associacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `staff_cargo`
--

INSERT INTO `staff_cargo` (`id`, `staff_id`, `cargo_id`, `data_associacao`) VALUES
(1, 31, 14, '2024-12-01 17:49:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_do_evento`
--

CREATE TABLE `status_do_evento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `status_do_evento`
--

INSERT INTO `status_do_evento` (`id`, `nome`) VALUES
(1, 'Concluido'),
(2, 'Cancelado'),
(3, 'Em adamento'),
(4, 'Adiado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_social`
--

CREATE TABLE `status_social` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `status_social`
--

INSERT INTO `status_social` (`id`, `descricao`, `created_at`) VALUES
(1, 'A', '2024-10-20 01:23:17'),
(2, 'B', '2024-10-20 01:25:07'),
(3, 'C', '2024-10-20 01:25:10'),
(4, 'D', '2024-10-20 01:25:14'),
(5, 'E', '2024-10-20 01:25:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tema`
--

CREATE TABLE `tema` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tema`
--

INSERT INTO `tema` (`id`, `nome`, `descricao`, `criado_em`) VALUES
(14, 'Dia das Mulheres', 'Dia das guerreiras', '2024-11-20 16:23:12'),
(15, 'Consciência negra', 'Vidas negras importam', '2024-11-20 16:35:29'),
(23, 'Festa Junina', 'arráia', '2024-11-27 00:08:02'),
(25, 'Dia das crianças', 'Muitas brincadeiras e diversão', '2024-11-29 16:23:53'),
(26, 'Halloween', 'Dia das bruxas', '2024-11-29 16:24:15'),
(27, 'Páscoa', 'Chocolate', '2024-11-29 16:24:35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id`, `descricao`) VALUES
(1, 'prato principal'),
(2, 'bebidas'),
(3, 'sobremesa');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `buffet`
--
ALTER TABLE `buffet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo` (`tipo_id`);

--
-- Índices de tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `escolaridades`
--
ALTER TABLE `escolaridades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tema_id` (`tema_id`),
  ADD KEY `fk_objetivo_id` (`objetivo_id`),
  ADD KEY `fk_buffet_id` (`buffet_id`),
  ADD KEY `fk_status_do_evento` (`status_do_evento_id`),
  ADD KEY `fk_faixa_etaria` (`faixa_etaria_id`),
  ADD KEY `fk_escolaridades` (`escolaridades_id`),
  ADD KEY `fk_status_social` (`status_social_id`);

--
-- Índices de tabela `evento_buffet`
--
ALTER TABLE `evento_buffet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`),
  ADD KEY `buffet_id` (`buffet_id`);

--
-- Índices de tabela `evento_objetivo`
--
ALTER TABLE `evento_objetivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`),
  ADD KEY `objetivo_id` (`objetivo_id`);

--
-- Índices de tabela `evento_staff`
--
ALTER TABLE `evento_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evento` (`evento_id`),
  ADD KEY `fk_staff` (`staff_id`);

--
-- Índices de tabela `evento_tema`
--
ALTER TABLE `evento_tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Índices de tabela `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `objetivo`
--
ALTER TABLE `objetivo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `problemas_evento`
--
ALTER TABLE `problemas_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evento_id` (`evento_id`);

--
-- Índices de tabela `produtor`
--
ALTER TABLE `produtor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `staffs_eventos`
--
ALTER TABLE `staffs_eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- Índices de tabela `staff_cargo`
--
ALTER TABLE `staff_cargo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`,`cargo_id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- Índices de tabela `status_do_evento`
--
ALTER TABLE `status_do_evento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status_social`
--
ALTER TABLE `status_social`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `buffet`
--
ALTER TABLE `buffet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `escolaridades`
--
ALTER TABLE `escolaridades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de tabela `evento_buffet`
--
ALTER TABLE `evento_buffet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `evento_objetivo`
--
ALTER TABLE `evento_objetivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `evento_staff`
--
ALTER TABLE `evento_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `evento_tema`
--
ALTER TABLE `evento_tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `objetivo`
--
ALTER TABLE `objetivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `problemas_evento`
--
ALTER TABLE `problemas_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtor`
--
ALTER TABLE `produtor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `staffs_eventos`
--
ALTER TABLE `staffs_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `staff_cargo`
--
ALTER TABLE `staff_cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `status_do_evento`
--
ALTER TABLE `status_do_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `status_social`
--
ALTER TABLE `status_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `buffet`
--
ALTER TABLE `buffet`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`);

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_buffet_id` FOREIGN KEY (`buffet_id`) REFERENCES `buffet` (`id`),
  ADD CONSTRAINT `fk_escolaridades` FOREIGN KEY (`escolaridades_id`) REFERENCES `escolaridades` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_faixa_etaria` FOREIGN KEY (`faixa_etaria_id`) REFERENCES `faixa_etaria` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_objetivo_id` FOREIGN KEY (`objetivo_id`) REFERENCES `objetivo` (`id`),
  ADD CONSTRAINT `fk_status_do_evento` FOREIGN KEY (`status_do_evento_id`) REFERENCES `status_do_evento` (`id`),
  ADD CONSTRAINT `fk_status_social` FOREIGN KEY (`status_social_id`) REFERENCES `status_social` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tema_id` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`);

--
-- Restrições para tabelas `evento_buffet`
--
ALTER TABLE `evento_buffet`
  ADD CONSTRAINT `evento_buffet_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `evento_buffet_ibfk_2` FOREIGN KEY (`buffet_id`) REFERENCES `buffet` (`id`);

--
-- Restrições para tabelas `evento_objetivo`
--
ALTER TABLE `evento_objetivo`
  ADD CONSTRAINT `evento_objetivo_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `evento_objetivo_ibfk_2` FOREIGN KEY (`objetivo_id`) REFERENCES `objetivo` (`id`);

--
-- Restrições para tabelas `evento_staff`
--
ALTER TABLE `evento_staff`
  ADD CONSTRAINT `fk_evento` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_staff` FOREIGN KEY (`staff_id`) REFERENCES `staffs_eventos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `evento_tema`
--
ALTER TABLE `evento_tema`
  ADD CONSTRAINT `evento_tema_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `evento_tema_ibfk_2` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`);

--
-- Restrições para tabelas `problemas_evento`
--
ALTER TABLE `problemas_evento`
  ADD CONSTRAINT `fk_evento_id` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`);

--
-- Restrições para tabelas `staffs_eventos`
--
ALTER TABLE `staffs_eventos`
  ADD CONSTRAINT `staffs_eventos_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`);

--
-- Restrições para tabelas `staff_cargo`
--
ALTER TABLE `staff_cargo`
  ADD CONSTRAINT `staff_cargo_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffs_eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_cargo_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
