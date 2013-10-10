<?php
class ArticleGridLink extends CDataColumn {


    protected function renderDataCellContent($row, $data)
    {
	if (isset($data->title)) echo CHtml::link($data->title, array('/article/view', 'artid'=>$data->artid));
    }
}

?>
