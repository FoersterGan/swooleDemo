//直播表
CREATE TABLE  `live_team`(
  `id` tinyint(1) unsigned NOT NULL auto_increment,
  `name` VARCHAR(20) NOT NULL DEFAULT '',
  `image` VARCHAR(20) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  `update_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT charset=utf8;
//比赛球队表
CREATE TABLE  `live_game`(
  `id` int(10) unsigned NOT NULL auto_increment,
  `a_id` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `b_id` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `a_score` int(1)  unsigned NOT NULL DEFAULT 0,
  `b_score` int(1)  unsigned NOT NULL DEFAULT 0,
  `narrator` VARCHAR(20) NOT NULL DEFAULT '',
  `start_time` int(10) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  `update_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT charset=utf8;

//球员表
CREATE TABLE  `live_player`(
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` VARCHAR(20) NOT NULL DEFAULT '',
  `image` VARCHAR(20) NOT NULL DEFAULT '',
  `age` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `position` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  `update_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT charset=utf8;
//直播内容表
CREATE TABLE  `live_otus`(
  `id` int(10) unsigned NOT NULL auto_increment,
  `game_id` int(10) unsigned NOT NULL DEFAULT 0,
  `team_id` int(10) unsigned NOT NULL DEFAULT 0,
  `content` VARCHAR(200) NOT NULL DEFAULT '',
  `image` VARCHAR(20) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT charset=utf8;

//用户聊天表
CREATE TABLE  `live_chart`(
  `id` int(10) unsigned NOT NULL auto_increment,
  `game_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `content` VARCHAR(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT charset=utf8;