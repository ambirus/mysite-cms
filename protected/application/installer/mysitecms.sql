SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

{{%CREATEDB%}}

USE `{{%DBNAME%}}`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `installed` tinyint(1) NOT NULL DEFAULT '1',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `modules` (`id`, `alias`, `name`, `installed`, `state`) VALUES
  (1, 'core', 'Core', 1, 1),
  (2, 'admin', 'Admin area', 1, 1),
  (3, 'mailing', 'Mailing', 1, 1),
  (4, 'navigation', 'Navigation', 1, 1),
  (5, 'page', 'Pages', 1, 1),
  (6, 'site', 'Site', 1, 1);

CREATE TABLE `module_core_jobs` (
  `id` bigint(20) NOT NULL,
  `module` varchar(50) NOT NULL,
  `command` varchar(1024) NOT NULL,
  `data` mediumtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `module_core_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_index` (`status`);


ALTER TABLE `module_core_jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

CREATE TABLE `module_admin_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `module_admin_settings` (`id`, `alias`, `name`, `value`) VALUES
  (1, 'login', 'Admin login', '{{%LOGINADMIN%}}'),
  (2, 'password', 'Admin password', '{{%PASSADMIN%}}'),
  (3, 'last_login', 'Last login', ''),
  (4, 'installed', 'Installed', '1'),
  (5, 'state', 'Active', '1');

CREATE TABLE `module_mailing_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `module_mailing_settings` (`id`, `alias`, `name`, `value`) VALUES
  (1, 'mailType', 'Mailing type', 'mail');

CREATE TABLE `module_mailing_spam` (
  `ips` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `module_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `module_navigation` (`id`, `alias`, `name`, `state`) VALUES
  (1, 'main', 'Main menu', 1);

CREATE TABLE `module_navigation_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(1024) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_num` tinyint(2) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `module_navigation_items` (`id`, `menu_id`, `parent_id`, `url`, `alias`, `title`, `order_num`, `state`) VALUES
  (1, 1, 0, '/', 'main', 'Main', 0, 1),
  (2, 1, 0, '/about', 'about', 'About us', 2, 1),
  (3, 1, 0, '/services', 'services', 'Our services', 3, 1),
  (4, 1, 0, '/contacts', 'contacts', 'Contacts', 4, 1);

CREATE TABLE `module_navigation_prettyurls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `fullUrl` varchar(1024) NOT NULL,
  `shortUrl` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shortUrl` (`shortUrl`(255))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `module_navigation_prettyurls` (`id`, `model`, `fullUrl`, `shortUrl`) VALUES
  (1, 'application\\modules\\page\\models\\Page', '/page/front/index/id=2', '/about'),
  (2, 'application\\modules\\page\\models\\Page', '/page/front/index/id=3', '/services');

CREATE TABLE `module_page_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) NOT NULL,
  `body` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `module_page_items` (`id`, `title`, `body`, `keywords`, `description`, `created_at`, `updated_at`, `state`) VALUES
  (1, 'Main', '<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>\r\n\r\n<p>Fusce et aliquam erat. Maecenas molestie rutrum tellus a lacinia. Sed pellentesque molestie ante, quis tempor eros pharetra id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec mauris lectus, efficitur aliquam ultrices at, viverra sed erat. Morbi eu massa mauris. Donec et molestie elit. Morbi nec consequat turpis, ac lacinia odio. Praesent tellus neque, vestibulum rutrum eros non, sollicitudin semper urna. Sed ac tortor ultricies, convallis enim nec, sodales orci. Sed id iaculis lectus, quis pretium nisl. Mauris molestie urna sed erat aliquet, id tincidunt ante tempor. Vestibulum tincidunt urna at eros hendrerit vehicula. Duis pulvinar elit in mi rhoncus porttitor. Donec eu ligula quis lectus eleifend blandit venenatis sed quam. Sed pharetra est at lectus porta ullamcorper vitae faucibus dui. Ut et luctus nisi, vitae commodo urna. Morbi tempor malesuada massa, ac rutrum mauris dapibus id. Aenean lobortis lacus orci, id tristique lacus ultricies id. Integer nibh augue, efficitur ut pulvinar vel, ultricies id lectus. Vivamus ac sapien orci. Nulla tincidunt at felis ullamcorper commodo. Etiam hendrerit lacus ut sapien maximus, vitae volutpat tortor consequat. Etiam arcu ex, feugiat id odio sit amet, ultricies semper ante. Fusce et ipsum vitae ex venenatis eleifend. Quisque pretium ipsum eu purus posuere, id pellentesque justo ultrices. Aliquam tempor faucibus ex ac feugiat.</p>', '', '', 1495446169, 1495787452, 1),
  (2, 'About us', '<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>\r\n\r\n<p>Fusce et aliquam erat. Maecenas molestie rutrum tellus a lacinia. Sed pellentesque molestie ante, quis tempor eros pharetra id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec mauris lectus, efficitur aliquam ultrices at, viverra sed erat. Morbi eu massa mauris. Donec et molestie elit. Morbi nec consequat turpis, ac lacinia odio. Praesent tellus neque, vestibulum rutrum eros non, sollicitudin semper urna. Sed ac tortor ultricies, convallis enim nec, sodales orci. Sed id iaculis lectus, quis pretium nisl. Mauris molestie urna sed erat aliquet, id tincidunt ante tempor. Vestibulum tincidunt urna at eros hendrerit vehicula. Duis pulvinar elit in mi rhoncus porttitor. Donec eu ligula quis lectus eleifend blandit venenatis sed quam. Sed pharetra est at lectus porta ullamcorper vitae faucibus dui. Ut et luctus nisi, vitae commodo urna. Morbi tempor malesuada massa, ac rutrum mauris dapibus id. Aenean lobortis lacus orci, id tristique lacus ultricies id. Integer nibh augue, efficitur ut pulvinar vel, ultricies id lectus. Vivamus ac sapien orci. Nulla tincidunt at felis ullamcorper commodo. Etiam hendrerit lacus ut sapien maximus, vitae volutpat tortor consequat. Etiam arcu ex, feugiat id odio sit amet, ultricies semper ante. Fusce et ipsum vitae ex venenatis eleifend. Quisque pretium ipsum eu purus posuere, id pellentesque justo ultrices. Aliquam tempor faucibus ex ac feugiat.</p>', '', '', 1495446169, 1495787452, 1),
  (3, 'Our services', '<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>\r\n\r\n<p>Fusce et aliquam erat. Maecenas molestie rutrum tellus a lacinia. Sed pellentesque molestie ante, quis tempor eros pharetra id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec mauris lectus, efficitur aliquam ultrices at, viverra sed erat. Morbi eu massa mauris. Donec et molestie elit. Morbi nec consequat turpis, ac lacinia odio. Praesent tellus neque, vestibulum rutrum eros non, sollicitudin semper urna. Sed ac tortor ultricies, convallis enim nec, sodales orci. Sed id iaculis lectus, quis pretium nisl. Mauris molestie urna sed erat aliquet, id tincidunt ante tempor. Vestibulum tincidunt urna at eros hendrerit vehicula. Duis pulvinar elit in mi rhoncus porttitor. Donec eu ligula quis lectus eleifend blandit venenatis sed quam. Sed pharetra est at lectus porta ullamcorper vitae faucibus dui. Ut et luctus nisi, vitae commodo urna. Morbi tempor malesuada massa, ac rutrum mauris dapibus id. Aenean lobortis lacus orci, id tristique lacus ultricies id. Integer nibh augue, efficitur ut pulvinar vel, ultricies id lectus. Vivamus ac sapien orci. Nulla tincidunt at felis ullamcorper commodo. Etiam hendrerit lacus ut sapien maximus, vitae volutpat tortor consequat. Etiam arcu ex, feugiat id odio sit amet, ultricies semper ante. Fusce et ipsum vitae ex venenatis eleifend. Quisque pretium ipsum eu purus posuere, id pellentesque justo ultrices. Aliquam tempor faucibus ex ac feugiat.</p>', '', '', 1495446169, 1495787452, 1);


CREATE TABLE `module_site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `module_site_settings` (`id`, `alias`, `name`, `value`) VALUES
  (1, 'appName', 'Site name', '{{%NAMESITE%}}'),
  (2, 'theme', 'Site theme', '{{%THEMESITE%}}'),
  (3, 'language', 'Site language', '{{%LANGSITE%}}'),
  (4, 'mail', 'Contact email', '{{%CONTACTMAIL%}}'),
  (5, 'footer', 'Site footer', '<p>&copy; 2017, MySite CMS</p>\r\n'),
  (6, 'google', 'Google block', '                                                                                                                        '),
  (7, 'header', 'Site header', '<h2>MySite CMS</h2>\r\n'),
  (8, 'links', 'Site links', '<div>\r\n<div>\r\n<h4>Contacts:</h4>\r\n\r\n<ul>\r\n	<li><strong>E-mail:</strong> <a href=\"mailto:clients@mysite-cms.ru\">clients@mysite-cms.ru</a></li>\r\n	<li><strong>VK:</strong> <a href=\"https://vk.com/mysitecms\" target=\"_blank\">vk.com/mysitecms</a></li>\r\n</ul>\r\n</div>\r\n</div>\r\n'),
  (9, 'logo', 'Site logo', '<h1>MySite CMS</h1>\r\n'),
  (10, 'yandex', 'Yandex block', ''),
  (11, 'mainPage', 'Main page', '1'),
  (12, 'captcha', 'Captcha using flag', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;