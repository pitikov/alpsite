<?php
    /** Класс отображения брифинга публикаций на главной
     */
    class ArticleBriefing extends CDataColumn {
    public $noImage = false;

	protected function renderDataCellContent($row, $data)
	{
	  echo CHtml::link($this->noImage?strip_tags($data->brief,'<h1><h2><h3><h4>'):$data->brief, array('/article/view/', 'artid'=>$data->artid));
	}
    }

?>
