
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言ID，自增',
  `post_title` varchar(255) NOT NULL COMMENT '言留标题',
  `post_author` varchar(96) NOT NULL COMMENT '留言者用户名',
  `post_content` text NOT NULL COMMENT '留言内容',
  `post_time` datetime NOT NULL COMMENT '留言时间',
  `reply_content` text COMMENT '管理员回复内容',
  `reply_time` datetime DEFAULT NULL COMMENT '管理员回复时间',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;