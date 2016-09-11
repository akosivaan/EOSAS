<?php

/**
 * This is the model class for table "trainiees".
 *
 * The followings are the available columns in table 'trainiees':
 * @property string $fname
 * @property string $lname
 * @property string $mname
 * @property string $age
 * @property string $sex
 * @property string $brgy
 * @property string $municipality
 * @property string $contactno
 * @property string $titlemail
 * @property string $title
 */
class Trainiees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Trainiees the static model class
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
		return 'trainiees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titlemail', 'required'),
			array('fname, lname, mname, brgy', 'length', 'max'=>20),
			array('age', 'length', 'max'=>2),
			array('sex', 'length', 'max'=>1),
			array('municipality, titlemail, title', 'length', 'max'=>30),
			array('contactno', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fname, lname, mname, age, sex, brgy, municipality, contactno, titlemail, title', 'safe', 'on'=>'search'),
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
			'fname' => 'Fname',
			'lname' => 'Lname',
			'mname' => 'Mname',
			'age' => 'Age',
			'sex' => 'Sex',
			'brgy' => 'Brgy',
			'municipality' => 'Municipality',
			'contactno' => 'Contactno',
			'titlemail' => 'Titlemail',
			'title' => 'Title',
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

		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('brgy',$this->brgy,true);
		$criteria->compare('municipality',$this->municipality,true);
		$criteria->compare('contactno',$this->contactno,true);
		$criteria->compare('titlemail',$this->titlemail,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
		*inserting data on the trainiees table
		*assume that an applicant can only join one training at a time
	*/
	
	public function insert($title){

	//$rowCount=$command->execute(); 
	$id = Yii::app()->session['username']; 
	$count = Trainiees::Model()->count("titlemail=:titlemail", array("titlemail" => $id));
	if($count == 0){
	$i=0;
	$user = Yii::app()->db->createCommand()
    ->select('fname, lname, mname , age , sex, brgy, municipality, contactNo')
    ->from('applicant')
    ->where('username=:username', array(':username'=>$id))
    ->queryAll();

		foreach($user as $need)
		{
		$specialize[$i] = $need['fname'];
		$i++;
		$specialize[$i] = $need['lname'];
		$i++;
		$specialize[$i] = $need['mname'];
		$i++;
		$specialize[$i] = $need['age'];
		$i++;
		$specialize[$i] = $need['sex'];
		$i++;
		$specialize[$i] = $need['brgy'];
		$i++;
		$specialize[$i] = $need['municipality'];
		$i++;
		$specialize[$i] = $need['contactNo'];
		$i++;
		}   
		
		$sql = "insert into trainiees (fname, lname, mname, age, sex, brgy, municipality, contactno, titlemail, title) 
								values (:fname, :lname, :mname, :age , :sex, :brgy, :municipality, :contactno, :titlemail, :title)";
		$parameters = array( ':fname'=>$specialize[0], ':lname'=>$specialize[1] , ':mname'=>$specialize[2] , ':age'=>$specialize[3],
							':sex'=>$specialize[4] , ':brgy'=>$specialize[5] , ':municipality'=>$specialize[6] , ':contactno'=>$specialize[7],
							':titlemail'=>$id , ':title'=>$title);
		Yii::app()->db->createCommand($sql)->execute($parameters);
		
		}
	}
}