-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 10, 2024 at 06:17 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolory`
--

CREATE TABLE `kolory` (
  `id` int(11) NOT NULL,
  `nazwa_koloru` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marki`
--

CREATE TABLE `marki` (
  `id` int(11) NOT NULL,
  `nazwa_marki` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marki`
--

INSERT INTO `marki` (`id`, `nazwa_marki`) VALUES
(1, 'Audi'),
(2, 'BMW'),
(3, 'Citroen'),
(4, 'Dacia'),
(5, 'Fiat'),
(6, 'Ford'),
(7, 'Hyundai'),
(8, 'Kia'),
(9, 'Mercedes'),
(10, 'Nissan'),
(11, 'Opel'),
(12, 'Peugeot'),
(13, 'Renault'),
(14, 'SEAT'),
(15, 'Skoda'),
(16, 'Toyota'),
(17, 'Volkswagen'),
(18, 'Volvo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `nazwa_modelu` varchar(25) NOT NULL,
  `id_marki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modele`
--

INSERT INTO `modele` (`id`, `nazwa_modelu`, `id_marki`) VALUES
(1, 'A4', 1),
(2, 'A8', 1),
(3, 'X5', 2),
(4, 'M4', 2),
(5, 'C4', 3),
(6, 'Saxo', 3),
(7, 'Logan', 4),
(8, 'Sandero', 4),
(9, 'Punto', 5),
(10, 'Tipo', 5),
(11, 'Mondeo', 6),
(12, 'Focus', 6),
(13, 'i20', 7),
(14, 'Genesis', 7),
(15, 'Ceed', 8),
(16, 'Picanto', 8),
(17, 'Klasa C', 9),
(18, 'W201', 9),
(19, '240SX', 10),
(20, 'GT-R', 10),
(21, 'Corsa', 11),
(22, 'Insignia', 11),
(23, '206', 12),
(24, '307', 12),
(25, 'Laguna', 13),
(26, 'Thalia', 13),
(27, 'Ibiza', 14),
(28, 'Leon', 14),
(29, 'Superb', 15),
(30, 'Octavia', 15),
(31, 'Supra', 16),
(32, 'GT86', 16),
(33, 'Bora', 17),
(34, 'Golf', 17),
(35, 'V90', 18),
(36, '242', 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `id` int(11) NOT NULL,
  `id_uzytkownicy` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_marki` int(11) NOT NULL,
  `id_modele` int(11) NOT NULL,
  `przebieg` int(11) NOT NULL,
  `rocznik` date NOT NULL,
  `pojemnosc_silnika` int(11) NOT NULL,
  `moc` int(11) NOT NULL,
  `id_rodzaje_skrzyni_biegow` int(11) NOT NULL,
  `id_rodzaje_paliwa` int(11) NOT NULL,
  `id_kolory` int(11) NOT NULL,
  `id_status_ogloszenia` int(11) NOT NULL,
  `waznosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `id` int(11) NOT NULL,
  `nazwisko` varchar(25) NOT NULL,
  `imie` varchar(25) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `data_urodzenia` date NOT NULL,
  `rodo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaje_paliwa`
--

CREATE TABLE `rodzaje_paliwa` (
  `id` int(11) NOT NULL,
  `nazwa_paliwa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaje_skrzyni_biegow`
--

CREATE TABLE `rodzaje_skrzyni_biegow` (
  `id` int(11) NOT NULL,
  `nazwa_typu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nazwa_roli` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statusy`
--

CREATE TABLE `statusy` (
  `id` int(11) NOT NULL,
  `nazwa_statusu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `id_osoby` int(11) NOT NULL,
  `haslo` text NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kolory`
--
ALTER TABLE `kolory`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `marki`
--
ALTER TABLE `marki`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rodzaje_paliwa`
--
ALTER TABLE `rodzaje_paliwa`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rodzaje_skrzyni_biegow`
--
ALTER TABLE `rodzaje_skrzyni_biegow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `statusy`
--
ALTER TABLE `statusy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kolory`
--
ALTER TABLE `kolory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marki`
--
ALTER TABLE `marki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modele`
--
ALTER TABLE `modele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `osoby`
--
ALTER TABLE `osoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rodzaje_paliwa`
--
ALTER TABLE `rodzaje_paliwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rodzaje_skrzyni_biegow`
--
ALTER TABLE `rodzaje_skrzyni_biegow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statusy`
--
ALTER TABLE `statusy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
