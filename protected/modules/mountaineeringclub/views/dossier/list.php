<?php
/* @var $this DossierController */

$this->breadcrumbs=array(
	'Члены клуба'=>array('/mountaineeringclub/dossier'),
	'Список',
);
?>
<h1>Члены клуба</h1>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$clubMembers,
	'columns'=>array(
	    array(
		'name'=>'name',
		'class'=>'MemberDossierGridLink',
	    ),
	),
	'hideHeader'=>true
    ));
?>