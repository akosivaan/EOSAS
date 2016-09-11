<?php

/**
 * This is the model class for table "peso".
 *
 * The followings are the available columns in table 'peso':
 * @property string $employee_no
 * @property string $municipality
 * @property string $brgy
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $position
 * @property string $regstatus
 * @property string $pesoemail
 * @property string $password
 */
class Peso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Peso the static model class
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
		return 'peso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_no, municipality, fname, lname, mname', 'required'),
			array('employee_no', 'length', 'max'=>16),
			array('municipality, brgy, fname, mname, lname', 'length', 'max'=>20),
			array('position, regstatus', 'length', 'max'=>20),
			array('pesoemail', 'length', 'max'=>50),
			array('username', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employee_no, municipality, brgy, fname, mname, lname, position, regstatus, pesoemail, username,password', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employee_no' => 'Employee No',
			'municipality' => 'Municipality',
			'brgy' => 'Baranggay',
			'fname' => 'First Name',
			'mname' => 'Midddle Name',
			'lname' => 'Last Name',
			'position' => 'Position',
			'regstatus' => 'Registration Status',
			'pesoemail' => 'Email Address',
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

		$criteria->compare('employee_no',$this->employee_no,true);
		$criteria->compare('municipality',$this->municipality,true);
		$criteria->compare('brgy',$this->brgy,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('regstatus',$this->regstatus,true);
		$criteria->compare('pesoemail',$this->pesoemail,true);
		$criteria->compare('username',$this->username,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*
		*change status of an applicant to approve
	*/
	public function approve($id){
		$user = Yii::app()->db->createCommand()
					->update('peso', array(
					'regstatus'=>'APPROVED',
			   ),  'username=:username', array(':username'=>$id) );
		$enter = Yii::app()->db->createCommand()
					->update('enter', array(
					'status'=>'APPROVED',
			   ),  'username=:username', array(':username'=>$id) );
	}
	
	/*
		*Deactivate an account of an applicant
	*/
	public function deactivate($id){
		$user = Yii::app()->db->createCommand()
					->update('peso', array(
					'regstatus'=>'DEACTIVATED',
			   ),  'username=:username', array(':username'=>$id) );
		$enter = Yii::app()->db->createCommand()
					->update('enter', array(
					'status'=>'DEACTIVATED',
			   ),  'username=:username', array(':username'=>$id) );
	}
}
