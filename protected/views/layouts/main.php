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

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />

<script src="javascript/jquery.min.js" type="text/javascript"></script>


<style media="handheld">
</style>

<style media="print">
</style>

<script type="text/javascript">
<!--
$(document).ready(function() {
  $('#toolbar a').on('mouseenter', function() {
    //		$(this).find('input').stop();
    if ($(this).find('span').css('display') == 'none') $(this).find('span').show('fast');

  });

  $('#toolbar').on('mouseleave', function() {
    $('#toolbar a span').stop().hide('fast');
  });

  $('nav#main-navigation .menu-transform').on('mouseenter', function() {
    $(this).find('.sub-menu').css('margin-left', '0px');
    $('header a span').stop().hide(100);
    $('header #logo').stop().animate({'width': '90%', 'margin-left': '-45%'}, 100);
    $('nav#main-navigation').stop().animate({'width' : '70'}, 100);
  });

  $('nav#main-navigation .menu-transform').on('mouseleave', function() {
    $(this).find('.sub-menu').css('margin-left', '-9999px');
    $('header #logo').stop().animate({'width': '70%', 'margin-left': '-35%'}, 50);
    $('nav#main-navigation').stop().animate({'width' : '230'}, 50, function() { $('header a span').stop().show(100); });
  });

});
-->
</script>

</head>
<body>
  <header>
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
  </header>
  <aside>
    <nav id="toolbar" role="toolbar search">
      <a id="login" href='<?php echo $this->createUrl('/user');?>'><img class="icon" src="/images/user-icon.png" /><span><?php echo Yii::app()->user->isGuest?'login':Yii::app()->user->name;?></span></a>
      <a id="search"><img class="icon" src="/images/search-icon.png" /><span><input id="search-field" name="search-field" type="text" size="40" /></span></a>
      <a id="help" href="<?php echo $this->createUrl('/site/page',array('view'=>'help'));?>"><img class="icon" src="/images/help-icon.png" /><span>help</span></a>
    </nav>
  </aside>
  <section id="main-section" role="main">
    <?php echo $content; ?>
    <!-- А futter как генерится -->
    <footer role="contentinfo">
      <address>1-2-3-4-5…  rabbit go to the walk….</address>
    </footer>
  </section>
</body>
</html>
