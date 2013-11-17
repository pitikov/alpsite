<?php

/**
 * This is the model class for table "lib_climbing_list".
 *
 * The followings are the available columns in table 'lib_climbing_list':
 * @property integer $id
 * @property integer $member
 * @property string $date
 * @property string $peak
 * @property string $route
 * @property string $difficulty
 * @property string $ingroup
 * @property integer $report
 *
 * The followings are the available model relations:
 * @property LibUserDossier $member0
 * @property ArticleBody $report0
 */
class LibClimbingList extends CActiveRecord
{
    
    public $dateEdit;

    /**
     * @return string the associated database table name */
    public function tableName()
    {
        return 'lib_climbing_list';
    }
    
    /** @return array validation rules for model attributes. */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('member, date, peak, route, ingroup', 'required'),
            array('member, report', 'numerical', 'integerOnly'=>true),
            array('peak, route, ingroup', 'length', 'max'=>64),
            array('difficulty', 'length', 'max'=>3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, member, date, peak, route, difficulty, ingroup, report', 'safe', 'on'=>'search'),
        );
    }
    
    /** @return array relational rules. */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'member0' => array(self::BELONGS_TO, 'LibUserDossier', 'member'),
            'report0' => array(self::BELONGS_TO, 'ArticleBody', 'report'),
        );
    }
    
    /** @return array customized attribute labels (name=>label) */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'member' => 'участник',
            'date' => 'дата',
            'peak' => 'на вершину',
            'route' => 'по маршруту',
            'difficulty' => 'категории сложности',
            'ingroup' => 'в составе группы',
            'report' => 'указатель на отчет',
        );
    }
    
    /** Retrieves a list of models based on the current search/filter conditions.
     * 
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     *   models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     * 
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.	 */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('member',$this->member);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('peak',$this->peak,true);
        $criteria->compare('route',$this->route,true);
        $criteria->compare('difficulty',$this->difficulty,true);
        $criteria->compare('ingroup',$this->ingroup,true);
        $criteria->compare('report',$this->report);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LibClimbingList the static model class */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
