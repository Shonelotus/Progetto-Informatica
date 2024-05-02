-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 02, 2024 alle 08:59
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noleggio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `id` int(11) NOT NULL,
  `gps` int(11) NOT NULL,
  `codiceRFID` int(11) NOT NULL,
  `latPosizione` float NOT NULL,
  `longPosizione` float NOT NULL,
  `kmEffettutati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `numeroTessera` int(11) NOT NULL,
  `numeroCarta` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `id` int(11) NOT NULL,
  `via` int(11) NOT NULL,
  `cap` int(11) NOT NULL,
  `paese` int(11) NOT NULL,
  `provincia` int(11) NOT NULL,
  `stato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `id` int(11) NOT NULL,
  `isNoleggio` tinyint(1) NOT NULL,
  `dataOra` datetime NOT NULL,
  `distanzaPercorsa` decimal(10,0) NOT NULL,
  `tariffa` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idBici` int(11) NOT NULL,
  `idStazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `id` int(11) NOT NULL,
  `codice` int(11) NOT NULL,
  `numeroSlot` int(11) NOT NULL,
  `idIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idIndirizzo` (`idIndirizzo`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCliente` (`idCliente`,`idBici`,`idStazione`),
  ADD KEY `idStazione` (`idStazione`),
  ADD KEY `idBici` (`idBici`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codice` (`codice`),
  ADD KEY `idIndirizzo` (`idIndirizzo`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`idIndirizzo`) REFERENCES `indirizzo` (`id`);

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`idStazione`) REFERENCES `stazione` (`id`),
  ADD CONSTRAINT `operazione_ibfk_3` FOREIGN KEY (`idBici`) REFERENCES `bicicletta` (`id`);

--
-- Limiti per la tabella `stazione`
--
ALTER TABLE `stazione`
  ADD CONSTRAINT `stazione_ibfk_1` FOREIGN KEY (`idIndirizzo`) REFERENCES `indirizzo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
