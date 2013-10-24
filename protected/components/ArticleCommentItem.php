<?php
class ArticleCommentItem extends CDataColumn {

  protected function renderDataCellContent($row, $data)
  {
    $comments = new CArrayDataProvider($data->articleComments, array(
    ));
    echo $data->body.'<br/>';
    if (!Yii::app()->user->isGuest) { ?>
      <input type="submit" value="Комментировать" onclick="PostComment(<?php echo $data->id;?>);"/>
      <?php } // !isGuest ?>
      <?php if ((Yii::app()->user->uid() == $data->uid) && (count($data->articleComments) == 0)) { ?>
	<input type="submit" value="Удалить" onclick="DeleteComment(<?php echo $data->id;?>);"/>
      <?php } ?>
      <div class ="article_comment" id="author">
      <?php echo $data->u->name; ?>
      </div>
      <div class ="article_comment" id="timestamp">
      <?php
      $date = date_create_from_format('Y-m-d H:i:s', $data->timestamp);
      echo $date->format('d.m.Y (H:i)');
      ?>
      </div>
      <?php
      if ($comments->getItemCount() > 0 )
	$this->grid->widget('zii.widgets.grid.CGridView', array(
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
	'enablePagination'=>false,
	));
     ?>
     <a href name="c<?php echo $data->id; ?>"/>
     <?php
  }

}

?>
