
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `ims_stu_profile`;
CREATE TABLE `ims_stu_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `fakeid` varchar(255) NOT NULL DEFAULT '' COMMENT 'FAKEID',
  `from_user` varchar(255) NOT NULL DEFAULT '' COMMENT 'OPENid',
  `xh` varchar(50) NOT NULL DEFAULT '' COMMENT 'ѧ��',
  `jwcpwd` text NOT NULL DEFAULT '' COMMENT '��������',
  `libpwd` text NOT NULL DEFAULT '' COMMENT 'ͼ�������',
  `realname` varchar(10) NOT NULL DEFAULT '' COMMENT '��ʵ����',
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '�ǳ�',
  `xb` text NOT NULL DEFAULT '' COMMENT '�Ա�',
  `csrq` text NOT NULL DEFAULT '' COMMENT '��������',
  `sfzh` text NOT NULL DEFAULT '' COMMENT '���֤��',
  `xymc` text NOT NULL DEFAULT '' COMMENT 'ѧԺ����',
  `zymc` text NOT NULL DEFAULT '' COMMENT 'רҵ����',
  `zyfx` text NOT NULL DEFAULT '' COMMENT 'רҵ����',
  `bjmc` text NOT NULL DEFAULT '' COMMENT '�༶����',
  `nj` text NOT NULL  DEFAULT '' COMMENT '�꼶',
  `syszd` text NOT NULL DEFAULT '' COMMENT '��Դ���ڵ�',
  `wechat` varchar(255) NOT NULL DEFAULT '' COMMENT '΢�ź�',
  `qq` varchar(15) NOT NULL DEFAULT '' COMMENT 'QQ��',
  `avatar` varchar(100) NOT NULL DEFAULT '' COMMENT 'ͷ��',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '�ֻ�����',
  `shortnum` varchar(11) NOT NULL DEFAULT '' COMMENT '�̺�',
  `room` varchar(255) NOT NULL DEFAULT '' COMMENT '�����',
  `createtime` int(10) unsigned NOT NULL COMMENT '����ʱ��',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;