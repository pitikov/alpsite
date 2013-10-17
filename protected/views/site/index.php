<?php
/** @var $this SiteController */

  $this->pageTitle=Yii::app()->name;
  $this->layout='//layouts/titlepage';
?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>

<h2>Что новенького</h2>

<?php
      $this->widget('zii.widgets.CListView', array(
	  'dataProvider'=>$ArticleList,
	  'itemView'=>'brief',
	  'sortableAttributes'=>array(
	    'timestamp',
	  ),
      ));
?>
