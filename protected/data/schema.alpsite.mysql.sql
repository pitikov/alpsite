drop schema if exists `alpsite`;

create schema if not exists `alpsite` default collate 'utf8_general_ci' character set 'utf8';

use `alpsite`;

-- Таблица пользователей
-- 1-й зарегестрированный пользователь автоматически становится администратором
create table if not exists `site_user` (
	`uid` integer primary key auto_increment,
	`login` varchar(16) not null unique comment 'user login',
	`mail` varchar(128) not null unique comment 'user email',
	`name` varchar(128) not null comment 'Имя пользователя в миру',
	`pwdrestorequest` varchar(128) not null comment 'Текст контрольного вопросса',
	`hash` varchar(32) not null comment 'hash-свертка пароля',
	`requesthash` varchar(32) not null comment 'hash-свертка ответа на контрольный вопросс',
	`accessrules` set('site_member','federation_member', 'club_member','site_admin') comment 'Регулирование доступа к разделам сайта на базе членства'
) engine = innodb comment 'Таблица пользователей сайта';

create table if not exists `site_user_openid` (
	`id` integer primary key auto_increment,
	`uid` integer not null comment 'указатель на запись пользователя',
	`service` varchar(50) not null comment 'Имя сервиса аутенфикации',
	`token` varchar(32)  not null comment 'свертка от ключа OpenId',
	key `fk_site_user_openid` (`uid`),
	constraint `fk_site_user_openid` foreign key (`uid`) references `site_user`(`uid`) on update cascade on delete cascade,
	constraint `unq_site_openid` unique (`service`,`token`) comment 'Делаем привязку к OpenId уникальной'
) engine = innodb comment 'Таблица токенов OpenId и OpenAuth';

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
	`title` varchar(128) not null comment 'названия тем',
	`icon` varchar(128) default null comment 'иконка', -- вопросс необходимости
	`parent` integer default null comment 'указатель на родительскую тему',
	`iscommentenable` bool default true comment 'Разрешение комментариев в теме', -- вопросс необходимости
	key `fk_article_theme_parent` (`parent`),
	constraint `uq_article_hteme` unique (`parent`, `title`),
	constraint `fk_article_theme_parent` foreign key (`parent`) references `article_theme` (`id`) on update cascade on delete cascade
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


-- *************** табличные данные (библиотека) ***************
-- библиотека данных о пользователях
create table if not exists `lib_user_dossier` (
	`id` integer primary key auto_increment,
	`uid` integer default null comment 'привязка к учетке пользователя сайта',
	`name` varchar(128) not null comment 'Имя Фамилия Отчество',
	`date_of_bethday` date default null comment 'День рождения',
	`sport_range` enum (
		'не имеет',
		'3-й разряд',
		'2-й разряд',
		'1-й разряд',
		'кандидат в мастера спорта',
		'мастер спорта',
		'заслуженный мастер спорта'
	) default 'не имеет' comment 'текущий разряд',
	`mountain_resque` integer default null comment '№ жетона спасение в горах',
	`mountain_guide` enum (
		'не имеет',
		'стажер',
		'III категория',
		'II категория',
		'I категория'
	) default 'не имеет' comment 'текущая инструкторская категория',
	`about` text default null comment 'Данные о участнике',
	`photo` varchar(128) default null comment 'путь к файлу фотографии',
	key `fk_user_dossier_uid` (`uid`),
	constraint `fk_user_dossier_uid` foreign key (`uid`) references `site_user`(`uid`) on update cascade on delete set null
) engine = innodb comment 'Досье участника';

-- схоженные вершины
create table if not exists `lib_climbing_list` (
	`id` integer primary key auto_increment,
	`member` integer not null comment 'участник',
	`date` date not null comment 'дата',
	`peak` varchar (64) not null comment 'на вершину',
	`route` varchar (64) not null comment 'по маршруту',
	`difficulty` enum (
		'1Б','2А','2Б','3А','3Б','4А','4Б','5А','5Б','6А','6Б'
	) not null default '1Б' comment 'категории сложности',
	`ingroup` varchar(64) not null comment 'в составе группы',
	`report` integer default null comment 'указатель на отчет',
	key `fk_climbing_member` (`member`),
	key `fk_climbing_report` (`report`),
	constraint `fk_climbing_member` foreign key (`member`) references `lib_user_dossier`(`id`) on update cascade on delete cascade,
	constraint `fk_climbing_report` foreign key (`report`) references `article_body`(`artid`) on update cascade on delete set null,
	constraint `unq_climbing_list` unique (`date`,`member`,`peak`,`route`,`difficulty`)
) engine = innodb comment 'список восхождений';

-- @@TODO@@
-- В настоящий момент информация о членах федерации и членах клуба почти полностью
-- идентична, хотя предполагается что должны быть различия - вопросс требует
-- проработки
-- ************************ ФЕДЕРАЦИЯ **************************
-- должности в федерации
create table if not exists `federation_role` (
	`id` integer primary key auto_increment,
	`role` varchar(50) comment 'должность'
) engine innodb comment 'должности в федерации';

insert into `federation_role` (`role`) values
('Председатель федерации'),
('Вице-председатель'),
('Член совета'),
('Контролер'),
('Старший тренер'),
('Почетный член'),
('член федерации');

-- члены федерации
create table if not exists `federation_member` (
	`dossier` integer primary key,
	`member_from` date not null comment 'член с (дата)',
	`memberr_to` date default null comment 'член по (дата)',
	`federation_role` integer default null comment 'занимаемая должность',
	`special_service` text default null comment 'Особые заслуги',
	key `fk_federation_member_dossier` (`dossier`),
	key `fk_federation_member_role` (`federation_role`),
	constraint `fk_federation_member_dossier` foreign key (`dossier`) references `lib_user_dossier`(`id`) on update cascade on delete cascade,
	constraint `fk_federation_member_role` foreign key (`federation_role`) references `federation_role`(`id`) on update cascade on delete restrict
) engine = innodb comment 'Члены федерации';

-- оффициальные документы федерации
create table if not exists `federation_documents` (
	`artid` integer primary key,
	constraint `fk_federation_documents` foreign key (`artid`) references `article_body`(`artid`) on update cascade on delete cascade
) engine = innodb comment 'Документы на странице федерации';

insert into `article_theme` (`title`,`icon`) values ('Федерация Альпинизма Пензенской области','/images/federation-icon.png');

create table if not exists `federation_calendar` (
	`id` integer primary key auto_increment,
	`title` varchar(100) not null comment 'Наиманование АМ',
	`begin` date not null comment 'начало АМ',
	`finish` date not null comment 'окончание АМ',
	`localtion` varchar(100) not null comment 'место проведения',
	`latitude` float default null comment 'широта',
	`longitude` float default null comment 'долгота',
	`organisation` varchar(100) not null comment 'проводящая организация',
	`responsible_executor` varchar(50) not null comment 'ответственный исполнитель'
) engine = innodb comment 'календарь АМ';

create table if not exists `federation_calendar_article` (
	`id` integer primary key auto_increment,
	`event` integer not null comment 'указатель на АМ',
	`article` integer not null comment 'указатель на статью',
	`note` tinytext default null comment 'Примечание',
	key `fk_federation_calendar_event` (`event`),
	key `fk_federation_calendar_article` (`article`),
	constraint `fk_federation_calendar_event` foreign key (`event`) references `federation_calendar`(`id`) on update cascade on delete cascade,
	constraint `fk_federation_calendar_article` foreign key (`article`) references `article_body`(`artid`) on update cascade on delete cascade,
	constraint `unq_federation_calendar_event_article` unique (`event`,`article`) comment 'ограничение двойного включения статьи в АМ'
) engine = innodb comment 'подшивки статей к АМ из календаря';

-- ************************ клуб **************************
-- должности в клубе
create table if not exists `mountaineeringclub_role` (
	`id` integer primary key auto_increment,
	`role` varchar(50) comment 'должность'
) engine innodb comment 'должности в федерации';

insert into `mountaineeringclub_role` (`role`) values
('Старший тренер'),
('Тренер'),
('Почетный член клуба'),
('член клуба');

-- члены клуба
create table if not exists `mountaineeringclub_member` (
	`dossier` integer primary key,
	`member_from` date not null comment 'член с (дата)',
	`member_to` date default null comment 'член по (дата)',
	`mountaineeringclub_role` integer default null comment 'занимаемая должность',
	`special_service` text default null comment 'Особые заслуги',
	key `fk_mountaineeringclub_member_dossier` (`dossier`),
	key `fk_mountaineeringclub_member_role` (`mountaineeringclub_role`),
	constraint `fk_mountaineeringclub_member_dossier` foreign key (`dossier`) references `lib_user_dossier`(`id`) on update cascade on delete cascade,
	constraint `fk_mountaineeringclub_member_role` foreign key (`mountaineeringclub_role`) references `mountaineeringclub_role`(`id`) on update cascade on delete restrict
) engine = innodb comment 'Члены клуба';

-- оффициальные документы клуба
create table if not exists `mountaineeringclub_documents` (
	`artid` integer primary key,
	constraint `fk_mountaineeringclub_documents` foreign key (`artid`) references `article_body`(`artid`) on update cascade on delete cascade
) engine = innodb comment 'Документы на странице альпклуба';

insert into `article_theme` (`title`,`icon`) values ('Альпклуб "Пенза"','/images/club-icon.png');

-- Календарь мероприятий клуба
create table if not exists `mountaineeringclub_calendar` (
	`id` integer primary key auto_increment,
	`title` varchar(100) not null comment 'Наиманование мероприятия',
	`begin` datetime not null comment 'начало АМ',
	`finish` datetime default null comment 'окончание АМ',
	`localtion` varchar(100) not null comment 'место проведения',
	`latitude` float default null comment 'широта',
	`longitude` float default null comment 'долгота',
	`responsible_executor` integer not null comment 'ответственный исполнитель',
	`article` integer default null comment 'Указатель на связанную статью',
	key `fk_club_calendar_executor` (`responsible_executor`),
	key `fk_club_calendar_article` (`article`),
	constraint `fk_club_calendar_executor` foreign key (`responsible_executor`) references `site_user`(`uid`) on update cascade on delete restrict,
	constraint `fk_club_calendar_article` foreign key (`article`) references `article_body`(`artid`) on update cascade on delete set null
) engine = innodb comment 'Календарь мероприятий клуба';

insert into `article_theme` (`title`,`icon`) values ('Отчеты','/images/report-icon.png'),('Горы мира','/images/mountain-icon.png');