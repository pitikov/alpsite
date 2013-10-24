<?php

/**
 * This is the model class for table "article_comment".
 *
 * The followings are the available columns in table 'article_comment':
 * @property string $id
 * @property integer $artid
 * @property integer $uid
 * @property string $parent
 * @property string $body
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property ArticleBody $art
 * @property ArticleComment $parent0
 * @property ArticleComment[] $articleComments
 * @property SiteUser $u
 */
class ArticleComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleComment the static model class
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
		return 'article_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('artid, uid, body, timestamp', 'required'),
			array('artid, uid', 'numerical', 'integerOnly'=>true),
			array('id, parent', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, artid, uid, parent, body, timestamp', 'safe', 'on'=>'search'),
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
			'art' => array(self::BELONGS_TO, 'ArticleBody', 'artid'),
			'parent0' => array(self::BELONGS_TO, 'ArticleComment', 'parent'),
			'articleComments' => array(self::HAS_MANY, 'ArticleComment', 'parent'),
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
			'artid' => 'Статья',
			'uid' => 'Автор',
			'parent' => 'Над комментарий',
			'body' => 'Тело',
			'timestamp' => 'Дата время',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('artid',$this->artid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
