<script type="text/javascript">
    function ArticleDelete() {
        if (confirm('Удалить статью ?')) {
            window.location.href = "/index.php/article/delete/?artid="+<?php echo $article->artid;?>;
        }
    }
    function ArticleEdit()
    {
        window.location.href = "/index.php/article/edit/?artid="+<?php echo $article->artid;?>;
    }
</script>
<?php
/* @var $this ArticleController */

$this->breadcrumbs=array(
	'Статьи'=>array('/article'),
	$article->theme0->title=>array('/article/theme','themeid'=>$article->theme0->id),
	$article->title,
);
?>
<h1><?php echo $article->title; ?></h1>

<div class ="article" id="body">
	<?php echo $article->body;?>
</div>
<div class ="article" id="author">
    <?php echo $article->author0->name; ?>
</div>
<div class ="article" id="timestamp">
    <?php 
        $date = date_create_from_format('Y-m-d H:i:s', $article->timestamp);
        echo $date->format('d.m.Y (H:i)');
    ?>
</div>
<?php if ($article->author == Yii::app()->user->uid()) { ?>
<input type="submit" value="Удалить" onclick="ArticleDelete();"/>
<input type="submit" value="Редактировать" onclick="ArticleEdit();"/>
<?php } ?>

