<?php
/* @var $this ArticleController */
$this->layout='//layouts/column1';
$this->breadcrumbs=array(
	'Статьи'=>array('/article/themelist'),
	$arttheme
);
?>
<h1><?php echo $arttheme; ?></h1>

<p>
<?php
  $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$articles,
      'columns'=>array(
	  array(
	      'name'=>'title',
	      'class'=>'ArticleGridLink',
	  ),array(
	      'name'=>'author0.name',
	      'header'=>'автор'
	  ),array(
	      'name'=>'timestamp',
	  ),array(
	      'name'=>'brief',
	      'header'=>'кратко'
	  ),
      ),
  ));
?>
</p>
