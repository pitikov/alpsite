<?php
/* @var $this ArticleBodyController */
/* @var $model ArticleBody */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-body-post-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	    <?php
		if ($subthemeSelectEnable) {
		    echo $form->labelEx($model,'theme');
		    echo $form->textField($model,'theme');
		    echo $form->error($model,'theme');
		}
	    ?>
	</div>

	<div class="row">
	    <?php
	      if ($titleEdit==true) {
		echo $form->labelEx($model,'title');
		echo $form->textField($model,'title');
		echo $form->error($model,'title');
	      } else {
		echo '<h1>'.$model->title.'</h1>';
	      }
	    ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'body'); ?>
		<?php
		    $this->widget('ImperaviRedactorWidget', array(
			// You can either use it for model attribute
			'model' => $model,
			'attribute' => 'body',

			// or just for input field
			'name' => 'message_body',

			// Some options, see http://imperavi.com/redactor/docs/
			'options' => array(
			    'lang' => 'ru',
			    'toolbar' => true,
			    'iframe' => false,
			    'css' => 'wym.css',
			),
		    ));
		?>
		<?php echo $form->error($model,'body'); ?>
	</div>
<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'md5body'); ?>
		<?php echo $form->textField($model,'md5body'); ?>
		<?php echo $form->error($model,'md5body'); ?>
	</div>
?>
	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords'); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'brief');
		    $this->widget('ImperaviRedactorWidget', array(
			// You can either use it for model attribute
			'model' => $model,
			'attribute' => 'brief',

			// or just for input field
			'name' => 'message_body',

			// Some options, see http://imperavi.com/redactor/docs/
			'options' => array(
			    'lang' => 'ru',
			    'toolbar' => true,
			    'iframe' => true,
			    'css' => 'wym.css',
			),
		    ));
		    echo $form->error($model,'brief'); */?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
