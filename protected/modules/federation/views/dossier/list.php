<?php
/** @var $this DossierController */

$this->breadcrumbs=array(
	'Члены федерации'=>array('/federation/dossier'),
	'Список',
);
?>
<h1>Члены федерации</h1>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$federationMembers,
	'columns'=>array(
	    array(
		'name'=>'name',
		'class'=>'MemberDossierGridLink',
	    ),
	),
	'hideHeader'=>true
    ));
?>