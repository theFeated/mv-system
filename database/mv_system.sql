-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3309
-- Generation Time: Apr 02, 2024 at 01:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mv_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `agencyID` varchar(11) NOT NULL,
  `agencyName` varchar(150) NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `telNum` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`agencyID`, `agencyName`, `contactPerson`, `address`, `telNum`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ag001', 'CHeD', 'Mary Ann Kasava', 'Fly High St. Davao City', '555-1133', '2024-03-23 03:23:43', '2024-03-23 03:23:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `collegeID` varchar(11) NOT NULL,
  `collegeName` varchar(150) NOT NULL,
  `collegeDean` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`collegeID`, `collegeName`, `collegeDean`, `created_at`, `updated_at`, `deleted_at`) VALUES
('CIC002', 'College of Information and Computing', 'Dr. Ivy', '2024-03-23 03:18:57', '2024-03-24 05:28:43', NULL),
('COB003', 'College of Business', 'Dr. Bess Ness', '2024-03-23 03:19:33', '2024-03-24 05:28:43', NULL),
('CoT001', 'College of Technology', 'Dr. Tech Know', '2024-03-23 03:12:00', '2024-03-24 05:28:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `externalfunds`
--

CREATE TABLE `externalfunds` (
  `exFundID` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `researchID` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agencyID` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contribution` int(11) NOT NULL,
  `purpose` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `externalfunds`
--

INSERT INTO `externalfunds` (`exFundID`, `researchID`, `agencyID`, `contribution`, `purpose`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ExF-001', 'r001', 'ag001', 100000, 'For boracay vacation this holy week', '2024-03-24 20:24:43', '2024-03-24 20:24:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2024_03_16_113929_add_delete_at_college', 2),
(21, '2024_03_17_212147_create_agency_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `monitorings`
--

CREATE TABLE `monitorings` (
  `monitoringID` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `researchID` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `progress` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remarks` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `monitoringPersonnel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `monitorings`
--

INSERT INTO `monitorings` (`monitoringID`, `researchID`, `progress`, `status`, `remarks`, `monitoringPersonnel`, `date`, `deleted_at`, `created_at`, `updated_at`) VALUES
('M-001', 'r003', 'Possible Ongoing', 'Dropped', 'The research can posssibly be ongoing.', 'Reh Ret', '2024-03-13', NULL, '2024-03-24 20:09:14', '2024-03-24 20:09:14'),
('M-002', 'r001', 'Entering Phase 2', 'Ongoing', 'Blah Blah Blah Blah', 'Crisdan Antoque', '2024-03-25', NULL, '2024-03-24 20:23:12', '2024-03-24 20:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `researchID` varchar(11) NOT NULL,
  `collegeID` varchar(11) NOT NULL,
  `researcherID` varchar(11) NOT NULL,
  `agencyID` varchar(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `researchTitle` varchar(255) NOT NULL,
  `researchType` varchar(50) NOT NULL,
  `year` year(4) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `link_1` varchar(255) DEFAULT NULL,
  `link_2` varchar(255) DEFAULT NULL,
  `link_3` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `internalFund` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`researchID`, `collegeID`, `researcherID`, `agencyID`, `status`, `researchTitle`, `researchType`, `year`, `startDate`, `endDate`, `link_1`, `link_2`, `link_3`, `extension`, `internalFund`, `created_at`, `updated_at`, `deleted_at`) VALUES
('r001', 'CIC002', '2023-12345', 'ag001', 'Ongoing', 'Analysis of how pigs can fly', 'Analysis', '2024', '2024-03-13', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-24 19:54:20', '2024-03-24 21:16:11', NULL),
('r002', 'COB003', '2022-01667', NULL, 'Dropped', 'How to jump high', 'Educational', '2024', '2024-03-13', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-24 19:55:26', '2024-03-24 21:16:13', NULL),
('r003', 'COB003', '2022-01667', 'ag001', 'Dropped', 'How to do this and that', 'Analysis', '2024', '2024-03-07', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-24 19:58:50', '2024-03-24 21:16:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `researcher`
--

CREATE TABLE `researcher` (
  `researcherID` varchar(11) NOT NULL,
  `collegeID` varchar(11) NOT NULL,
  `researcherName` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contactNum` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researcher`
--

INSERT INTO `researcher` (`researcherID`, `collegeID`, `researcherName`, `email`, `contactNum`, `created_at`, `updated_at`, `deleted_at`) VALUES
('2022-01667', 'CIC002', 'Jea Ver June', 'jeaverjune01667@usep.edu.ph', '09202201667', '2024-03-23 03:22:07', '2024-03-23 03:22:07', NULL),
('2023-12345', 'COB003', 'Her Ter', 'herter@gmail.com', '666-0987', '2024-03-23 05:14:24', '2024-03-23 05:14:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `roleName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `roleDescription` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`, `roleDescription`, `created_at`, `updated_at`, `deleted_at`) VALUES
('role001', 'Research Leader', 'The person that leads the research.', '2024-03-23 03:22:38', '2024-03-23 03:22:38', NULL),
('role002', 'Principal Investigator (PI)', 'This is the lead researcher who is responsible for overseeing the entire project. The PI is responsible for:\r\nDesigning the research study\r\nObtaining funding for the research\r\nHiring and supervising research staff\r\nEnsuring that the research is conducted ethically\r\nAnalyzing the data and writing up the research findings\r\nSubmitting the research findings for publication', '2024-03-23 04:58:11', '2024-03-23 04:58:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_researchassigned`
--

CREATE TABLE `role_researchassigned` (
  `assignedID` varchar(10) NOT NULL,
  `roleID` varchar(11) NOT NULL,
  `researcherID` varchar(11) NOT NULL,
  `researchID` varchar(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_researchassigned`
--

INSERT INTO `role_researchassigned` (`assignedID`, `roleID`, `researcherID`, `researchID`, `deleted_at`, `created_at`, `updated_at`) VALUES
('A-001', 'role001', '2022-01667', 'r001', NULL, '2024-03-24 21:34:57', '2024-03-24 21:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bkKD5zxQWzGMUgX8VapO12sOQ1vgnfZ8rIGkEkpZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHRKbHNpQkdxdDdGQkxmaXl1UjNJa3BsRnJnMk13UDJVS1VYMnlDdiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Jlc2VhcmNoIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1711357178),
('gaLjqsqofT43dAbJCoubrfbzSchPQ8I9OGNHOvOD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid0RrU3VZbEhvVXp1NWEwcTZRU0tjMkUxTXZoMk1WSFZueG1zZnhLdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6NTAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1712036754),
('jSprruvQ65Z3so1RX20BB5Ce5T4pKD80IRX0Bnx3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYUZTU1ZsZlVQc2NYQTNCeHM5bzVZRU1RRkFQTDdraTIzUk9wWm9jRiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo1MDAwL3Jlc2VhcmNoL3Nob3cvcjAwMyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjUwMDAvcmVzZWFyY2gvc2hvdy9yMDAzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1712058299),
('QPWIOiuTydcFTeVzBG5292FSd0G72GrWgytTsuiO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUXhmV2tzdXMwcXdadG4zbXY2TkpWQVZHVVB5ZE1rOUdRSE02WUlhbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Jlc2VhcmNoL3Nob3cvcjAwMiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZWFyY2gvcmVzdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1711344899),
('RjUcoRxE4S6NQZDp1wEqeikqtOAMXFia7CqqIlON', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXN3QlJubHV1N3Y3ZUtOUWF4R2lQOEFXazNZSGlVUmNXYlNWeXBhVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6NTAwMC9yZXNlYXJjaC9zaG93L3IwMDMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1712044412),
('tHVGkdflOuZvCVkdlxIT6BK7b3dicsHscM3LuW78', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibWc5TXVVS3NYMXNwMklDdzVtSWFkMzl1b2Z3YmpHaXAzdzBmT0lHSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6NTAwMC9yZXNlYXJjaC9zaG93L3IwMDEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1711947980),
('Wbj1OSNnqGLrdkRdTZZYDDBcPjZkA0bzCnoSXtSt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1lUblprOXJkQTBVTGhYVWZBWHlxb2hHc1o5UWJNSlpwV2g0N3Q1VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6NTAwMC9yZXNlYXJjaCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1711628605),
('x46Oc0ms0KYve4arquH9BY4ECATM4AsOlooXCf1R', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGYwZ1AwVHNYQ0puTHc3bkxKZTZ0WXpId2F0ZDJtZmNBN2xmSFk4WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1711942266);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jean Vergel Dionsay', 'jvjunes@gmail.com', NULL, '$2y$12$zZZp29aRBkTSas4dqplVnOUa8C79Soio8b.HOoK8xXg3kToZmRSwO', NULL, '2024-03-16 03:27:06', '2024-03-16 05:29:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agencyID`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`collegeID`);

--
-- Indexes for table `externalfunds`
--
ALTER TABLE `externalfunds`
  ADD PRIMARY KEY (`exFundID`),
  ADD KEY `fk_exF_research` (`researchID`),
  ADD KEY `fk_exF_agency` (`agencyID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD UNIQUE KEY `unique_monitoring_research` (`monitoringID`,`researchID`),
  ADD KEY `fk_m_research` (`researchID`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`researchID`),
  ADD KEY `fk_r_college` (`collegeID`),
  ADD KEY `fk_r_researcher` (`researcherID`),
  ADD KEY `fk_r_agency` (`agencyID`);

--
-- Indexes for table `researcher`
--
ALTER TABLE `researcher`
  ADD PRIMARY KEY (`researcherID`),
  ADD KEY `fk_res_college` (`collegeID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `role_researchassigned`
--
ALTER TABLE `role_researchassigned`
  ADD PRIMARY KEY (`assignedID`),
  ADD UNIQUE KEY `roleID` (`roleID`,`researcherID`,`researchID`),
  ADD KEY `fk_assigned_research` (`researchID`),
  ADD KEY `fk_assigned_researcher` (`researcherID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `externalfunds`
--
ALTER TABLE `externalfunds`
  ADD CONSTRAINT `fk_exF_agency` FOREIGN KEY (`agencyID`) REFERENCES `agency` (`agencyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_exF_research` FOREIGN KEY (`researchID`) REFERENCES `research` (`researchID`) ON DELETE CASCADE;

--
-- Constraints for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD CONSTRAINT `fk_m_research` FOREIGN KEY (`researchID`) REFERENCES `research` (`researchID`) ON DELETE CASCADE;

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `fk_r_agency` FOREIGN KEY (`agencyID`) REFERENCES `agency` (`agencyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_r_college` FOREIGN KEY (`collegeID`) REFERENCES `college` (`collegeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_r_researcher` FOREIGN KEY (`researcherID`) REFERENCES `researcher` (`researcherID`) ON DELETE CASCADE;

--
-- Constraints for table `researcher`
--
ALTER TABLE `researcher`
  ADD CONSTRAINT `fk_res_college` FOREIGN KEY (`collegeID`) REFERENCES `college` (`collegeID`) ON DELETE CASCADE;

--
-- Constraints for table `role_researchassigned`
--
ALTER TABLE `role_researchassigned`
  ADD CONSTRAINT `fk_assigned_research` FOREIGN KEY (`researchID`) REFERENCES `research` (`researchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_assigned_researcher` FOREIGN KEY (`researcherID`) REFERENCES `researcher` (`researcherID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
