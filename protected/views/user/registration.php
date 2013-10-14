<?php
/* @var $this SiteUserController */
/* @var $model SiteUser */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    'Пользователь'=>array('/user'),
    'Регистрация'
);
?>
<h1>Регистрация пользователя</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-user-registration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login'); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail'); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pwdrestorequest'); ?>
		<?php echo $form->textField($model,'pwdrestorequest'); ?>
		<?php echo $form->error($model,'pwdrestorequest'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hash'); ?>
		<?php echo $form->textField($model,'hash'); ?>
		<?php echo $form->error($model,'hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requesthash'); ?>
		<?php echo $form->textField($model,'requesthash'); ?>
		<?php echo $form->error($model,'requesthash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accessrules'); ?>
		<?php echo $form->textField($model,'accessrules'); ?>
		<?php echo $form->error($model,'accessrules'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->