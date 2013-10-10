<?php

/**
 * This is the model class for table "article_theme_submit".
 *
 * The followings are the available columns in table 'article_theme_submit':
 * @property integer $id
 * @property integer $uid
 * @property integer $theme
 * @property string $triggers
 *
 * The followings are the available model relations:
 * @property ArticleTheme $theme0
 * @property SiteUser $u
 */
class ArticleThemeSubmit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleThemeSubmit the static model class
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
		return 'article_theme_submit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, theme, triggers', 'required'),
			array('uid, theme', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, theme, triggers', 'safe', 'on'=>'search'),
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
			'u' => array(self::BELONGS_TO, 'SiteUser', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'theme' => 'Theme',
			'triggers' => 'Triggers',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('theme',$this->theme);
		$criteria->compare('triggers',$this->triggers,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}