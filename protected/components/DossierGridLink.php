<?php
    class DossierGridLink extends CDataColumn {

        protected function renderDataCellContent($row, $data)
        {
	    echo CHtml::link('<img src="'.$data->photo.'"/>'.$data->name, array('/user/information', 'persona'=>$data->id));

        }
    }

?>
