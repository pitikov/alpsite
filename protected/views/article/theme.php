<?php
/* @var $this ArticleController */
$this->layout='//layouts/column1';
$this->breadcrumbs=array(
	'Статьи'=>array('/article/themelist'),
	$arttheme
);
?>
<h1><?php
  echo (isset($parenttheme->title)?CHtml::link($parenttheme->title,array('/article/theme','themeid'=>$parenttheme->id)) . ' / ':'') . $arttheme;
?></h1>
<script type="text/javascript">
function getLabel()
{
  if (uname = prompt("Введите название темы", "")) {
    window.location.href = "/index.php/article/themeadd/?title="+uname+"&parent="+<?php echo $id;?>;
  }
}
</script>

<p>
<?php
  /// @todo В дальнейшем делать проверку на доступ пользователя к редактированию темы для создания субтемы
  if (!Yii::app()->user->isGuest || ($themelist->itemCount != 0)) {
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$themelist,
      'columns'=>array(
	array(
	  'name'=>'title',
	  'class'=>'ArticleThemeGridLink',
	  'header'=>'Тематика статей',
	  'footer'=>Yii::app()->user->isGuest?'':'<input type="image" src="/images/folder_add.png" onclick="getLabel()" value="Добавить тему">',
	),
	array(
	    'name'=>'id',
	    'class'=>'ArticleThemeDelete',
	    'header'=>'',
	    'htmlOptions'=>array(
	        'style'=>'width:32px;'
	    ),
	    'visible'=>!Yii::app()->user->isGuest,
	)
      ),
    ));
  }
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$articles,
      'columns'=>array(
	  array(
	      'name'=>'title',
	      'class'=>'ArticleGridLink',
	      'footer'=>Yii::app()->user->isGuest?'':CHtml::link('<img src=\'/images/folder_add.png\'/>', array('/article/post','theme'=>$id)),
	  ),array(
	      'name'=>'author0.name',
	      'header'=>'автор'
	  ),array(
	      'name'=>'timestamp',
	  ),array(
	      'name'=>'brief',
	      'header'=>'кратко',
	      'class'=>'ArticleBriefing',
	      'noImage'=>true,
	  ),
      ),
    ));
?>
</p>
