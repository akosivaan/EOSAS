
<?php

/**
 * This is the model class for table "applicant".
 *
 * The followings are the available columns in table 'applicant':
 * @property string $applicantemail
 * @property string $password
 * @property string $pin
 * @property string $fname
 * @property string $lname
 * @property string $mname
 * @property string $birthdate
 * @property string $sex
 * @property string $age
 * @property string $religion
 * @property string $street
 * @property string $brgy
 * @property string $municipality
 * @property string $placeBirth
 * @property string $height
 * @property string $weight
 * @property string $maritalstatus
 * @property string $contactNo
 * @property string $employmentstatus
 * @property string $wheretowork
 * @property string $passportno
 * @property string $passportexp
 * @property string $facebook
 * @property string $regstatus
 * @property string $position_wanted
 * @property string $specialization_wanted
 * @property string $username
 *
 * The followings are the available model relations:
 * @property ApplicantLast2Years[] $applicantLast2Years
 * @property ApplicantLicence[] $applicantLicences
 * @property ApplicantSkill[] $applicantSkills
 * @property ApplicantTrain[] $applicantTrains
 * @property ApplicantWorkExp[] $applicantWorkExps
 * @property ApplicantLanguageSpoken[] $applicantLanguageSpokens
 * @property ApplicantEduc[] $applicantEducs
 * @property ApplicantLanguageKnown[] $applicantLanguageKnowns
 * @property ApplicantDisability[] $applicantDisabilities
 */
class Applicant extends CActiveRecord
{

	const SEX_M='M';
	const SEX_F='F';
    
    const MS_SINGLE='SINGLE';
	const MS_MARRIED='MARRIED';
    const MS_WIDOWED='WIDOWED';
    
    const ES_Active='Actively looking for work';
    const ES_Employed='Currently Employed';
    const ES_local='Terminated/LaidOff,Local';
    const ES_abroad='Terminated/LaidOff,Abroad';
    
    const WP_Anywhere='Anywhere';
	const WP_Abroad='Abroad';
    const WP_Local='Local Only';
	
	const Position_All='Any Position Level';
	const Position_CEO='CEO_SVP_AVP_VP_Director';
	const Position_Manager='Asst. Manager_Manager';
	const Position_Supervisor='Supervisor';
	const Position_Employee='Employee';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Applicant the static model class
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
		return 'applicant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, fname,lname,
			birthdate , sex, age, brgy , municipality, maritalstatus ,
			employmentstatus , wheretowork , 
			position_wanted , specialization_wanted' , 'required'),
			array('applicantemail, fname, lname, mname , brgy, municipality', 'length', 'max'=>70),
			array('pin, religion, regstatus', 'length', 'max'=>20),
			array('sex', 'length', 'max'=>1),
			//array('age', 'length', 'max'=>2),
			array('street, passportno', 'length', 'max'=>20),
			array('placeBirth, employmentstatus, facebook', 'length', 'max'=>50),
			array('height, weight,age','numerical','allowEmpty'=>true),
			array('maritalstatus, wheretowork', 'length', 'max'=>10),
			array('contactNo', 'length', 'max'=>11),
			array('position_wanted, specialization_wanted', 'length', 'max'=>100),
			array('username', 'length', 'max'=>50),
			array('birthdate, passportexp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('applicantemail, password, PIN, fname, lname, mname, birthdate, sex, age, religion, street, brgy, municipality, placeBirth, height, weight, maritalstatus, contactNo, employmentstatus, wheretowork, passportno, passportexp, facebook, regstatus, position_wanted, specialization_wanted', 'safe', 'on'=>'search'),
			array('applicantemail','unique','message'=>'{attribute}:{value} already exists!'),
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
			'applicantLast2Years' => array(self::HAS_MANY, 'ApplicantLast2Years', 'username'),
			'applicantLicences' => array(self::HAS_MANY, 'ApplicantLicence', 'username'),
			'applicantSkills' => array(self::HAS_MANY, 'ApplicantSkill', 'username'),
			'applicantTrains' => array(self::HAS_MANY, 'ApplicantTrain', 'username'),
			'applicantWorkExps' => array(self::HAS_MANY, 'ApplicantWorkExp', 'username'),
			'applicantLanguageSpokens' => array(self::HAS_MANY, 'ApplicantLanguageSpoken', 'username'),
			'applicantEducs' => array(self::HAS_MANY, 'ApplicantEduc', 'username'),
			'applicantLanguageKnowns' => array(self::HAS_MANY, 'ApplicantLanguageKnown', 'username'),
			'applicantDisabilities' => array(self::HAS_MANY, 'ApplicantDisability', 'username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'applicantemail' => 'Email Address',
			'password' => 'Password',
			'pin' => 'PIN',
			'fname' => 'First Name',
			'lname' => 'Last Name',
			'mname' => 'Middle Name',
			'birthdate' => 'Birth Date',
			'sex' => 'Sex',
			'age' => 'Age',
			'religion' => 'Religion',
			'street' => 'Street',
			'brgy' => 'Baranggay',
			'municipality' => 'Municipality',
			'placeBirth' => 'Place Birth',
			'height' => 'Height (cm)',
			'weight' => 'Weight (lbs)',
			'maritalstatus' => 'Marital Status',
			'contactNo' => 'Contact No (mobile)',
			'employmentstatus' => 'Employment Status',
			'wheretowork' => 'Where To Work',
			'passportno' => 'Passport No',
			'passportexp' => 'Passport Expiry',
			'facebook' => 'Facebook',
			'regstatus' => 'Registration Status',
			'position_wanted' => 'Position Wanted',
			'specialization_wanted' => 'Specialization Wanted',
			'username' => 'Username',
		);
	}

	public function getSex()
	{
			return array(
				self::SEX_M=>'M',
				self::SEX_F=>'F',				
			);
	}
    
    public function getMS()
	{
			return array(
				self::MS_SINGLE=>'SINGLE',
				self::MS_MARRIED=>'MARRIED',
                self::MS_WIDOWED=>'WIDOWED',
			);
	}
    
    public function getES()
	{
			return array(
				self::ES_Active=>'Actively looking for work',
				self::ES_Employed=>'Currently Employed',
                self::ES_local=>'Terminated/LaidOff,Local',
                self::ES_abroad=>'Terminated/LaidOff,Abroad',
			);
	}
    
    public function getWP()
	{
			return array(
				self::WP_Anywhere=>'Anywhere',
				self::WP_Abroad=>'Abroad',
                self::WP_Local=>'Local Only',
			);
	}
	
	public function getPosition()
	{
			return array(
				self::Position_All=>'Any Position Level',
				self::Position_CEO=>'CEO/SVP/AVP/VP/Director',
				self::Position_Manager=>'Asst. Manager/Manager',
				self::Position_Supervisor=>'Supervisor',
				self::Position_Employee=>'Employee',
			);
	}
	
	public function getSpecialization()
    {
		return array(
			array('id'=>'N/A','text'=>'N/A','group'=>'Any Specialization'),
			array('id'=>'Any Specialization','text'=>'Any Specialization','group'=>'Any Specialization'),
			array('id'=>'All Accounting_Finance','text'=>'Any Accounting/Finance','group'=>'Accounting/Finance'),
            array('id'=>'Audit and Taxation','text'=>'Audit and Taxation','group'=>'Accounting/Finance'),
			array('id'=>'Banking_Financial','text'=>'Banking/Financial','group'=>'Accounting/Finance'),
			array('id'=>'Corporate Finance_Investment','text'=>'Corporate Finance/Investment','group'=>'Accounting/Finance'),
			array('id'=>'General_Cost Accounting','text'=>'General/Cost Accounting','group'=>'Accounting/Finance'),
			
			array('id'=>'All Admin_Human Resources','text'=>'Any Admin_Human Resources','group'=>'Admin_Human Resources'),
            array('id'=>'Clerical_Administrative','text'=>'Clerical_Administrative','group'=>'Admin_Human Resources'),
			array('id'=>'Human Resources','text'=>'Human Resources','group'=>'Admin_Human Resources'),
			array('id'=>'Secretarial','text'=>'Secretarial','group'=>'Admin_Human Resources'),
			array('id'=>'Top Management','text'=>'Top Management','group'=>'Admin_Human Resources'),
			
			array('id'=>'All Arts_Media_Communication','text'=>'Any Arts_Media_Communication','group'=>'Arts_Media_Communication'),
            array('id'=>'Advertising','text'=>'Advertising','group'=>'Arts_Media_Communication'),
			array('id'=>'Arts_Creative Design','text'=>'Arts_Creative Design','group'=>'Arts_Media_Communication'),
			array('id'=>'Entertainment','text'=>'Entertainment','group'=>'Arts_Media_Communication'),
			array('id'=>'Public Relations','text'=>'Public Relations','group'=>'Arts_Media_Communication'),
			
			array('id'=>'All Building_Construction','text'=>'Any Building_Construction','group'=>'Building_Construction'),
            array('id'=>'Architect_Interior Design','text'=>'Architect_Interior Design','group'=>'Building_Construction'),
			array('id'=>'Civil Engineering_Construction','text'=>'Civil Engineering_Construction','group'=>'Building_Construction'),
			array('id'=>'Property_Real Estate','text'=>'Property_Real Estate','group'=>'Building_Construction'),
			array('id'=>'Quantity Surveying','text'=>'Quantity Surveying','group'=>'Building_Construction'),
			
			array('id'=>'All Computer_Information Technology','text'=>'Any Computer_Information Technology','group'=>'Computer_Information Technology'),
            array('id'=>'IT - Hardware','text'=>'IT - Hardware','group'=>'Computer_Information Technology'),
			array('id'=>'IT - Network_Sys_DB Admin','text'=>'IT - Network_Sys_DB Admin','group'=>'Computer_Information Technology'),
			array('id'=>'IT - Software','text'=>'IT - Software','group'=>'Computer_Information Technology'),
			
			array('id'=>'All Education_Training','text'=>'Any Education_Training','group'=>'Education_Training'),
            array('id'=>'Education','text'=>'Education','group'=>'Education_Training'),
			array('id'=>'Training and Development','text'=>'Training and Development','group'=>'Education_Training'),
			
			array('id'=>'All Engineering','text'=>'Any Engineering','group'=>'Engineering'),
            array('id'=>'Chemical Engineering','text'=>'Chemical Engineering','group'=>'Engineering'),
			array('id'=>'Electrical Engineering','text'=>'Electrical Engineering','group'=>'Engineering'),
			array('id'=>'Electronics Engineering','text'=>'Electronics Engineering','group'=>'Engineering'),
            array('id'=>'Environmental Engineering','text'=>'Environmental Engineering','group'=>'Engineering'),
			array('id'=>'Industrial Engineering','text'=>'Industrial Engineering','group'=>'Engineering'),
			array('id'=>'Mechanical_Automotive Engineering','text'=>'Mechanical_Automotive Engineering','group'=>'Engineering'),
            array('id'=>'Oil_Gas Engineering','text'=>'Oil_Gas Engineering','group'=>'Engineering'),
			array('id'=>'Other Engineering','text'=>'Other Engineering','group'=>'Engineering'),
			
			array('id'=>'All Health Care','text'=>'All Health Care','group'=>'Health Care'),
			array('id'=>'Doctor_Diagnosis','text'=>'Doctor_Diagnosis','group'=>'Health Care'),
            array('id'=>'Pharmacy','text'=>'Pharmacy','group'=>'Health Care'),
			array('id'=>'Nurse_Medical Support','text'=>'Nurse_Medical Support','group'=>'Health Care'),
			
			array('id'=>'All Hotel_Restaurant','text'=>'Any Hotel_Restaurant','group'=>'Hotel_Restaurant'),
            array('id'=>'Food_Beverage_Restaurant','text'=>'Food_Beverage_Restaurant','group'=>'Hotel_Restaurant'),
			array('id'=>'Hotel_Tourism','text'=>'Hotel_Tourism','group'=>'Hotel_Restaurant'),
			
			array('id'=>'All Manufacturing','text'=>'Any Manufacturing','group'=>'Manufacturing'),
            array('id'=>'Maintenance','text'=>'Maintenance','group'=>'Manufacturing'),
			array('id'=>'Manufacturing','text'=>'Manufacturing','group'=>'Manufacturing'),
			array('id'=>'Process Design and Color','text'=>'Process Design and Color','group'=>'Manufacturing'),
            array('id'=>'Purchasing_Material Management','text'=>'Purchasing_Material Management','group'=>'Manufacturing'),
			array('id'=>'Quality Assurance','text'=>'Quality Assurance','group'=>'Manufacturing'),
			
			array('id'=>'All Sales_Marketing','text'=>'Any Sales_Marketing','group'=>'Sales_Marketing'),
            array('id'=>'Sales - Corporate','text'=>'Sales - Corporate','group'=>'Sales_Marketing'),
			array('id'=>'Marketing_Business Development','text'=>'Marketing_Business Development','group'=>'Sales_Marketing'),
			array('id'=>'Merchandising','text'=>'Merchandising','group'=>'Sales_Marketing'),
            array('id'=>'Retail Sales','text'=>'Retail Sales','group'=>'Sales_Marketing'),
			array('id'=>'Sales - Engineering_Technology_IT','text'=>'Sales - Engineering_Technology_IT','group'=>'Sales_Marketing'),
			array('id'=>'Sales - Finance Services','text'=>'Sales - Finance Services','group'=>'Sales_Marketing'),
			array('id'=>'Telesales_Telemarketing','text'=>'Telesales_Telemarketing','group'=>'Sales_Marketing'),
			
			array('id'=>'All Sciences','text'=>'All Sciences','group'=>'Science'),
            array('id'=>'Actuarial_Statistics','text'=>'Actuarial_Statistics','group'=>'Science'),
			array('id'=>'Agriculture','text'=>'Agriculture','group'=>'Science'),
			array('id'=>'Aviation','text'=>'Aviation','group'=>'Science'),
            array('id'=>'Biotechnology','text'=>'Biotechnology','group'=>'Science'),
			array('id'=>'Chemistry','text'=>'Chemistry','group'=>'Science'),
			array('id'=>'Food Tech_Nutritionist','text'=>'Food Tech_Nutritionist','group'=>'Science'),
			array('id'=>'Geology_Geophysics','text'=>'Geology_Geophysics','group'=>'Science'),
			array('id'=>'Science and Technology','text'=>'Science and Technology','group'=>'Science'),
			
			array('id'=>'All Services','text'=>'All Services','group'=>'Services'),
            array('id'=>'Security_Armed Forces','text'=>'Security_Armed Forces','group'=>'Services'),
			array('id'=>'Customer Service','text'=>'Customer Service','group'=>'Services'),
			array('id'=>'Logistics_Supply Chain','text'=>'Logistics_Supply Chain','group'=>'Services'),
            array('id'=>'Law_Legal Services','text'=>'Law_Legal Services','group'=>'Services'),
			array('id'=>'Personal Care_Housekeeping','text'=>'Personal Care_Housekeeping','group'=>'Services'),
			array('id'=>'Social Services','text'=>'Social Services','group'=>'Services'),
			array('id'=>'Tech and Helpdesk Support','text'=>'Tech and Helpdesk Support','group'=>'Services'),
			
			array('id'=>'All Others','text'=>'All Others','group'=>'Others'),
            array('id'=>'General Work','text'=>'General Work','group'=>'Others'),
			array('id'=>'Journalist_Editors','text'=>'Journalist_Editors','group'=>'Others'),
			array('id'=>'Publishing','text'=>'Publishing','group'=>'Others'),
			array('id'=>'Others','text'=>'Others','group'=>'Others'),
			
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

		$criteria->compare('applicantemail',$this->applicantemail,true);
		$criteria->compare('password',$this->password,true);
	//	$criteria->compare('pin',$this->pin,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('brgy',$this->brgy,true);
		$criteria->compare('municipality',$this->municipality,true);
		$criteria->compare('placeBirth',$this->placeBirth,true);
		//$criteria->addCondition('height',$this->height,true);
		//$criteria->compare('weight',$this->weight,true);
		$criteria->compare('maritalstatus',$this->maritalstatus,true);
		$criteria->compare('contactNo',$this->contactNo,true);
		$criteria->compare('employmentstatus',$this->employmentstatus,true);
		$criteria->compare('wheretowork',$this->wheretowork,true);
		//$criteria->compare('passportno',$this->passportno,true);
		$criteria->compare('passportexp',$this->passportexp,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('regstatus',$this->regstatus,true);
		$criteria->compare('position_wanted',$this->position_wanted,true);
		$criteria->compare('specialization_wanted',$this->specialization_wanted,true);
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
					->update('applicant', array(
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
					->update('applicant', array(
					'regstatus'=>'DEACTIVATED',
			   ),  'username=:username', array(':username'=>$id) );
		$enter = Yii::app()->db->createCommand()
					->update('enter', array(
					'status'=>'DEACTIVATED',
			   ),  'username=:username', array(':username'=>$id) );	
	}
	
	/*
		* Search all PENDING applicants
	*/
	public function searchPENDING()
	{
		//function to search All Approved Employmement Opportunities
		//search view for applicant and visitor 
		
		$criteria=new CDbCriteria;
		$criteria->compare('applicantemail',$this->applicantemail,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('regstatus','PENDING',true);
		$criteria->compare('municipality',$this->municipality,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
	
	/*
		* Employer Search
		* Shows all approved applicants only
	*/
	public function employerSearch()
	{
		//function to search All Approved Employmement Opportunities
		//search view for applicant and visitor 
		
		$criteria=new CDbCriteria;
		$criteria->compare('regstatus','APPROVED',true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
	
	/*
		*function to get the matched employment opportunities to the applicant
	*/
	public function getMatched($id){
	//position
	$location = "";
	$specialize = "";
	$pos = "";
	$user = Yii::app()->db->createCommand()
    ->select('position_wanted')
    ->from('applicant')
    ->where('username=:id', array(':id'=>$id))
    ->queryAll();

		foreach($user as $need)
		{
		$pos = $need['position_wanted'];
		}  
		
	//specialization
	$user = Yii::app()->db->createCommand()
    ->select('specialization_wanted')
    ->from('applicant')
    ->where('username=:id', array(':id'=>$id))
    ->queryAll();

		foreach($user as $need)
		{
		$specialize = $need['specialization_wanted'];
		}   
	
		
	//wheretowork
	$user = Yii::app()->db->createCommand()
    ->select('wheretowork')
    ->from('applicant')
    ->where('username=:id', array(':id'=>$id))
    ->queryAll();

		foreach($user as $need)
		{
		$location = $need['wheretowork'];
		}
	//final
	$user = Yii::app()->db->createCommand()
    ->select('jobtitle')
    ->from('employment')
    ->where('location=:location or specialization=:specialization or location=:anywhere' , 
			array(':location'=>$location , ':specialization'=>$specialize,':anywhere'=>'Anywhere'))
    ->queryAll();

		return $user;
	}
	
	/*
		*Insert data of applicants that applied for an employment opportunity in the match table
		*Use to reference who applied for an applicant
	*/
	public function insertMatch($id , $employer){
		$applicant = Yii::app()->session['username']; 
		$sql = "SELECT COUNT(*) FROM matches";
		$matched = Yii::app()->db->createCommand($sql)->queryScalar();
		$mydate = date('m-d-Y');
		$app = Applicant::model()->findByAttributes(array('username'=>$applicant));
		$emp = Employment::model()->findByPK($id);
		$fname = $app->fname;
		$mname = $app->mname;
		$lname = $app->lname;
		$sql = "insert into matches (applicant, jobtitle,fname,mname,lname,job_id, status, employer,date) 
								values (:applicant, :jobtitle,:fname,:mname,:lname,:job_id, :status, :employer,:date)";
		$parameters = array( ':applicant'=>$applicant,':jobtitle'=>$emp->jobtitle,':fname'=>$fname,':mname'=>$mname,':lname'=>$lname,':job_id'=>$id , ':status'=>'MATCHED', ':employer'=>$employer,':date'=>$mydate);
		Yii::app()->db->createCommand($sql)->execute($parameters);
	
	}

	public function searchActive(){
		$criteria = new CDbCriteria;
		$criteria->compare('employmentstatus','Actively looking for work',true);

		return new CActiveDataProvider($this,array('criteria'=>$criteria));
	}
	
	/*
		* Search Approved Applicants
	*/
	public function searchApproved()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('applicantemail',$this->applicantemail,true);
	
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('mname',$this->mname,true);

		$criteria->compare('brgy',$this->brgy,true);
		$criteria->compare('municipality',$this->municipality,true);
	
		$criteria->compare('regstatus','APPROVED',true);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
