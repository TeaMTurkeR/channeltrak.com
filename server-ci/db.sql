CREATE TABLE `channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `youtube_id` varchar(255) NOT NULL,
  `youtube_title` varchar(255) NOT NULL,
  `cover_id` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `published` datetime NOT NULL,
  `added` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `youtube_id` (`youtube_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `traks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `youtube_id` varchar(11) NOT NULL,
  `channel_id` varchar(11) NOT NULL,
  `views` int(11) NOT NULL,
  `published` datetime NOT NULL,
  `imported` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `youtube_id` (`youtube_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `channel_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` varchar(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `trak_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trak_id` varchar(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trak_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

