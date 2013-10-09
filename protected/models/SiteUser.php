<?php

/**
 * This is the model class for table "site_user".
 *
 * The followings are the available columns in table 'site_user':
 * @property integer $uid
 * @property string $login
 * @property string $mail
 * @property string $name
 * @property string $pwdrestorequest
 * @property string $hash
 * @property string $requesthash
 * @property string $accessrules
 *
 * The followings are the available model relations:
 * @property ArticleComment[] $articleComments
 * @property ArticleModerator[] $articleModerators
 * @property ArticleSubmit[] $articleSubmits
 * @property ArticleThemeSubmit[] $articleThemeSubmits
 * @property LibUserDossier[] $libUserDossiers
 * @property MountaineeringclubCalendar[] $mountaineeringclubCalendars
 * @property SitePwdrequest $sitePwdrequest
 * @property SiteUserOpenid[] $siteUserOpens
 */
class SiteUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteUser the static model class
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
		return 'site_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, mail, name, pwdrestorequest, hash, requesthash', 'required'),
			array('login', 'length', 'max'=>16),
			array('mail, name, pwdrestorequest', 'length', 'max'=>128),
			array('hash, requesthash', 'length', 'max'=>32),
			array('accessrules', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, login, mail, name, pwdrestorequest, hash, requesthash, accessrules', 'safe', 'on'=>'search'),
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
			'articleComments' => array(self::HAS_MANY, 'ArticleComment', 'uid'),
			'articleModerators' => array(self::HAS_MANY, 'ArticleModerator', 'uid'),
			'articleSubmits' => array(self::HAS_MANY, 'ArticleSubmit', 'uid'),
			'articleThemeSubmits' => array(self::HAS_MANY, 'ArticleThemeSubmit', 'uid'),
			'libUserDossiers' => array(self::HAS_MANY, 'LibUserDossier', 'uid'),
			'mountaineeringclubCalendars' => array(self::HAS_MANY, 'MountaineeringclubCalendar', 'responsible_executor'),
			'sitePwdrequest' => array(self::HAS_ONE, 'SitePwdrequest', 'uid'),
			'siteUserOpens' => array(self::HAS_MANY, 'SiteUserOpenid', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'login' => 'Login',
			'mail' => 'Mail',
			'name' => 'Name',
			'pwdrestorequest' => 'Pwdrestorequest',
			'hash' => 'Hash',
			'requesthash' => 'Requesthash',
			'accessrules' => 'Accessrules',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('pwdrestorequest',$this->pwdrestorequest,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('requesthash',$this->requesthash,true);
		$criteria->compare('accessrules',$this->accessrules,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}