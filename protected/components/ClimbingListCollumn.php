<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClimbingListCollumn
 *
 * @author evgeniy
 */
class ClimbingListCollumn extends CDataColumn {
    //put your code here
    protected function renderDataCellContent($row, LibClimbingList $data) {
        if (($this->name === 'peak') && !is_null($data->report)) {
            echo CHtml::link($data->peak, Yii::app()->createUrl('/article/view', array('artid'=>$data->report)));
        } else if ($this->name === 'member') {
            echo CHtml::link('<image src=\'/images/listEdit\' title=\'Редактировать\' alt=\'e\'/>', Yii::app()->createUrl('/user/climbingEdit', array('id'=>$data->id, 'uid'=>Yii::app()->user->uid())));
            echo CHtml::link('<image src=\'/images/listDelete\' title=\'Удалить\' alt=\'x\'/>', Yii::app()->createUrl('/user/climbingDelete', array('id'=>$data->id)), array('confirm'=>'confirm("Удалить данные восхождения?")'));
        } else parent::renderDataCellContent($row, $data);
    }
}
