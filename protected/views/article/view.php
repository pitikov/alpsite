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

    function PostComment(cid)
    {
        /// @todo Облагородить форму ввода комментария
        var text = prompt('Что Вы думаете по этому поводу?','');
        if (text) {
            window.location.href = "<?php echo $this->createUrl('/article/comment', array('artid'=>$article->artid,'cid'=>''));?>"+cid+"&text="+text;
	}
    }

    function DeleteComment(cid) {
      if (confirm('Удалить комментарий?'))
	window.location.href = "/index.php/article/deleteComment?artid=<?php echo $article->artid;?>&cid="+cid+"&pcid="+0;
    }
</script>
<?php
/** @var $this ArticleController */

$this->breadcrumbs=array(
	'Статьи'=>array('/article'),
	$article->theme0->title=>array('/article/theme','themeid'=>$article->theme0->id),
	$article->title,
);
?>
<h3><?php
    $parentdir = isset($article->theme0->parent)?CHtml::link($article->theme0->parent0->title,array('/article/theme','themeid'=>$article->theme0->parent))." / ":NULL;
    echo $parentdir . CHtml::link($article->theme0->title, array('/article/theme','themeid'=>$article->theme));
?></h3>
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
<?php } // $article->author == Yii::app()->user->uid()
if (!Yii::app()->user->isGuest) { ?>
<input type="submit" value="Комментировать" onclick="PostComment(0);"/>
<?php } // !isGuest ?>
<?php
    if ($comments->getItemCount() > 0 )
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$comments,
	'columns'=>array(
	    array(
	      'name'=>'body',
	      'class'=>'ArticleCommentItem',
	     // 'type'=>'html',
	    ),
	),
	'hideHeader'=>true,
	'emptyText'=>'no comments',
	'enablePagination'=>true,
	'pager'=>array(
	    'pageSize'=>25,
	)
    ));
?>
<a name="c0"/>

