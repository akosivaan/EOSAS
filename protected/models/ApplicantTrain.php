<?php

/**
 * This is the model class for table "applicantTrain".
 *
 * The followings are the available columns in table 'applicantTrain':
 * @property string $name
 * @property string $acquiredSkill
 * @property string $yearsExp
 * @property string $certRecieve
 * @property string $issuingAgency
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Applicant $email0
 */
class ApplicantTrain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantTrain the static model class
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
		return 'applicantTrain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, issuingAgency', 'length', 'max'=>70),
			array('acquiredSkill', 'length', 'max'=>70),
			array('yearsExp', 'length', 'max'=>2),
			array('certRecieve', 'length', 'max'=>70),
			array('username', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, acquiredSkill, yearsExp, certRecieve, issuingAgency, username', 'safe', 'on'=>'search'),
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
			'email0' => array(self::BELONGS_TO, 'Applicant', 'username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'acquiredSkill' => 'Acquired Skill',
			'yearsExp' => 'Years Exp',
			'certRecieve' => 'Cert Recieve',
			'issuingAgency' => 'Issuing Agency',
			'username' => 'Username',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('acquiredSkill',$this->acquiredSkill,true);
		$criteria->compare('yearsExp',$this->yearsExp,true);
		$criteria->compare('certRecieve',$this->certRecieve,true);
		$criteria->compare('issuingAgency',$this->issuingAgency,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}