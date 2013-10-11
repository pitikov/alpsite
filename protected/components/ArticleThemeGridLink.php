<?php
    class ArticleThemeGridLink extends CDataColumn {

        protected function renderDataCellContent($row, $data)
        {
        //    parent::renderDataCellContent($row, $data);
	    echo CHtml::link('<img src="'.$data->icon.'"/>'.$data->title, array('/article/theme','themeid'=>$data->id));
        }

    }

?>
