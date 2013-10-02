drop schema if exists `alpsite`;

create schema if not exists `alpsite` default collate 'utf8_general_ci' character set 'utf8';

use `alpsite`;

create table if not exists `site_user` (
	`uid` integer primary key auto_increment,
	`login` varchar(16) not null unique comment 'user login',
	`mail` varchar(128) not null unique comment 'user email',
	`name` varchar(128) not null comment 'Имя пользователя в миру',
	`pwdrestorequest` varchar(128) not null comment 'Текст контрольного вопросса',
	`hash` varchar(32) not null comment 'hash-свертка пароля',
	`requesthash` varchar(32) not null comment 'hash-свертка ответа на контрольный вопросс',
	`accessrules` set('site_member','federation_member', 'club_member') comment 'Регулирование доступа к разделам сайта на базе членства'
) engine = innodb comment 'Таблица пользователей сайта';

-- Таблца восстановлений пароля. Заполняется при запроссе восстановления пароля и 
-- успешном ответе на контрольный вопрос. Запись таблицы удаляется при входе 
-- пользователя на сайт. Аттрибут rndprefix является динамически формируемой 
-- частью url страницы восстановления.
create table if not exists `site_pwdrequest` (
	`uid` integer not null unique primary key comment 'указатель на запись пользователя',
	`rndsuffix` varchar(64) not null unique comment 'уникальный ключ url страницы восстановления пароля',
	key `fk_site_pwdrequest_uid` (`uid`),
	constraint `fk_site_pwdrequets_uid` foreign key (`uid`) references `site_user` (`uid`) on update cascade on delete cascade
) engine = innodb comment 'Запроссы восстановления пароля';

-- ******************* Статьи на сайте *****************************
-- таблица тематики статей
create table if not exists `article_theme` (
	`id` integer primary key auto_increment,
	`title` varchar(128) not null unique comment 'названия тем',
	`icon` varchar(128) default null comment 'иконка', -- вопросс необходимости
	`iscommentenable` bool default true comment 'Разрешение комментариев в теме' -- вопросс необходимости
) engine = innodb comment 'Темы статей';

-- Таблица модераторов
-- связывает тему статей с пользователем, назначенным модератором, 
-- по умолчанию тем кто создал тему, однако предусматреть редактирование 
-- списка модераторов. Модератор будет получать оповещения о публикациях и 
-- комментариях в теме.
create table if not exists `article_moderator` (
	`id` integer primary key,
	`theme` integer not null comment 'Указатель не тему',
	`uid` integer not null comment 'Указатель на модератора',
	key `unq_article_maderator` (`theme`, `uid`) comment 'Исключим дубли тема+модератор',
	key `fk_article_moderator_theme` (`theme`),
	key `fk_article_moderator_uid` (`uid`),
	constraint `fk_article_moderator_theme` foreign key (`theme`) references `article_theme`(`id`) on update cascade on delete cascade,
	constraint `fk_article_moderator_uid` foreign key (`uid`) references `site_user`(`uid`) on update cascade on delete cascade
) engine = innodb comment 'Модераторы тем статей';

-- Таблица статей
-- Содержит тело статьи и информацию о ней
-- автор статьи получает оповещения о комментариях.
create table if not exists `article_body` (
	`artid` integer primary key auto_increment,
	`theme` integer not null comment 'Указатель на тему',
	`author` integer not null comment 'Указатель на автора',
	`timestamp` timestamp default current_timestamp comment 'дата время публикации',
	`title` varchar (128) not null comment 'Заголовок статьи',
	`body` longtext not null comment 'текст',
	`brief` text default null comment 'аннонс',
	`md5body` varchar(32) not null unique comment 'hash от тела статьи для исключения дублирования текстовки',
	`keywords` varchar(128) default null comment 'ключевые слова для поиска',
	key `unq_article_in_theme` (`theme`,`title`) comment 'исключим дубли заголовка в теме',
	key `fk_article_body_theme` (`theme`),
	key `k_article_keywords` (`keywords`),
	constraint `fk_article_body_theme` foreign key (`theme`) references `article_theme`(`id`) on update cascade on delete restrict
) engine = innodb comment 'Описание тела статьи';

create table if not exists `article_comment` (
	`id` integer unsigned primary key,
	`artid` integer not null comment 'указатель на статью',
	`uid` integer not null comment 'автор кмеента',
	`parent` integer unsigned default null comment 'Указатель на комментируемый комментарий',
	`body` text not null comment 'Текст комментария',
	`timestamp` timestamp not null default current_timestamp comment 'время публикации',
	key `fk_article_comment_artid` (`artid`),
	key `fk_article_comment_uid` (`uid`),
	key `fk_article_comment_parent` (`parent`),
	constraint `fk_article_comment_artid` foreign key (`artid`) references `article_body` (`artid`) on update cascade on delete cascade,
	constraint `fk_article_comment_uid` foreign key (`uid`) references `site_user` (`uid`) on update cascade on delete restrict,
	constraint `fk_article_comment_parent` foreign key (`parent`) references `article_comment` (`id`) on update cascade on delete restrict
) engine = innodb comment 'Комментарии к статьям';

create table if not exists `article_submit` (
	`id` integer primary key auto_increment,
	`uid` integer not null comment 'Указатель на пользователя',
	`artid` integer not null comment 'Указатель на статью',
	`triggers` set ('Редактрование статьи', 'Коментарйи', 'Статья уделенна') not null comment 'Тригерры оповещения',
	key `unq_article_submit` (`artid`, `uid`) comment 'блокировка двойных подписок',
	key `fk_article_submit_uid` (`uid`),
	key `fk_article_submit_artid` (`artid`),
	constraint `fk_article_submit_uid` foreign key (`uid`) references `site_user` (`uid`) on update cascade on delete cascade,
	constraint `fk_article_submit_artid` foreign key (`artid`) references `article_body` (`artid`) on update cascade on delete cascade
) engine innodb comment 'Подписка на статью';

create table if not exists `article_theme_submit` (
	`id` integer primary key auto_increment,
	`uid` integer not null comment 'Указатель на пользователя',
	`theme` integer not null comment 'Указатель на тему',
	`triggers` set ('Новая статья', 'Сатья переименованна', 'Перемещение статьи в другую тему', 'Статья уделенна', 'Тема удаленна') not null comment 'Тригерры оповещения',
	key `unq_article_theme_submit` (`theme`, `uid`) comment 'блокировка двойных подписок',
	key `fk_article_theme_submit_uid` (`uid`),
	key `fk_article_theme_submit_theme` (`theme`),
	constraint `fk_article_theme_submit_uid` foreign key (`uid`) references `site_user` (`uid`) on update cascade on delete cascade,
	constraint `fk_article_theme_submit_theme` foreign key (`theme`) references `article_theme` (`id`) on update cascade on delete cascade
) engine innodb comment 'Подписка на статью';

-- ************************ ФЕДЕРАЦИЯ **************************
create table if not exists `federation_member` (
	`mid` integer primary key auto_increment,
	`uid` integer default null comment 'привязка к учетке пользователя сайта',
	`name` varchar(128) not null comment 'Имя Фамилия отчество',
	`date_of_bethday` date default null comment 'День рождения',
	`sport_range` enum (
		'не имеет',
		'3-й разряд',
		'2-й разряд',
		'1-й разряд',
		'кандидат в мастера спорта',
		'мастер спорта',
		'заслуженный мастер спорта'
	) default null comment 'текущий разряд',
	`mountain_resque` bool default null comment 'жетон спасение в горах',
	`mountain_guide` enum (
		'не имеет',
		'стажер',
		'III категория',
		'II категория',
		'I категория'
	) default null comment 'текущая инструкторская категория',
	`about` text default null comment 'Данные о участнике',
	`photo` varchar(128) default null comment 'путь к файлу фотографии',
	key `fk_federation_member_uid` (`uid`),
	constraint `fk_federation_member_uid` foreign key (`uid`) references `site_user`(`uid`) on update cascade on delete set null
) engine = innodb comment 'Члены федерации';