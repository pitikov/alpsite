<?php
    class ArticleThemeGridLink extends CDataColumn {

        protected function renderDataCellContent($row, $data)
        {
	  $icon = isset($data->icon)?$data->icon:'/images/folder.png';
        //    parent::renderDataCellContent($row, $data);
	    echo CHtml::link('<img src="'.$icon.'"/>'.$data->title, array('/article/theme','themeid'=>$data->id));
        }

    }

?>
