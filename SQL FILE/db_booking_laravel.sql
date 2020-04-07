-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 03:53 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_booking_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descride` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `descride`, `created_at`, `updated_at`) VALUES
(1, 'Mrs.Hzzzzzz', 'Prof. Keanu Dietrich', '2020-01-16 08:17:54', '2020-02-02 06:25:05'),
(2, 'Dr.SayHiiii', 'Dr. Elijah Hartmann DVM', '2020-01-16 08:17:54', '2020-02-02 06:26:49'),
(3, 'Mr.', 'Heaven Will', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(4, 'Mr.', 'Dr. Valentina Daugherty', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(5, 'Prof.', 'Marge Borer Sr.', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(6, 'Prof.', 'Dr. Camryn Ebert', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(7, 'Mr.', 'Mallie Franecki', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(8, 'Mr.', 'Wyman Dickens PhD', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(9, 'Prof.', 'Mrs. Shana Tremblay IV', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(10, 'Prof.', 'Lane Bosco', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(11, 'Dr.', 'Dr. August Kozey II', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(12, 'Mr.', 'Macie Wilderman', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(13, 'Dr.', 'Dr. Cecelia Durgan Sr.', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(14, 'Miss', 'Dr. Nelson Quitzon', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(15, 'Ms.', 'Isabell Wunsch', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(16, 'Mrs.', 'Prof. Glen Schmeler', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(17, 'Mr.', 'Amina Halvorson Sr.', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(18, 'Prof.', 'Elva Goldner', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(19, 'Ms.', 'Shawn DuBuque', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(20, 'Prof.', 'Domenica Dietrich', '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(21, 'Ms.MinhTest', 'Descride', '2020-01-16 08:28:13', '2020-01-16 08:28:13'),
(22, 'Title', 'Des', '2020-02-02 06:29:45', '2020-02-02 06:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallerys`
--

CREATE TABLE `gallerys` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descride` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallerys`
--

INSERT INTO `gallerys` (`id`, `title`, `descride`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'Mrs.', 'Riley Frami', 12, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(2, 'Dr.', 'Julius Greenholt', 2, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(3, 'Dr.', 'Amani Corwin MD', 19, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(4, 'Mr.', 'Joanny Wolff', 4, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(5, 'Prof.', 'Prof. Stan Considine', 14, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(6, 'Dr.', 'Gail Bins', 13, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(7, 'Prof.', 'Piper Franecki', 11, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(8, 'Mr.', 'Troy Kutch', 5, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(9, 'Prof.', 'Bobby Langosh', 10, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(10, 'Dr.', 'Nicholaus Will', 7, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(11, 'Dr.', 'Jordon Haag Jr.', 8, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(12, 'Dr.', 'Bartholome Mueller', 15, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(13, 'Mr.', 'Horace Christiansen', 5, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(14, 'Dr.', 'Dr. Misty Renner', 11, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(15, 'Mr.', 'Coby Nikolaus I', 18, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(16, 'Dr.', 'Kira Wilkinson', 4, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(17, 'Dr.', 'Prof. Waylon Pfannerstill', 15, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(18, 'Ms.', 'Prof. Emma Crist', 8, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(19, 'Dr.', 'Kirk Upton', 6, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(20, 'Ms.', 'Sylvester Purdy', 3, '2020-01-16 08:17:54', '2020-01-16 08:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2014_10_12_100000_create_password_resets_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2020_01_06_141952_create_permissions_table', 1),
(34, '2020_01_06_142009_create_roles_table', 1),
(35, '2020_01_06_142434_create_categories_table', 1),
(36, '2020_01_06_142511_create_gallerys_table', 1),
(37, '2020_01_06_142525_create_products_table', 1),
(38, '2020_01_06_144626_create_roles_permissions_table', 1),
(39, '2020_01_06_150021_create_users_table', 1),
(40, '2020_01_06_150056_create_bookings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descride` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `descride`, `created_at`, `updated_at`) VALUES
(1, 'Write - PageAdmin', 'Only write', NULL, NULL),
(2, 'Read - PageAdmin', 'Only read', NULL, NULL),
(3, 'Booking - PageStore', 'Only booking', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descride` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pathimage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prices` int(11) NOT NULL,
  `gallery_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `descride`, `pathimage`, `prices`, `gallery_id`, `created_at`, `updated_at`) VALUES
(1, 'Prof.', 'Prof. Johanna Fahey', 'Ms. Palma Torp', 4421, 3, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(2, 'Mr.', 'Prof. Milo Pacocha', 'Guido Hayes', 98103, 18, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(3, 'Dr.', 'Odessa Stiedemann', 'Kay Pollich', 12967, 17, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(4, 'Mr.', 'Dr. Lou Dach', 'Jennyfer Daugherty', 25156, 8, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(5, 'Mr.', 'Mr. Christopher Hahn', 'Benton Harvey MD', 8625, 12, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(6, 'Dr.', 'Ms. Ada Heathcote I', 'Doug Kozey DVM', 48510, 12, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(7, 'Ms.', 'Rickey Heller DDS', 'Miss Viola Kertzmann Jr.', 60830, 20, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(8, 'Dr.', 'Ivy Zemlak PhD', 'Laurine Abbott', 8890, 20, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(9, 'Dr.', 'Ezequiel Streich', 'Dr. Dudley Mohr IV', 68523, 7, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(10, 'Prof.', 'Hazel Willms', 'Prof. Nolan Fay I', 9496, 17, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(11, 'Dr.', 'Miss Melissa Ferry', 'Rachael Larson MD', 39844, 17, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(12, 'Mrs.', 'Loraine Johnston', 'Dr. Noemie Denesik', 88777, 15, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(13, 'Prof.', 'Johnpaul Hirthe', 'Mrs. Brooklyn Sauer DVM', 65508, 3, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(14, 'Dr.', 'Dr. Riley Reichel III', 'Twila Kuhic', 47773, 18, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(15, 'Dr.', 'Patricia Konopelski', 'Noelia Rau', 14561, 10, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(16, 'Prof.', 'Elenor Conn', 'Mrs. Jaquelin Marks', 68241, 14, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(17, 'Mrs.', 'Dr. Merle Pacocha I', 'Maynard Collier', 90931, 3, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(18, 'Prof.', 'Mr. Christop McKenzie', 'Nikko Becker', 94215, 10, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(19, 'Mr.', 'Ernie Bernier I', 'Darrel McDermott MD', 87190, 16, '2020-01-16 08:17:54', '2020-01-16 08:17:54'),
(20, 'Dr.', 'Marcelina Borer', 'Chase Hill IV', 78061, 20, '2020-01-16 08:17:54', '2020-01-16 08:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descride` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `descride`, `created_at`, `updated_at`) VALUES
(1, 'admin-master', 'This is master', NULL, NULL),
(2, 'admin-sub', 'This is master sub', NULL, NULL),
(3, 'customer', 'This is customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permissions_id` int(10) UNSIGNED NOT NULL,
  `roles_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `permissions_id`, `roles_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 2, 2),
(5, 3, 2),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `roles_id`) VALUES
(1, 'user01', 'admin@exemple.com', NULL, '$2y$10$MEVfBD5olZ01smY6SAsHVe7xlGOuJmE/Q5be.ZyYt/W3O3VSwqEae', NULL, NULL, NULL, 1),
(2, 'user022', 'adminsubr@exemple.com', NULL, '$2y$10$LnP/YLv5nqrw/ICWf6loS.kuu.jPAj.C/lznKv3vDGAbjF8UG4OJO', NULL, NULL, '2020-01-17 02:40:45', 2),
(3, 'customerTest02', 'customer@exemple.com', NULL, '$2y$10$SbBYndIplijfPzqUEpNbHev9KbX/1FRIjoQaDcKYEnf2kioM.SH0.', NULL, NULL, '2020-01-17 03:27:30', 3),
(5, 'Test0002', 'asddad@gmai.com', NULL, '$2y$10$9iunWeTflGjif8NSL7UR8.7hg9fDW8gIPFqCbWy7p0QDHrRtwlyrS', NULL, '2020-01-17 02:27:34', '2020-01-17 02:51:44', 1),
(6, 'TestGetList11dsaaaaa', 'asdashdb@gmail.com', NULL, '$2y$10$NoOVgCEJ82Sp6.K2Kv1xO.9bIkgxCjnTOZu8cTrJHC9KmhRX2tTwy', NULL, '2020-01-17 02:28:40', '2020-01-17 02:52:04', 1),
(7, 'user03', 'email@example.com', NULL, '123456', NULL, '2020-01-17 03:44:20', '2020-01-17 03:44:20', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_customer_id_foreign` (`customer_id`),
  ADD KEY `bookings_products_id_foreign` (`products_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallerys`
--
ALTER TABLE `gallerys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallerys_categorie_id_foreign` (`categorie_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_gallery_id_foreign` (`gallery_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_permissions_permissions_id_foreign` (`permissions_id`),
  ADD KEY `roles_permissions_roles_id_foreign` (`roles_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_roles_id_foreign` (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallerys`
--
ALTER TABLE `gallerys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `gallerys`
--
ALTER TABLE `gallerys`
  ADD CONSTRAINT `gallerys_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `gallerys` (`id`);

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permissions_id_foreign` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `roles_permissions_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
