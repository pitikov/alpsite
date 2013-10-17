<?php
class MemberDossierGridLink extends CDataColumn {

    protected function renderDataCellContent($row, $data)
    {
      ?>
	<a href='<?php echo Yii::app()->createUrl('/user/information', array('persona'=>$data->dossier));?>'>
	  <div id='DossierListEntyy'>
	    <img src="<?php echo $data->dossier0->photo ?>" width="180" height="180" align="left"/>
	      <div id='short_dossier'>
		<h2><?php echo $data->dossier0->name?></h2>
		<?php
		  echo $data->role();
		  echo $data->dossier0->sport_range;
		  echo '<br/>';
		  if (isset($data->dossier0->mountain_resque)) {
		    echo 'Жетон спасателя № '.$data->dossier0->mountain_resque;
		    echo '<br/>';
		  }
		  if ($data->dossier0->mountain_guide != 'не имеет') {
		    echo 'Инструктор '.$data->dossier0->mountain_guide;
		    echo '<br/>';
		  }
		?>
	      </div>
	  </div>
	</a>
      <?php
    }

}


?>
