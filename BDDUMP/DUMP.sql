-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 06 2017 г., 11:45
-- Версия сервера: 5.7.13-log
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zorr.loc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `db_coin`
--

CREATE TABLE IF NOT EXISTS `db_coin` (
  `cUid` int(11) NOT NULL,
  `cName` varchar(55) NOT NULL,
  `cAbbr` varchar(7) NOT NULL,
  `cOnline` int(11) NOT NULL,
  `cPrice` double(30,8) NOT NULL,
  `cMinimum` double(30,8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_coin`
--

INSERT INTO `db_coin` (`cUid`, `cName`, `cAbbr`, `cOnline`, `cPrice`, `cMinimum`) VALUES
(1, 'Bitcoin', 'BTC', 1, 1.00000000, 0.00100000),
(2, 'Litecoin', 'LTC', 1, 0.00843764, 0.10000000),
(3, 'Dogecoin', 'DOGE', 1, 0.00000038, 1000.00000000),
(4, 'Dollar', 'USD', 1, 0.00082732, 0.10000000),
(5, 'BlackCoin', 'BLK', 1, 0.00009684, 50.00000000),
(6, 'CloakCoin', 'CLOAK', 1, 0.00025550, 50.00000000),
(7, 'Creditbit', 'CRBIT', 0, 0.00063000, 50.00000000),
(8, 'CureCoin', 'CURE', 1, 0.00004468, 50.00000000),
(9, 'Dash', 'DASH', 1, 0.06128882, 3.00000000),
(10, 'DigitalCoin', 'DGC', 1, 0.00001220, 30.00000000),
(11, 'Ether', 'ETH', 0, 0.04164667, 0.10000000),
(12, 'Feathercoin', 'FTC', 1, 0.00001345, 25.00000000),
(13, 'GameCredits', 'GAME', 1, 0.00067966, 30.00000000),
(14, 'Namecoin', 'NMC', 1, 0.00063476, 30.00000000),
(15, 'Novacoin', 'NVC', 1, 0.00209667, 10.00000000),
(17, 'Peercoin', 'PPC', 1, 0.00065646, 20.00000000),
(18, 'Quark', 'QRK', 1, 0.00000094, 100.00000000),
(19, 'PrimeCoin', 'XPM', 1, 0.00016506, 100.00000000),
(20, 'ZCash', 'ZEC', 1, 0.05856950, 0.10000000),
(21, 'Monero', 'XMR', 0, 0.01683251, 0.10000000),
(23, 'Asiadigicoin', 'ADCN', 1, 0.00001592, 100.00000000),
(24, 'AdzCoin', 'ADZ', 1, 0.00001029, 100.00000000),
(25, 'BitBean', 'BITB', 1, 0.00000014, 1000.00000000),
(26, 'Breakout', 'BRK', 1, 0.00002773, 50.00000000),
(27, 'Darknet', 'DNET', 0, 0.00001160, 50.00000000),
(29, 'LeoCoin', 'LEO', 1, 0.00036947, 50.00000000),
(30, 'Maxcoin', 'MAX', 1, 0.00000055, 1000.00000000),
(31, 'MonetaryUnit', 'MUE', 1, 0.00003604, 1000.00000000),
(32, 'MyriadCoin', 'XMY', 0, 0.00000037, 1000.00000000),
(33, 'NAV Coin', 'NAV', 1, 0.00008109, 10.00000000),
(34, 'NuBits', 'NBT', 1, 0.00082896, 100.00000000),
(35, 'PotCoin', 'POT', 1, 0.00004435, 500.00000000),
(36, 'Pesobit', 'PSB', 1, 0.00000668, 1000.00000000),
(37, 'Rubycoin', 'RBY', 1, 0.00014033, 100.00000000),
(38, 'SolarCoin', 'SLR', 1, 0.00011415, 100.00000000),
(39, 'StartCOIN', 'START', 1, 0.00000627, 100.00000000),
(40, 'TitCoin', 'TIT', 0, 0.00000130, 100.00000000),
(41, 'TransferCoin', 'TX', 1, 0.00000775, 100.00000000),
(42, 'UniversalCurrency', 'UNIT', 1, 0.00000151, 100.00000000),
(43, 'Vertcoin', 'VTC', 1, 0.00008574, 100.00000000),
(44, 'Worldcoin', 'WDC', 1, 0.00000597, 100.00000000),
(45, 'ZCoin', 'XZC', 0, 0.00584019, 50.00000000);

-- --------------------------------------------------------

--
-- Структура таблицы `db_history_ref_balance`
--

CREATE TABLE IF NOT EXISTS `db_history_ref_balance` (
  `hrUid` int(11) NOT NULL,
  `hrUserId` int(11) NOT NULL,
  `hrRefId` int(11) NOT NULL,
  `hrCoin` varchar(55) NOT NULL,
  `hrAmount` double(30,8) NOT NULL,
  `hrDateAdd` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_hystory_user`
--

CREATE TABLE IF NOT EXISTS `db_hystory_user` (
  `hUid` int(11) NOT NULL,
  `hUserId` int(11) NOT NULL,
  `hDateAdd` varchar(255) NOT NULL,
  `hText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_insert_payeer`
--

CREATE TABLE IF NOT EXISTS `db_insert_payeer` (
  `ipUid` int(11) NOT NULL,
  `ipUserId` int(11) NOT NULL,
  `ipLogin` varchar(55) NOT NULL,
  `ipAmount` double(10,2) NOT NULL,
  `ipWallet` varchar(15) NOT NULL,
  `ipDate` varchar(55) NOT NULL,
  `ipStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_log_exchange`
--

CREATE TABLE IF NOT EXISTS `db_log_exchange` (
  `logUid` int(11) NOT NULL,
  `logUserId` int(11) NOT NULL,
  `logDateAdd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_log_payeer`
--

CREATE TABLE IF NOT EXISTS `db_log_payeer` (
  `logUid` int(11) NOT NULL,
  `logBatch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_news`
--

CREATE TABLE IF NOT EXISTS `db_news` (
  `nUid` int(11) NOT NULL,
  `nDateAdd` varchar(55) NOT NULL,
  `nTheme_ru` varchar(255) NOT NULL,
  `nTheme_en` varchar(255) NOT NULL,
  `nNews_ru` text NOT NULL,
  `nNews_en` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_stats_cashout`
--

CREATE TABLE IF NOT EXISTS `db_stats_cashout` (
  `scUid` int(11) NOT NULL,
  `scUidCoin` int(11) NOT NULL,
  `scAmount` double(30,8) NOT NULL,
  `scNameCoin` varchar(55) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_stats_cashout`
--

INSERT INTO `db_stats_cashout` (`scUid`, `scUidCoin`, `scAmount`, `scNameCoin`) VALUES
(1, 1, 3.07910578, 'BTC'),
(2, 2, 73.44115166, 'LTC'),
(3, 3, 12232953.82742809, 'DOGE'),
(4, 4, 716.74173287, 'USD'),
(5, 5, 101.53782991, 'BLK'),
(6, 6, 0.00000000, 'CLOAK'),
(7, 7, 0.00000000, 'CRBIT'),
(8, 8, 0.00000000, 'CURE'),
(9, 9, 3.10013367, 'DASH'),
(10, 10, 39.57743700, 'DGC'),
(11, 11, 0.00000000, 'ETH'),
(12, 12, 53.53542287, 'FTC'),
(13, 13, 0.00000000, 'GAME'),
(14, 14, 0.00000000, 'NMC'),
(15, 15, 0.00000000, 'NVC'),
(16, 17, 0.00000000, 'PPC'),
(17, 18, 0.00000000, 'QRK'),
(18, 19, 0.00000000, 'XPM'),
(19, 20, 0.52703253, 'ZEC'),
(20, 21, 0.63670446, 'XMR'),
(21, 23, 0.00000000, 'ADCN'),
(22, 24, 0.00000000, 'ADZ'),
(23, 25, 1879309.98646096, 'BITB'),
(24, 26, 0.00000000, 'BRK'),
(25, 27, 0.00000000, 'DNET'),
(26, 29, 0.00000000, 'LEO'),
(27, 30, 1000.00000000, 'MAX'),
(28, 31, 18495.87500000, 'MUE'),
(29, 32, 0.00000000, 'MYR'),
(30, 33, 0.00000000, 'NAV'),
(31, 34, 0.00000000, 'NBT'),
(32, 35, 0.00000000, 'POT'),
(33, 36, 0.00000000, 'PSB'),
(34, 37, 0.00000000, 'RBY'),
(35, 38, 0.00000000, 'SLR'),
(36, 39, 0.00000000, 'START'),
(37, 40, 0.00000000, 'TIT'),
(38, 41, 0.00000000, 'TX'),
(39, 42, 1192.64688696, 'UNIT'),
(40, 43, 0.00000000, 'VTC'),
(41, 44, 3156.92816716, 'WDC'),
(42, 45, 0.00000000, 'XZC');

-- --------------------------------------------------------

--
-- Структура таблицы `db_stats_enter`
--

CREATE TABLE IF NOT EXISTS `db_stats_enter` (
  `seUid` int(11) NOT NULL,
  `seUidCoin` int(11) NOT NULL,
  `seAmount` double(30,8) NOT NULL,
  `seNameCoin` varchar(55) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_stats_enter`
--

INSERT INTO `db_stats_enter` (`seUid`, `seUidCoin`, `seAmount`, `seNameCoin`) VALUES
(1, 1, 8.17180125, 'BTC'),
(2, 2, 103.11260088, 'LTC'),
(3, 3, 13483262.64858452, 'DOGE'),
(4, 4, 3178.04000000, 'USD'),
(5, 5, 122.66050271, 'BLK'),
(6, 6, 0.00000000, 'CLOAK'),
(7, 7, 0.00000000, 'CRBIT'),
(8, 8, 25.50151200, 'CURE'),
(9, 9, 32.51069001, 'DASH'),
(10, 10, 396.06098929, 'DGC'),
(11, 11, 0.00000000, 'ETH'),
(12, 12, 67.61383131, 'FTC'),
(13, 13, 0.10990000, 'GAME'),
(14, 14, 0.08000000, 'NMC'),
(15, 15, 13.40981600, 'NVC'),
(16, 17, 1.24075900, 'PPC'),
(17, 18, 0.00000000, 'QRK'),
(18, 19, 57.57372654, 'XPM'),
(19, 20, 5.34749510, 'ZEC'),
(20, 21, 0.00000000, 'XMR'),
(21, 23, 0.00000000, 'ADCN'),
(22, 24, 100.00000000, 'ADZ'),
(23, 25, 679466.93058366, 'BITB'),
(24, 26, 0.00000000, 'BRK'),
(25, 27, 0.00000000, 'DNET'),
(26, 29, 0.00000000, 'LEO'),
(27, 30, 2391.07096925, 'MAX'),
(28, 31, 32324.19616000, 'MUE'),
(29, 32, 0.03990000, 'MYR'),
(30, 33, 2.44896000, 'NAV'),
(31, 34, 0.00000000, 'NBT'),
(32, 35, 0.00000000, 'POT'),
(33, 36, 0.00000000, 'PSB'),
(34, 37, 0.00000000, 'RBY'),
(35, 38, 0.00000000, 'SLR'),
(36, 39, 10214.42163311, 'START'),
(37, 40, 0.00000000, 'TIT'),
(38, 41, 0.00000000, 'TX'),
(39, 42, 1229.40692542, 'UNIT'),
(40, 43, 342.24653710, 'VTC'),
(41, 44, 14996.23044510, 'WDC'),
(42, 45, 0.00000000, 'XZC');

-- --------------------------------------------------------

--
-- Структура таблицы `db_stat_coin`
--

CREATE TABLE IF NOT EXISTS `db_stat_coin` (
  `sUid` int(11) NOT NULL,
  `sUserId` int(11) NOT NULL,
  `sType` int(11) NOT NULL,
  `sAmount` double(30,8) NOT NULL,
  `sTxId` text NOT NULL,
  `sDateAdd` int(11) NOT NULL,
  `sCoin` varchar(20) NOT NULL,
  `sWallet` text NOT NULL,
  `sStatus` int(11) NOT NULL,
  `sTxStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_ticket`
--

CREATE TABLE IF NOT EXISTS `db_ticket` (
  `tUid` int(11) NOT NULL,
  `tUserId` int(11) NOT NULL,
  `tTheme` varchar(255) NOT NULL,
  `tDateAdd` int(11) NOT NULL,
  `tRead` int(11) NOT NULL,
  `tStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_ticket_info`
--

CREATE TABLE IF NOT EXISTS `db_ticket_info` (
  `tiUid` int(11) NOT NULL,
  `tiUidTicket` int(11) NOT NULL,
  `tiLogin` varchar(55) NOT NULL,
  `tiText` text NOT NULL,
  `tiDateAdd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_users`
--

CREATE TABLE IF NOT EXISTS `db_users` (
  `uUid` int(11) NOT NULL,
  `uLogin` varchar(55) NOT NULL,
  `uEmail` varchar(255) NOT NULL,
  `uPassword` varchar(255) NOT NULL,
  `uDateReg` int(11) NOT NULL,
  `uLastLogin` int(11) NOT NULL,
  `uIpReg` varchar(255) NOT NULL,
  `uLastIpLogin` varchar(255) NOT NULL,
  `uRefId` int(11) NOT NULL,
  `uStatus` int(11) NOT NULL,
  `uBalanceGHS` double(30,8) NOT NULL,
  `uMiner` varchar(10) NOT NULL,
  `uLastTime` int(11) NOT NULL,
  `uFIO` varchar(255) NOT NULL,
  `uCity` varchar(55) NOT NULL,
  `uSkype` varchar(255) NOT NULL,
  `uCountry` varchar(255) NOT NULL,
  `uHashLogin` varchar(255) NOT NULL,
  `uActivateEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_user_balance`
--

CREATE TABLE IF NOT EXISTS `db_user_balance` (
  `bUid` int(11) NOT NULL,
  `bUserId` int(11) NOT NULL,
  `bUidCoin` int(11) NOT NULL,
  `bBalance` double(30,8) NOT NULL,
  `bWallet` text NOT NULL,
  `bDestTag` text NOT NULL,
  `bStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `db_coin`
--
ALTER TABLE `db_coin`
  ADD PRIMARY KEY (`cUid`);

--
-- Индексы таблицы `db_history_ref_balance`
--
ALTER TABLE `db_history_ref_balance`
  ADD PRIMARY KEY (`hrUid`);

--
-- Индексы таблицы `db_hystory_user`
--
ALTER TABLE `db_hystory_user`
  ADD PRIMARY KEY (`hUid`);

--
-- Индексы таблицы `db_insert_payeer`
--
ALTER TABLE `db_insert_payeer`
  ADD PRIMARY KEY (`ipUid`);

--
-- Индексы таблицы `db_log_exchange`
--
ALTER TABLE `db_log_exchange`
  ADD PRIMARY KEY (`logUid`);

--
-- Индексы таблицы `db_log_payeer`
--
ALTER TABLE `db_log_payeer`
  ADD PRIMARY KEY (`logUid`);

--
-- Индексы таблицы `db_news`
--
ALTER TABLE `db_news`
  ADD PRIMARY KEY (`nUid`);

--
-- Индексы таблицы `db_stats_cashout`
--
ALTER TABLE `db_stats_cashout`
  ADD PRIMARY KEY (`scUid`);

--
-- Индексы таблицы `db_stats_enter`
--
ALTER TABLE `db_stats_enter`
  ADD PRIMARY KEY (`seUid`);

--
-- Индексы таблицы `db_stat_coin`
--
ALTER TABLE `db_stat_coin`
  ADD PRIMARY KEY (`sUid`);

--
-- Индексы таблицы `db_ticket`
--
ALTER TABLE `db_ticket`
  ADD PRIMARY KEY (`tUid`);

--
-- Индексы таблицы `db_ticket_info`
--
ALTER TABLE `db_ticket_info`
  ADD PRIMARY KEY (`tiUid`);

--
-- Индексы таблицы `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`uUid`);

--
-- Индексы таблицы `db_user_balance`
--
ALTER TABLE `db_user_balance`
  ADD PRIMARY KEY (`bUid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `db_coin`
--
ALTER TABLE `db_coin`
  MODIFY `cUid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `db_history_ref_balance`
--
ALTER TABLE `db_history_ref_balance`
  MODIFY `hrUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_hystory_user`
--
ALTER TABLE `db_hystory_user`
  MODIFY `hUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_insert_payeer`
--
ALTER TABLE `db_insert_payeer`
  MODIFY `ipUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_log_exchange`
--
ALTER TABLE `db_log_exchange`
  MODIFY `logUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_log_payeer`
--
ALTER TABLE `db_log_payeer`
  MODIFY `logUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_news`
--
ALTER TABLE `db_news`
  MODIFY `nUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_stats_cashout`
--
ALTER TABLE `db_stats_cashout`
  MODIFY `scUid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `db_stats_enter`
--
ALTER TABLE `db_stats_enter`
  MODIFY `seUid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `db_stat_coin`
--
ALTER TABLE `db_stat_coin`
  MODIFY `sUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_ticket`
--
ALTER TABLE `db_ticket`
  MODIFY `tUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_ticket_info`
--
ALTER TABLE `db_ticket_info`
  MODIFY `tiUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_users`
--
ALTER TABLE `db_users`
  MODIFY `uUid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `db_user_balance`
--
ALTER TABLE `db_user_balance`
  MODIFY `bUid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
