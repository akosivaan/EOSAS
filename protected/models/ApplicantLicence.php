<?php

/**
 * This is the model class for table "applicantlicence".
 *
 * The followings are the available columns in table 'applicantlicence':
 * @property string $title
 * @property string $expdate
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Applicant $email0
 */
class Applicantlicence extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Applicantlicence the static model class
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
		return 'applicantlicence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, username', 'length', 'max'=>50),
			array('expdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, expdate, username', 'safe', 'on'=>'search'),
			array('expdate', 'default', 'setOnEmpty' => true, 'value' => null),
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
			'title' => 'Title',
			'expdate' => 'Exp Date',
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

		$criteria->compare('title',$this->title,true);
		$criteria->compare('expdate',$this->expdate,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}