ALTER TABLE `#__template_styles` CHANGE `params` `params` MEDIUMTEXT;

DROP TABLE IF EXISTS `#__gridbox_pages`;
CREATE TABLE `#__gridbox_pages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `theme` varchar(255) NOT NULL,
    `meta_title` varchar(255) NOT NULL,
    `meta_description` text NOT NULL,
    `meta_keywords` text NOT NULL,
    `published` tinyint(1) NOT NULL DEFAULT 1,
    `params` mediumtext NOT NULL,
    `style` mediumtext NOT NULL,
    `fonts` text NOT NULL,
    `intro_image` varchar(255) NOT NULL,
    `page_alias` varchar(255) NOT NULL,
    `page_category` varchar(255) NOT NULL,
    `page_access` int(11) NOT NULL DEFAULT 1,
    `intro_text` mediumtext NOT NULL,
    `image_alt` varchar(255) NOT NULL,
    `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `end_publishing` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `hits` int(11) NOT NULL DEFAULT 0,
    `language` varchar(255) NOT NULL DEFAULT '*',
    `app_id` int(11) NOT NULL DEFAULT 0,
    `saved_time` varchar(255) NOT NULL DEFAULT '',
    `order_list` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_app`;
CREATE TABLE `#__gridbox_app` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `alias` varchar(255) NOT NULL,
    `theme` int(11) NOT NULL,
    `type` varchar(255) NOT NULL,
    `page_layout` mediumtext NOT NULL,
    `page_items` mediumtext NOT NULL,
    `page_fonts` text NOT NULL,
    `app_fonts` text NOT NULL,
    `app_layout` mediumtext NOT NULL,
    `app_items` mediumtext NOT NULL,
    `saved_time` varchar(255) NOT NULL DEFAULT '',
    `published` tinyint(1) NOT NULL DEFAULT 1,
    `access` tinyint(1) NOT NULL DEFAULT 1,
    `language` varchar(255) NOT NULL DEFAULT '*',
    `image` varchar(255) NOT NULL,
    `meta_title` varchar(255) NOT NULL,
    `meta_description` text NOT NULL,
    `meta_keywords` text NOT NULL,
    `order_list` int(11) NOT NULL DEFAULT 1,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_fonts`;
CREATE TABLE `#__gridbox_fonts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `font` varchar(255) NOT NULL,
    `styles` varchar(255) NOT NULL,
    `custom_src` text NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_plugins`;
CREATE TABLE `#__gridbox_plugins` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    `type` varchar(255) NOT NULL,
    `joomla_constant` varchar(255) NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_page_blocks`;
CREATE TABLE `#__gridbox_page_blocks` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `item` mediumtext NOT NULL,
    `image` varchar(255) NOT NULL,
    `type` varchar(255) NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_library`;
CREATE TABLE `#__gridbox_library` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `item` mediumtext NOT NULL,
    `type` varchar(255) NOT NULL DEFAULT 'section',
    `global_item` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_categories`;
CREATE TABLE `#__gridbox_categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `alias` varchar(255) NOT NULL,
    `published` tinyint(1) NOT NULL DEFAULT 1,
    `access` tinyint(1) NOT NULL DEFAULT 1,
    `app_id` int(11) NOT NULL,
    `language` varchar(255) NOT NULL DEFAULT '*',
    `description` text NOT NULL,
    `image` varchar(255) NOT NULL,
    `meta_title` varchar(255) NOT NULL,
    `meta_description` text NOT NULL,
    `meta_keywords` text NOT NULL,
    `parent` int(11) NOT NULL DEFAULT 0,
    `order_list` int(11) NOT NULL DEFAULT 1,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_tags`;
CREATE TABLE `#__gridbox_tags` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `alias` varchar(255) NOT NULL,
    `hits` int(11) NOT NULL DEFAULT 0,
    `published` tinyint(1) NOT NULL DEFAULT 1,
    `access` tinyint(1) NOT NULL DEFAULT 1,
    `language` varchar(255) NOT NULL DEFAULT '*',
    `description` text NOT NULL,
    `image` varchar(255) NOT NULL,
    `meta_title` varchar(255) NOT NULL,
    `meta_description` text NOT NULL,
    `meta_keywords` text NOT NULL,
    `order_list` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_tags_map`;
CREATE TABLE `#__gridbox_tags_map` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `tag_id` int(11) NOT NULL,
    `page_id` int(11) NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_api`;
CREATE TABLE `#__gridbox_api` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service` varchar(255) NOT NULL,
    `key` text NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_website`;
CREATE TABLE `#__gridbox_website` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `favicon` varchar(255) NOT NULL,
    `header_code` mediumtext NOT NULL,
    `body_code` mediumtext NOT NULL,
    `enable_autosave` varchar(255) NOT NULL DEFAULT "false",
    `autosave_delay` varchar(255) NOT NULL DEFAULT "10",
    `breakpoints` text NOT NULL,
    `date_format` varchar(255) NOT NULL DEFAULT "j F Y",
    `container` varchar(255) NOT NULL DEFAULT '1170',
    `disable_responsive` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_star_ratings`;
CREATE TABLE IF NOT EXISTS  `#__gridbox_star_ratings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `plugin_id` varchar(255) NOT NULL,
    `option` varchar(255) NOT NULL,
    `view` varchar(255) NOT NULL,
    `page_id` varchar(255) NOT NULL,
    `rating` FLOAT NOT NULL,
    `count` int(11) NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_star_ratings_users`;
CREATE TABLE IF NOT EXISTS  `#__gridbox_star_ratings_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `plugin_id` varchar(255) NOT NULL,
    `option` varchar(255) NOT NULL,
    `view` varchar(255) NOT NULL,
    `page_id` varchar(255) NOT NULL,
    `ip` varchar(255) NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_filter_state`;
CREATE TABLE `#__gridbox_filter_state` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `value` varchar(255) NOT NULL,
    `user` int(11) NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_instagram`;
CREATE TABLE `#__gridbox_instagram` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `plugin_id` varchar(255) NOT NULL,
    `accessToken` varchar(255) NOT NULL,
    `count` int(11) NOT NULL,
    `images` mediumtext NOT NULL,
    `saved_time` varchar(255) NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__gridbox_system_pages`;
CREATE TABLE `#__gridbox_system_pages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `type` varchar(255) NOT NULL,
    `theme` varchar(255) NOT NULL,
    `html` mediumtext NOT NULL,
    `items` mediumtext NOT NULL,
    `fonts` text NOT NULL,
    `saved_time` varchar(255) NOT NULL DEFAULT '',
    `order_list` int(11) NOT NULL DEFAULT 0,
    `page_options` mediumtext NOT NULL,
    PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

INSERT INTO `#__gridbox_system_pages`(`title`, `type`, `theme`, `order_list`, `page_options`) VALUES
('404 Error Page', '404', 0, 1, '{"enable_header":false}');

INSERT INTO `#__gridbox_website` (`favicon`, `header_code`, `body_code`, `breakpoints`) VALUES
('', '', '', '{"tablet":1024,"tablet-portrait":768,"phone":667,"phone-portrait":375,"menuBreakpoint":768}');

INSERT INTO `#__gridbox_api` (`service`, `key`) VALUES
('google_maps', ''),
('library_font', ''),
('user_colors', '{"0":"#eb523c","1":"#f65954","2":"#ec821a","3":"#f5c500","4":"#34dca2","5":"#20364c","6":"#32495f","7":"#0075a9","8":"#1996dd","9":"#6cc6fa"}');

INSERT INTO `#__gridbox_plugins` (`title`, `image`, `type`, `joomla_constant`) VALUES
('ba-image', 'flaticon-picture', 'content', 'IMAGE'),
('ba-text', 'flaticon-file', 'content', 'TEXT'),
('ba-button', 'plugins-button', 'content', 'BUTTON'),
('ba-logo', 'flaticon-diamond', 'navigation', 'LOGO'),
('ba-menu', 'flaticon-app', 'navigation', 'MENU'),
('ba-modules', 'plugins-modules', '3rd-party-plugins', 'JOOMLA_MODULES'),
('ba-forms', 'plugins-forms', '3rd-party-plugins', 'BALBOOA_FORMS'),
('ba-gallery', 'plugins-gallery', '3rd-party-plugins', 'BALBOOA_GALLERY');

INSERT INTO `#__gridbox_fonts` (`font`, `styles`) VALUES
('Open+Sans', 300),
('Open+Sans', 400),
('Open+Sans', 700),
('Poppins', 300),
('Poppins', 400),
('Poppins', 500),
('Poppins', 600),
('Poppins', 700),
('Roboto', 300),
('Roboto', 400),
('Roboto', 500),
('Roboto', 700),
('Roboto', 900),
('Lato', 300),
('Lato', 400),
('Lato', 700),
('Slabo+27px', 400),
('Oswald', 300),
('Oswald', 400),
('Oswald', 600),
('Roboto+Condensed', 300),
('Roboto+Condensed', 400),
('Roboto+Condensed', 700),
('PT+Sans', 400),
('PT+Sans', 700),
('Montserrat', 200),
('Montserrat', 300),
('Montserrat', 400),
('Montserrat', 700),
('Playfair+Display', 400),
('Playfair+Display', 700),
('Comfortaa', 300),
('Comfortaa', 400),
('Comfortaa', 700);

INSERT INTO `#__gridbox_app` (`title`, `type`, `order_list`) VALUES
('TAGS', 'tags', '50');