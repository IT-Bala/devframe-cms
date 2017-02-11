DROP TABLE tbl_admin;

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_admin VALUES("1","admin","admin","1");



DROP TABLE tbl_admin_design;

CREATE TABLE `tbl_admin_design` (
  `design_id` int(11) NOT NULL AUTO_INCREMENT,
  `font_size` int(11) NOT NULL,
  `font_family` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`design_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_admin_design VALUES("1","15","\'Lucida Grande\'","1");



DROP TABLE tbl_admin_menu;

CREATE TABLE `tbl_admin_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_admin_submenu;

CREATE TABLE `tbl_admin_submenu` (
  `submenu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `submenu` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`submenu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_menus;

CREATE TABLE `tbl_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `submenu_id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `menu_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_newsletter;

CREATE TABLE `tbl_newsletter` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_email` varchar(255) NOT NULL,
  `news_subject` varchar(255) NOT NULL,
  `news_msg` varchar(255) NOT NULL,
  `news_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_pages;

CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `friendly_url` text NOT NULL,
  `page_link` varchar(255) NOT NULL,
  `page_date` varchar(255) NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `default_page` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_plugins;

CREATE TABLE `tbl_plugins` (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`plugin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_plugins VALUES("1","Newsletter","0");



DROP TABLE tbl_posts;

CREATE TABLE `tbl_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `friendly_url` text NOT NULL,
  `post_link` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `default_page` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE tbl_themes;

CREATE TABLE `tbl_themes` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_themes VALUES("1","blue","1");



