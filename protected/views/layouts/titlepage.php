<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="titleContetnt">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="rightcollumn">
  <div id='spacer1'></div>
  <div id='federationActions'>
    <h3>Скоро</h3>
    <?php
      if (get_class($this->federationActions) == 'CActiveDataProvider') {
      $this->widget('zii.widgets.CListView', array(
	  'dataProvider'=>$fedrationActions,
	  'itemView'=>'_post',   // refers to the partial view named '_post'
	  'sortableAttributes'=>array(
	  'title',
	  'create_time'=>'Post Time',
	),
      ));
      } else {
	echo 'Нет запланированных АМ';
      }
    ?>
  </div>
  <div id='federationActions'>
  <h3>Тренировки</h3>
    <?php
      if (get_class($this->traningList) == 'CActiveDataProvider') {
      $this->widget('zii.widgets.CListView', array(
	  'dataProvider'=>$fedrationActions,
	  'itemView'=>'_post',   // refers to the partial view named '_post'
	  'sortableAttributes'=>array(
	  'title',
	  'create_time'=>'Post Time',
	),
      ));
      } else {
	echo 'Нет запланированных тренировок';
      }
    ?>  </div>
</div>
<?php $this->endContent(); ?>
