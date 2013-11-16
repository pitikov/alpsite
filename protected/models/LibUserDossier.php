<?php

/**
 * This is the model class for table "lib_user_dossier".
 *
 * The followings are the available columns in table 'lib_user_dossier':
 * @property integer $id
 * @property integer $uid
 * @property string $name
 * @property string $date_of_bethday
 * @property string $sport_range
 * @property integer $mountain_resque
 * @property string $mountain_guide
 * @property string $about
 * @property string $photo
 *
 * The followings are the available model relations:
 * @property FederationMember $federationMember
 * @property LibClimbingList[] $libClimbingLists
 * @property SiteUser $u
 * @property MountaineeringclubMember $mountaineeringclubMember
 */
class LibUserDossier extends CActiveRecord
{
        public $dob;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lib_user_dossier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('uid, mountain_resque', 'numerical', 'integerOnly'=>true),
			array('name, photo', 'length', 'max'=>128),
			array('sport_range', 'length', 'max'=>48),
			array('mountain_guide', 'length', 'max'=>22),
			array('date_of_bethday, about', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, name, date_of_bethday, sport_range, mountain_resque, mountain_guide, about, photo', 'safe', 'on'=>'search'),
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
			'federationMember' => array(self::HAS_ONE, 'FederationMember', 'dossier'),
			'libClimbingLists' => array(self::HAS_MANY, 'LibClimbingList', 'member'),
			'u' => array(self::BELONGS_TO, 'SiteUser', 'uid'),
			'mountaineeringclubMember' => array(self::HAS_ONE, 'MountaineeringclubMember', 'dossier'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'привязка к учетке пользователя сайта',
			'name' => 'Имя Фамилия отчество',
			'date_of_bethday' => 'День рождения',
			'sport_range' => 'текущий разряд',
			'mountain_resque' => 'жетон спасение в горах',
			'mountain_guide' => 'текущая инструкторская категория',
			'about' => 'Данные о участнике',
			'photo' => 'путь к файлу фотографии',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_of_bethday',$this->date_of_bethday,true);
		$criteria->compare('sport_range',$this->sport_range,true);
		$criteria->compare('mountain_resque',$this->mountain_resque);
		$criteria->compare('mountain_guide',$this->mountain_guide,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('photo',$this->photo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibUserDossier the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
        protected function afterFind()
        {
            $this->dob = is_null($this->date_of_bethday)?null:date_create_from_format('Y-m-d', $this->date_of_bethday)->format('d.m.Y');
            
            parent::afterFind();
        }
}
