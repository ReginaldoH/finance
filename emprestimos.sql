-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/07/2025 às 04:33
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
-- Banco de dados: `emprestimos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `chave` varchar(50) NOT NULL,
  `grupo` int(11) NOT NULL,
  `pagina` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nome`, `chave`, `grupo`, `pagina`) VALUES
(1, 'Home', 'home', 0, 'Sim'),
(2, 'Configurações', 'configuracoes', 0, 'Não'),
(3, 'Usuários', 'usuarios', 1, 'Sim'),
(4, 'Acessos', 'acessos', 2, 'Sim'),
(5, 'Grupos Acesso', 'grupo_acessos', 2, 'Sim'),
(8, 'Clientes', 'clientes', 1, 'Sim'),
(9, 'Empréstimos', 'emprestimos', 0, 'Sim'),
(10, 'Formas de Pagamento', 'formas_pgto', 2, 'Sim'),
(11, 'Despesas / Pagamentos', 'pagar', 4, 'Sim'),
(12, 'Recebimentos', 'receber', 4, 'Sim'),
(13, 'Contas Vencidas', 'receber_vencidas', 4, 'Sim'),
(14, 'Relatórios Financeiros', 'relatorios_financeiro', 4, 'Não'),
(15, 'Frequências', 'frequencias', 2, 'Sim'),
(16, 'Cobranças Recorrentes', 'cobrancas', 0, 'Sim'),
(17, 'Feriados', 'feriados', 2, 'Sim'),
(18, 'Relatório de Débitos', 'relatorios_debitos', 4, 'Não'),
(19, 'Lucro Empréstimos', 'relatorios_lucros', 4, 'Sim'),
(20, 'Relatório Diário Caixa', 'relatorios_caixa', 4, 'Não'),
(21, 'Editar Contas', 'editar_contas', 4, 'Não'),
(22, 'Relatório de Inadimplêntes', 'relatorio_ina', 4, 'Não'),
(23, 'Verificar Pagamentos', 'verificar_pgtos', 0, 'Não'),
(24, 'Gestão Mensagens', 'gestao_mensagens', 0, 'Não'),
(25, 'Solicitações Empréstimos', 'solicitar_emprestimo', 0, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `data_cad` date NOT NULL,
  `registro` varchar(25) NOT NULL,
  `id_reg` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `nome`, `descricao`, `arquivo`, `data_cad`, `registro`, `id_reg`, `usuario`) VALUES
(1, 'teste', NULL, '26-03-2025-15-48-35-eupng.png', '2025-03-26', 'Receber', 3, 13),
(2, 'teste', NULL, '26-03-2025-15-50-22-planet9_Wallpaper_5000x2813.jpg', '2025-03-26', 'Receber', 8, 13),
(3, 'teste', NULL, '26-03-2025-15-50-51-00teste.pdf', '2025-03-26', 'Receber', 10, 13),
(4, 'teste', NULL, '26-03-2025-15-52-51-planet9_Wallpaper_5000x2813.jpg', '2025-03-26', 'Receber', 4, 13),
(5, 'teste', NULL, '26-03-2025-15-54-13-Nitro_Wallpaper_5000x2813.jpg', '2025-03-26', 'Receber', 11, 13),
(6, 'fgfg', NULL, '26-03-2025-17-48-29-00teste.pdf', '2025-03-26', 'Receber', 12, 13),
(10, 'fdafa fa', NULL, '14-05-2025-20-12-29-logo.png', '2025-05-14', 'Cobrança', 6, 13),
(11, '', NULL, '15-05-2025-12-16-43-Sistema-ERP-Marketing-e-Comunicação.png', '2025-05-15', 'Pagar', 0, 13),
(13, 'gfdgdf', NULL, '15-05-2025-12-41-55-fundo_log_emp.jpg', '2025-05-15', 'Receber', 108, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `data_cad` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `pix` varchar(50) DEFAULT NULL,
  `indicacao` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `pessoa` varchar(25) DEFAULT NULL,
  `grupo` varchar(100) DEFAULT NULL,
  `endereco_sec` varchar(75) DEFAULT NULL,
  `nome_sec` varchar(75) DEFAULT NULL,
  `telefone_sec` varchar(25) DEFAULT NULL,
  `status` varchar(35) DEFAULT NULL,
  `comprovante_endereco` varchar(100) DEFAULT NULL,
  `comprovante_rg` varchar(100) DEFAULT NULL,
  `dados_emprestimo` varchar(255) DEFAULT NULL,
  `senha_crip` varchar(100) DEFAULT NULL,
  `telefone2` varchar(35) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `status_cliente` varchar(50) DEFAULT NULL,
  `api_pgto` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `telefone`, `cpf`, `email`, `endereco`, `data_nasc`, `data_cad`, `obs`, `pix`, `indicacao`, `bairro`, `cidade`, `estado`, `cep`, `pessoa`, `grupo`, `endereco_sec`, `nome_sec`, `telefone_sec`, `status`, `comprovante_endereco`, `comprovante_rg`, `dados_emprestimo`, `senha_crip`, `telefone2`, `foto`, `status_cliente`, `api_pgto`) VALUES
(1, 'Cliente Teste', '(31) 97527-5084', '540.726.510-95', '', '', '0000-00-00', '2025-03-03', '', '', '', '', '', '', '', 'Física', '', '', '', '', 'Ativo', '', '', NULL, '$2y$10$XY8HwSQCByDsKD24eytXkejfn7KZJPbtThW6Jhx1rsCdaT3hnrwrG', '', '12-05-2025-15-34-55-i3.png', 'Péssimo', 'Mercado Pago'),
(11, 'Hugo Teste', '(31) 94444-4444', '000.000.000-45', 'hugotest@hotmaiol.com', 'Rua Boa Vista', '1111-11-11', '2025-03-26', '', 'gfgdfgfdgdg', 'gdgfdg', 'Cabana do Pai Tomás', 'Belo Horizonte', 'MG', '30512-660', 'Física', '', 'gfdsgs', 'gdgfdg', 'gfgsgfd', 'Ativo', '13-05-2025-18-20-29-fundo_log_emp.jpg', '26-03-2025-19-23-06-rel_teste_pdf.pdf', '2000 mil reais em 5 parcelas', '$2y$10$XY8HwSQCByDsKD24eytXkejfn7KZJPbtThW6Jhx1rsCdaT3hnrwrG', '(45) 45445', '12-05-2025-12-11-25-i2.png', 'Regular', NULL),
(15, 'aaaaaaaa', '(31) 99534-8118', '33.333.333/333', 'aaaassssaa@hotmail.com', '', '1111-11-11', '2025-03-27', '', '', '', '', '', '', '', '', '', '', '', '', 'Ativo', 'sem-foto.png', 'sem-foto.png', '', '$2y$10$r8A4iytmZe2x6yTdaO4S.uVQqud53OYyEaNjEcwtzRjFTwab3j5fO', '', '12-05-2025-12-11-07-4.jpg', 'Regular', 'Asaas'),
(16, 'Cliente testess', '(20) 00000-0000', '10.000.000/000', 'testess@hotmail.com', 'Rua Boa Vista', '1111-11-11', '2025-03-27', '', '', '', 'Cabana do Pai Tomás', 'Belo Horizonte', 'MG', '30512-660', '', '', '', '', '', 'Ativo', 'sem-foto.png', 'sem-foto.png', '', '$2y$10$ZRlIQBemHghrLatiQojFZuklO/VjhYPkhNFYfXJgk/p7ZtOyH8hM2', '', '12-05-2025-12-10-56-2.jpg', 'Ruim', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cobrancas`
--

CREATE TABLE `cobrancas` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `data_venc` date NOT NULL,
  `frequencia` varchar(25) NOT NULL,
  `valor_parcela` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cobrancas`
--

INSERT INTO `cobrancas` (`id`, `cliente`, `valor`, `parcelas`, `juros`, `multa`, `data`, `usuario`, `obs`, `data_venc`, `frequencia`, `valor_parcela`) VALUES
(1, 1, 5.00, 1, 0.00, 0.00, '2025-05-25', 13, '', '2025-05-25', 'Mensal', 5.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `logo_rel` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `ativo` varchar(5) DEFAULT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `juros_emp` int(11) DEFAULT NULL,
  `taxa_sistema` varchar(20) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `instancia` varchar(100) DEFAULT NULL,
  `dias_aviso` int(11) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `marca_dagua` varchar(5) DEFAULT NULL,
  `dias_criar_parcelas` varchar(20) DEFAULT NULL,
  `pix_sistema` varchar(50) DEFAULT NULL,
  `saldo_inicial` decimal(8,2) DEFAULT NULL,
  `verificar_pagamentos` varchar(5) DEFAULT NULL,
  `seletor_api` varchar(30) DEFAULT NULL,
  `assinatura` varchar(100) DEFAULT NULL,
  `recursos` varchar(35) DEFAULT NULL,
  `cobrar_automatico` varchar(5) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `entrada_sistema` varchar(5) DEFAULT NULL,
  `fundo_login` varchar(100) DEFAULT NULL,
  `logo_site` varchar(100) DEFAULT NULL,
  `api_pagamento` varchar(35) DEFAULT NULL,
  `chave_api_asaas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`nome`, `email`, `telefone`, `endereco`, `instagram`, `logo`, `icone`, `logo_rel`, `id`, `ativo`, `juros`, `multa`, `juros_emp`, `taxa_sistema`, `token`, `instancia`, `dias_aviso`, `cnpj`, `marca_dagua`, `dias_criar_parcelas`, `pix_sistema`, `saldo_inicial`, `verificar_pagamentos`, `seletor_api`, `assinatura`, `recursos`, `cobrar_automatico`, `access_token`, `public_key`, `entrada_sistema`, `fundo_login`, `logo_site`, `api_pagamento`, `chave_api_asaas`) VALUES
('Sys Cobranças', 'contato@hugocursos.com.br', '(31) 97527-5084', 'Rua X Número 150 - Bairro Centro Belo Horizonte - MG', '', 'logo.png', 'icone.png', 'logo.jpg', 1, 'Sim', 0.50, 5.00, 10, 'Cliente', '826e2f0c-6a32-413d-b0b9-af027eec2826', 'v9t7zpp51nsSCMeqqJWfI4lj8iGG12tyMqW8PwvBH3CojiUaHM', 3, '11.111.111/1111-11', 'Sim', 'Final de Semana', '', 0.00, 'Não', 'menuia', 'assinatura.jpg', 'Empréstimos e Cobranças', 'Sim', '', '', 'Login', '13-05-2025-15-03-01-00.webp', '12-05-2025-15-05-31-ChatGPT-Image-12-de-mai.-de-2025,-13_45_31.png', 'Asaas', '$aact_prod_000MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6OjU2YzExN2Y1LTJiOWItNDZmMy05MTBlLTZjMjBmOGViZWVjZDo6JGFhY2hfZDU3MjdjZDUtZTZmOC00ZWJjLThlNmQtNDlkYjU3ZDYyOGY2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` bigint(20) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `appkey` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `status_api` varchar(100) DEFAULT NULL,
  `horario` datetime DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `juros_emp` decimal(8,2) DEFAULT NULL,
  `data_venc` date NOT NULL,
  `frequencia` varchar(25) NOT NULL,
  `tipo_juros` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `valor_parcela` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `cliente`, `valor`, `parcelas`, `juros`, `multa`, `data`, `usuario`, `obs`, `juros_emp`, `data_venc`, `frequencia`, `tipo_juros`, `status`, `valor_parcela`) VALUES
(1, 16, 1000.00, 5, 0.50, 5.00, '2025-05-15', 13, '', 10.00, '2025-05-12', 'Diária', 'Padrão', 'Finalizado', 220.00),
(2, 1, 3000.00, 2, 1.00, 5.00, '2025-05-15', 13, '', 10.00, '2025-05-15', 'Mensal', 'Padrão', 'Finalizado', 1650.00),
(3, 1, 1000.00, 7, 0.50, 5.00, '2025-05-16', 13, '', 10.00, '2025-05-13', 'Mensal', 'Padrão', NULL, 157.14),
(4, 1, 1000.00, 6, 0.50, 5.00, '2025-05-16', 13, '', 10.00, '2025-05-12', 'Diária', 'Padrão', NULL, 183.33),
(5, 1, 1.00, 10, 0.50, 5.00, '2025-05-18', 13, '', 0.00, '2025-05-18', 'Mensal', 'Padrão', NULL, 0.10),
(6, 1, 1000.00, 1, 0.50, 5.00, '2025-05-21', 13, '', 10.00, '2025-05-21', 'Mensal', 'Somente Júros', NULL, 100.00),
(7, 1, 1000.00, 10, 0.50, 5.00, '2025-05-27', 13, '', 10.00, '2025-05-27', 'Mensal', 'Padrão', 'Finalizado', 110.00),
(8, 1, 1000.00, 10, 0.50, 5.00, '2025-05-27', 13, '', 10.00, '2025-05-27', 'Mensal', 'Padrão', 'Finalizado', 110.00),
(9, 1, 1000.00, 10, 0.50, 5.00, '2025-05-27', 13, '', 10.00, '2025-05-27', 'Mensal', 'Padrão', 'Finalizado', 110.00),
(10, 1, 1000.00, 1, 0.50, 5.00, '2025-05-29', 13, '', 10.00, '2025-05-29', 'Mensal', 'Somente Júros', NULL, 100.00),
(11, 1, 1300.00, 2, 0.50, 5.00, '2025-05-29', 1, '', 0.00, '2025-05-29', 'Mensal', 'Sem Júros', NULL, 1300.00),
(12, 1, 1000.00, 1, 0.50, 5.00, '2025-06-15', 13, '', 10.00, '2025-06-15', 'Mensal', 'Somente Júros', NULL, 100.00),
(13, 1, 800.00, 1, 0.50, 5.00, '2025-06-25', 13, '', 10.00, '2025-06-25', 'Mensal', 'Somente Júros', NULL, 100.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `feriados`
--

CREATE TABLE `feriados` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `feriados`
--

INSERT INTO `feriados` (`id`, `data`) VALUES
(1, '2024-01-01'),
(2, '2024-02-28'),
(4, '2024-02-27'),
(5, '2024-02-26'),
(6, '2024-03-28'),
(8, '2025-05-17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `formas_pgto`
--

CREATE TABLE `formas_pgto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `taxa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `formas_pgto`
--

INSERT INTO `formas_pgto` (`id`, `nome`, `taxa`) VALUES
(1, 'Pix', 0),
(2, 'Dinheiro', 0),
(3, 'Cartão de Crédito', 10),
(4, 'Cartão de Débito', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `id` int(11) NOT NULL,
  `frequencia` varchar(30) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `frequencias`
--

INSERT INTO `frequencias` (`id`, `frequencia`, `dias`) VALUES
(1, 'Nenhuma', 0),
(2, 'Diária', 1),
(3, 'Semanal', 7),
(4, 'Mensal', 30),
(5, 'Trimestral', 90),
(6, 'Semestral', 180),
(7, 'Anual', 365),
(8, 'Quinzenal', 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo_acessos`
--

CREATE TABLE `grupo_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `grupo_acessos`
--

INSERT INTO `grupo_acessos` (`id`, `nome`) VALUES
(1, 'Pessoas'),
(2, 'Cadastros'),
(4, 'Financeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagar`
--

CREATE TABLE `pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `referencia` varchar(25) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `pago` varchar(5) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pagar`
--

INSERT INTO `pagar` (`id`, `descricao`, `valor`, `data`, `data_venc`, `data_pgto`, `usuario_lanc`, `usuario_pgto`, `referencia`, `id_ref`, `pago`, `obs`) VALUES
(1, 'Cliente Teste', 1000.00, '2025-05-12', '2025-05-12', '2025-05-12', 13, 13, 'Empréstimo', 1, 'Sim', NULL),
(2, 'Cliente Teste', 2000.00, '2025-05-12', '2025-05-12', '2025-05-12', 13, 13, 'Empréstimo', 2, 'Sim', NULL),
(3, 'Cliente Teste', 1500.00, '2025-05-12', '2025-05-12', '2025-05-12', 13, 13, 'Empréstimo', 3, 'Sim', NULL),
(4, 'Conta de luz', 500.00, '2025-05-13', '2025-05-12', NULL, 13, NULL, 'Conta', NULL, 'Não', ''),
(5, '', 1350.00, '2025-05-13', '2025-05-13', '2025-05-13', 13, 13, 'Empréstimo', 4, 'Sim', NULL),
(6, 'Cliente testess', 1500.00, '2025-05-13', '2025-05-13', '2025-05-13', 13, 13, 'Empréstimo', 5, 'Sim', NULL),
(7, 'Cliente Teste', 1000.00, '2025-05-14', '2025-05-14', '2025-05-14', 13, 13, 'Empréstimo', 6, 'Sim', NULL),
(9, 'Cliente testess', 1500.00, '2025-05-14', '2025-05-14', '2025-05-14', 13, 13, 'Empréstimo', 8, 'Sim', NULL),
(10, 'Cliente testess', 1200.00, '2025-05-14', '2025-05-14', '2025-05-14', 13, 13, 'Empréstimo', 9, 'Sim', NULL),
(11, 'Cliente testess', 3500.00, '2025-05-14', '2025-05-14', '2025-05-14', 13, 13, 'Empréstimo', 10, 'Sim', NULL),
(13, 'Conta Telefone', 350.00, '2025-05-15', '2025-05-15', '2025-05-15', 13, 13, 'Conta', NULL, 'Sim', ''),
(14, 'Conta de Água', 360.00, '2025-05-15', '2025-05-15', '2025-05-15', 13, 13, 'Conta', NULL, 'Sim', ''),
(15, 'Conta Teste', 450.00, '2025-05-15', '2025-05-15', NULL, 13, NULL, 'Conta', NULL, 'Não', ''),
(16, 'aaaa', 68.00, '2025-05-15', '2025-05-15', '2025-05-15', 13, 13, 'Conta', NULL, 'Sim', ''),
(17, 'Cliente testess', 1000.00, '2025-05-15', '2025-05-15', '2025-05-15', 13, 13, 'Empréstimo', 1, 'Sim', NULL),
(18, 'Cliente Teste', 3000.00, '2025-05-15', '2025-05-15', '2025-05-15', 13, 13, 'Empréstimo', 2, 'Sim', NULL),
(19, 'Cliente Teste', 1000.00, '2025-05-16', '2025-05-16', '2025-05-16', 13, 13, 'Empréstimo', 3, 'Sim', NULL),
(20, 'Cliente Teste', 1000.00, '2025-05-16', '2025-05-16', '2025-05-16', 13, 13, 'Empréstimo', 4, 'Sim', NULL),
(21, 'Cliente Teste', 1.00, '2025-05-18', '2025-05-18', '2025-05-18', 13, 13, 'Empréstimo', 5, 'Sim', NULL),
(22, 'Cliente Teste', 1000.00, '2025-05-21', '2025-05-21', '2025-05-21', 13, 13, 'Empréstimo', 6, 'Sim', NULL),
(23, 'Cliente Teste', 1000.00, '2025-05-27', '2025-05-27', '2025-05-27', 13, 13, 'Empréstimo', 7, 'Sim', NULL),
(24, 'Cliente Teste', 1000.00, '2025-05-27', '2025-05-27', '2025-05-27', 13, 13, 'Empréstimo', 8, 'Sim', NULL),
(25, 'Cliente Teste', 1000.00, '2025-05-27', '2025-05-27', '2025-05-27', 13, 13, 'Empréstimo', 9, 'Sim', NULL),
(26, 'Cliente Teste', 1000.00, '2025-05-29', '2025-05-29', '2025-05-29', 13, 13, 'Empréstimo', 10, 'Sim', NULL),
(27, 'Cliente Teste', 1300.00, '2025-05-29', '2025-05-29', '2025-05-29', 1, 1, 'Empréstimo', 11, 'Sim', NULL),
(28, 'Cliente Teste', 1000.00, '2025-06-15', '2025-06-15', '2025-06-15', 13, 13, 'Empréstimo', 12, 'Sim', NULL),
(29, 'Cliente Teste', 1000.00, '2025-06-25', '2025-06-25', '2025-06-25', 13, 13, 'Empréstimo', 13, 'Sim', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `receber`
--

CREATE TABLE `receber` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `referencia` varchar(30) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `parcela` int(11) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `forma_pgto` varchar(30) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `ref_pix` varchar(60) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  `recorrencia` varchar(5) DEFAULT NULL,
  `hash2` varchar(100) DEFAULT NULL,
  `parcela_sem_juros` decimal(8,2) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `hora_alerta` time DEFAULT NULL,
  `alerta` varchar(5) DEFAULT NULL,
  `cobrar_sempre` varchar(5) DEFAULT NULL,
  `data_alerta` date DEFAULT NULL,
  `alerta_lembrete` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `receber`
--

INSERT INTO `receber` (`id`, `cliente`, `referencia`, `id_ref`, `valor`, `parcela`, `usuario_lanc`, `usuario_pgto`, `data`, `data_venc`, `data_pgto`, `pago`, `forma_pgto`, `descricao`, `hash`, `ref_pix`, `obs`, `frequencia`, `recorrencia`, `hash2`, `parcela_sem_juros`, `hora`, `hora_alerta`, `alerta`, `cobrar_sempre`, `data_alerta`, `alerta_lembrete`) VALUES
(1, 1, 'Conta', 0, 50.00, 0, 13, NULL, '2025-05-15', '2025-05-14', NULL, 'Não', 'Pix', 'Conta X', NULL, 'pay_qvlp2a9nn4rrkur7', '', NULL, NULL, NULL, NULL, NULL, '19:35:00', NULL, 'Sim', NULL, NULL),
(7, 16, 'Empréstimo', 1, 1357.31, 0, 13, 13, '2025-05-15', '2025-05-15', '2025-05-29', 'Sim', 'Cartão de Débito', 'Baixa Empréstimo', NULL, '', NULL, 0, NULL, NULL, NULL, '18:07:50', '08:33:00', NULL, NULL, NULL, NULL),
(10, 1, 'Empréstimo', 2, 3000.00, 0, 13, 13, '2025-05-15', '2025-05-15', '2025-05-15', 'Sim', 'Dinheiro', 'Baixa Empréstimo', NULL, NULL, NULL, 0, NULL, NULL, NULL, '23:18:59', '10:23:00', NULL, NULL, NULL, NULL),
(11, 1, 'Empréstimo', 3, 157.14, 1, 13, NULL, '2025-05-16', '2025-05-13', NULL, 'Não', NULL, 'Cliente Teste (1)', NULL, 'pay_5oc0rsjr3f215rnv', NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(12, 1, 'Empréstimo', 3, 157.14, 2, 13, NULL, '2025-05-16', '2025-06-13', NULL, 'Não', NULL, 'Cliente Teste (2)', NULL, NULL, NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(13, 1, 'Empréstimo', 3, 157.14, 3, 13, NULL, '2025-05-16', '2025-07-14', NULL, 'Não', NULL, 'Cliente Teste (3)', NULL, NULL, NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(14, 1, 'Empréstimo', 3, 157.14, 4, 13, NULL, '2025-05-16', '2025-08-13', NULL, 'Não', NULL, 'Cliente Teste (4)', NULL, NULL, NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(15, 1, 'Empréstimo', 3, 157.14, 5, 13, NULL, '2025-05-16', '2025-09-15', NULL, 'Não', NULL, 'Cliente Teste (5)', NULL, NULL, NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(16, 1, 'Empréstimo', 3, 157.14, 6, 13, NULL, '2025-05-16', '2025-10-13', NULL, 'Não', NULL, 'Cliente Teste (6)', NULL, NULL, NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(17, 1, 'Empréstimo', 3, 157.14, 7, 13, NULL, '2025-05-16', '2025-11-13', NULL, 'Não', NULL, 'Cliente Teste (7)', NULL, NULL, NULL, 0, '', NULL, 142.86, NULL, '09:51:00', NULL, NULL, NULL, NULL),
(18, 1, 'Empréstimo', 4, 200.00, 1, 13, NULL, '2025-05-16', '2025-05-13', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (1)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 166.67, '11:44:39', '08:31:00', NULL, 'Não', '2025-05-16', NULL),
(19, 1, 'Empréstimo', 4, 200.00, 2, 13, NULL, '2025-05-16', '2025-05-14', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (2)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 166.67, '11:44:39', '08:31:00', NULL, 'Não', '2025-05-16', NULL),
(20, 1, 'Empréstimo', 4, 183.33, 3, 13, NULL, '2025-05-16', '2025-05-15', NULL, 'Não', NULL, 'Cliente Teste (3)', NULL, 'pay_lh4r899sxvbjdpi1', NULL, 0, '', NULL, 166.67, NULL, '08:31:00', NULL, 'Não', '2025-05-16', NULL),
(21, 1, 'Empréstimo', 4, 183.33, 4, 13, NULL, '2025-05-16', '2025-05-16', NULL, 'Não', NULL, 'Cliente Teste (4)', NULL, NULL, NULL, 0, '', NULL, 166.67, NULL, '08:58:00', 'Sim', NULL, NULL, NULL),
(22, 1, 'Empréstimo', 4, 183.33, 5, 13, NULL, '2025-05-16', '2025-05-19', NULL, 'Não', NULL, 'Cliente Teste (5)', NULL, NULL, NULL, 0, '', NULL, 166.67, NULL, '08:58:00', 'Sim', NULL, NULL, NULL),
(23, 1, 'Empréstimo', 4, 183.33, 6, 13, 13, '2025-05-16', '2025-05-20', '2025-05-29', 'Sim', '', 'Cliente Teste (6)', NULL, NULL, NULL, 0, '', NULL, 166.67, '17:57:02', '08:58:00', 'Sim', NULL, NULL, NULL),
(24, 1, 'Empréstimo', 5, 5.00, 1, 13, NULL, '2025-05-18', '2025-05-19', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (1)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 0.10, '11:44:39', '08:38:00', NULL, NULL, NULL, NULL),
(25, 1, 'Empréstimo', 5, 5.00, 2, 13, NULL, '2025-05-18', '2025-06-18', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (2)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 0.10, '11:44:39', '08:38:00', NULL, NULL, NULL, NULL),
(26, 1, 'Empréstimo', 5, 0.10, 3, 13, NULL, '2025-05-18', '2025-07-18', NULL, 'Não', NULL, 'Cliente Teste (3)', NULL, NULL, NULL, 0, '', NULL, 0.10, NULL, '08:38:00', NULL, NULL, NULL, NULL),
(27, 1, 'Empréstimo', 5, 5.00, 4, 13, NULL, '2025-05-18', '2025-08-18', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (4)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 0.10, '11:44:39', '08:38:00', NULL, NULL, NULL, NULL),
(28, 1, 'Empréstimo', 5, 0.10, 5, 13, NULL, '2025-05-18', '2025-09-18', NULL, 'Não', NULL, 'Cliente Teste (5)', NULL, '102345603532', NULL, 0, '', NULL, 0.10, NULL, '08:38:00', NULL, NULL, NULL, NULL),
(29, 1, 'Empréstimo', 5, 5.00, 6, 13, NULL, '2025-05-18', '2025-10-20', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (6)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 0.10, '11:44:39', '08:38:00', NULL, NULL, NULL, NULL),
(30, 1, 'Empréstimo', 5, 5.00, 7, 13, NULL, '2025-05-18', '2025-11-18', '2025-05-19', 'Sim', 'PIX', 'Cliente Teste (7)', NULL, 'pay_wdx0czye9gp2u4tj', NULL, 0, '', NULL, 0.10, '11:44:39', '08:38:00', NULL, NULL, NULL, NULL),
(31, 1, 'Empréstimo', 5, 0.10, 8, 13, NULL, '2025-05-18', '2025-12-18', NULL, 'Não', NULL, 'Cliente Teste (8)', NULL, NULL, NULL, 0, '', NULL, 0.10, NULL, '08:38:00', NULL, NULL, NULL, NULL),
(32, 1, 'Empréstimo', 5, 0.10, 9, 13, NULL, '2025-05-18', '2026-01-19', NULL, 'Não', NULL, 'Cliente Teste (9)', NULL, NULL, NULL, 0, '', NULL, 0.10, NULL, '08:38:00', NULL, NULL, NULL, NULL),
(33, 1, 'Empréstimo', 5, 0.10, 10, 13, NULL, '2025-05-18', '2026-02-18', NULL, 'Não', NULL, 'Cliente Teste (10)', NULL, NULL, NULL, 0, '', NULL, 0.10, NULL, '08:38:00', NULL, NULL, NULL, NULL),
(34, 1, 'Empréstimo', 6, 100.00, 1, 13, 13, '2025-05-21', '2025-05-21', '2025-05-21', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '10:37:39', '08:32:00', NULL, NULL, NULL, NULL),
(35, 1, 'Empréstimo', 6, 100.00, 2, 13, NULL, '2025-05-21', '2025-06-23', NULL, 'Não', NULL, 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, NULL, '08:21:00', NULL, NULL, NULL, NULL),
(36, 1, 'Cobrança', 1, 5.00, 1, 13, 13, '2025-05-25', '2025-05-26', '2025-05-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, NULL, '20:38:44', '08:08:00', NULL, NULL, NULL, NULL),
(37, 1, 'Cobrança', 1, 2.00, 2, 13, 13, '2025-05-25', '2025-06-26', '2025-05-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '20:39:15', '08:37:00', NULL, NULL, NULL, NULL),
(38, 1, 'Cobrança', 1, 3.00, 3, 13, 13, '2025-05-25', '2025-07-28', '2025-05-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '20:39:24', '10:28:00', NULL, NULL, NULL, NULL),
(39, 1, 'Cobrança', 1, 7.00, 4, 13, NULL, '2025-05-25', '2025-08-28', NULL, 'Não', NULL, 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, NULL, '09:14:00', NULL, NULL, NULL, NULL),
(50, 1, 'Empréstimo', 7, 1100.00, 0, 13, 13, '2025-05-27', '2025-05-27', '2025-05-27', 'Sim', 'Pix', 'Baixa Empréstimo', NULL, NULL, NULL, 0, NULL, NULL, NULL, '22:44:22', '10:32:00', NULL, NULL, NULL, NULL),
(51, 1, 'Empréstimo', 8, 110.00, 1, 13, 13, '2025-05-27', '2025-05-27', '2025-05-27', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 0, '', NULL, 100.00, '22:47:34', '08:53:00', NULL, NULL, NULL, NULL),
(61, 1, 'Empréstimo', 8, 990.00, 0, 13, 13, '2025-05-27', '2025-05-27', '2025-05-27', 'Sim', 'Pix', 'Baixa Empréstimo', NULL, NULL, NULL, 0, NULL, NULL, NULL, '22:48:34', '08:22:00', NULL, NULL, NULL, NULL),
(72, 1, 'Empréstimo', 9, 2000.00, 0, 13, 13, '2025-05-27', '2025-05-27', '2025-05-27', 'Sim', 'Dinheiro', 'Baixa Empréstimo', NULL, NULL, NULL, 0, NULL, NULL, NULL, '22:49:40', '08:12:00', NULL, NULL, NULL, NULL),
(73, 1, 'Empréstimo', 10, 100.00, 1, 13, 13, '2025-05-29', '2025-05-29', '2025-05-29', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '18:11:19', '09:49:00', NULL, NULL, NULL, NULL),
(74, 1, 'Empréstimo', 10, 50.00, 2, 13, 13, '2025-05-29', '2025-06-30', '2025-05-29', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '18:11:50', '09:12:00', NULL, NULL, NULL, NULL),
(75, 1, 'Empréstimo', 10, 150.00, 3, 13, NULL, '2025-05-29', '2025-07-30', NULL, 'Não', NULL, 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, NULL, '10:35:00', NULL, NULL, NULL, NULL),
(76, 1, 'Empréstimo', 11, 300.00, 1, 1, 1, '2025-05-29', '2025-05-29', '2025-05-29', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 0, '', NULL, 1300.00, '18:25:36', '08:58:00', NULL, NULL, NULL, NULL),
(77, 1, 'Empréstimo', 11, 1000.00, 2, 1, NULL, '2025-05-29', '2025-05-29', NULL, 'Não', NULL, 'saaa', NULL, NULL, NULL, 0, '', NULL, NULL, NULL, '09:07:00', NULL, NULL, NULL, NULL),
(78, 11, 'Conta', 0, 645.00, 0, 13, NULL, '2025-06-12', '2025-06-12', NULL, 'Não', NULL, '645', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '10:45:00', NULL, NULL, NULL, NULL),
(79, 15, 'Conta', 0, 55.00, 0, 13, NULL, '2025-06-12', '2025-06-12', NULL, 'Não', NULL, 'Teste', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '10:00:00', NULL, NULL, NULL, NULL),
(80, 1, 'Empréstimo', 12, 100.00, 1, 13, NULL, '2025-06-15', '2025-06-16', NULL, 'Não', NULL, 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, NULL, '08:54:00', NULL, NULL, NULL, NULL),
(81, 1, 'Empréstimo', 13, 100.00, 1, 13, 13, '2025-06-25', '2025-06-25', '2025-06-25', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:39:10', '08:02:00', NULL, NULL, NULL, NULL),
(82, 1, 'Empréstimo', 13, 100.00, 2, 13, 13, '2025-06-25', '2025-07-25', '2025-06-25', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:40:28', '08:05:00', NULL, NULL, NULL, NULL),
(83, 1, 'Conta', 13, 100.00, 0, 13, NULL, '2025-06-25', '2025-06-25', '2025-06-25', 'Sim', NULL, 'Amortização Empréstimo', NULL, NULL, '', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 1, 'Empréstimo', 13, 100.00, 3, 13, 13, '2025-06-25', '2025-08-25', '2025-06-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:41:10', '09:01:00', NULL, NULL, NULL, NULL),
(85, 1, 'Empréstimo', 13, 100.00, 4, 13, 13, '2025-06-25', '2025-09-25', '2025-06-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:42:55', '09:03:00', NULL, NULL, NULL, NULL),
(86, 1, 'Empréstimo', 13, 90.00, 5, 13, 13, '2025-06-25', '2025-10-27', '2025-06-25', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:43:25', '09:01:00', NULL, NULL, NULL, NULL),
(87, 1, 'Empréstimo', 13, 90.00, 6, 13, 13, '2025-06-25', '2025-11-27', '2025-06-25', 'Sim', 'Pix', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:44:07', '10:59:00', NULL, NULL, NULL, NULL),
(88, 1, 'Conta', 13, 100.00, 0, 13, NULL, '2025-06-25', '2025-06-25', '2025-06-25', 'Sim', NULL, 'Amortização Empréstimo', NULL, NULL, '', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 1, 'Empréstimo', 13, 80.00, 7, 13, 13, '2025-06-25', '2025-12-29', '2025-06-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, 0.00, '22:45:32', '10:45:00', NULL, NULL, NULL, NULL),
(90, 1, 'Empréstimo', 13, 80.00, 8, 13, 13, '2025-06-25', '2026-01-29', '2025-06-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, NULL, '22:45:49', '10:49:00', NULL, NULL, NULL, NULL),
(91, 1, 'Empréstimo', 13, 80.00, 9, 13, 13, '2025-06-25', '2026-03-02', '2025-06-25', 'Sim', '', 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, NULL, '22:46:33', '09:48:00', NULL, NULL, NULL, NULL),
(92, 1, 'Empréstimo', 13, 80.00, 10, 13, NULL, '2025-06-25', '2026-04-02', NULL, 'Não', NULL, 'Cliente Teste (1)', NULL, NULL, NULL, 30, 'Sim', NULL, NULL, NULL, '09:18:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitar_emprestimo`
--

CREATE TABLE `solicitar_emprestimo` (
  `id` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `garantia` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `solicitar_emprestimo`
--

INSERT INTO `solicitar_emprestimo` (`id`, `cliente`, `valor`, `parcelas`, `data`, `obs`, `garantia`, `status`) VALUES
(3, 1, 3000.00, 10, '2025-03-27', 'obs testte aaaa', 'garantia teste  aa', 'Concluída'),
(6, 1, 5000.00, 12, '2025-05-12', 'adsfdafd', 'fasdfa', 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_clientes`
--

CREATE TABLE `status_clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cor` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `status_clientes`
--

INSERT INTO `status_clientes` (`id`, `nome`, `cor`) VALUES
(1, 'Bom', '#28a745'),
(2, 'Regular', '#6c757d'),
(3, 'Ruim', '#fd7e14'),
(4, 'Péssimo', '#dc3545');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `senha_crip` varchar(130) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `data` date NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `senha_crip`, `nivel`, `ativo`, `telefone`, `endereco`, `foto`, `data`, `token`) VALUES
(11, 'Marcela Recepcionista', 'marcela@hotmail.com', '', '$2y$10$CdSrS.09zGc5MucuB6IXSOPemGA75p28S1LLKS48rGRaapbD85ywW', 'Comum', 'Sim', '(31) 99534-8118', 'Rua C', 'sem-foto.jpg', '2023-05-08', ''),
(13, 'Sys-Cobrança', 'contato@hugocursos.com.br', '', '$2y$10$khs6j8JCNS/J8sB9lUGY.uq.6RsDG22LYN5bpP7IV6WPPAiy.inOq', 'Administrador', 'Sim', '(31) 97527-5084', 'aaaaaabbb', '13-05-2025-14-01-22-eupng.png', '2024-06-04', NULL),
(14, 'Teste', 'teste@hotmaiol.com', '', '$2y$10$sHcUGB/HS9q1HHGxHdtWf.Vlfj/bvEupnfD3qkoeiHDQdq3oH6v9a', 'Comum', 'Sim', '(00) 00002-0000', 'fdsf fdf adfa fa ', 'sem-foto.jpg', '2025-05-14', NULL),
(15, 'aaaaaa', 'aaaaassssa@hotmail.com', '', '$2y$10$aKmzddm6u5M.IWlFpQtiLOQvb47sKx7I4z7wxnbMeaW1c6hjZeqTW', 'Administrador', 'Sim', '(33) 33333-3333', '', 'sem-foto.jpg', '2025-05-14', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_permissoes`
--

CREATE TABLE `usuarios_permissoes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios_permissoes`
--

INSERT INTO `usuarios_permissoes` (`id`, `usuario`, `permissao`) VALUES
(93, 14, 1),
(94, 14, 2),
(95, 14, 3),
(96, 14, 4),
(97, 14, 5),
(98, 14, 8),
(99, 14, 9),
(100, 14, 10),
(101, 14, 11),
(102, 14, 12),
(103, 14, 13),
(104, 14, 14),
(105, 14, 15),
(106, 14, 16),
(107, 14, 17),
(108, 14, 18),
(109, 14, 19),
(110, 14, 20),
(111, 14, 21),
(112, 14, 22),
(113, 14, 23),
(114, 14, 24),
(115, 14, 25),
(117, 11, 12),
(118, 11, 13),
(119, 11, 19),
(120, 11, 11),
(123, 11, 18),
(124, 11, 22),
(125, 11, 8),
(126, 11, 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `feriados`
--
ALTER TABLE `feriados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `receber`
--
ALTER TABLE `receber`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `solicitar_emprestimo`
--
ALTER TABLE `solicitar_emprestimo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status_clientes`
--
ALTER TABLE `status_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `feriados`
--
ALTER TABLE `feriados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pagar`
--
ALTER TABLE `pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `receber`
--
ALTER TABLE `receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `solicitar_emprestimo`
--
ALTER TABLE `solicitar_emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `status_clientes`
--
ALTER TABLE `status_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
