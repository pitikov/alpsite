<?php
/* @var $this LibClimbingListController */
/* @var $model LibClimbingList */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lib-climbing-list-climbingAdd-form',
	'enableAjaxValidation'=>true,
)); ?>
    <h1>Данные о восхождении</h1>
	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tr>
                <td><?php echo $form->labelEx($model,'date'); ?></td>
                <td><?php echo $form->textField($model,'date'); ?></td>
            </tr><tr>
                <td></td>
                <td><?php echo $form->error($model,'date'); ?></td>
            </tr><tr>
                <td><?php echo $form->labelEx($model,'peak'); ?></td>
                <td><?php echo $form->textField($model,'peak'); ?></td>
            </tr><tr>
                <td></td>
                <td><?php echo $form->error($model,'peak'); ?></td>
            </tr><tr>
                <td><?php echo $form->labelEx($model,'route'); ?></td>
                <td><?php echo $form->textField($model,'route'); ?></td>
            </tr><tr>
                <td></td>
                <td><?php echo $form->error($model,'route'); ?></td>
            </tr><tr>
                <td><?php echo $form->labelEx($model,'difficulty'); ?></td>
                <td><?php echo $form->dropDownList($model,'difficulty', array(
                    '1Б'=>'1Б','2А'=>'2А','2Б'=>'2Б','3А'=>'3А','3Б'=>'3Б','4А'=>'4А','4Б'=>'4Б','5А'=>'5А','5Б'=>'5Б','6А'=>'6А','6Б'=>'6Б'
                )); ?></td>
            </tr><tr>
                <td></td>
                <td><?php echo $form->error($model,'difficulty'); ?></td>
            </tr><tr>
                <td><?php echo $form->labelEx($model,'ingroup'); ?></td>
                <td><?php echo $form->textField($model,'ingroup'); ?></td>
            </tr><tr>
                <td></td>
                <td><?php echo $form->error($model,'ingroup'); ?></td>
            </tr>
            <?php if (count($reports) > 1) { ?>
            <tr>
                <td><?php echo $form->labelEx($model,'report'); ?></td>
                <td><?php echo $form->listBox($model,'report', $reports); ?></td>
            </tr><tr>
                <td></td>
                <td><?php echo $form->error($model,'report'); ?></td>
            </tr>
            <?php } ?>
        </table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord?'Сохранить':'Изменить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->