<?php

/**
 * This is the model class for table "federation_member".
 *
 * The followings are the available columns in table 'federation_member':
 * @property integer $dossier
 * @property string $member_from
 * @property string $member_to
 * @property integer $federation_role
 * @property string $special_service
 *
 * The followings are the available model relations:
 * @property LibUserDossier $dossier0
 * @property FederationRole $federationRole
 */
class FederationMember extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'federation_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dossier, member_from', 'required'),
			array('dossier, federation_role', 'numerical', 'integerOnly'=>true),
			array('member_to, special_service', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dossier, member_from, member_to, federation_role, special_service', 'safe', 'on'=>'search'),
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
			'dossier0' => array(self::BELONGS_TO, 'LibUserDossier', 'dossier'),
			'federationRole' => array(self::BELONGS_TO, 'FederationRole', 'federation_role'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dossier' => 'Dossier',
			'member_from' => 'член с (дата)',
			'member_to' => 'член по (дата)',
			'federation_role' => 'занимаемая должность',
			'special_service' => 'Особые заслуги',
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

		$criteria->compare('dossier',$this->dossier);
		$criteria->compare('member_from',$this->member_from,true);
		$criteria->compare('member_to',$this->member_to,true);
		$criteria->compare('federation_role',$this->federation_role);
		$criteria->compare('special_service',$this->special_service,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FederationMember the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
