<?php
    class ArticleThemeDelete extends CDataColumn {

        protected function renderDataCellContent($row, $data)
        {
	    echo CHtml::link('<img src="/images/folder_del.png"/>', array('/article/themedel','themeid'=>$data->id));
        }

    }

?>
