DROP TABLE IF EXISTS `formgen_bool_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_bool_form_option` (
  `id` int(11) NOT NULL,
  `default` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_ci_dynamic_form`;
CREATE TABLE IF NOT EXISTS `formgen_ci_dynamic_form` (
  `id` int(11) NOT NULL,
  `dynamic_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_ci_dynamic_form_index_1` (`dynamic_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_date_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_date_form_option` (
  `id` int(11) NOT NULL,
  `default_type` varchar(255) DEFAULT NULL,
  `default_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_dynamic_form`;
CREATE TABLE IF NOT EXISTS `formgen_dynamic_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_addresses_json` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_dynamic_form_form_elements`;
CREATE TABLE IF NOT EXISTS `formgen_dynamic_form_form_elements` (
  `dynamic_form_id` int(11) NOT NULL,
  `form_element_id` int(11) NOT NULL,
  PRIMARY KEY (`dynamic_form_id`,`form_element_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_dynamic_form_t`;
CREATE TABLE IF NOT EXISTS `formgen_dynamic_form_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `submit_label` varchar(255) DEFAULT NULL,
  `text_thanks_html` text,
  `mail_subject` varchar(255) DEFAULT NULL,
  `mail_text_intro` varchar(255) DEFAULT NULL,
  `mail_text_outro` varchar(255) DEFAULT NULL,
  `dynamic_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_dynamic_form_t_index_1` (`dynamic_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_email_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_email_form_option` (
  `id` int(11) NOT NULL,
  `send_copy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_element`;
CREATE TABLE IF NOT EXISTS `formgen_form_element` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_index` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_element_set`;
CREATE TABLE IF NOT EXISTS `formgen_form_element_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_element_set_form_elements`;
CREATE TABLE IF NOT EXISTS `formgen_form_element_set_form_elements` (
  `form_element_set_id` int(11) NOT NULL,
  `form_element_id` int(11) NOT NULL,
  PRIMARY KEY (`form_element_set_id`,`form_element_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_form_option` (
  `id` int(11) NOT NULL,
  `mandatory` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_option_t`;
CREATE TABLE IF NOT EXISTS `formgen_form_option_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `help_text` varchar(255) DEFAULT NULL,
  `form_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_option_t_index_1` (`form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_text`;
CREATE TABLE IF NOT EXISTS `formgen_form_text` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_title`;
CREATE TABLE IF NOT EXISTS `formgen_form_title` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_title_t`;
CREATE TABLE IF NOT EXISTS `formgen_form_title_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `form_title_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_title_t_index_1` (`form_title_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_form_txt_t`;
CREATE TABLE IF NOT EXISTS `formgen_form_txt_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `text_html` text,
  `form_text_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_form_txt_t_index_1` (`form_text_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_multi_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_multi_form_option_t`;
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `empty_value` varchar(255) DEFAULT NULL,
  `multi_form_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_multi_form_option_t_index_1` (`multi_form_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_multi_form_option_value`;
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `multi_form_option_id` int(11) DEFAULT NULL,
  `selected` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_multi_form_option_value_index_1` (`multi_form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_multi_form_option_value_t`;
CREATE TABLE IF NOT EXISTS `formgen_multi_form_option_value_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `multi_form_option_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_multi_form_option_value_t_index_1` (`multi_form_option_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_numeric_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_numeric_form_option` (
  `id` int(11) NOT NULL,
  `default` varchar(255) DEFAULT NULL,
  `min` varchar(255) DEFAULT NULL,
  `max` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_static_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_static_form_option` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_static_form_option_t`;
CREATE TABLE IF NOT EXISTS `formgen_static_form_option_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `static_form_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_static_form_option_t_index_1` (`static_form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_string_form_option`;
CREATE TABLE IF NOT EXISTS `formgen_string_form_option` (
  `id` int(11) NOT NULL,
  `max_length` varchar(255) DEFAULT NULL,
  `multiline` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `formgen_string_form_option_t`;
CREATE TABLE IF NOT EXISTS `formgen_string_form_option_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n2n_locale` varchar(12) DEFAULT NULL,
  `default` varchar(255) DEFAULT NULL,
  `string_form_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formgen_string_form_option_t_index_1` (`string_form_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;