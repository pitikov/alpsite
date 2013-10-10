<?php

class ArticleFolderGridLink extends CDataColumn {

    protected function renderDataCellContent($row, $data)
    {
        if (isset($data->theme0->id)) {
	    echo CHtml::link($data->theme0->title, array('/article/theme','themeid'=>$data->theme0->id));
        } else {
	    parent::renderDataCellContent($row, $data);
        }
    }
}

?>
