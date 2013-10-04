<?php

/**
 * This is the model class for table "site_pwdrequest".
 *
 * The followings are the available columns in table 'site_pwdrequest':
 * @property integer $uid
 * @property string $rndsuffix
 *
 * The followings are the available model relations:
 * @property SiteUser $u
 */
class SitePwdrequest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SitePwdrequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_pwdrequest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, rndsuffix', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('rndsuffix', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, rndsuffix', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'u' => array(self::BELONGS_TO, 'SiteUser', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'rndsuffix' => 'Rndsuffix',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid);
		$criteria->compare('rndsuffix',$this->rndsuffix,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}