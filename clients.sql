-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Sty 2023, 20:00
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `clients`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `gatunek` varchar(40) NOT NULL,
  `plec` varchar(30) NOT NULL,
  `wielkosc` varchar(30) NOT NULL,
  `wiek` varchar(50) NOT NULL,
  `usposobienie` varchar(50) NOT NULL,
  `typ_siersci` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `reservations`
--

INSERT INTO `reservations` (`id`, `userId`, `gatunek`, `plec`, `wielkosc`, `wiek`, `usposobienie`, `typ_siersci`, `status`) VALUES
(4, 1, 'pies', 'męska', 'mały', 'młody', 'spokojny;przyjacielski;leniuszek', 'sierść', 'przyjęto'),
(5, 3, 'pies', 'męska', 'mały', 'młody', 'spokojny;przyjacielski;leniuszek', 'sierść', 'przyjęto');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` char(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `telephone`, `password`, `status`, `date`) VALUES
(2, 'Anna', 'Kowalska', 'kowal_ann@onet.pl', '123456789', '$2y$10$Zmeq0GbTHiHEPdEl3pAZyu4RmGbH./eKzfjbslo3J.qixSy0MpX1W', 1, '2023-01-24 00:00:00'),
(5, 'Magdalena', 'Kramek', 'mkramek@onet.pl', '123456789', '$2y$10$zgOIm3zna5xL4u9Bockgi.WCyfeHDUdTKPBSuldnJu2X87Mhy0Vv2', 1, '2023-01-26 00:00:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
