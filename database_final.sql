-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Gegenereerd op: 19 jan 2019 om 23:19
-- Serverversie: 5.7.23
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `yii2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `additions`
--

CREATE TABLE `additions` (
  `id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `addition_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `additions`
--

INSERT INTO `additions` (`id`, `description`, `addition_type_id`) VALUES
(1, '9-grain wheat', 1),
(2, 'Italian white', 1),
(3, 'Italian herb', 1),
(4, 'Yes', 3),
(5, 'No', 3),
(6, 'B.L.T.', 4),
(7, 'Chicken Fajita', 4),
(8, 'Subway Melt', 4),
(9, '15 CM', 2),
(10, '30 CM', 2),
(11, 'Pickles', 6),
(12, 'Green peppers', 6),
(13, 'Double meat', 5),
(14, 'Extra cheese', 5),
(15, 'Extra bacon', 5),
(16, 'Honey Mustard', 7),
(17, 'Mayonaise', 7),
(18, 'BBQ Sauce', 7),
(19, 'Spicy Italian', 4),
(20, 'Steak & Cheese', 4),
(21, 'Chicken Filet', 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `addition_types`
--

CREATE TABLE `addition_types` (
  `id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `multiselector` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `addition_types`
--

INSERT INTO `addition_types` (`id`, `description`, `multiselector`) VALUES
(1, 'Bread', 0),
(2, 'Size', 0),
(3, 'Baked', 0),
(4, 'Taste', 0),
(5, 'Extra', 1),
(6, 'Vegetable', 1),
(7, 'Sauce', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `meals`
--

INSERT INTO `meals` (`id`, `start_date`, `end_date`, `status`) VALUES
(3, '2019-01-01 00:00:00', '2019-01-10 23:59:59', 0),
(11, '2018-01-27 00:00:00', '2018-01-27 23:59:59', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1546268620);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `meal_id`) VALUES
(12, 3, 3),
(17, 3, 11),
(14, 4, 3),
(15, 9, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders_has_additions`
--

CREATE TABLE `orders_has_additions` (
  `orders_id` int(11) NOT NULL,
  `additions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `orders_has_additions`
--

INSERT INTO `orders_has_additions` (`orders_id`, `additions_id`) VALUES
(12, 1),
(15, 1),
(17, 2),
(14, 3),
(12, 4),
(15, 4),
(17, 4),
(14, 5),
(14, 6),
(15, 6),
(17, 7),
(14, 9),
(12, 10),
(15, 10),
(17, 10),
(12, 11),
(17, 11),
(12, 12),
(14, 12),
(12, 14),
(15, 14),
(17, 14),
(12, 15),
(17, 15),
(12, 16),
(17, 16),
(14, 17),
(15, 17),
(12, 19),
(14, 22),
(15, 22);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `auth_key` varchar(128) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `auth_key`, `is_admin`) VALUES
(3, 'matthijs', '$2y$13$tLmz87IUHBKNNDhaV5bpkuUdtlnyqPyfpbtVmhZ8mpHFbdbdxLbZi', 'NBFpZgtlddeq37sAevIoFdNu9p21lP7G', 0),
(4, 'admin', '$2y$13$ZtfDUOGL956TZPxlwI15qewQMupcrAxjI7vlCwIYjMgwvIHj.7BlC', 'GYbgYQS2NcdCcBsAeZ9m6OOqkDulbeKW', 1),
(8, 'demo', '$2y$13$VF.juDZsPQ0zO2HZk6RIY.G5.gyCS04Hd5Bs6VITyyWbTCQCbxJWG', 'GBWhQFHe6zQaJDd9qnL1uwjs14ahRces', 0),
(9, 'nienke', '$2y$13$xaBInLkohiOg7PGhdYUdneuRvohBaj3rkcKqenKtRPn2mtzAAvQda', '_bLWGZ21AE-UbkK7Ei8MbTw8yuTTpxQX', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `additions`
--
ALTER TABLE `additions`
  ADD PRIMARY KEY (`id`,`addition_type_id`),
  ADD KEY `addition_type_id_idx` (`addition_type_id`);

--
-- Indexen voor tabel `addition_types`
--
ALTER TABLE `addition_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`user_id`,`meal_id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `meal_id_idx` (`meal_id`);

--
-- Indexen voor tabel `orders_has_additions`
--
ALTER TABLE `orders_has_additions`
  ADD PRIMARY KEY (`orders_id`,`additions_id`),
  ADD KEY `fk_orders_has_additions_additions1_idx` (`additions_id`),
  ADD KEY `fk_orders_has_additions_orders1_idx` (`orders_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `additions`
--
ALTER TABLE `additions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `addition_types`
--
ALTER TABLE `addition_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `orders_has_additions`
--
ALTER TABLE `orders_has_additions`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `additions`
--
ALTER TABLE `additions`
  ADD CONSTRAINT `addition_type_id` FOREIGN KEY (`addition_type_id`) REFERENCES `addition_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `meal_id` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `orders_has_additions`
--
ALTER TABLE `orders_has_additions`
  ADD CONSTRAINT `fk_orders_has_additions_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

