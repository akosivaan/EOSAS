<?php

/**
 * This is the model class for table "enter".
 *
 * The followings are the available columns in table 'enter':
 * @property string $username
 * @property string $password
 * @property string $type
 * @property string status
 */
class Enter extends CActiveRecord
{	
	public $conf_password;
	const TYPE_PESO_OFFICER='PESO OFFICER';
	const TYPE_EMPLOYER='Employer';				
    const TYPE_APPLICANT='Applicant';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Enter the static model class
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
		return 'enter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username , password , type', 'required'),
			array('username', 'length', 'max'=>50),
			array('type', 'length', 'max'=>15),
			array('status', 'length', 'max'=>10),
			array('password', 'compare', 'compareAttribute'=>'conf_password'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, type', 'safe', 'on'=>'search'),
			array('username','unique','message'=>'{attribute}:{value} already exists!'),
		);
	}

	/*
		*show the choices for classification upon creating an account
	*/
	public function getClassificationOptions()
	{
			return array(
				self::TYPE_EMPLOYER=>'Employer',				
				self::TYPE_APPLICANT=>'Applicant',
			);
	}

	public function getClassification()
	{
			return array(
				self::TYPE_PESO_OFFICER=>'PESO OFFICER',
				self::TYPE_EMPLOYER=>'Employer',				
				self::TYPE_APPLICANT=>'Applicant',
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
			'username' => 'Username',
			'password' => 'Password',
			'type' => 'Type',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
		* Authentication of the user
	*/
	public function authenticateUser($username, $password){
        $record = Enter::model()->find(
			array('condition' => 'username=:username AND password=:password',
                  'params' =>array(':username'=>$username, ':password'=>$password)
            ));
        return $record;
    }
}
