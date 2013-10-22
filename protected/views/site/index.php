<?php
/** @var $this SiteController */

  $this->pageTitle=Yii::app()->name;
  $this->layout='//layouts/titlepage';
?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$ArticleList,
	'columns'=>array(
	    array(
	      'name'=>'brief',
	      'class'=>'ArticleBriefing',
	     // 'type'=>'html',
	    ),
	),
	'hideHeader'=>true,
	'emptyText'=>'Новых публикаций не найдено',
	'enablePagination'=>true,
	'pager'=>array(
	    'pageSize'=>10,
	)
    ));
?>
