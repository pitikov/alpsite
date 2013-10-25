<?php /** @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<div id="socialuttons">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like" data-href="http://alpsite58.ru" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="box_count" data-action="like" data-show-faces="true" data-send="false"></div>
</div>
<?php $this->endContent(); ?>