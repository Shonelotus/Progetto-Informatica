-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2024 alle 22:15
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

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id`, `idUser`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `id` int(11) NOT NULL,
  `gps` int(11) NOT NULL,
  `codiceRFID` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `kmEffettutati` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `bicicletta`
--

INSERT INTO `bicicletta` (`id`, `gps`, `codiceRFID`, `latitude`, `longitude`, `kmEffettutati`) VALUES
(1, 12345, 1234, 45.464123, 9.190456, NULL),
(2, 23456, 2345, 45.46789, 9.181234, NULL),
(3, 34567, 3456, 45.472345, 9.193456, NULL),
(4, 45678, 4567, 45.478901, 9.185678, NULL),
(5, 56789, 5678, 45.469012, 9.179876, NULL),
(6, 67890, 6789, 45.475678, 9.192345, NULL),
(7, 78901, 7890, 45.473456, 9.181123, NULL),
(8, 89012, 8901, 45.468901, 9.184567, NULL),
(9, 90123, 9012, 45.471234, 9.190789, NULL),
(10, 12346, 1235, 45.474567, 9.182345, NULL),
(11, 23457, 2346, 45.476789, 9.188901, NULL),
(12, 34568, 3457, 45.468567, 9.173456, NULL),
(13, 45678, 5678, 45.479987, 9.187486, NULL),
(14, 56789, 6789, 45.465832, 9.172612, NULL),
(15, 67890, 7890, 45.472305, 9.185942, NULL),
(16, 78901, 8901, 45.480192, 9.198475, NULL),
(17, 89012, 9012, 45.469762, 9.179584, NULL),
(18, 90123, 1238, 45.478945, 9.192754, NULL),
(19, 97548, 6675, 45.46717465354171, 9.166683652797236, NULL),
(20, 23457, 3457, 45.474532, 9.187234, NULL),
(21, 34568, 4568, 45.47129, 9.190567, NULL),
(22, 45679, 5679, 45.475678, 9.182345, NULL),
(23, 56780, 6780, 45.469834, 9.180123, NULL),
(24, 67891, 7891, 45.478901, 9.197654, NULL),
(25, 78902, 8902, 45.46789, 9.181234, NULL),
(26, 89013, 9013, 45.475321, 9.188745, NULL),
(27, 90124, 124, 45.473212, 9.179865, NULL),
(29, 23458, 3458, 45.474563, 9.183456, NULL),
(30, 34569, 4569, 45.472341, 9.187654, NULL),
(31, 45680, 5670, 45.479876, 9.196543, NULL),
(32, 56781, 6781, 45.469876, 9.174563, NULL),
(33, 67892, 7892, 45.478321, 9.193212, NULL),
(34, 78903, 8903, 45.468754, 9.175432, NULL),
(35, 89014, 9014, 45.477213, 9.185432, NULL),
(36, 90125, 125, 45.472123, 9.184321, NULL),
(38, 23459, 3459, 45.475654, 9.188932, NULL),
(39, 34570, 4570, 45.471234, 9.186789, NULL),
(40, 45681, 5671, 45.476543, 9.182143, NULL),
(41, 56782, 6782, 45.469432, 9.180432, NULL),
(42, 67893, 7893, 45.47789, 9.195432, NULL),
(43, 78904, 8904, 45.468123, 9.176543, NULL),
(44, 89015, 9015, 45.474321, 9.184876, NULL),
(45, 90126, 126, 45.473098, 9.181098, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `numeroTessera` int(11) NOT NULL,
  `numeroCarta` varchar(16) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id`, `numeroTessera`, `numeroCarta`, `idUser`, `idIndirizzo`) VALUES
(1, 123456, '1234567812345678', 1, 1),
(2, 234567, '2345678923456789', 2, 2),
(3, 345678, '3456789034567890', 3, 3),
(4, 456789, '4567890145678901', 4, 4),
(5, 567890, '5678901256789012', 5, 5),
(6, 678901, '6789012367890123', 6, 6),
(7, 789012, '7890123478901234', 7, 7),
(8, 890123, '8901234589012345', 8, 8),
(9, 901234, '9012345690123456', 9, 9),
(10, 123457, '1234576812345679', 10, 10),
(11, 234568, '2345687923456780', 11, 11),
(12, 345679, '3456798034567891', 12, 12),
(13, 456790, '4567909145678902', 13, 13),
(14, 567801, '5678010256789013', 14, 14),
(15, 678912, '6789121367890124', 15, 15),
(16, 789023, '7890232478901235', 16, 16),
(17, 890134, '8901343589012346', 17, 17),
(18, 901245, '9012454690123457', 18, 18),
(19, 123458, '1234586812345670', 19, 19),
(20, 234569, '2345697923456781', 20, 20),
(21, 345680, '3456808034567892', 21, 21),
(22, 456791, '4567919145678903', 22, 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `id` int(11) NOT NULL,
  `via` varchar(64) NOT NULL,
  `cap` int(11) NOT NULL,
  `paese` varchar(64) NOT NULL,
  `provincia` varchar(64) NOT NULL,
  `stato` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`id`, `via`, `cap`, `paese`, `provincia`, `stato`) VALUES
(1, 'Via Roma', 10100, 'Torino', 'TO', 'Italia'),
(2, 'Via Milano', 20100, 'Milano', 'MI', 'Italia'),
(3, 'Via Napoli', 80100, 'Napoli', 'NA', 'Italia'),
(4, 'Via Firenze', 50100, 'Firenze', 'FI', 'Italia'),
(5, 'Via Venezia', 30100, 'Venezia', 'VE', 'Italia'),
(6, 'Via Genova', 16100, 'Genova', 'GE', 'Italia'),
(7, 'Via Bologna', 40100, 'Bologna', 'BO', 'Italia'),
(8, 'Via Bari', 70100, 'Bari', 'BA', 'Italia'),
(9, 'Via Palermo', 90100, 'Palermo', 'PA', 'Italia'),
(10, 'Via Cagliari', 9100, 'Cagliari', 'CA', 'Italia'),
(11, 'Via Trieste', 34100, 'Trieste', 'TS', 'Italia'),
(12, 'Via Perugia', 6100, 'Perugia', 'PG', 'Italia'),
(13, 'Via Parma', 43100, 'Parma', 'PR', 'Italia'),
(14, 'Via Padova', 35100, 'Padova', 'PD', 'Italia'),
(15, 'Via Modena', 41100, 'Modena', 'MO', 'Italia'),
(16, 'Via Verona', 37100, 'Verona', 'VR', 'Italia'),
(17, 'Via Siena', 53100, 'Siena', 'SI', 'Italia'),
(18, 'Via Reggio Calabria', 89100, 'Reggio Calabria', 'RC', 'Italia'),
(19, 'Via Catanzaro', 88100, 'Catanzaro', 'CZ', 'Italia'),
(20, 'Via Trento', 38100, 'Trento', 'TN', 'Italia'),
(21, 'Via Aosta', 11100, 'Aosta', 'AO', 'Italia'),
(22, 'Via L\'Aquila', 67100, 'L\'Aquila', 'AQ', 'Italia');

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `id` int(11) NOT NULL,
  `tipoOperazione` varchar(32) NOT NULL,
  `dataOra` datetime NOT NULL,
  `distanzaPercorsa` decimal(10,0) NOT NULL,
  `tariffa` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idBici` int(11) NOT NULL,
  `idStazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`id`, `tipoOperazione`, `dataOra`, `distanzaPercorsa`, `tariffa`, `idCliente`, `idBici`, `idStazione`) VALUES
(1, 'noleggio', '2024-05-23 09:00:00', 15, 12, 10, 10, 20),
(2, 'riconsegna', '2024-05-23 09:30:00', 15, 12, 10, 10, 21),
(3, 'noleggio', '2024-05-23 10:00:00', 5, 4, 11, 11, 21),
(4, 'riconsegna', '2024-05-23 10:20:00', 5, 4, 11, 11, 22),
(5, 'noleggio', '2024-05-23 11:00:00', 8, 6, 12, 12, 22),
(6, 'riconsegna', '2024-05-23 11:40:00', 8, 6, 12, 12, 23),
(7, 'noleggio', '2024-05-23 12:00:00', 12, 10, 13, 13, 23),
(8, 'riconsegna', '2024-05-23 12:45:00', 12, 10, 13, 13, 24),
(9, 'noleggio', '2024-05-23 13:00:00', 20, 16, 14, 14, 24),
(10, 'riconsegna', '2024-05-23 14:00:00', 20, 16, 14, 14, 25),
(11, 'noleggio', '2024-05-23 14:00:00', 18, 14, 15, 15, 25),
(12, 'riconsegna', '2024-05-23 15:00:00', 18, 14, 15, 15, 26),
(13, 'noleggio', '2024-05-23 15:00:00', 10, 8, 16, 16, 26),
(14, 'riconsegna', '2024-05-23 15:30:00', 10, 8, 16, 16, 27),
(15, 'noleggio', '2024-05-23 16:00:00', 25, 20, 17, 17, 27),
(16, 'riconsegna', '2024-05-23 17:00:00', 25, 20, 17, 17, 28),
(17, 'noleggio', '2024-05-23 17:00:00', 30, 24, 18, 18, 28),
(18, 'riconsegna', '2024-05-23 18:00:00', 30, 24, 18, 18, 29),
(19, 'noleggio', '2024-05-23 18:00:00', 22, 18, 19, 19, 29),
(20, 'riconsegna', '2024-05-23 18:45:00', 22, 18, 19, 19, 30),
(21, 'noleggio', '2024-05-23 19:00:00', 7, 6, 20, 20, 30),
(22, 'riconsegna', '2024-05-23 19:15:00', 7, 6, 20, 20, 21);

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `id` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `codice` int(11) NOT NULL,
  `numeroSlot` int(11) NOT NULL,
  `idIndirizzo` int(11) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`id`, `nome`, `codice`, `numeroSlot`, `idIndirizzo`, `latitude`, `longitude`) VALUES
(1, 'Stazione Centrale', 191111, 75, NULL, 45.4851, 9.2034),
(2, 'Piazza del Duomo', 292222, 40, NULL, 45.4641, 9.191),
(3, 'Navigli District', 33333, 30, NULL, 45.4583, 9.1773),
(4, 'Parco Sempione', 444404, 20, NULL, 45.4748, 9.1815),
(5, 'Porta Nuova', 555055, 65, NULL, 45.4837, 9.1926),
(6, 'Quadrilatero della Moda', 666966, 45, NULL, 45.4689, 9.1949),
(7, 'Brera District', 779777, 85, NULL, 45.475, 9.1872),
(8, 'San Siro Stadium', 888988, 100, NULL, 45.4782, 9.1233),
(9, 'Leonardo da Vinci Museum', 998999, 60, NULL, 45.4667, 9.1707),
(10, 'Via Monte Napoleone', 109010, 60, NULL, 45.4686, 9.194),
(11, 'Porta Ticinese', 202920, 40, NULL, 45.4555, 9.182),
(12, 'Corso Buenos Aires', 303080, 80, NULL, 45.4793, 9.2077),
(13, 'Piazza Gae Aulenti', 404940, 50, NULL, 45.4836, 9.1873),
(14, 'Castello Sforzesco', 508050, 30, NULL, 45.4719, 9.18),
(15, 'Università degli Studi di Milano', 606069, 70, NULL, 45.4783, 9.2274),
(16, 'Parco Lambro', 707970, 20, NULL, 45.4798, 9.2636),
(17, 'Piazza Cordusio', 808070, 45, NULL, 45.4635, 9.1879),
(18, 'Cimitero Monumentale di Milano', 989090, 25, NULL, 45.4854, 9.1775),
(19, 'ciao', 123456, 91, NULL, 9.188371948973142, 45.49491372367405),
(20, 'mondo', 456780, 9, NULL, 45.4850458059739, 9.195238404051267),
(21, 'Biciclette di Milano', 987654, 50, NULL, 45.4642, 9.19),
(22, 'Stazione Centrale', 111111, 75, NULL, 45.4851, 9.2034),
(23, 'Piazza del Duomo', 222222, 40, NULL, 45.4641, 9.191),
(24, 'Navigli District', 333333, 30, NULL, 45.4583, 9.1773),
(25, 'Parco Sempione', 444444, 20, NULL, 45.4748, 9.1815),
(26, 'Porta Nuova', 555555, 65, NULL, 45.4837, 9.1926),
(27, 'Quadrilatero della Moda', 666666, 45, NULL, 45.4689, 9.1949),
(28, 'Brera District', 777777, 85, NULL, 45.475, 9.1872),
(29, 'San Siro Stadium', 888888, 100, NULL, 45.4782, 9.1233),
(30, 'Leonardo da Vinci Museum', 999999, 60, NULL, 45.4667, 9.1707),
(31, 'Via Monte Napoleone', 101010, 60, NULL, 45.4686, 9.194),
(32, 'Porta Ticinese', 202020, 40, NULL, 45.4555, 9.182),
(33, 'Corso Buenos Aires', 303030, 80, NULL, 45.4793, 9.2077),
(34, 'Piazza Gae Aulenti', 404040, 50, NULL, 45.4836, 9.1873),
(35, 'Castello Sforzesco', 505050, 30, NULL, 45.4719, 9.18),
(36, 'Università degli Studi di Milano', 606060, 70, NULL, 45.4783, 9.2274),
(37, 'Parco Lambro', 707070, 20, NULL, 45.4798, 9.2636),
(38, 'Piazza Cordusio', 808080, 45, NULL, 45.4635, 9.1879),
(39, 'Cimitero Monumentale di Milano', 909090, 25, NULL, 45.4854, 9.1775),
(40, 'Porta Venezia', 111222, 55, NULL, 45.474, 9.2016),
(41, 'Naviglio Grande', 222333, 85, NULL, 45.4571, 9.177),
(42, 'Museo Nazionale della Scienza e della Tecnologia', 333444, 70, NULL, 45.4634, 9.1709),
(43, 'Piazza Mercanti', 444555, 40, NULL, 45.4637, 9.187),
(44, 'Giardini Pubblici Indro Montanelli', 555666, 30, NULL, 45.473, 9.2032),
(45, 'Via della Spiga', 666777, 60, NULL, 45.4676, 9.1953),
(46, 'Piazza San Babila', 777888, 45, NULL, 45.4681, 9.1987),
(47, 'Corso Vittorio Emanuele II', 888999, 75, NULL, 45.4638, 9.1925),
(48, 'Fondazione Prada', 999000, 35, NULL, 45.4508, 9.2006),
(49, 'Porta Romana', 110110, 80, NULL, 45.4586, 9.201),
(50, 'Museo del Novecento', 121121, 65, NULL, 45.4634, 9.1866),
(51, 'Naviglio Pavese', 232232, 40, NULL, 45.4431, 9.1817),
(52, 'Biblioteca Nazionale Braidense', 343343, 25, NULL, 45.4738, 9.1879),
(53, 'Teatro alla Scala', 454454, 55, NULL, 45.4675, 9.1895),
(54, 'Cimitero Maggiore di Milano', 565565, 30, NULL, 45.4775, 9.1279),
(55, 'Via Montenapoleone', 676676, 70, NULL, 45.4693, 9.1963),
(56, 'Piazza del Cannone', 787787, 45, NULL, 45.4605, 9.1809),
(57, 'Via Torino', 898898, 100, NULL, 45.4645, 9.1838),
(58, 'Piazza della Repubblica', 909909, 50, NULL, 45.4833, 9.2006),
(59, 'Giardini Pubblici Indro Montanelli', 121212, 30, NULL, 45.4726, 9.2026),
(60, 'Arco della Pace', 232323, 85, NULL, 45.4743, 9.1762);

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
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `nome`, `cognome`, `email`, `password`) VALUES
(1, 'nicolo', 'moretto', 'simoriva@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'simon', 'riva', 'simoriva@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'luca', 'moretto', 'morettoluca@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'anna', 'rossi', 'annarossi@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(5, 'marco', 'bianchi', 'marcobianchi@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(6, 'giulia', 'verdi', 'giuliaverdi@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(7, 'federico', 'neri', 'federiconeri@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(8, 'alessia', 'bruni', 'alessiabruni@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(9, 'matteo', 'conti', 'matteoconti@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(10, 'chiara', 'martini', 'chiaramartini@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(11, 'andrea', 'morelli', 'andreamorelli@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 'francesca', 'marini', 'francescamarini@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(13, 'valerio', 'romano', 'valerioromano@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(14, 'elisa', 'ricci', 'elisaricci@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(15, 'giovanni', 'leone', 'giovannileone@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(16, 'ilaria', 'ferri', 'ilariaferri@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(17, 'lorenzo', 'galli', 'lorenzogalli@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(18, 'marta', 'vitali', 'martavitali@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(19, 'davide', 'gatti', 'davidegatti@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(20, 'serena', 'riva', 'serenariva@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(21, 'paolo', 'costantini', 'paolocostantini@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(22, 'ilaria', 'greco', 'ilariagreco@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
