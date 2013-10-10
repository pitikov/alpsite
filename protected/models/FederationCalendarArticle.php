<?php

/**
 * This is the model class for table "federation_calendar_article".
 *
 * The followings are the available columns in table 'federation_calendar_article':
 * @property integer $id
 * @property integer $event
 * @property integer $article
 * @property string $note
 *
 * The followings are the available model relations:
 * @property ArticleBody $article0
 * @property FederationCalendar $event0
 */
class FederationCalendarArticle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FederationCalendarArticle the static model class
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
		return 'federation_calendar_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event, article', 'required'),
			array('event, article', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event, article, note', 'safe', 'on'=>'search'),
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
			'event0' => array(self::BELONGS_TO, 'FederationCalendar', 'event'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event' => 'Event',
			'article' => 'Article',
			'note' => 'Note',
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
		$criteria->compare('event',$this->event);
		$criteria->compare('article',$this->article);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}