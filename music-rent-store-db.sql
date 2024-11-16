-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 04:58 PM
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
-- Database: `music-rent-store-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `email`, `password`) VALUES
(1, 'Khairiz Zaidin', 'khairiz@admin.com', '$2y$10$oPYFwDyb1iy/3/MM5EbnE.11fXkOzp.BFb7yMiDC9vpYp/TFaNIhW'),
(2, 'Admin', 'admin@admin.com', '$2y$10$xgZUHZsKB9wH8nPb4h2kiuVCGp6my7ujdQychjpGIbjAxdF3cCIrC');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Electric Bass Guitar'),
(6, 'Electric Guitar'),
(7, 'Piano'),
(8, 'Acoustic Guitar');

-- --------------------------------------------------------

--
-- Table structure for table `instrument`
--

CREATE TABLE `instrument` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instrument`
--

INSERT INTO `instrument` (`id`, `title`, `owner_id`, `description`, `category_id`, `cover`, `file`) VALUES
(6, 'Gibson Non-Reverse Thunderbird', 6, 'No imperfection on the body, the Non-Reverse Thunderbird\'s distinctive styling and huge, thunderous tone make it a standout on stage and in the studio. A master tone control rounds out the simple yet highly effective control layout.', 5, '67374321a5cbb2.28987319.jpg', '67374321a607e8.20998447.pdf'),
(7, 'GIBSON 1963 FIREBIRD V', 7, 'Solidbody Electric Guitar with Mahogany/Walnut Body, Mahogany/Walnut Neck, Rosewood Fingerboard, 2 Humbucking Pickups, and Vibrato Tailpiece - Ember Red', 6, '6737429d02f783.47037637.jpg', '6737429d033479.97948775.pdf'),
(8, 'GIBSON SG STANDARD BASS', 6, '4-string Electric Bass with Mahogany Body, Mahogany Neck, Rosewood Fingerboard, and 2 Humbucking Pickups - Heritage Cherry', 5, '6738aa076a6b71.05973244.jpg', '6738aa076aac94.41567354.pdf'),
(9, 'JACK CASADY SEMI-HOLLOWBODY', 8, '4-string Semi-hollowbody Electric Bass with Maple Body, Mahogany Neck, Rosewood Fretboard, 1 Humbucking Pickup, and VariTone Control - Sparkling Burgundy', 5, '6738ab2c0fccd9.64575435.jpg', '6738ab2c102381.92454014.pdf'),
(10, 'Roland Kiyola KF-10', 8, 'Digital Piano Hybrid keyboard with 88 keys, Ebony and ivory feel and escapement, SuperNatural Piano Modelling sound generation.', 7, '6738ac97891a55.06562056.jpg', '6738ac97896e14.67549871.pdf'),
(11, 'Nord Electro 5 HP73', 9, 'The 73-key Nord Electro 5 HP 73 stage piano/synthesizer brings a new level of versatility to an already established keyboard.', 7, '6738ad411eac04.18551492.jpg', '6738ad411ef724.02728880.pdf'),
(12, 'Alesis Prestige Artist 88-key', 10, '88-key Digital Piano with Hammer-action Keyboard, 30 Voices, 256-voice Polyphony, Arpeggiator, Lesson Mode, Recording, Metronome, and Sustain Pedal', 7, '6738ade2645310.91064992.jpg', '6738ade264a0c0.81183025.pdf'),
(13, 'Donner EC6868 HUSH-I ', 11, 'HUSH I PRO Guitar offers 18 effects, 8 classic guitar body tone simulations, and 20 IR slots includes 5 modulation, 5 delay, 5 reverb, overdrive, compressor, booster.', 8, '6738af1420cb55.42389405.jpg', '6738af14212d50.27966737.pdf'),
(14, 'Epiphone Dove Studio', 10, '6-string Acoustic-electric Guitar with Solid Spruce Top, Maple Back and Sides, Maple Neck, and Indian Laurel Fingerboard - Violin Burst', 8, '6738afc9b94c85.84371240.jpg', '6738afc9b98398.36341665.pdf'),
(15, 'Les Paul Custom', 7, 'Solidbody Electric Guitar with Mahogany Body, Maple Top, Mahogany Neck, Ebony Fretboard, and 2 Humbucking Pickups - Ebony', 6, '6738b0674315b2.34779845.jpg', '6738b067435226.01530980.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `name`, `phone_number`) VALUES
(6, 'Amir Akmal', '014-4355826'),
(7, 'Faiz King Faraoh', '018-7778425'),
(8, 'Lin A', '017-7399272'),
(9, 'Aus Chong', '013-3223541'),
(10, 'Mat Yie Xiang', '018-7345425'),
(11, 'Wuko Ban Anne', '012-0099214');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
