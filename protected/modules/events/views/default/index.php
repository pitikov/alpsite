<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>События</h1>

<?php 
    $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Календарь'));
    ?>
    <div style='display=inline-block; float=left;'>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'name'=>'inline_datepicker',
            'flat' => true, // tells the widget to show the calendar inline
            'language'=>'ru'
            )
        );
        ?>
        </div>
    <div style='display=inline-block; float=left;'>
        <?php
    ?>
    </div>
    <?php
    $this->endWidget(); ?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Список событий')); ?>
<?php $this->endWidget(); ?>
<?php
$tabParameters = array();
foreach($this->clips as $key=>$clip)
    $tabParameters['tab'.(count($tabParameters)+1)] = array('title'=>$key, 'content'=>$clip);
?>
 
<?php $this->widget('system.web.widgets.CTabView', array('tabs'=>$tabParameters)); ?>
