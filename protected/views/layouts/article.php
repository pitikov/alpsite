<?php /** @var $this Controller */ ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<div id="socialuttons">
    <div id="fb-root"></div>
</div>
<?php $this->endContent(); ?>