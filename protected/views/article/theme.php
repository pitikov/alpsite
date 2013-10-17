<?php
/* @var $this ArticleController */
$this->layout='//layouts/column1';
$this->breadcrumbs=array(
	'Статьи'=>array('/article/themelist'),
	$arttheme
);
?>
<h1><?php echo $arttheme; ?></h1>
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

  ///if ($themelist->itemCount > 0) {
    $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$themelist,
      'columns'=>array(
	array(
	  'name'=>'title',
	  'class'=>'ArticleThemeGridLink',
	  'header'=>'Тематика статей',
	  'footer'=>'<input type="image" src="/images/folder_add.png" onclick="getLabel()" value="Добавить тему">'
	),
	array(
	    'name'=>'id',
	    'class'=>'ArticleThemeDelete',
	    'header'=>'',
	    'htmlOptions'=>array(
	        'style'=>'width:32px;'
	    )
	)
      ),
    ));
  /*}
  /*?>
  <input type="image" src="/images/folder_add.png" onclick="getLabel()" value="Добавить тему">
  <?php*/
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
