<?php
/** @var $this UserController */
$this->breadcrumbs=array(
	'Персоны'
);

$this->layout='/layouts/column1';
?>
<h1>Персоны</h1>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$provider,
	'columns'=>array(
	    array(
		'name'=>'name',
		'class'=>'DossierGridLink',
	    ),array(
		'name'=>'date_of_bethday',
		'header'=>'дата рождения',
	    ),
	    /*
	    array(
	        'header'=>'Ф',
	        'value'=>'1',
	    ), array(
	        'header'=>'К',
	        'value'=>'1',
	    ), array(
	        'header'=>'С',
	        'value'=>'1',
	    )
	    */
	),
    ));
?>
