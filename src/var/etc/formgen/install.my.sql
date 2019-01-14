-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_bool_form_option
CREATE TABLE IF NOT EXISTS `formgen_bool_form_option` (
  `id` int(11) NOT NULL,
  `default` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_ci_dynamic_form
CREATE TABLE IF NOT EXISTS `formgen_ci_dynamic_form` (
  `id` int(11) NOT NULL,
  `dynamic_form_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_ci_dynamic_form_index_1` (`dynamic_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_dynamic_form
CREATE TABLE IF NOT EXISTS `formgen_dynamic_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_addresses_json` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_dynamic_form_t
CREATE TABLE IF NOT EXISTS `formgen_dynamic_form_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text_thanks_html` text,
  `dynamic_form_id` int(10) unsigned DEFAULT NULL,
  `submit_label` varchar(255) DEFAULT NULL,
  `mail_subject` varchar(255) DEFAULT NULL,
  `mail_text_intro` varchar(255) DEFAULT NULL,
  `mail_text_outro` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_dynamic_form_t_index_1` (`dynamic_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_email_form_option
CREATE TABLE IF NOT EXISTS `formgen_email_form_option` (
  `id` int(11) NOT NULL,
  `send_copy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_element
CREATE TABLE IF NOT EXISTS `formgen_form_element` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dynamic_form_id` int(10) unsigned DEFAULT NULL,
  `oder_index` varchar(255) DEFAULT NULL,
  `order_index` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_element_index_1` (`dynamic_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_option
CREATE TABLE IF NOT EXISTS `formgen_form_option` (
  `id` int(11) NOT NULL,
  `mandatory` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_option_t
CREATE TABLE IF NOT EXISTS `formgen_form_option_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `help_text` varchar(255) DEFAULT NULL,
  `form_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_option_t_index_1` (`form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_text
CREATE TABLE IF NOT EXISTS `formgen_form_text` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_title
CREATE TABLE IF NOT EXISTS `formgen_form_title` (
  `id` int(11) NOT NULL,
  `form_title_ts` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_title_t
CREATE TABLE IF NOT EXISTS `formgen_form_title_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `form_title_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_title_t_index_1` (`form_title_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_form_txt_t
CREATE TABLE IF NOT EXISTS `formgen_form_txt_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `text_html` text,
  `form_text_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_txt_t_index_1` (`form_text_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_multi_form_option
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_multi_form_option_value
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multi_form_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_multi_form_option_value_index_1` (`multi_form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_multi_form_option_value_t
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option_value_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `multi_form_option_value_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_multi_form_option_value_t_index_1` (`multi_form_option_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_numeric_form_option
CREATE TABLE IF NOT EXISTS `formgen_numeric_form_option` (
  `id` int(11) NOT NULL,
  `default` varchar(255) DEFAULT NULL,
  `min` varchar(255) DEFAULT NULL,
  `max` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_static_form_option
CREATE TABLE IF NOT EXISTS `formgen_static_form_option` (
  `id` int(11) NOT NULL,
  `hidden` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_static_form_option_t
CREATE TABLE IF NOT EXISTS `formgen_static_form_option_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `static_form_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_static_form_option_t_index_1` (`static_form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_string_form_option
CREATE TABLE IF NOT EXISTS `formgen_string_form_option` (
  `id` int(11) NOT NULL,
  `max_length` varchar(255) DEFAULT NULL,
  `multiline` varchar(255) DEFAULT NULL,
  `string_form_option_ts` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt


-- Exportiere Struktur von Tabelle abfall-rohstoffe.formgen_string_form_option_t
CREATE TABLE IF NOT EXISTS `formgen_string_form_option_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `default` varchar(255) DEFAULT NULL,
  `string_form_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_string_form_option_t_index_1` (`string_form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
