<?php

/**
 * This is the model class for table "applicantSkill".
 *
 * The followings are the available columns in table 'applicantSkill':
 * @property string $skill
 * @property string $username
 * @property string $type
 * The followings are the available model relations:
 * @property Applicant $email0
 */
class ApplicantSkill extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantSkill the static model class
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
		return 'applicantSkill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('skill,type', 'length', 'max'=>30),
			array('username', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('skill, username,type', 'safe', 'on'=>'search'),
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
			'username' => array(self::BELONGS_TO, 'Applicant', 'username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'skill' => 'Skill',
			'username' => 'Username',
			'type'=>'Type'
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

		$criteria->compare('skill',$this->skill,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('type',$this->type,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchSkills($type,$username){
		$criteria = new CDbCriteria;

		$criteria->compare('type',$type,true);
		$criteria->compare('skill',$this->skill,true);
		$criteria->compare('username',$username,true);
		return new CActiveDataProvider($this,array('criteria'=>$criteria));
	}
}