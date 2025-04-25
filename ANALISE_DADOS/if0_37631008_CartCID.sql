-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql206.infinityfree.com
-- Tempo de geração: 25/02/2025 às 18:41
-- Versão do servidor: 10.6.19-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_37631008_CartCID`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Carteirinha`
--

CREATE TABLE `Carteirinha` (
  `ID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `Nome` varchar(150) NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `RG` varchar(25) NOT NULL,
  `RG_Orgao_Expeditor` varchar(25) NOT NULL,
  `RG_Data_Expeditor` date NOT NULL,
  `Sexo` enum('F','M') NOT NULL,
  `Tipo_Sanguineo` varchar(3) NOT NULL,
  `Dt_Nascimento` date NOT NULL,
  `Celular` varchar(25) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Naturalidade` varchar(25) NOT NULL,
  `Nacionalidade` varchar(25) NOT NULL,
  `Nome_Pai` varchar(150) DEFAULT NULL,
  `Nome_Mae` varchar(150) NOT NULL,
  `Nome_Responsavel` varchar(150) NOT NULL,
  `Telefone_Responsavel` varchar(25) NOT NULL,
  `Email_Responsavel` varchar(100) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `Endereco` varchar(255) NOT NULL,
  `Numero` varchar(5) NOT NULL,
  `Complemento` varchar(75) DEFAULT NULL,
  `Bairro` varchar(100) NOT NULL,
  `Cidade` varchar(75) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `QRCode` tinytext NOT NULL,
  `Dt_Validade` date NOT NULL,
  `Dt_Inclusao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Carteirinha`
--

INSERT INTO `Carteirinha` (`ID`, `CID`, `Nome`, `CPF`, `RG`, `RG_Orgao_Expeditor`, `RG_Data_Expeditor`, `Sexo`, `Tipo_Sanguineo`, `Dt_Nascimento`, `Celular`, `Email`, `Naturalidade`, `Nacionalidade`, `Nome_Pai`, `Nome_Mae`, `Nome_Responsavel`, `Telefone_Responsavel`, `Email_Responsavel`, `CEP`, `Endereco`, `Numero`, `Complemento`, `Bairro`, `Cidade`, `UF`, `QRCode`, `Dt_Validade`, `Dt_Inclusao`) VALUES
(2, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', '', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '15976', '2025-10-21', '2024-10-21 22:07:42'),
(45, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '88291', '2025-10-21', '2024-10-22 02:22:48'),
(46, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '89948', '2025-10-21', '2024-10-22 02:36:00'),
(47, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '1561', '2025-10-21', '2024-10-22 02:36:12'),
(48, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '7283', '2025-10-21', '2024-10-22 02:37:27'),
(49, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '11493', '2025-10-21', '2024-10-22 02:41:27'),
(50, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '39985', '2025-10-21', '2024-10-22 02:46:29'),
(51, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '43445', '2025-10-21', '2024-10-22 02:57:19'),
(52, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '52755', '2025-10-21', '2024-10-22 04:39:22'),
(53, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '98522', '2025-10-21', '2024-10-22 04:39:43'),
(54, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '84303', '2025-10-21', '2024-10-22 05:03:20'),
(55, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '2234', '2025-10-21', '2024-10-22 05:05:01'),
(56, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '70865', '2025-10-21', '2024-10-22 05:06:45'),
(57, 128, 'JOHN DOE', '923.981.060-98', '123456789-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto ', 'Arujá', 'SP', '13514', '2025-10-21', '2024-10-22 05:07:10'),
(58, 128, 'JOHN DOE', '547.250.868-19', '11.111.111-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Rua Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto', 'Arujá', 'SP', '76310', '2025-10-21', '2024-10-22 07:05:06'),
(59, 128, 'JOHN DOE', '547.250.868-19', '11.111.111-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Rua Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto', 'Arujá', 'SP', '3780', '2025-10-21', '2024-10-22 07:06:17'),
(60, 128, 'JOHN DOE', '221.401.930-83', '11.111.111-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1973-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Rua Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto', 'Arujá', 'SP', '71059', '2025-10-22', '2024-10-23 00:14:22'),
(61, 128, 'JOHN DOE', '221.401.930-83', '11.111.111-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1973-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Rua Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto', 'Arujá', 'SP', '77791', '2025-10-22', '2024-10-23 00:14:29'),
(62, 128, 'JOHN DOE', '221.401.930-83', '11.111.111-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1973-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', 'XING LING', 'XANG LANG', '', '', '', '07417-540', 'Rua Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto', 'Arujá', 'SP', '12300', '2025-10-22', '2024-10-23 00:16:14'),
(63, 119, 'JOHN DOE', '221.401.930-83', '11.111.111-1', 'SSP/SP', '2000-01-01', 'M', 'A+', '1970-01-01', '(11) 91234-5678', 'A@A.COM', 'SÃO PAULO', 'CHINESA', '', 'XANG LANG', '', '', '', '07417-540', 'Rua Luiz Gonzaga Colangelo Nóbrega', '151', '', 'Parque Rodrigo Barreto', 'Arujá', 'SP', '43233', '2025-10-22', '2024-10-23 01:15:31'),
(68, 129, 'JOANA DARC', '221.401.930-83', '11.111.111-1', 'SSP/SP', '2000-01-01', 'F', 'A+', '1500-01-01', '(11) 9111-1111', 'A@A.COM', 'LORENA', 'FRANÃ‡A', 'Jacques d\'Arc', 'Isabelle RomÃ©e', '', '', '', '08773-330', 'Avenida Mariano Souza Mello', '263', '', 'Vila Mogilar', 'Mogi das Cruzes', 'SP', '', '0000-00-00', '2024-11-01 00:47:25'),
(69, 129, 'JOANA DARC', '221.401.930-83', '11.111.111-1', 'SSP/SP', '2000-01-01', 'F', 'A+', '1500-01-01', '(11) 9111-1111', 'A@A.COM', 'LORENA', 'FRANÃ‡A', 'Jacques d\'Arc', 'Isabelle RomÃ©e', '', '', '', '08773-330', 'Avenida Mariano Souza Mello', '263', '', 'Vila Mogilar', 'Mogi das Cruzes', 'SP', '', '0000-00-00', '2024-11-01 00:48:20'),
(70, 129, 'JOANA DARC', '241.441.860-59', '11.111.111-1', 'SSP/SP', '2000-01-01', 'F', 'A+', '2000-01-01', '(11) 9111-1111', 'A@A.COM', 'LORENA', 'FRANÃ‡A', 'Jacques d\'Arc', 'Isabelle RomÃ©e', '', '', '', '08773-330', 'Avenida Mariano Souza Mello', '263', '', 'Vila Mogilar', 'Mogi das Cruzes', 'SP', '', '0000-00-00', '2024-11-01 00:49:32'),
(71, 129, 'JOANA DARC', '241.441.860-59', '11.111.111-1', 'SSP/SP', '2000-01-01', 'F', 'A+', '2000-01-01', '(11) 9111-1111', 'A@A.COM', 'LORENA', 'FRANÃ‡A', 'Jacques d\'Arc', 'Isabelle RomÃ©e', '', '', '', '08773-330', 'Avenida Mariano Souza Mello', '263', '', 'Vila Mogilar', 'Mogi das Cruzes', 'SP', '1089', '2025-10-31', '2024-11-01 00:54:20'),
(72, 119, 'Maria joaquina', '343.710.227-31', '11.952.372-3', 'ssp', '1998-11-08', 'F', 'A+', '1997-11-08', '(11) 9872-8728', 'mariahelena@gmail.com', 'Santo andrÃ©', 'Brasileira', 'Vantuir hahahaha', 'Maria hahahahaha', 'Maria Helena', '(12) 33234-2342', 'ghfsdhjagsdhjagsd@gmail.com', '66079-200', 'Rua Rosa de Saronsa', '221', '', 'GuamÃ¡', 'BelÃ©m', 'PA', '854', '2025-11-07', '2024-11-08 01:01:05'),
(73, 119, 'Maria Helena', '343.710.227-31', '11.952.372-3', 'ssp', '1998-11-08', 'F', 'A+', '1997-11-08', '(11) 9872-8728', 'mariahelena@gmail.com', 'Santo andrÃ©', 'Brasileira', 'Vantuir hahahaha', 'Maria hahahahaha', 'Maria Helena', '(12) 33234-2342', 'ghfsdhjagsdhjagsd@gmail.com', '66079-200', 'Rua Rosa de Saronsa', '221', '', 'GuamÃ¡', 'BelÃ©m', 'PA', '1640', '2025-11-07', '2024-11-08 01:02:55'),
(74, 119, 'Maria joaquina', '343.710.227-31', '11.952.372-3', 'ssp', '0000-00-00', 'F', 'A+', '2024-11-08', '(11) 9872-8728', 'gabi@gmail.com', 'Santo andrÃ©', 'Brasileira', 'Joao ', 'naroa', 'asdas', '(22) 3333-333_', 'maria@gmail.com', '09390-130', 'Rua Antonieta Monteiro Hauck', '222', '', 'Vila Magini', 'MauÃ¡', 'SP', '845', '2025-11-07', '2024-11-08 02:24:09'),
(75, 119, 'Maria Joaquina', '713.323.834-91', '65.554.822-1 ', 'ssp', '2024-11-11', 'M', 'A+', '2024-11-20', '(11) 8989-8989', 'gabriella@hotmail.com', 'santo andre', 'brasileira', 'joao carlos', 'maria joaquina', 'nathan alves', '(11) 8787-8787', 'gabriela@gmail.com', '09390-120', 'Avenida AntÃ´nia Rosa Fioravanti', '222', '', 'Jardim Rosina', 'MauÃ¡', 'SP', '1689', '2025-11-08', '2024-11-08 19:08:48'),
(76, 119, 'maria helena', '481.173.701-66', '18.852.843-X', 'ssp', '2024-11-07', 'M', 'A+', '2024-11-21', '(11) 9872-8728', 'gabi@gmail.com', 'Santo andrÃ©', 'Brasileira', 'Helio Amelio', 'JoÃ£o amelio', 'Reginaldo Armenio', '(11) 9995-4543', 'gabi@gmail.com', '09390-120', 'Avenida AntÃ´nia Rosa Fioravanti', '222', 'casa', 'Jardim Rosina', 'MauÃ¡', 'SP', '89', '2025-11-08', '2024-11-09 01:41:07'),
(77, 119, 'Maria Joaquina', '713.323.834-91', '65.554.822-1 ', 'ssp', '2024-11-05', 'M', 'A+', '2024-11-01', '(11) 8989-8989', 'gabriella@hotmail.com', 'santo andre', 'brasileira', 'joao carlos', 'maria joaquina', 'nathan alves', '(11) 8787-8787', 'gabriela@gmail.com', '09390-120', 'Avenida AntÃ´nia Rosa Fioravanti', '3349', 'Casa', 'Jardim Rosina', 'MauÃ¡', 'SP', '1906', '2025-11-10', '2024-11-11 01:30:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Doencas`
--

CREATE TABLE `Doencas` (
  `ID` int(11) NOT NULL,
  `CID` varchar(6) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `GRUPO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Doencas`
--

INSERT INTO `Doencas` (`ID`, `CID`, `Nome`, `GRUPO`) VALUES
(119, '6A02', 'Transtorno do Espectro do Autismo (TEA)', 1),
(120, '6A02.0', 'Transtorno do Espectro do Autismo sem deficiência intelectual (DI) e com comprometimento leve ou ausente da linguagem funcional', 1),
(121, '6A02.1', 'Transtorno do Espectro do Autismo com deficiência intelectual (DI) e com comprometimento leve ou ausente da linguagem funcional', 1),
(122, '6A02.2', 'Transtorno do Espectro do Autismo sem deficiência intelectual (DI) e com linguagem funcional prejudicada', 1),
(123, '6A02.3', 'Transtorno do Espectro do Autismo com deficiência intelectual (DI) e com linguagem funcional prejudicada', 1),
(124, '6A02.4', 'Transtorno do Espectro do Autismo sem deficiência intelectual (DI) e com ausência de linguagem funcional', 1),
(125, '6A02.5', 'Transtorno do Espectro do Autismo com deficiência intelectual (DI) e com ausência de linguagem funcional', 1),
(126, '6A02.Y', 'Outro Transtorno do Espectro do Autismo especificado', 1),
(127, '6A02.Z', 'Transtorno do Espectro do Autismo, não especificado', 1),
(128, 'F90', 'Transtorno do Déficit de Atenção com Hiperatividade (TDAH) e os Transtornos Hipercinéticos', 2),
(129, 'F91.3', 'Distúrbio Desafiador e de Oposição', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Grupo_Doencas`
--

CREATE TABLE `Grupo_Doencas` (
  `ID` int(11) NOT NULL,
  `Descrição` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Grupo_Doencas`
--

INSERT INTO `Grupo_Doencas` (`ID`, `Descrição`) VALUES
(1, 'TEA'),
(2, 'TDAH'),
(3, 'DDO');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `Carteirinha`
--
ALTER TABLE `Carteirinha`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_carteirinha_doencas` (`CID`);

--
-- Índices de tabela `Doencas`
--
ALTER TABLE `Doencas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_doencas_grupos` (`GRUPO`);

--
-- Índices de tabela `Grupo_Doencas`
--
ALTER TABLE `Grupo_Doencas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `Carteirinha`
--
ALTER TABLE `Carteirinha`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `Doencas`
--
ALTER TABLE `Doencas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de tabela `Grupo_Doencas`
--
ALTER TABLE `Grupo_Doencas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
