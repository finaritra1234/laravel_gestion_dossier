-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 03, 2023 at 12:23 PM
-- Server version: 8.0.33
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gest_dossier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'RAKOTO', 'heritiana@gmail.com', '$2y$10$Z5TAS8Sd/Hl89BwCcL5bQOa7dzR.O8vDWCVzNNHCWXMZVf8E0VqZ2', NULL, '2023-08-01 11:31:14', '2023-08-01 11:31:14'),
(2, 'meva', 'meva@gmail.com', '$2y$10$JyIDegKfQyIP8xYGfowx3e6MJytOUTS6P9zGCC/RwjaJ0Se4Dzz4q', NULL, '2023-08-03 06:08:10', '2023-08-03 06:08:10'),
(3, 'soa', 'soa@gmail.com', '$2y$10$ZqwL3ifdsOZI6nO/Y969meCeiBv7FT7RM0PyHgzZ6iZukgElel7ym', NULL, '2023-08-03 06:12:44', '2023-08-03 06:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `dossiers`
--

DROP TABLE IF EXISTS `dossiers`;
CREATE TABLE IF NOT EXISTS `dossiers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_dossier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_dossier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dossiers`
--

INSERT INTO `dossiers` (`id`, `type_dossier`, `nb_dossier`, `created_at`, `updated_at`) VALUES
(1, 'Avenant', '1', '2023-08-01 11:34:38', '2023-08-01 11:34:38'),
(4, 'Libre', '1', '2023-08-01 11:35:29', '2023-08-01 11:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
CREATE TABLE IF NOT EXISTS `enseignants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `im` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naiss` date NOT NULL,
  `lieu_naiss` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `corps` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acte` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `enseignants_im_unique` (`im`),
  KEY `enseignants_etablissement_id_foreign` (`etablissement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enseignants`
--

INSERT INTO `enseignants` (`id`, `im`, `nom`, `prenom`, `date_naiss`, `lieu_naiss`, `corps`, `grad`, `indice`, `acte`, `etablissement_id`, `created_at`, `updated_at`) VALUES
(1, '125452', 'JOEL', 'Meva', '2023-07-30', 'Antanamahalan', 'cord', 'grad', 'indice', 'acte', 2, '2023-08-01 11:36:43', '2023-08-03 06:32:06'),
(2, '364588', 'ROLEX', 'jean', '2023-04-10', 'Antanamahalan', 'cord', 'grad', 'indice', 'acte', 1, '2023-08-01 11:37:22', '2023-08-03 06:32:18'),
(3, '123456', 'LARAVEL', 'Symphony', '2022-08-28', 'Informatique', 'soa', 'en', 'indice', 'acte', 2, '2023-08-02 13:34:44', '2023-08-03 06:32:40'),
(4, '557856', 'GOKA', 'malay', '2023-08-01', 'ANdrefana', 'cord', 'grad', 'indice', 'acte', 1, '2023-08-02 13:40:09', '2023-08-03 06:33:02'),
(5, '789878', 'RAMEVATAHA', 'Ngita volo', '2009-04-08', 'AMBOHITSIFATATRA', 'cord', 'grad', 'indice', 'acte', 2, '2023-08-03 06:30:33', '2023-08-03 06:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cisco` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_etabl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_etabl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `etablissements`
--

INSERT INTO `etablissements` (`id`, `cisco`, `nom_etabl`, `adresse_etabl`, `created_at`, `updated_at`) VALUES
(1, 'Andramena', 'Andramena', 'Andramena', '2023-08-01 11:33:23', '2023-08-01 11:33:23'),
(2, 'Andringitra', 'Andringitra', 'Andringitra', '2023-08-01 11:33:35', '2023-08-01 11:33:35'),
(3, 'Razanadraz', 'Razanadraz', 'Razanadraz', '2023-08-01 11:33:54', '2023-08-01 11:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_06_07_121318_create_admins_table', 1),
(3, '2023_07_28_192507_create_etablissements_table', 1),
(4, '2023_07_28_193237_create_enseignants_table', 1),
(5, '2023_07_31_080348_create_dossiers_table', 1),
(6, '2023_07_31_080634_create_responsables_table', 1),
(7, '2023_07_31_081011_create_traitements_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsables`
--

DROP TABLE IF EXISTS `responsables`;
CREATE TABLE IF NOT EXISTS `responsables` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responsables`
--

INSERT INTO `responsables` (`id`, `nom`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Finance', 'Responsable finance', '2023-08-01 11:37:43', '2023-08-01 11:40:11'),
(2, 'Visa prefet', 'Responsavle visa prefet', '2023-08-01 11:39:49', '2023-08-01 11:40:25'),
(3, 'Prefet', 'Responsable prefet', '2023-08-01 11:40:00', '2023-08-01 11:40:39'),
(4, 'Dreen', 'responsable dreen', '2023-08-01 12:26:43', '2023-08-01 12:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `traitements`
--

DROP TABLE IF EXISTS `traitements`;
CREATE TABLE IF NOT EXISTS `traitements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_depot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_envoye` date DEFAULT NULL,
  `date_retour` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motif` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enseignant_id` bigint UNSIGNED NOT NULL,
  `dossier_id` bigint UNSIGNED NOT NULL,
  `responsable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `traitements_dossier_id_foreign` (`dossier_id`),
  KEY `traitements_responsable_id_foreign` (`responsable_id`),
  KEY `traitements_enseignant_id_foreign` (`enseignant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traitements`
--

INSERT INTO `traitements` (`id`, `date_depot`, `date_envoye`, `date_retour`, `status`, `motif`, `enseignant_id`, `dossier_id`, `responsable_id`, `created_at`, `updated_at`) VALUES
(1, '2023-07-31', '2023-08-02', '2023-08-02', 'REJETER', 'Dossier  incomplete', 2, 1, 1, '2023-08-01 17:49:09', '2023-08-02 15:42:54'),
(2, '2023-08-02', '2023-08-02', '2023-08-02', 'REJETER', 'Information incomplet', 1, 1, 2, '2023-08-02 08:48:07', '2023-08-02 15:43:31'),
(3, '2023-08-02', '2023-08-02', '2023-08-02', 'REJETER', 'Erreur sur IM', 3, 1, 1, '2023-08-02 13:35:06', '2023-08-02 15:44:13'),
(4, '2023-08-02', NULL, NULL, NULL, NULL, 4, 1, 4, '2023-08-02 13:45:32', '2023-08-02 13:45:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enseignants`
--
ALTER TABLE `enseignants`
  ADD CONSTRAINT `enseignants_etablissement_id_foreign` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `traitements`
--
ALTER TABLE `traitements`
  ADD CONSTRAINT `traitements_dossier_id_foreign` FOREIGN KEY (`dossier_id`) REFERENCES `dossiers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traitements_enseignant_id_foreign` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traitements_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `responsables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
