<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Авторизация';
$this->breadcrumbs=array(
	'Авторизация',
);
?>

<h1>Авторизация пользователя</h1>

<p>Пожалуйста введите учетные данные:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
		    Подсказка: Вы можите использовать <kbd>demo</kbd>/<kbd>demo</kbd> или <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Авторизироваться'); ?>
	</div>
	<div>Или воспользуйтесь формой <?php echo CHtml::link('регистрации пользователя', array('/user/registration')); ?>.</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
    if (Yii::app()->user->hasFlash('error')) {
        echo '<div class="error">'.Yii::app()->user->getFlash('error').'</div>';
    }
?>
<h2>Если вы уже имеете регистрацию на нижеуказанных ресурсах, вы можете использовать ее:</h2>
<?php
    $this->widget('ext.eauth.EAuthWidget', array('action' => '/user/login'));
?>
