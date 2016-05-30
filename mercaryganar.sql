-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2016 a las 07:09:48
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercaryganar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `affiliateuser`
--

CREATE TABLE `affiliateuser` (
  `Id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `referedby` varchar(15) NOT NULL DEFAULT 'none',
  `ipaddress` int(10) UNSIGNED NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `active` int(11) NOT NULL,
  `doj` date NOT NULL,
  `country` text NOT NULL,
  `tamount` double NOT NULL DEFAULT '0',
  `payment` varchar(10) NOT NULL,
  `signupcode` text NOT NULL,
  `level` int(1) NOT NULL DEFAULT '2',
  `pcktaken` int(10) NOT NULL DEFAULT '0',
  `launch` int(1) NOT NULL DEFAULT '0',
  `expiry` date NOT NULL DEFAULT '2199-12-31',
  `bankname` varchar(250) NOT NULL DEFAULT 'Not Available',
  `accountname` varchar(250) NOT NULL DEFAULT 'Not Available',
  `accountno` double NOT NULL DEFAULT '0',
  `accounttype` int(11) NOT NULL DEFAULT '0',
  `ifsccode` varchar(100) NOT NULL DEFAULT 'Not Available',
  `getpayment` int(11) NOT NULL DEFAULT '1',
  `renew` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `affiliateuser`
--

INSERT INTO `affiliateuser` (`Id`, `username`, `password`, `fname`, `address`, `email`, `referedby`, `ipaddress`, `mobile`, `active`, `doj`, `country`, `tamount`, `payment`, `signupcode`, `level`, `pcktaken`, `launch`, `expiry`, `bankname`, `accountname`, `accountno`, `accounttype`, `ifsccode`, `getpayment`, `renew`) VALUES
(40, 'adminadmin', '123123123', 'Administrador', 'Address OF Company Or Individual', 'EmailofAdmin@Domain.com', 'none', 0, 0, 1, '0000-00-00', 'Colombia', 1265, '', '0', 1, 1, 0, '0000-00-00', 'Not Available', 'Not Available', 0, 0, 'Not Available', 1, 0),
(86, 'Sumitsinghal', '123456789', 'Usuario', 'France Address', 'singhal.techie@gmail.com', 'adminadmin', 0, 9999999999, 1, '2015-09-19', 'Colombia', 0, '', '1284892893', 2, 18, 0, '2018-06-14', 'Not Available', 'Not Available', 0, 0, 'Not Available', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `bannerid` double NOT NULL,
  `bannerdesc` varchar(100) NOT NULL,
  `bannerhtml` text NOT NULL,
  `banneractive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `comment`) VALUES
(1, 'US Dollar', 'USD', ''),
(28, 'Australian Dollar', 'AUD', ''),
(3, 'Brazilian Real', 'BRL', ''),
(4, 'Canadian Dollar', 'CAD', ''),
(5, 'Czech Koruna', 'CZK', ''),
(6, 'Danish Krone', 'DKK', ''),
(7, 'Euro', 'EUR', ''),
(8, 'Thai Baht', 'THB', ''),
(9, 'Hong Kong Dollar', 'HKD', ''),
(10, 'Hungarian Forint', 'HUF', ''),
(11, 'Israeli New Sheqel', 'ILS', ''),
(12, 'Japanese Yen', 'JPY', ''),
(13, 'Malaysian Ringgit', 'MYR', ''),
(14, 'Mexican Peso', 'MXN', ''),
(15, 'Norwegian Krone', 'NOK', ''),
(16, 'New Zealand Dollar', 'NZD', ''),
(17, 'Philippine Peso', 'PHP', ''),
(18, 'Polish Zloty ', 'PLN', ''),
(19, 'Pound Sterling', 'GBP', ''),
(20, 'Russian Ruble', 'RUB', ''),
(21, 'Singapore Dollar', 'SGD', ''),
(22, 'Swedish Krona', 'SEK', ''),
(23, 'Swiss Franc', 'CHF', ''),
(24, 'Taiwan New Dollar', 'TWD', ''),
(26, 'Turkish Lira', 'TRY', ''),
(2, 'Colombian Peso', 'COP', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emailtext`
--

CREATE TABLE `emailtext` (
  `id` int(6) NOT NULL,
  `code` varchar(50) NOT NULL,
  `etext` text NOT NULL,
  `emailactive` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emailtext`
--

INSERT INTO `emailtext` (`id`, `code`, `etext`, `emailactive`) VALUES
(1, 'SIGNUP', 'This email is the confirmation for your order you have just signed up. Thank you for your interest. Our team welcomes you to our website. \n\nRegards\nTeam Skyey Technologies', 1),
(2, 'FORGOTPASSWORD', 'Hi, \nYou have requested a password on our website and therefore we have sent the password on this email. If you haven''t do it please ignore the email.\n\nRegards\nTeam Skyey Technologies', 1),
(5, 'NEWMEMBER', 'You have got new order, bingo!', 1),
(6, 'NEWMEMBER', 'You have got new order, bingo!', 1),
(7, 'SIGNUP', 'This email is the confirmation for your order you have just signed up. Thank you for your interest. Our team welcomes you to our website. \r\n\r\nRegards\r\nTeam Skyey Technologies', 1),
(8, 'NEWMEMBER', 'You have got new order, bingo!', 1),
(9, 'SIGNUP', 'This email is the confirmation for your order you have just signed up. Thank you for your interest. Our team welcomes you to our website. \r\n\r\nRegards\r\nTeam Skyey Technologies', 1),
(10, 'NEWMEMBER', 'You have got new order, bingo!', 1),
(11, 'SIGNUP', 'This email is the confirmation for your order you have just signed up. Thank you for your interest. Our team welcomes you to our website. \r\n\r\nRegards\r\nTeam Skyey Technologies', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `posteddate` date NOT NULL,
  `valid` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `currency` text NOT NULL,
  `details` text NOT NULL,
  `tax` double NOT NULL DEFAULT '0',
  `mpay` double NOT NULL DEFAULT '0',
  `sbonus` double DEFAULT '0',
  `cdate` date NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `level1` double NOT NULL DEFAULT '0',
  `level2` double NOT NULL DEFAULT '0',
  `level3` double NOT NULL DEFAULT '0',
  `level4` double NOT NULL DEFAULT '0',
  `level5` double NOT NULL DEFAULT '0',
  `level6` double NOT NULL DEFAULT '0',
  `level7` double NOT NULL DEFAULT '0',
  `level8` double NOT NULL DEFAULT '0',
  `level9` double NOT NULL DEFAULT '0',
  `level10` double NOT NULL DEFAULT '0',
  `level11` double NOT NULL DEFAULT '0',
  `level12` double NOT NULL DEFAULT '0',
  `level13` double NOT NULL DEFAULT '0',
  `level14` double NOT NULL DEFAULT '0',
  `level15` double NOT NULL DEFAULT '0',
  `level16` double NOT NULL DEFAULT '0',
  `level17` double NOT NULL DEFAULT '0',
  `level18` double NOT NULL DEFAULT '0',
  `level19` double NOT NULL DEFAULT '0',
  `level20` double NOT NULL DEFAULT '0',
  `gateway` int(1) NOT NULL DEFAULT '3',
  `validity` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `currency`, `details`, `tax`, `mpay`, `sbonus`, `cdate`, `active`, `level1`, `level2`, `level3`, `level4`, `level5`, `level6`, `level7`, `level8`, `level9`, `level10`, `level11`, `level12`, `level13`, `level14`, `level15`, `level16`, `level17`, `level18`, `level19`, `level20`, `gateway`, `validity`) VALUES
(17, 'Trial', 5, 'USD', 'Trial Package', 0, 50, 1, '2015-09-19', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 999),
(18, 'Basico', 80000, 'COP', 'Paquete con mercado', 0, 1000000, 0, '2016-05-30', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paymentgateway`
--

CREATE TABLE `paymentgateway` (
  `id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paymentgateway`
--

INSERT INTO `paymentgateway` (`id`, `Name`, `status`, `comment`, `date`) VALUES
(1, 'PayPal', 1, 0, '0000-00-00'),
(2, 'Cash On Delivery', 1, 0, '0000-00-00'),
(3, 'Payza', 1, 0, '0000-00-00'),
(4, 'SolidTrustPay', 1, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(6) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `payment_amount` double NOT NULL DEFAULT '0',
  `payment_status` int(1) NOT NULL DEFAULT '0',
  `itemid` varchar(25) NOT NULL,
  `createdtime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `userid`, `payment_amount`, `payment_status`, `itemid`, `createdtime`) VALUES
(19, '86', 0, 0, '', '2016-05-30 00:06:23'),
(20, '86', 0, 0, '', '2016-05-30 00:06:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paypalpayments`
--

CREATE TABLE `paypalpayments` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `transacid` text NOT NULL,
  `price` double DEFAULT '0',
  `currency` text NOT NULL,
  `date` date NOT NULL,
  `cod` int(1) NOT NULL DEFAULT '0',
  `renew` int(1) NOT NULL DEFAULT '0',
  `renacid` int(9) NOT NULL COMMENT 'Package choosen at renew time, id of package',
  `pckid` double NOT NULL,
  `gateway` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paypalpayments`
--

INSERT INTO `paypalpayments` (`id`, `orderid`, `transacid`, `price`, `currency`, `date`, `cod`, `renew`, `renacid`, `pckid`, `gateway`) VALUES
(55, 86, 'C.O.D', 0, '', '2015-09-22', 1, 0, 0, 0, ''),
(56, 86, 'C.O.D', 0, '', '2015-09-22', 1, 0, 0, 0, ''),
(57, 86, 'C.O.D', 0, '', '2015-09-22', 1, 0, 0, 0, ''),
(58, 86, 'C.O.D', 0, '', '2015-09-22', 1, 0, 0, 0, ''),
(59, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 0, ''),
(60, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 0, ''),
(61, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 17, 'C.O.D'),
(62, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 17, 'C.O.D'),
(63, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 17, 'C.O.D'),
(64, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 17, 'C.O.D'),
(65, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 0, 0, 17, 'C.O.D'),
(66, 86, 'C.O.D', 5, 'USD', '2015-09-22', 1, 1, 0, 0, ''),
(67, 86, 'C.O.D', 5, 'USD', '2015-09-23', 1, 1, 0, 0, ''),
(68, 86, 'C.O.D', 5, 'USD', '2015-09-23', 1, 1, 17, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `email` varchar(100) NOT NULL DEFAULT 'Enter Your E-Mail Address',
  `sno` int(9) NOT NULL,
  `wlink` varchar(100) NOT NULL DEFAULT 'www.yourwebsite.com',
  `invoicedetails` text NOT NULL,
  `coname` text NOT NULL,
  `fblink` text NOT NULL,
  `twitterlink` text NOT NULL,
  `paypalid` text NOT NULL,
  `maintain` int(1) NOT NULL DEFAULT '0',
  `alwdpayment` int(11) NOT NULL DEFAULT '0' COMMENT 'user will get payment via paypal or via payment in bank account.',
  `minmobile` double NOT NULL,
  `maxmobile` double NOT NULL,
  `footer` varchar(50) NOT NULL,
  `header` varchar(50) NOT NULL,
  `payzaid` varchar(128) NOT NULL DEFAULT 'Not Available',
  `solidtrustid` varchar(128) NOT NULL DEFAULT 'Not Available',
  `solidbutton` varchar(128) NOT NULL DEFAULT 'Not Available'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`email`, `sno`, `wlink`, `invoicedetails`, `coname`, `fblink`, `twitterlink`, `paypalid`, `maintain`, `alwdpayment`, `minmobile`, `maxmobile`, `footer`, `header`, `payzaid`, `solidtrustid`, `solidbutton`) VALUES
('admin@admin.com', 0, 'localhost', 'Cali, Colombia', 'MercarGanando', 'https://fb.com/Webster17', 'https://twitter.com/websterh18', 'play4s-facilitator@yahoo.co.in', 0, 1, 0, 0, 'Desarrollado por hugogarcia.co', 'MercarGanando', 'Payza', 'Solid', 'Button');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `affiliateuser`
--
ALTER TABLE `affiliateuser`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`bannerid`);

--
-- Indices de la tabla `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `currency` ADD FULLTEXT KEY `code` (`code`);

--
-- Indices de la tabla `emailtext`
--
ALTER TABLE `emailtext`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paymentgateway`
--
ALTER TABLE `paymentgateway`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paypalpayments`
--
ALTER TABLE `paypalpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `affiliateuser`
--
ALTER TABLE `affiliateuser`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `bannerid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `emailtext`
--
ALTER TABLE `emailtext`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `paymentgateway`
--
ALTER TABLE `paymentgateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `paypalpayments`
--
ALTER TABLE `paypalpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
