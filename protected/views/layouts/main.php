<?php /* @var $this Controller */ ?>
<?php /*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::app()->user->name, 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
*/?>
<!DOCTYPE html>
<html lang="ru" xml:lang="ru">
    <head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="ru" />
	<meta name="author" content="Ezersky Boris" />

	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<meta name="robots" content="index,follow" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="cache-control" content="no-cache">
	
	<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" size="16x16"/>
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/alpsite.css" media="screen, projection" />

<style media="handheld">
</style>

<style media="print">
</style>

<script type="text/javascript">
<!--	
-->
</script>

</head>
<body>
	<header>
		<div id="logo"></div>
		<nav id="navigation" role="navigation">
		    <?php
			echo CHtml::link('федерация',$this->createUrl('/federation'));
			echo CHtml::link('клуб',$this->createUrl('/mountaineeringclub'));
			echo CHtml::link('события',$this->createUrl('/events'));
			echo CHtml::link('отчёты',$this->createUrl('/reports'));
			echo CHtml::link('горы мира',$this->createUrl('/mountains'));
		    ?>
		</nav>
	</header>

	<aside>
		<nav role="toolbar search">
		</nav>
	</aside>
	
	<section id="main-section" role="main">
	    <?php 
		// тут собственно происходит вставка содержимого
		echo $content; 
	    ?>
	</section>

	<footer role="contentinfo">
		<address>
		</address>
	</footer>

</body>
</html>
