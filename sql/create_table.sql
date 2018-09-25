//어드민 테이블 생성
CREATE TABLE `admin_user` (
  `index` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk',
  `adm_id` varchar(50) NOT NULL COMMENT 'Id',
  `adm_pw` varchar(255) NOT NULL COMMENT '패스워드(password 함수)',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
  PRIMARY KEY (`index`,`adm_id`),
  UNIQUE KEY `adm_id_UNIQUE` (`adm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='신규 어드민 유저';

//계정 등록
INSERT INTO `admin_user`(`adm_id`, `adm_pw`) VALUES ('admin', PASSWORD('0615'));

//게임 테이블 생성
CREATE TABLE `sl_table` (
 `red_index` int(11) NOT NULL AUTO_INCREMENT,
 `table_date` text NOT NULL,
 `red_update_state` varchar(255) NOT NULL,
 `red_answer` varchar(255) NOT NULL,
 `red_modestate` varchar(255) NOT NULL,
 `gifttype` int(11) NOT NULL,
 `game_type` varchar(10) NOT NULL,
 PRIMARY KEY (`red_index`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8
