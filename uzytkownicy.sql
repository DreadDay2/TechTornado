-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2023 at 06:57 PM
-- Wersja serwera: 8.0.35-0ubuntu0.20.04.1
-- Wersja PHP: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techtornado`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int NOT NULL,
  `user` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `nazwisko` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `login` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `nr_telefonu` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `pass` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `nazwisko`, `login`, `email`, `nr_telefonu`, `pass`) VALUES
(1, 'Adam', 'Najder', 'anajder', 'adam@gmail.com', '745239478', '$2y$10$j2Y5EFLCqOBTYuJ.a9DiFuamYk21CF9JqJRVQlldJXkA8L1DUXtq2'),
(2, 'Marek', 'Guziński', 'maguz', 'marek@gmail.com', '770185487', '$2y$10$L1twdXSAf9ioRJ4jxSyPYufleVEVwuyrPwJGe.h1RofGkn7m5zLf2'),
(3, 'Anna', 'Langner', 'alang', 'anna@gmail.com', '162046677', '$2y$10$0VPCoxWqYeRWbctPzc4Opu6wEO0AasUloKB5ArzIWyQqYc54y.sWO'),
(4, 'Andrzej', 'Tkocz', 'antko', 'andrzej@gmail.com', '684571163', '$2y$10$AqV1rkQVuZcmEhWgJqXO1uPMhoXLUGZVLKdadlZzXH509B.bZsgaS'),
(5, 'Justyna', 'Błachnio', 'jusio', 'justyna@gmail.com', '162289119', '$2y$10$BA2JkPkGaMUeTXh6s6SpqOwknSwsJbxsxvXGpbwIa.qvfcaJSB2Da'),
(6, 'Kasia', 'Pinkowski', 'kaspin', 'kasia@gmail.com', '703848392', '$2y$10$FYiWohdaKNhY01ye9BzzTeJ/g7.JsINk4gusj/FHP296Vxr6FpLUm'),
(7, 'Beata', 'Żmudziński', 'beamu', 'beata@gmail.com', '254759511', '$2y$10$WTqAn5O6mqM1FEhEr9abEeRxQpk7n74vhZN8uU.pEOiJJnkdVtWN2'),
(8, 'Jakub', 'Kłosek', 'jakes', 'jakub@gmail.com', '703423165', '$2y$10$elAKxXMKveFnfYQY0ZfIm.GuAB.UZ6pv.OIMamDJahIYyhWa0VMNq'),
(9, 'Janusz', 'Kurzyński', 'jankus', 'janusz@gmail.com', '134541708', '$2y$10$6dS9IH4NY9Z/icRYLvog0ukATRGgm/NMYItdFBHklpJbNC6kXVS6u'),
(10, 'Roman', 'Szostak', 'rosza', 'roman@gmail.com', '553752502', '$2y$10$nFmxxunN2NG8c0AXJdNz1u.JFkeaETv08uEGx8dwPclDW0x84D0Gy'),
(14, 'Alojz', 'Kiepski', 'ferdek123', 'alojzkiepski@gmail.com', '556448903', '$2y$10$4ZvqxyHpxkdS/jJ3MXAnk.u1vmCKalz7/e4vJzJium9AlnvEOtkDq'),
(15, 'Szymon', 'Michalewicz', 'szygmon', 'szygmon@gmail.com', '123456789', '$2y$10$guUoIvwmRBZERxYkgmkxb.kay9oRVEVUcnJVcf3HcD5Pi1pesBicy'),
(30, 'Olaf', 'Kajak', 'ola1', 'ninjago276@wp.pl', '999222333', '$2y$10$2HiqQYfD6q9waPfVQzftne7L8ExINUfxcxHipYsJdAtBNoa3I/g4.'),
(17, 'Orzeł ', 'Norbi', 'adamo1', 'lalak@gmail.com', '724145264', '$2y$10$DR0kDVun/mCHvgUCdNqKOeokCr7oAlQ4k09J6amiZTLRV6oswYwDi'),
(19, 'Kacper', 'Rozwalka', 'kacper1', 'kacperr@gmail.com', '726100724', '$2y$10$Uki3YcfxgzSyzg79wWgtB.o4v19gUHavM2V5PlTjGBuwP2bCXO67m'),
(31, 'Kacper', 'Rozwalka', 'kacper1', 'k.rozwalka@zset.leszno.pl', '726100725', '$2y$10$RXggyZhGj1vwGjv9VzrUQ.Vv2Z7vkOZV7aL0ugC/ujNsdrBwWjDsa');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
