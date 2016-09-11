<?php

/**
 * This is the model class for table "employer".
 *
 * The followings are the available columns in table 'employer':
 * @property string $employeremail
 * @property string $password
 * @property string $companyName
 * @property string $companyAddress
 * @property string $facebook
 * @property string $regstatus
 * @property string $contactno
 * @property string $employertype
 * @property string $location
 *
 * The followings are the available model relations:
 * @property Employment[] $employments
 */
class Employer extends CActiveRecord
{
	const TYPE_GOVERNMENT='Government';
	const TYPE_PRIVATE='Private';				
    const LOCAL_LOCAL='Local';
    const LOCAL_OVERSEAS='Overseas';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employer the static model class
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
		return 'employer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyname , companyaddress', 'required'),
			array('employeremail, companyname, companyaddress', 'length', 'max'=>120),
			array('facebook', 'length', 'max'=>30),
			array('regstatus', 'length', 'max'=>15),
			array('contactno', 'length', 'max'=>11),
			array('username', 'length', 'max'=>50),
			array('location', 'length', 'max'=>100),
			array('employertype', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeremail, password, companyName, companyAddress, facebook, regstatus, contactno, location, employertype,enddate', 'safe', 'on'=>'search'),
			array('employeremail','unique','message'=>'{attribute}:{value} already exists!'),
			array('username','unique','message'=>'{attribute}:{value} already exists!'),
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
			'employments' => array(self::HAS_MANY, 'Employment', 'username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeremail' => 'Employeremail',
			'password' => 'Password',
			'companyname' => 'Company Name',
			'companyaddress' => 'Company Address',
			'facebook' => 'Facebook',
			'regstatus' => 'Regstatus',
			'contactno' => 'Contactno(mobile)',
			'username' => 'Username',
			'employertype' => 'Type',
			'location' => 'Location',
			//'enddate' => 'Post Expiration'
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

		$criteria->compare('employeremail',$this->employeremail,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('companyaddress',$this->companyaddress,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('regstatus',$this->regstatus,true);
		$criteria->compare('contactno',$this->contactno,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('employertype',$this->employertype,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
		* Change Status of an Employer to Approved
	*/
	public function approve($id){
		$user = Yii::app()->db->createCommand()
					->update('employer', array(
					'regstatus'=>'APPROVED',
			   ),  'username=:username', array(':username'=>$id) );
		$enter = Yii::app()->db->createCommand()
					->update('enter', array(
					'status'=>'APPROVED',
			   ),  'username=:username', array(':username'=>$id) );
	}
	
	/*
		* Deactivate an account of the employer
	*/
	public function deactivate($id){
		$user = Yii::app()->db->createCommand()
					->update('employer', array(
					'regstatus'=>'DEACTIVATED',
			   ),  'username=:username', array(':username'=>$id) );
		$enter = Yii::app()->db->createCommand()
					->update('enter', array(
					'status'=>'DEACTIVATED',
			   ),  'username=:username', array(':username'=>$id) );
	}

	public function getType()
	{
			return array(
				self::TYPE_GOVERNMENT=>'Government',
				self::TYPE_PRIVATE=>'Private',				
			);
	}

	public function getLocal(){
		return array(
				self::LOCAL_LOCAL=>'Local',
				self::LOCAL_OVERSEAS=>'Overseas',				
			);
	}
	
	/*
		* Search pending employer
	*/
	public function searchPENDING()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('employeremail',$this->employeremail,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('companyaddress',$this->companyaddress,true);
		$criteria->compare('regstatus','PENDING',true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
}