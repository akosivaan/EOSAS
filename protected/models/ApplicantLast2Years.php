<?php

/**
 * This is the model class for table "applicantLast2Years".
 *
 * The followings are the available columns in table 'applicantLast2Years':
 * @property string $companyName
 * @property string $companyAddress
 * @property string $dateFrom
 * @property string $dateTo
 * @property string $designation
 * @property string $position
 * @property string $supervisor
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Applicant $email0
 */
class ApplicantLast2Years extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantLast2Years the static model class
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
		return 'applicantLast2Years';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyName, companyAddress, designation', 'length', 'max'=>70),
			array('position', 'length', 'max'=>20),
			array('supervisor, username', 'length', 'max'=>70),
			array('dateFrom, dateTo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('companyName, companyAddress, dateFrom, dateTo, designation, position, supervisor, username', 'safe', 'on'=>'search'),
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
			'companyName' => 'Company Name',
			'companyAddress' => 'Company Address',
			'dateFrom' => 'Date From',
			'dateTo' => 'Date To',
			'designation' => 'Designation',
			'position' => 'Position',
			'supervisor' => 'Supervisor',
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

		$criteria->compare('companyName',$this->companyName,true);
		$criteria->compare('companyAddress',$this->companyAddress,true);
		$criteria->compare('dateFrom',$this->dateFrom,true);
		$criteria->compare('dateTo',$this->dateTo,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('supervisor',$this->supervisor,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}