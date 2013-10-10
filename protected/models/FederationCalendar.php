<?php

/**
 * This is the model class for table "federation_calendar".
 *
 * The followings are the available columns in table 'federation_calendar':
 * @property integer $id
 * @property string $title
 * @property string $begin
 * @property string $finish
 * @property string $localtion
 * @property double $latitude
 * @property double $longitude
 * @property string $organisation
 * @property string $responsible_executor
 *
 * The followings are the available model relations:
 * @property FederationCalendarArticle[] $federationCalendarArticles
 */
class FederationCalendar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FederationCalendar the static model class
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
		return 'federation_calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, begin, finish, localtion, organisation, responsible_executor', 'required'),
			array('latitude, longitude', 'numerical'),
			array('title, localtion, organisation', 'length', 'max'=>100),
			array('responsible_executor', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, begin, finish, localtion, latitude, longitude, organisation, responsible_executor', 'safe', 'on'=>'search'),
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
			'federationCalendarArticles' => array(self::HAS_MANY, 'FederationCalendarArticle', 'event'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'begin' => 'Begin',
			'finish' => 'Finish',
			'localtion' => 'Localtion',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'organisation' => 'Organisation',
			'responsible_executor' => 'Responsible Executor',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('begin',$this->begin,true);
		$criteria->compare('finish',$this->finish,true);
		$criteria->compare('localtion',$this->localtion,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('organisation',$this->organisation,true);
		$criteria->compare('responsible_executor',$this->responsible_executor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}