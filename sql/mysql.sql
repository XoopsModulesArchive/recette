#
# Table structure for table `stories`
#

CREATE TABLE recette (
  storyid int(8) unsigned NOT NULL auto_increment,
  uid int(5) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  created int(10) unsigned NOT NULL default '0',
  published int(10) unsigned NOT NULL default '0',
  expired int(10) UNSIGNED NOT NULL default '0',
  hostname varchar(20) NOT NULL default '',
  nohtml tinyint(1) NOT NULL default '0',
  nosmiley tinyint(1) NOT NULL default '0',
  hometext text NOT NULL,
  bodytext text NOT NULL,
  counter int(8) unsigned NOT NULL default '0',
  topicid smallint(4) unsigned NOT NULL default '1',
  ihome tinyint(1) NOT NULL default '0',
  notifypub tinyint(1) NOT NULL default '0',
  story_type varchar(5) NOT NULL default '',
  topicdisplay tinyint(1) NOT NULL default '0',
  topicalign char(1) NOT NULL default 'R',
  comments smallint(5) unsigned NOT NULL default '0',
  image varchar(255) NOT NULL default '',
  nbpers int(10) NOT NULL default '0',
  tpspreparation varchar(30) NOT NULL default '',
  tpscuisson varchar(30) NOT NULL default '',
  tpsrepos varchar(30) NOT NULL default '',
  PRIMARY KEY  (storyid),
  KEY idxstoriestopic (topicid),
  KEY ihome (ihome),
  KEY uid (uid),
  KEY published_ihome (published,ihome),
  KEY title (title(40)),
  KEY created (created),
  FULLTEXT KEY search (title,hometext,bodytext)
) TYPE=MyISAM;


#
# Table structure for table `stories_files`
#

CREATE TABLE recette_files (
  fileid int(8) unsigned NOT NULL auto_increment,
  filerealname varchar(255) NOT NULL default '',
  storyid int(8) unsigned NOT NULL default '0',
  date int(10) NOT NULL default '0',
  mimetype varchar(64) NOT NULL default '',
  downloadname varchar(255) NOT NULL default '',
  counter int(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (fileid),
  KEY storyid (storyid)
) TYPE=MyISAM;

#
# Table structure for table `topics`
#

CREATE TABLE recette_topics (
  topic_id smallint(4) unsigned NOT NULL auto_increment,
  topic_pid smallint(4) unsigned NOT NULL default '0',
  topic_imgurl varchar(20) NOT NULL default '',
  topic_title varchar(50) NOT NULL default '',
  PRIMARY KEY  (topic_id),
  KEY pid (topic_pid)
) TYPE=MyISAM;

INSERT INTO recette_topics VALUES (1,0,'xoops.gif','XOOPS');


CREATE TABLE recette_ingredient (
  id smallint(4) unsigned NOT NULL auto_increment,
  name varchar(50) NOT NULL default '',
  PRIMARY KEY (id),
  KEY index_name (name)
) TYPE=MyISAM;

CREATE TABLE recette_lnk_ingredient_recette (
  id smallint(4) unsigned NOT NULL auto_increment,
  ingredient smallint(4) unsigned NOT NULL,
  recette int(8) unsigned NOT NULL,
  quantite varchar(40) NOT NULL,
  PRIMARY KEY (id)
) TYPE=MyISAM;


CREATE TABLE recette_cat (
  id smallint(4) unsigned NOT NULL auto_increment,
  categorie varchar(50) NOT NULL default '',
  description varchar(50) NOT NULL default '',
  image varchar(100) NOT NULL,
  PRIMARY KEY (id)
) TYPE=MyISAM;

CREATE TABLE recette_lnk_cat (
  id smallint(4) unsigned NOT NULL auto_increment,
  categorie smallint(4) unsigned NOT NULL,
  recette int(8) unsigned NOT NULL,
  PRIMARY KEY (id)
) TYPE=MyISAM;