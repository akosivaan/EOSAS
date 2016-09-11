<?php

/**
 * This is the model class for table "applicantEduc".
 *
 * The followings are the available columns in table 'applicantEduc':
 * @property string $email
 * @property string $collegeDegree
 * @property string $collegeGrad
 * @property string $collegeSchool
 * @property string $highGrad
 * @property string $highSchool
 * @property string $elementary
 * @property string $elementaryGrad
 * @property string $elementarySchool
 * @property string $highschool
 *
 * The followings are the available model relations:
 * @property Applicant $email0
 */
class ApplicantEduc extends CActiveRecord
{
	const College_N='N/A';
    const College_one='1st year HS';
	const College_two='2nd year HS';	
    const College_three='3rd year HS';
	const College_four='4th year HS';
    const College_five='5th year HS';
	const College_six='6th year HS';	
    const College_A='HighSchool Grad';
    
    const Elem_N='N/A';
    const Elem_one='Grade one';
	const Elem_two='Grade two';	
    const Elem_three='Grade three';
    const Elem_four='Grade four';
    const Elem_five='Grade five';
	const Elem_six='Grade six';
    const Elem_A='Elem Graduate';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantEduc the static model class
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
		return 'applicantEduc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, highSchool, elementary, highschool', 'length', 'max'=>70),
			array('collegeDegree, elementarySchool', 'length', 'max'=>70),
			array('collegeGrad, highGrad, elementaryGrad', 'numerical','allowEmpty'=>true),
			array('collegeSchool', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, collegeDegree, collegeGrad, collegeSchool, highGrad, highSchool, elementary, elementaryGrad, elementarySchool, highschool', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'collegeDegree' => 'College Degree',
			'collegeGrad' => 'College Graduation',
			'collegeSchool' => 'College School',
			'highGrad' => 'High School Graduation',
			'highSchool' => 'High School',
			'elementary' => 'Elementary',
			'elementaryGrad' => 'Elementary Graduation',
			'elementarySchool' => 'Elementary School',
			'highschool' => 'Highschool',
		);
	}

	public function getCol()
	{
			return array(
				self::College_N=>'N/A',
                self::College_one=>'1st year HS',
				self::College_two=>'2nd year HS',	
                self::College_three=>'3rd year HS',
				self::College_four=>'4th year HS',
                self::College_five=>'5th year HS',
				self::College_six=>'6th year HS',	
				self::College_A=>'HighSchool Graduate',				
			);
            
	}
    
    public function getElem()
	{
			return array(
				self::Elem_N=>'N/A',
                self::Elem_one=>'Grade one',
				self::Elem_two=>'Grade two',	
                self::Elem_three=>'Grade three',
				self::Elem_four=>'Grade four',
                self::Elem_five=>'Grade five',
				self::Elem_six=>'Grade six',	
				self::Elem_A=>'Elementary Graduate',				
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
		$criteria->compare('collegeDegree',$this->collegeDegree,true);
		$criteria->compare('collegeGrad',$this->collegeGrad,true);
		$criteria->compare('collegeSchool',$this->collegeSchool,true);
		$criteria->compare('highGrad',$this->highGrad,true);
		$criteria->compare('highSchool',$this->highSchool,true);
		$criteria->compare('elementary',$this->elementary,true);
		$criteria->compare('elementaryGrad',$this->elementaryGrad,true);
		$criteria->compare('elementarySchool',$this->elementarySchool,true);
		$criteria->compare('highschool',$this->highschool,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}