<?php
class MemberDossierGridLink extends CDataColumn {
    
    protected function renderDataCellContent($row, $data)
    {
	    echo CHtml::link('<img src="'.$data->dossier0->photo.'"/>'.$data->dossier0->name, array('/user/information', 'persona'=>$data->dossier));
    }
    
}


?>