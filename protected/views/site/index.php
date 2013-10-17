<?php
/** @var $this SiteController */

  $this->pageTitle=Yii::app()->name;
  $this->layout='//layouts/titlepage';
?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>

<h2>Что новенького</h2>
Где-то тут будут размещены бирифинги последних статей,<br/>
с картинками, с переходом по клику.
