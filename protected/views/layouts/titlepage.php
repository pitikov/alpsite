<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="titleContetnt">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="rightcollumn">
  <div id='federationActions'>
    <h3>Скоро</h3>
    Здесь разместить анонс предстоящих АМ
  </div>
  <div id='federationActions'>
  <h3>Тренировки</h3>
  Лента предстоящих тренировок
  </div>
</div>
<?php $this->endContent(); ?>
