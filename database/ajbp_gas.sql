-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para ajbp_gas
CREATE DATABASE IF NOT EXISTS `ajbp_gas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ajbp_gas`;

-- A despejar estrutura para tabela ajbp_gas.encomendas
CREATE TABLE IF NOT EXISTS `encomendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `zona_id` int DEFAULT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `morada` text NOT NULL,
  `tipo_gas` varchar(60) NOT NULL,
  `modalidade` enum('Loja','Domicilio') NOT NULL DEFAULT 'Domicilio',
  `preco_unit` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `quantidade` int NOT NULL,
  `observacoes` text,
  `estado` varchar(30) NOT NULL DEFAULT 'Recebida',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_encomendas_zona` (`zona_id`),
  CONSTRAINT `encomendas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_encomendas_zona` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela ajbp_gas.encomendas: ~13 rows (aproximadamente)
INSERT INTO `encomendas` (`id`, `user_id`, `zona_id`, `nome`, `email`, `telefone`, `morada`, `tipo_gas`, `modalidade`, `preco_unit`, `valor_total`, `quantidade`, `observacoes`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'aswasas', 'Propano 11kg', 'Domicilio', NULL, NULL, '2', 'as', 'Pendente', '2025-12-15 15:00:41', '2025-12-16 20:01:16'),
	(2, 1, 1, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'asasasa', 'Butano 13kg', 'Domicilio', NULL, NULL, '1', '1234344', 'Entregue', '2025-12-15 19:22:54', '2025-12-16 16:22:19'),
	(3, 1, 1, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'rua do patameiro', 'Propano 45kg', 'Domicilio', NULL, NULL, '2', '213123', 'Cancelada', '2025-12-16 16:23:56', '2025-12-16 18:45:03'),
	(4, 1, NULL, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'sasas', 'Propano 45kg', 'Domicilio', NULL, NULL, '3', 'asas', 'Recebida', '2025-12-16 19:54:39', NULL),
	(5, 1, NULL, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'rrr', 'Propano 11kg', 'Domicilio', NULL, NULL, '1', '', 'Recebida', '2025-12-16 19:57:20', NULL),
	(6, 4, NULL, 'Diogo Alexandre Pinto', 'diogo123@gmail.com', '912012020', '122', 'Propano 11kg', 'Domicilio', NULL, NULL, '4', '1', 'Recebida', '2025-12-16 19:57:55', NULL),
	(9, 1, 3, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'asasas', 'Propano 11kg', 'Domicilio', 33.00, 66.00, '2', NULL, 'Recebida', '2025-12-16 20:47:02', NULL),
	(10, 1, 3, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'asasasas', 'Butano 13kg', 'Domicilio', 43.00, 172.00, '4', NULL, 'Recebida', '2025-12-16 21:53:09', NULL),
	(11, 3, 3, 'superuser', 'admin@ajbpgas.com', '012345678', 'asas', 'Propano 45kg', 'Domicilio', 110.00, 110.00, '1', NULL, 'Recebida', '2025-12-16 21:56:06', NULL),
	(12, 3, 3, 'superuser', 'admin@ajbpgas.com', '012345678', 'sadsd', 'Propano 45kg', 'Domicilio', 120.00, 120.00, '1', NULL, 'Pendente', '2025-12-16 21:56:31', '2025-12-16 21:58:32'),
	(13, 3, 3, 'superuser', 'admin@ajbpgas.com', '012345678', '1212', 'Butano 13kg', 'Domicilio', 41.00, 41.00, '1', NULL, 'Recebida', '2025-12-16 22:07:15', NULL),
	(14, 3, 3, 'superuser', 'admin@ajbpgas.com', '012345678', '1212', 'Butano 13kg', 'Domicilio', 43.00, 43.00, '1', '1212', 'Recebida', '2025-12-16 22:07:29', NULL),
	(15, 1, 3, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', 'asas', 'Propano 45kg', 'Domicilio', 120.00, 240.00, '2', NULL, 'Recebida', '2025-12-16 22:13:04', NULL);

-- A despejar estrutura para tabela ajbp_gas.mensagens
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `resposta` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `responded_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela ajbp_gas.mensagens: ~2 rows (aproximadamente)
INSERT INTO `mensagens` (`id`, `user_id`, `assunto`, `mensagem`, `resposta`, `created_at`, `responded_at`) VALUES
	(5, 1, 'asasasa', 'asasasas', 'asasasas', '2025-12-16 16:21:55', '2025-12-16 16:22:09'),
	(6, 1, 'asas', 'asas', 'assa', '2025-12-16 19:59:20', '2025-12-16 20:03:26');

-- A despejar estrutura para tabela ajbp_gas.precos
CREATE TABLE IF NOT EXISTS `precos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `zona_id` int NOT NULL,
  `tipo_gas` varchar(60) NOT NULL,
  `modalidade` enum('Loja','Domicilio') NOT NULL DEFAULT 'Domicilio',
  `preco_unit` decimal(10,2) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_zona_tipo_modalidade` (`zona_id`,`tipo_gas`,`modalidade`),
  CONSTRAINT `fk_precos_zona` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=536 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela ajbp_gas.precos: ~21 rows (aproximadamente)
INSERT INTO `precos` (`id`, `zona_id`, `tipo_gas`, `modalidade`, `preco_unit`, `updated_at`) VALUES
	(1, 1, 'Propano 11kg', 'Domicilio', 32.00, '2025-12-16 16:10:03'),
	(3, 1, 'Butano 13kg', 'Domicilio', 42.00, '2025-12-16 15:55:48'),
	(4, 1, 'Light 12kg', 'Domicilio', 29.00, '2025-12-16 15:55:48'),
	(13, 1, 'Propano 11kg', 'Loja', 30.00, '2025-12-16 20:05:16'),
	(15, 1, 'Butano 13kg', 'Loja', 40.00, '2025-12-16 15:55:48'),
	(16, 1, 'Light 12kg', 'Loja', 25.00, '2025-12-16 15:55:48'),
	(17, 3, 'Propano 11kg', 'Loja', 30.00, '2025-12-16 21:55:23'),
	(18, 3, 'Propano 11kg', 'Domicilio', 33.00, '2025-12-16 16:10:03'),
	(20, 3, 'Butano 13kg', 'Loja', 40.00, '2025-12-16 15:48:52'),
	(43, 2, 'Propano 11kg', 'Loja', 30.00, '2025-12-16 20:05:28'),
	(44, 2, 'Propano 11kg', 'Domicilio', 34.00, '2025-12-16 16:04:51'),
	(46, 2, 'Butano 13kg', 'Loja', 40.00, '2025-12-16 16:04:51'),
	(47, 2, 'Butano 13kg', 'Domicilio', 45.00, '2025-12-16 16:10:03'),
	(48, 2, 'Light 12kg', 'Loja', 25.00, '2025-12-16 16:04:51'),
	(49, 2, 'Light 12kg', 'Domicilio', 31.00, '2025-12-16 16:04:51'),
	(61, 3, 'Butano 13kg', 'Domicilio', 43.00, '2025-12-16 22:07:20'),
	(62, 3, 'Light 12kg', 'Loja', 25.00, '2025-12-16 16:10:03'),
	(63, 3, 'Light 12kg', 'Domicilio', 30.00, '2025-12-16 16:10:03'),
	(80, 3, 'Propano 45kg', 'Domicilio', 120.00, '2025-12-16 21:56:22'),
	(87, 2, 'Propano 45kg', 'Domicilio', 125.00, '2025-12-16 17:52:51'),
	(94, 1, 'Propano 45kg', 'Domicilio', 118.00, '2025-12-16 17:52:51');

-- A despejar estrutura para tabela ajbp_gas.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `telemovel` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela ajbp_gas.utilizadores: ~3 rows (aproximadamente)
INSERT INTO `utilizadores` (`id`, `nome`, `email`, `telemovel`, `password_hash`, `created_at`, `role`) VALUES
	(1, 'Pedro Peralta', 'pedroperalta2004@gmail.com', '913764304', '$2y$10$Zo0M2Mi7rtnuukrd0uT5qeyXnflnViSoCxCJEZP5RHftmrGbj4Y16', '2025-12-14 22:48:09', 'user'),
	(3, 'superuser', 'admin@ajbpgas.com', '012345678', '$2y$10$mfZNRo9AmT8kljgI0h2INuoj3sL.deU494iT7VU2cU7NulPXwxXGq', '2025-12-14 23:06:59', 'admin'),
	(4, 'Diogo Alexandre Pinto', 'diogo123@gmail.com', '912012020', '$2y$10$8mfB8/0Sp2vVqbl9FeCyDeBBtl7JnXMQOz4.ldCK3A5T2zAVHIoKS', '2025-12-16 19:08:07', 'user');

-- A despejar estrutura para tabela ajbp_gas.zonas
CREATE TABLE IF NOT EXISTS `zonas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela ajbp_gas.zonas: ~3 rows (aproximadamente)
INSERT INTO `zonas` (`id`, `nome`, `created_at`) VALUES
	(1, 'Tarouca / Armamar', '2025-12-16 12:16:31'),
	(2, 'Lamego', '2025-12-16 12:16:31'),
	(3, 'Castro Daire', '2025-12-16 12:16:31');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
