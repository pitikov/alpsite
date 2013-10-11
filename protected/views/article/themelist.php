<?php
/* @var $this ArticleController */
$this->layout='//layouts/column1';

$this->breadcrumbs=array(
	'Статьи'=>array('/article/themelist'),
);
?>
<h1>Список тем</h1>

<?php
/// @TODO Преобразовать модель данных к виду дерево. Для отображения использовать дерево
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$themelist,
      'columns'=>array(
	array(
	  'name'=>'title',
	  'class'=>'ArticleThemeGridLink',
	  'header'=>'Тематика статей'
	),
      ),
  ));
?>
