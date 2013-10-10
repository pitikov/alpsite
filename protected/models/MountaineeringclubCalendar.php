<?php

/**
 * This is the model class for table "mountaineeringclub_calendar".
 *
 * The followings are the available columns in table 'mountaineeringclub_calendar':
 * @property integer $id
 * @property string $title
 * @property string $begin
 * @property string $finish
 * @property string $localtion
 * @property double $latitude
 * @property double $longitude
 * @property integer $responsible_executor
 * @property integer $article
 *
 * The followings are the available model relations:
 * @property ArticleBody $article0
 * @property SiteUser $responsibleExecutor
 */
class MountaineeringclubCalendar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MountaineeringclubCalendar the static model class
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
		return 'mountaineeringclub_calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, begin, localtion, responsible_executor', 'required'),
			array('responsible_executor, article', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('title, localtion', 'length', 'max'=>100),
			array('finish', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, begin, finish, localtion, latitude, longitude, responsible_executor, article', 'safe', 'on'=>'search'),
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
			'article0' => array(self::BELONGS_TO, 'ArticleBody', 'article'),
			'responsibleExecutor' => array(self::BELONGS_TO, 'SiteUser', 'responsible_executor'),
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
			'responsible_executor' => 'Responsible Executor',
			'article' => 'Article',
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
		$criteria->compare('responsible_executor',$this->responsible_executor);
		$criteria->compare('article',$this->article);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}