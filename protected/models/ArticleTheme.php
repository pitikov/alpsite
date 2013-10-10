<?php

/**
 * This is the model class for table "article_theme".
 *
 * The followings are the available columns in table 'article_theme':
 * @property integer $id
 * @property string $title
 * @property string $icon
 * @property integer $iscommentenable
 *
 * The followings are the available model relations:
 * @property ArticleBody[] $articleBodies
 * @property ArticleModerator[] $articleModerators
 * @property ArticleThemeSubmit[] $articleThemeSubmits
 */
class ArticleTheme extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleTheme the static model class
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
		return 'article_theme';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('iscommentenable', 'numerical', 'integerOnly'=>true),
			array('title, icon', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, icon, iscommentenable', 'safe', 'on'=>'search'),
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
			'articleBodies' => array(self::HAS_MANY, 'ArticleBody', 'theme'),
			'articleModerators' => array(self::HAS_MANY, 'ArticleModerator', 'theme'),
			'articleThemeSubmits' => array(self::HAS_MANY, 'ArticleThemeSubmit', 'theme'),
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
			'icon' => 'Icon',
			'iscommentenable' => 'Iscommentenable',
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
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('iscommentenable',$this->iscommentenable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}