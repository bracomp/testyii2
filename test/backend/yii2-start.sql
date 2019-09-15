-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 13 2019 г., 11:34
-- Версия сервера: 5.5.8
-- Версия PHP: 5.4.0

--
-- База данных: `yii2-start`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apple`
--

CREATE TABLE IF NOT EXISTS `apple` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `color` varchar(16) NOT NULL,
  `date0` int(11) NOT NULL,
  `date1` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `eat` int(2) NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `apple`
--

INSERT INTO `apple` (`id`, `color`, `date0`, `date1`, `status`, `eat`, `state`) VALUES
(1, 'lime', 156837, '2019-09-13 10:34:25', 2, 67, 2),
(2, 'yellow', 1568370865, '2019-09-13 10:34:25', 1, 100, 0),
(3, 'green', 1568370866, '2019-09-13 10:34:26', 1, 100, 1),
(4, 'gray', 1568370866, '2019-09-13 10:34:26', 1, 100, 0),
(6, 'red', 1568370866, '2019-09-13 10:34:26', 1, 100, 1),
(7, 'gray', 1568370866, '2019-09-13 10:34:26', 1, 100, 0),
(8, 'lime', 1568370866, '2019-09-13 10:34:26', 1, 100, 0),
(9, 'silver', 1568370866, '2019-09-13 10:34:26', 1, 100, 0),
(10, 'olive', 1568370931, '2019-09-13 10:34:26', 2, 34, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '_VNwvoKBYfQdV9-m04zfaiN3aijcNKfn', '$2y$13$5p7HR9hwaIzCZjzT95xbKuQBpRuGGkSW7othqEGht8LCI8LVQvg/a', NULL, 'admin@test.uz', 10, 1467146186, 1568341134),
(2, 'user', 'FBsuWpmB0Kz4MZOxXFnApay2THcyDuul', '$2y$13$6NuDKMv.BM6yppuAjYcMGuyeqK1QsP9UHMvzRSczJl0vNzZjsWZe2', NULL, 'user@test.uz', 10, 1467146418, 1568341135);
