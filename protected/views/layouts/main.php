<!DOCTYPE html>
<html lang="ru" xml:lang="ru">

<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="ru" />
<meta name="author" content="Ezersky Boris" />
<meta name="author" content="Pitikov Evgeniy" />

<meta name="keywords" content="" />
<meta name="description" content="" />

<meta name="robots" content="index,follow" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="cache-control" content="no-cache">

<link rel="Shortcut Icon" type="image/x-icon" href="/images/mountain-icon.png" size="16x16"/>

<?php
  Yii::app()->getClientScript()->registerCoreScript('jquery');
  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/javascript/client.menu.js');
  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/javascript/client.article.js');
  Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/screen.css', 'screen');

?>

<style media="handheld">
</style>

<style media="print">
</style>

</head>
<body>
  <menuheader>
    <nav id="main-navigation" role="navigation">
      <div id="logo">
	<a href="<?php echo $this->createUrl('/'); ?>" title="на главную"><img src="/images/logo.png" alt="Logo" /></a>
      </div>
      <div class="menu-transform">
	<div class="sub-menu">
	  <a href="<?php echo $this->createUrl('/federation/official/rules');?>">Устав</a>
	  <a href="<?php echo $this->createUrl('/federation/official/details');?>">Реквизиты</a>
	  <a href="<?php echo $this->createUrl('/federation/dossier/list');?>">Члены федерации</a>
	  <a href="<?php echo $this->createUrl('/federation/plan/calendar');?>">План работы и развития</a>
	</div>
	<a class="main-item" href='<?php echo $this->createUrl('/federation');?>'><img class="icon" src="/images/help-icon.png" /><span>федерация<span></a>
      </div>
      <div class="menu-transform">
	<div class="sub-menu">
	  <a href="<?php echo $this->createUrl('/mountaineeringclub/official/history');?>">История клуба</a>
	  <a href="<?php echo $this->createUrl('/mountaineeringclub/dossier/list');?>">Члены клуба</a>
	  <a href="<?php echo $this->createUrl('/mountaineeringclub/calendar/index');?>">Расписание занятий</a>
	</div>
	<a class="main-item" href="<?php echo $this->createUrl('/mountaineeringclub');?>"><img class="icon" src="/images/club-icon.png" /><span>клуб<span></a>
      </div>
      <a class="main-item" href="<?php echo $this->createUrl('/events');?>"><img class="icon" src="/images/calendar-icon.png" /><span>события<span></a>
      <?php if (!Yii::app()->user->isGuest) { ?>
      <div class="menu-transform">
	<div class="sub-menu">
	  <a href="<?php echo $this->createUrl('/reports/index');?>">Просмотр</a>
	  <a href="<?php echo $this->createUrl('/reports/post');?>">Публиковать</a>
	</div>
	<?php } ?>
	<a class="main-item" href="<?php echo $this->createUrl('/reports/index');?>"><img class="icon" src="/images/report-icon.png" /><span>отчёты<span></a>
	<?php if (!Yii::app()->user->isGuest) { ?>
      </div>
      <div class="menu-transform">
	<div class="sub-menu">
	  <a href="<?php echo $this->createUrl('/mountains/index');?>">Просмотр</a>
	  <a href="<?php echo $this->createUrl('/mountains/post');?>">Публиковать</a>
	</div>
	<?php } ?>
	<a class="main-item" href="<?php echo $this->createUrl('/mountains');?>"><img class="icon" src="/images/mountain-icon.png" /><span>горы мира<span></a>
	<?php if (!Yii::app()->user->isGuest) { ?>
      </div>
      <?php } ?>
      <div id="copyright">&copy; One-two-three & etc…</div>
    </nav>
    </menuheader>
  <aside>
    <nav id="toolbar" role="toolbar search">
      <a id="login" href='<?php echo $this->createUrl('/user');?>'><img class="icon" src="/images/user-icon.png" /><span><?php echo Yii::app()->user->isGuest?'login':Yii::app()->user->name;?></span></a>
      <a id="search"><img class="icon" src="/images/search-icon.png" /><span><input id="search-field" name="search-field" type="text" size="40" /></span></a>
      <a id="help" href="<?php echo $this->createUrl('/site/page',array('view'=>'help'));?>"><img class="icon" src="/images/help-icon.png" /><span>help</span></a>
    </nav>
  </aside>
  <section id="main-section" role="main">
  <div class="main-content">
    <?php echo $content; ?>
  </div>
  <div class="clear"/>
    <!-- А futter как генерится -->
    <footer role="contentinfo">
      <address>1-2-3-4-5…  rabbit go to the walk….</address>
    </footer>
  </section>
</body>
</html>
