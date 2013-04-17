CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_qualifications` text NOT NULL,
  `user_registered` datetime NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `user_channel_name` varchar(100) NOT NULL,
  `user_channel_slug` varchar(100) NOT NULL,
  `user_channel_code` varchar(8) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_blog_slug` (`user_blog_slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `songs` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `song_slug` varchar(100) NOT NULL,
  `song_title` text NOT NULL,
  `song_source` varchar(11) NOT NULL,
  `song_source_id` varchar(100) NOT NULL,
  `song_channel_name` text NOT NULL,
  `song_channel_slug` varchar(100) NOT NULL,
  `song_favorites` int(11) NOT NULL DEFAULT 0,
  `song_posted` datetime NOT NULL,
  PRIMARY KEY (`song_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `channels` (
  `channel_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_slug` varchar(100) NOT NULL,
  `channel_name` text NOT NULL,
  `channel_yt_id` varchar(100) NOT NULL,
  `channel_img_url` text NOT NULL,
  `channel_status` int(11) NOT NULL DEFAULT 0,
  `channel_approved` datetime NOT NULL,
  PRIMARY KEY (`channel_id`),
  UNIQUE KEY `channel_yt_id` (`channel_yt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `favorites` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  PRIMARY KEY (`favorite_id`),
  UNIQUE KEY `favorite_id` (`favorite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;