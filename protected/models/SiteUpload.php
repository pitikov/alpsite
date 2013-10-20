<?php

/**
 * This is the model class for table "site_upload".
 *
 * The followings are the available columns in table 'site_upload':
 * @property integer $id
 * @property string $serverpath
 * @property string $mimetype
 * @property string $icon
 * @property string $description
 * @property integer $owner
 *
 * The followings are the available model relations:
 * @property SiteUser $owner0
 */
class SiteUpload extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteUpload the static model class
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
		return 'site_upload';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serverpath, mimetype, icon, owner', 'required'),
			array('owner', 'numerical', 'integerOnly'=>true),
			array('serverpath, mimetype', 'length', 'max'=>128),
			array('icon, description', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, serverpath, mimetype, icon, description, owner', 'safe', 'on'=>'search'),
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
			'owner0' => array(self::BELONGS_TO, 'SiteUser', 'owner'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'serverpath' => 'Serverpath',
			'mimetype' => 'Mimetype',
			'icon' => 'Icon',
			'description' => 'Description',
			'owner' => 'Owner',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('serverpath',$this->serverpath,true);
		$criteria->compare('mimetype',$this->mimetype,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('owner',$this->owner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}