<?php

/**
 * This is the model class for table "article_body".
 *
 * The followings are the available columns in table 'article_body':
 * @property integer $artid
 * @property integer $theme
 * @property integer $author
 * @property string $timestamp
 * @property string $title
 * @property string $body
 * @property string $brief
 * @property string $md5body
 * @property string $keywords
 *
 * The followings are the available model relations:
 * @property ArticleTheme $theme0
 * @property ArticleComment[] $articleComments
 * @property ArticleSubmit[] $articleSubmits
 * @property FederationCalendarArticle[] $federationCalendarArticles
 * @property FederationDocuments $federationDocuments
 * @property LibClimbingList[] $libClimbingLists
 * @property MountaineeringclubCalendar[] $mountaineeringclubCalendars
 * @property MountaineeringclubDocuments $mountaineeringclubDocuments
 */
class ArticleBody extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleBody the static model class
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
		return 'article_body';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('theme, author, timestamp, title, body, md5body', 'required'),
			array('theme, author', 'numerical', 'integerOnly'=>true),
			array('title, keywords', 'length', 'max'=>128),
			array('md5body', 'length', 'max'=>32),
			array('brief', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('artid, theme, author, timestamp, title, body, brief, md5body, keywords', 'safe', 'on'=>'search'),
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
			'theme0' => array(self::BELONGS_TO, 'ArticleTheme', 'theme'),
			'author0' => array(self::BELONGS_TO, 'SiteUser', 'author'),
			'articleComments' => array(self::HAS_MANY, 'ArticleComment', 'artid'),
			'articleSubmits' => array(self::HAS_MANY, 'ArticleSubmit', 'artid'),
			'federationCalendarArticles' => array(self::HAS_MANY, 'FederationCalendarArticle', 'article'),
			'federationDocuments' => array(self::HAS_ONE, 'FederationDocuments', 'artid'),
			'libClimbingLists' => array(self::HAS_MANY, 'LibClimbingList', 'report'),
			'mountaineeringclubCalendars' => array(self::HAS_MANY, 'MountaineeringclubCalendar', 'article'),
			'mountaineeringclubDocuments' => array(self::HAS_ONE, 'MountaineeringclubDocuments', 'artid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'artid' => 'Artid',
			'theme' => 'Тема',
			'author' => 'Автор',
			'timestamp' => 'дата',
			'title' => 'нвазвание',
			'body' => 'тело',
			'brief' => 'кратко',
			'md5body' => 'Md5body',
			'keywords' => 'ключевые слова',
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

		$criteria->compare('artid',$this->artid);
		$criteria->compare('theme',$this->theme);
		$criteria->compare('author',$this->author);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('md5body',$this->md5body,true);
		$criteria->compare('keywords',$this->keywords,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
