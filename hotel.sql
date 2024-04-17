-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Maj 2019, 17:30
-- Wersja serwera: 10.1.8-MariaDB
-- Wersja PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hotel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `numer` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `imie`, `nazwisko`, `numer`, `email`) VALUES
(63, 'Robert', 'asfasdf', 908908678, '345345345@123awsd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pokoje`
--

CREATE TABLE `pokoje` (
  `id_pokoju` int(11) NOT NULL,
  `nazwa_pokoju` varchar(50) NOT NULL,
  `cena` int(11) NOT NULL,
  `czy_wolny` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pokoje`
--

INSERT INTO `pokoje` (`id_pokoju`, `nazwa_pokoju`, `cena`, `czy_wolny`) VALUES
(1, 'Pokoj Krolewski', 1000, 1),
(2, 'Pokoj Szlachecki', 1000, 1),
(3, 'Pokoj Wielki', 1000, 1),
(4, 'Pokoj Duzy', 1000, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `raccept`
--

CREATE TABLE `raccept` (
  `id_rezerwacji` int(11) NOT NULL,
  `id_klienta` smallint(6) DEFAULT NULL,
  `id_pokoju` smallint(6) DEFAULT NULL,
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  `ilosc_dni` int(11) NOT NULL,
  `cenarazem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `raccept`
--

INSERT INTO `raccept` (`id_rezerwacji`, `id_klienta`, `id_pokoju`, `od`, `do`, `ilosc_dni`, `cenarazem`) VALUES
(2, 63, 2, '2019-05-20', '2019-05-25', 5, 5000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id_rezerwacji` int(11) NOT NULL,
  `id_klienta` smallint(6) DEFAULT NULL,
  `id_pokoju` smallint(6) DEFAULT NULL,
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  `ilosc_dni` int(11) NOT NULL,
  `cenarazem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_uzytkownika` int(11) NOT NULL,
  `user` varchar(20) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `czy_admin` bit(1) NOT NULL,
  `imie` varchar(30) DEFAULT NULL,
  `nazwisko` varchar(30) DEFAULT NULL,
  `numer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_uzytkownika`, `user`, `pass`, `email`, `czy_admin`, `imie`, `nazwisko`, `numer`) VALUES
(1, 'admin1', '$2y$10$nhON71XW93ElIaP4Q3gpKOsYIwtq3TxWGhIrmUvgEeXSTdPk/Md0C', 'admin1@gmail.com', b'1', 'Hubert', 'KozÅ‚owski', 123456234),
(2, 'pracownik1', '$2y$10$jLeLebivKWFZztTGmxYOiOsMVQrBJmYK.flGktBhKBt9mDBSqBxdC', 'goshantas@gmail.com', b'0', 'Roman', 'Kowalski', 456456456);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy_zwolnieni`
--

CREATE TABLE `uzytkownicy_zwolnieni` (
  `id_uzytkownika` int(11) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `numer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uzytkownicy_zwolnieni`
--

INSERT INTO `uzytkownicy_zwolnieni` (`id_uzytkownika`, `imie`, `nazwisko`, `email`, `numer`) VALUES
(1, 'Roman', 'Polski', 'zz7ospcrjogn@10minut.xyz', 789067123);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgloszenia`
--

CREATE TABLE `zgloszenia` (
  `id_zgloszenia` int(11) NOT NULL,
  `dane` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `temat` varchar(45) NOT NULL,
  `tresc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`);

--
-- Indexes for table `pokoje`
--
ALTER TABLE `pokoje`
  ADD PRIMARY KEY (`id_pokoju`);

--
-- Indexes for table `raccept`
--
ALTER TABLE `raccept`
  ADD PRIMARY KEY (`id_rezerwacji`);

--
-- Indexes for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id_rezerwacji`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- Indexes for table `uzytkownicy_zwolnieni`
--
ALTER TABLE `uzytkownicy_zwolnieni`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- Indexes for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD PRIMARY KEY (`id_zgloszenia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT dla tabeli `pokoje`
--
ALTER TABLE `pokoje`
  MODIFY `id_pokoju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `raccept`
--
ALTER TABLE `raccept`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy_zwolnieni`
--
ALTER TABLE `uzytkownicy_zwolnieni`
  MODIFY `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `zgloszenia`
--
ALTER TABLE `zgloszenia`
  MODIFY `id_zgloszenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
