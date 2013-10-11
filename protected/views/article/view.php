<?php
/* @var $this ArticleController */

$this->breadcrumbs=array(
	'Статьи'=>array('/article'),
	$article->theme0->title=>array('/article/theme','themeid'=>$article->theme0->id),
	$article->title,
);
?>
<h1><?php echo $article->title; ?></h1>

<div id="article">
	<?php echo $article->body;?>
</div>
