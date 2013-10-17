CREATE DATABASE  IF NOT EXISTS `alpsite` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `alpsite`;
-- MySQL dump 10.14  Distrib 5.5.32-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: alpsite
-- ------------------------------------------------------
-- Server version	5.5.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article_body`
--

DROP TABLE IF EXISTS `article_body`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_body` (
  `artid` int(11) NOT NULL AUTO_INCREMENT,
  `theme` int(11) NOT NULL COMMENT 'Указатель на тему',
  `author` int(11) NOT NULL COMMENT 'Указатель на автора',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата время публикации',
  `title` varchar(128) NOT NULL COMMENT 'Заголовок статьи',
  `body` longtext NOT NULL COMMENT 'текст',
  `brief` text COMMENT 'аннонс',
  `md5body` varchar(32) NOT NULL COMMENT 'hash от тела статьи для исключения дублирования текстовки',
  `keywords` varchar(128) DEFAULT NULL COMMENT 'ключевые слова для поиска',
  PRIMARY KEY (`artid`),
  UNIQUE KEY `md5body` (`md5body`),
  KEY `unq_article_in_theme` (`theme`,`title`) COMMENT 'исключим дубли заголовка в теме',
  KEY `fk_article_body_theme` (`theme`),
  KEY `k_article_keywords` (`keywords`),
  CONSTRAINT `fk_article_body_theme` FOREIGN KEY (`theme`) REFERENCES `article_theme` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Описание тела статьи';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_body`
--

LOCK TABLES `article_body` WRITE;
/*!40000 ALTER TABLE `article_body` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_body` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_comment`
--

DROP TABLE IF EXISTS `article_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_comment` (
  `id` int(10) unsigned NOT NULL,
  `artid` int(11) NOT NULL COMMENT 'указатель на статью',
  `uid` int(11) NOT NULL COMMENT 'автор кмеента',
  `parent` int(10) unsigned DEFAULT NULL COMMENT 'Указатель на комментируемый комментарий',
  `body` text NOT NULL COMMENT 'Текст комментария',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время публикации',
  PRIMARY KEY (`id`),
  KEY `fk_article_comment_artid` (`artid`),
  KEY `fk_article_comment_uid` (`uid`),
  KEY `fk_article_comment_parent` (`parent`),
  CONSTRAINT `fk_article_comment_artid` FOREIGN KEY (`artid`) REFERENCES `article_body` (`artid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_comment_uid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON UPDATE CASCADE,
  CONSTRAINT `fk_article_comment_parent` FOREIGN KEY (`parent`) REFERENCES `article_comment` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Комментарии к статьям';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_comment`
--

LOCK TABLES `article_comment` WRITE;
/*!40000 ALTER TABLE `article_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_moderator`
--

DROP TABLE IF EXISTS `article_moderator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_moderator` (
  `id` int(11) NOT NULL,
  `theme` int(11) NOT NULL COMMENT 'Указатель не тему',
  `uid` int(11) NOT NULL COMMENT 'Указатель на модератора',
  PRIMARY KEY (`id`),
  KEY `unq_article_maderator` (`theme`,`uid`) COMMENT 'Исключим дубли тема+модератор',
  KEY `fk_article_moderator_theme` (`theme`),
  KEY `fk_article_moderator_uid` (`uid`),
  CONSTRAINT `fk_article_moderator_theme` FOREIGN KEY (`theme`) REFERENCES `article_theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_moderator_uid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Модераторы тем статей';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_moderator`
--

LOCK TABLES `article_moderator` WRITE;
/*!40000 ALTER TABLE `article_moderator` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_moderator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_submit`
--

DROP TABLE IF EXISTS `article_submit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_submit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'Указатель на пользователя',
  `artid` int(11) NOT NULL COMMENT 'Указатель на статью',
  `triggers` set('Редактрование статьи','Коментарйи','Статья уделенна') NOT NULL COMMENT 'Тригерры оповещения',
  PRIMARY KEY (`id`),
  KEY `unq_article_submit` (`artid`,`uid`) COMMENT 'блокировка двойных подписок',
  KEY `fk_article_submit_uid` (`uid`),
  KEY `fk_article_submit_artid` (`artid`),
  CONSTRAINT `fk_article_submit_uid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_submit_artid` FOREIGN KEY (`artid`) REFERENCES `article_body` (`artid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Подписка на статью';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_submit`
--

LOCK TABLES `article_submit` WRITE;
/*!40000 ALTER TABLE `article_submit` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_submit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_theme`
--

DROP TABLE IF EXISTS `article_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL COMMENT 'названия тем',
  `icon` varchar(128) DEFAULT NULL COMMENT 'иконка',
  `parent` int(11) DEFAULT NULL COMMENT 'указатель на родительскую тему',
  `iscommentenable` tinyint(1) DEFAULT '1' COMMENT 'Разрешение комментариев в теме',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `fk_article_theme_parent` (`parent`),
  CONSTRAINT `fk_article_theme_parent` FOREIGN KEY (`parent`) REFERENCES `article_theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Темы статей';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_theme`
--

LOCK TABLES `article_theme` WRITE;
/*!40000 ALTER TABLE `article_theme` DISABLE KEYS */;
INSERT INTO `article_theme` VALUES (1,'Федерация Альпинизма Пензенской области','/images/federation-icon.png',NULL,1),(2,'Альпклуб \"Пенза\"','/images/club-icon.png',NULL,1),(3,'Отчеты','/images/report-icon.png',NULL,1),(4,'Горы мира','/images/mountain-icon.png',NULL,1);
/*!40000 ALTER TABLE `article_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_theme_submit`
--

DROP TABLE IF EXISTS `article_theme_submit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_theme_submit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'Указатель на пользователя',
  `theme` int(11) NOT NULL COMMENT 'Указатель на тему',
  `triggers` set('Новая статья','Сатья переименованна','Перемещение статьи в другую тему','Статья уделенна','Тема удаленна') NOT NULL COMMENT 'Тригерры оповещения',
  PRIMARY KEY (`id`),
  KEY `unq_article_theme_submit` (`theme`,`uid`) COMMENT 'блокировка двойных подписок',
  KEY `fk_article_theme_submit_uid` (`uid`),
  KEY `fk_article_theme_submit_theme` (`theme`),
  CONSTRAINT `fk_article_theme_submit_uid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_theme_submit_theme` FOREIGN KEY (`theme`) REFERENCES `article_theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Подписка на статью';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_theme_submit`
--

LOCK TABLES `article_theme_submit` WRITE;
/*!40000 ALTER TABLE `article_theme_submit` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_theme_submit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `federation_calendar`
--

DROP TABLE IF EXISTS `federation_calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `federation_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Наиманование АМ',
  `begin` date NOT NULL COMMENT 'начало АМ',
  `finish` date NOT NULL COMMENT 'окончание АМ',
  `localtion` varchar(100) NOT NULL COMMENT 'место проведения',
  `latitude` float DEFAULT NULL COMMENT 'широта',
  `longitude` float DEFAULT NULL COMMENT 'долгота',
  `organisation` varchar(100) NOT NULL COMMENT 'проводящая организация',
  `responsible_executor` varchar(50) NOT NULL COMMENT 'ответственный исполнитель',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='календарь АМ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `federation_calendar`
--

LOCK TABLES `federation_calendar` WRITE;
/*!40000 ALTER TABLE `federation_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `federation_calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `federation_calendar_article`
--

DROP TABLE IF EXISTS `federation_calendar_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `federation_calendar_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL COMMENT 'указатель на АМ',
  `article` int(11) NOT NULL COMMENT 'указатель на статью',
  `note` tinytext COMMENT 'Примечание',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_federation_calendar_event_article` (`event`,`article`) COMMENT 'ограничение двойного включения статьи в АМ',
  KEY `fk_federation_calendar_event` (`event`),
  KEY `fk_federation_calendar_article` (`article`),
  CONSTRAINT `fk_federation_calendar_event` FOREIGN KEY (`event`) REFERENCES `federation_calendar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_federation_calendar_article` FOREIGN KEY (`article`) REFERENCES `article_body` (`artid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='подшивки статей к АМ из календаря';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `federation_calendar_article`
--

LOCK TABLES `federation_calendar_article` WRITE;
/*!40000 ALTER TABLE `federation_calendar_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `federation_calendar_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `federation_documents`
--

DROP TABLE IF EXISTS `federation_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `federation_documents` (
  `artid` int(11) NOT NULL,
  PRIMARY KEY (`artid`),
  CONSTRAINT `fk_federation_documents` FOREIGN KEY (`artid`) REFERENCES `article_body` (`artid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Документы на странице федерации';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `federation_documents`
--

LOCK TABLES `federation_documents` WRITE;
/*!40000 ALTER TABLE `federation_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `federation_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `federation_member`
--

DROP TABLE IF EXISTS `federation_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `federation_member` (
  `dossier` int(11) NOT NULL,
  `member_from` date NOT NULL COMMENT 'член с (дата)',
  `memberr_to` date DEFAULT NULL COMMENT 'член по (дата)',
  `federation_role` int(11) DEFAULT NULL COMMENT 'занимаемая должность',
  `special_service` text COMMENT 'Особые заслуги',
  PRIMARY KEY (`dossier`),
  KEY `fk_federation_member_dossier` (`dossier`),
  KEY `fk_federation_member_role` (`federation_role`),
  CONSTRAINT `fk_federation_member_dossier` FOREIGN KEY (`dossier`) REFERENCES `lib_user_dossier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_federation_member_role` FOREIGN KEY (`federation_role`) REFERENCES `federation_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Члены федерации';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `federation_member`
--

LOCK TABLES `federation_member` WRITE;
/*!40000 ALTER TABLE `federation_member` DISABLE KEYS */;
INSERT INTO `federation_member` VALUES (1,'0000-00-00',NULL,6,'Фотограф'),(2,'0000-00-00',NULL,4,''),(3,'0000-00-00',NULL,1,NULL),(4,'0000-00-00',NULL,7,NULL),(5,'0000-00-00',NULL,2,NULL);
/*!40000 ALTER TABLE `federation_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `federation_role`
--

DROP TABLE IF EXISTS `federation_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `federation_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL COMMENT 'должность',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='должности в федерации';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `federation_role`
--

LOCK TABLES `federation_role` WRITE;
/*!40000 ALTER TABLE `federation_role` DISABLE KEYS */;
INSERT INTO `federation_role` VALUES (1,'Председатель федерации'),(2,'вице-председатель'),(3,'Член совета'),(4,'Контролер'),(5,'Старший тренер'),(6,'Почетный член'),(7,'член федерации');
/*!40000 ALTER TABLE `federation_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lib_climbing_list`
--

DROP TABLE IF EXISTS `lib_climbing_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_climbing_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` int(11) NOT NULL COMMENT 'участник',
  `date` date NOT NULL COMMENT 'дата',
  `peak` varchar(64) NOT NULL COMMENT 'на вершину',
  `route` varchar(64) NOT NULL COMMENT 'по маршруту',
  `difficulty` enum('1Б','2А','2Б','3А','3Б','4А','4Б','5А','5Б','6А','6Б') NOT NULL DEFAULT '1Б' COMMENT 'категории сложности',
  `ingroup` varchar(64) NOT NULL COMMENT 'в составе группы',
  `report` int(11) DEFAULT NULL COMMENT 'указатель на отчет',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_climbing_list` (`date`,`member`,`peak`,`route`,`difficulty`),
  KEY `fk_climbing_member` (`member`),
  KEY `fk_climbing_report` (`report`),
  CONSTRAINT `fk_climbing_member` FOREIGN KEY (`member`) REFERENCES `lib_user_dossier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_climbing_report` FOREIGN KEY (`report`) REFERENCES `article_body` (`artid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='список восхождений';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_climbing_list`
--

LOCK TABLES `lib_climbing_list` WRITE;
/*!40000 ALTER TABLE `lib_climbing_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `lib_climbing_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lib_user_dossier`
--

DROP TABLE IF EXISTS `lib_user_dossier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_user_dossier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT 'привязка к учетке пользователя сайта',
  `name` varchar(128) NOT NULL COMMENT 'Имя Фамилия Отчество',
  `date_of_bethday` date DEFAULT NULL COMMENT 'День рождения',
  `sport_range` enum('не имеет','3-й разряд','2-й разряд','1-й разряд','кандидат в мастера спорта','мастер спорта','заслуженный мастер спорта') DEFAULT 'не имеет' COMMENT 'текущий разряд',
  `mountain_resque` int(11) DEFAULT NULL COMMENT '№ жетона спасение в горах',
  `mountain_guide` enum('не имеет','стажер','III категория','II категория','I категория') DEFAULT 'не имеет' COMMENT 'текущая инструкторская категория',
  `about` text COMMENT 'Данные о участнике',
  `photo` varchar(128) DEFAULT NULL COMMENT 'путь к файлу фотографии',
  PRIMARY KEY (`id`),
  KEY `fk_user_dossier_uid` (`uid`),
  CONSTRAINT `fk_user_dossier_uid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Досье участника';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_user_dossier`
--

LOCK TABLES `lib_user_dossier` WRITE;
/*!40000 ALTER TABLE `lib_user_dossier` DISABLE KEYS */;
INSERT INTO `lib_user_dossier` VALUES (1,NULL,'Езерский Борис Олегович','0000-00-00','2-й разряд',NULL,'не имеет','Гурман','http://cs417120.vk.me/v417120841/c2b/1F_WXpMwzYQ.jpg'),(2,1,'Питиков Евгений Алексеевич','0000-00-00','2-й разряд',NULL,'не имеет','Зануда','https://lh5.googleusercontent.com/-YXmdsRQfxMQ/T1uSL6gqOTI/AAAAAAAAADQ/X4CU40gG1I4/w426-h427/IMG_5078.JPG'),(3,NULL,'Школьников Александр Николаевич','0000-00-00','кандидат в мастера спорта',56,'II категория','Хотя он и далеко, он всеже Наш','https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash4/c30.30.381.381/s160x160/392596_237669279632425_353327084_n.jpg'),(4,NULL,'Кожунов Антон Алексеевич','0000-00-00','1-й разряд',NULL,'не имеет','Наше все','http://cs4411.vk.me/u21927680/a_c68f6b75.jpg'),(5,NULL,'Купцов Максим Евгеньевич',NULL,'1-й разряд',NULL,'не имеет','Old scool junior','http://cs425222.vk.me/v425222656/2c00/rPccb2HvWWU.jpg');
/*!40000 ALTER TABLE `lib_user_dossier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mountaineeringclub_calendar`
--

DROP TABLE IF EXISTS `mountaineeringclub_calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mountaineeringclub_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Наиманование мероприятия',
  `begin` datetime NOT NULL COMMENT 'начало АМ',
  `finish` datetime DEFAULT NULL COMMENT 'окончание АМ',
  `localtion` varchar(100) NOT NULL COMMENT 'место проведения',
  `latitude` float DEFAULT NULL COMMENT 'широта',
  `longitude` float DEFAULT NULL COMMENT 'долгота',
  `responsible_executor` int(11) NOT NULL COMMENT 'ответственный исполнитель',
  `article` int(11) DEFAULT NULL COMMENT 'Указатель на связанную статью',
  PRIMARY KEY (`id`),
  KEY `fk_club_calendar_executor` (`responsible_executor`),
  KEY `fk_club_calendar_article` (`article`),
  CONSTRAINT `fk_club_calendar_executor` FOREIGN KEY (`responsible_executor`) REFERENCES `site_user` (`uid`) ON UPDATE CASCADE,
  CONSTRAINT `fk_club_calendar_article` FOREIGN KEY (`article`) REFERENCES `article_body` (`artid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Календарь мероприятий клуба';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mountaineeringclub_calendar`
--

LOCK TABLES `mountaineeringclub_calendar` WRITE;
/*!40000 ALTER TABLE `mountaineeringclub_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `mountaineeringclub_calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mountaineeringclub_documents`
--

DROP TABLE IF EXISTS `mountaineeringclub_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mountaineeringclub_documents` (
  `artid` int(11) NOT NULL,
  PRIMARY KEY (`artid`),
  CONSTRAINT `fk_mountaineeringclub_documents` FOREIGN KEY (`artid`) REFERENCES `article_body` (`artid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Документы на странице альпклуба';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mountaineeringclub_documents`
--

LOCK TABLES `mountaineeringclub_documents` WRITE;
/*!40000 ALTER TABLE `mountaineeringclub_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `mountaineeringclub_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mountaineeringclub_member`
--

DROP TABLE IF EXISTS `mountaineeringclub_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mountaineeringclub_member` (
  `dossier` int(11) NOT NULL,
  `member_from` date NOT NULL COMMENT 'член с (дата)',
  `member_to` date DEFAULT NULL COMMENT 'член по (дата)',
  `mountaineeringclub_role` int(11) DEFAULT NULL COMMENT 'занимаемая должность',
  `special_service` text COMMENT 'Особые заслуги',
  PRIMARY KEY (`dossier`),
  KEY `fk_mountaineeringclub_member_dossier` (`dossier`),
  KEY `fk_mountaineeringclub_member_role` (`mountaineeringclub_role`),
  CONSTRAINT `fk_mountaineeringclub_member_dossier` FOREIGN KEY (`dossier`) REFERENCES `lib_user_dossier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mountaineeringclub_member_role` FOREIGN KEY (`mountaineeringclub_role`) REFERENCES `mountaineeringclub_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Члены клуба';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mountaineeringclub_member`
--

LOCK TABLES `mountaineeringclub_member` WRITE;
/*!40000 ALTER TABLE `mountaineeringclub_member` DISABLE KEYS */;
INSERT INTO `mountaineeringclub_member` VALUES (4,'0000-00-00',NULL,1,NULL),(5,'0000-00-00',NULL,1,NULL);
/*!40000 ALTER TABLE `mountaineeringclub_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mountaineeringclub_role`
--

DROP TABLE IF EXISTS `mountaineeringclub_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mountaineeringclub_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL COMMENT 'должность',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='должности в федерации';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mountaineeringclub_role`
--

LOCK TABLES `mountaineeringclub_role` WRITE;
/*!40000 ALTER TABLE `mountaineeringclub_role` DISABLE KEYS */;
INSERT INTO `mountaineeringclub_role` VALUES (1,'Старший тренер'),(2,'Тренер'),(3,'Почетный член клуба'),(4,'член клуба');
/*!40000 ALTER TABLE `mountaineeringclub_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_pwdrequest`
--

DROP TABLE IF EXISTS `site_pwdrequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_pwdrequest` (
  `uid` int(11) NOT NULL COMMENT 'указатель на запись пользователя',
  `rndsuffix` varchar(64) NOT NULL COMMENT 'уникальный ключ url страницы восстановления пароля',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `rndsuffix` (`rndsuffix`),
  KEY `fk_site_pwdrequest_uid` (`uid`),
  CONSTRAINT `fk_site_pwdrequets_uid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Запроссы восстановления пароля';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_pwdrequest`
--

LOCK TABLES `site_pwdrequest` WRITE;
/*!40000 ALTER TABLE `site_pwdrequest` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_pwdrequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_user`
--

DROP TABLE IF EXISTS `site_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(16) NOT NULL COMMENT 'user login',
  `mail` varchar(128) NOT NULL COMMENT 'user email',
  `name` varchar(128) NOT NULL COMMENT 'Имя пользователя в миру',
  `pwdrestorequest` varchar(128) NOT NULL COMMENT 'Текст контрольного вопросса',
  `hash` varchar(32) NOT NULL COMMENT 'hash-свертка пароля',
  `requesthash` varchar(32) NOT NULL COMMENT 'hash-свертка ответа на контрольный вопросс',
  `accessrules` set('site_member','federation_member','club_member','site_admin') DEFAULT NULL COMMENT 'Регулирование доступа к разделам сайта на базе членства',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей сайта';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_user`
--

LOCK TABLES `site_user` WRITE;
/*!40000 ALTER TABLE `site_user` DISABLE KEYS */;
INSERT INTO `site_user` VALUES (1,'65d19abedc03b8ba','climber.pitikov@gmail.com','Евгений Питиков','openid','openid','openid','site_admin'),(2,'bdc97e7b871c0fbd','pitikov@yandex.ru','Евгений Питиков','openid','openid','openid',NULL),(3,'pitikov','pitikov@ya.ru','Pitikov Evgeniy','dream-peak','2b30c8ab6824f2dd94397e1385fd7515','2c50345003992ea639bcccfcd84fab51','site_admin');
/*!40000 ALTER TABLE `site_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_user_openid`
--

DROP TABLE IF EXISTS `site_user_openid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_user_openid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'указатель на запись пользователя',
  `service` varchar(50) NOT NULL COMMENT 'Имя сервиса аутенфикации',
  `token` varchar(32) NOT NULL COMMENT 'свертка от ключа OpenId',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_site_openid` (`service`,`token`) COMMENT 'Делаем привязку к OpenId уникальной',
  KEY `fk_site_user_openid` (`uid`),
  CONSTRAINT `fk_site_user_openid` FOREIGN KEY (`uid`) REFERENCES `site_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Таблица токенов OpenId и OpenAuth';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_user_openid`
--

LOCK TABLES `site_user_openid` WRITE;
/*!40000 ALTER TABLE `site_user_openid` DISABLE KEYS */;
INSERT INTO `site_user_openid` VALUES (1,1,'google','ffeb43a4e2ab8906635ba18f1b6d4a2c'),(2,2,'yandex','550f312adea34b9c977f745b698ef5fb');
/*!40000 ALTER TABLE `site_user_openid` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-17 10:02:48
