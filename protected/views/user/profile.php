<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Пользователь'=>array('/user'),
	Yii::app()->user->name,
);
?>
<h1><?php echo Yii::app()->user->name;?></h1>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Профиль пользователя')); ?>
<h2>Профиль пользователя</h2>
<?php
echo 'User type: '.Yii::app()->user->identType();
echo '<br/>';
echo 'User UID : '.Yii::app()->user->uid();
echo '<br/>';
echo 'User ID : '.Yii::app()->user->id;
echo '<br/>';
echo 'User name : '.Yii::app()->user->name;
?>
<?php $this->endWidget(); ?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Досье')); ?>
<div class="warning">
<h4>ВНИМАНИЕ</h4>
<p>Все публикуемые здесь данные доступны к просмотру как другими пользователми так и гостями сайта, однако именно заполнение досье дает некоторые бонусы на сайте.</p>
<p>При обнаружении публикации заведомо ложных данных досье будет удаленно, а аккаунт заблокирован.</p>
</div>
 <?php
/* @var $this LibUserDossierController */
/* @var $dossier LibUserDossier */
/* @var $form CActiveForm */
$rangeList = array(
                'не имеет'=>'не присваивался',
                '3-й разряд'=>'3-й разряд',
                '2-й разряд'=>'2-й разряд',
                '1-й разряд'=>'1-й разряд',
                'кандидат в мастера спорта'=>'КМС',
                'мастер спорта'=>'МС',
                'заслуженный мастер спорта'=>'ЗМС'
            );
$guideList = array(
    'не имеет'=>'не имею','стажер'=>'стажер','III категория'=>'III категория','II категория'=>'II категория','I категория'=>'I категория'
);         
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'lib-user-dossier-federation-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

    <?php echo $form->errorSummary($dossier); ?>

    <div class="row">
        <?php echo $form->labelEx($dossier,'name'); ?>
        <?php echo $form->textField($dossier,'name'); ?>
        <?php echo $form->error($dossier,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($dossier,'mountain_resque'); ?>
        <?php echo $form->textField($dossier,'mountain_resque'); ?>
        <?php echo $form->error($dossier,'mountain_resque'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($dossier,'photo'); ?>
        <?php echo $form->textField($dossier,'photo'); ?>
        <?php echo $form->error($dossier,'photo'); ?>
    </div>

    <div class="row">
        <?php 
            
            echo $form->labelEx($dossier,'sport_range');
            echo $form->dropDownList($dossier,'sport_range',$rangeList);
            echo $form->error($dossier,'sport_range'); 
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($dossier,'mountain_guide'); ?>
        <?php echo $form->dropDownList($dossier,'mountain_guide', $guideList); ?>
        <?php echo $form->error($dossier,'mountain_guide'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($dossier,'date_of_bethday'); ?>
        <?php 
            echo $form->textField($dossier,'date_of_bethday'); 
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'date_of_bethday',
                'model'=>$dossier,
                'attribute'=>'dob',
                
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    
                ),
                'language'=>'ru',
                'htmlOptions'=>array(
                    'style'=>'height:20px;'
                ),
            ));
        ?>
        <?php echo $form->error($dossier,'date_of_bethday'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($dossier,'about'); ?>
        <?php echo $form->textArea($dossier,'about'); ?>
        <?php echo $form->error($dossier,'about'); ?>
    </div>


    <div class="row buttons">
    <?php 
        echo CHtml::submitButton($dossier->isNewRecord?'Создать':'Изменить');
        if (!$dossier->isNewRecord) {
    ?>
      <input type='button' value='Удалить' on='confirm(\'Удалить досье?\')'/>
    <?php } ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form --> 
<?php $this->endWidget(); ?>
<?php 
    // Список восхождений
    $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Восхождения'));
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$climbingList,
        'template'=>'{pager}{items}{summary}{pager}',
        'summaryText'=>'Восхождения {start}-{end} из {count}',
        'emptyText'=>'Вы не публиковали данные о восхождениях',
        'columns'=>array(
            array(
                'name'=>'id',
                'header'=>'№',
                'value'=>'$row+1',
            ),
            array(
                'name'=>'date',
                'value'=>'date_create_from_format(\'Y-m-d\', $data->date)->format(\'d.m.Y\')'
            ),
            array(
                'name'=>'peak',
                'class'=>'ClimbingListCollumn',
            ),
            'route',
            'difficulty',
            'ingroup',
            array(
                'name'=>'member',
                'header'=>'',
                'class'=>'ClimbingListCollumn',
            )
        ),
        'htmlOptions'=>array(
            // Здесь разместить HTML свойства
        )
    ));
    
    $this->endWidget(); 
    $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Публикации'));
    
        $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$articles,
        'template'=>'{pager}{items}{summary}{pager}',
        'summaryText'=>'Публикации {start}-{end} из {count}',
        'emptyText'=>'Вы не публиковали статей или отчетов',
        'columns'=>array(
            array(
                'name'=>'id',
                'header'=>'№',
                'value'=>'$row+1',
            ),
            array(
                'name'=>'brief',
                'class'=>'ArticleBriefing',
            ),
            array(
                'name'=>'timestamp',
                'value'=>'date_create_from_format(\'Y-m-d H:i:s\', $data->timestamp)->format(\'d.m.Y (H:i)\')'
            ),
        ),
        'htmlOptions'=>array(
            // Здесь разместить HTML свойства
        )
    ));
    
    echo CHtml::link('Опубликовать', $this->createUrl('/article/post',array('theme'=>3)));
    
    
    $this->endWidget(); ?>
    <?php  /** Здесь следует вставить проверку на наличие досье по еоторой разрешать следующие два виджета*/
    if (!$dossier->isNewRecord) {
    ?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Альп-Клуб "Пенза"')); ?>
<?php $this->endWidget(); ?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Федерация')); ?>
 <?php
/* @var $this FederationMemberController */
/* @var $federation FederationMember */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'federation-member-federation-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($federation); ?>

    <div class="row">
        <?php echo $form->labelEx($federation,'dossier'); ?>
        <?php echo $form->textField($federation,'dossier'); ?>
        <?php echo $form->error($federation,'dossier'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($federation,'member_from'); ?>
        <?php echo $form->textField($federation,'memberfrom'); ?>
        <?php echo $form->error($federation,'member_from'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($federation,'federation_role'); ?>
        <?php echo $form->textField($federation,'federation_role'); ?>
        <?php echo $form->error($federation,'federation_role'); ?>
    </div>

 
    <div class="row">
        <?php echo $form->labelEx($federation,'member_to'); ?>
        <?php echo $form->textField($federation,'memberto'); ?>
        <?php echo $form->error($federation,'member_to'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($federation,'special_service'); ?>
        <?php echo $form->textField($federation,'special_service'); ?>
        <?php echo $form->error($federation,'special_service'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($federation->isNewRecord?'Создать':'Сохранить изменения'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form --> 
<?php $this->endWidget(); ?>
<?php 
}
/** Окончане блока доступного только при наличии досье
*/
?>
<?php
$tabParameters = array();
foreach($this->clips as $key=>$clip)
    $tabParameters['tab'.(count($tabParameters)+1)] = array('title'=>$key, 'content'=>$clip);
?>
 
<?php $this->widget('system.web.widgets.CTabView', array('tabs'=>$tabParameters)); ?>




