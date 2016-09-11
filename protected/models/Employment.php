<?php

/**
 * This is the model class for table "employment".
 *
 * The followings are the available columns in table 'employment':
 * @property string $minEduc
 * @property string $maxeduc
 * @property string $minexp
 * @property string $maxage
 * @property string $minage
 * @property string $sex
 * @property string $maritalstatus
 * @property string $regstatus
 * @property string $username
 * @property string $jobtitle
 * @property string $location
 * @property string $specialization
 * @property string $position
 * @property string $type
 * @property string $description
 * @property string $pic
 * @property string $companyname
 * @property string $min_salary
 * @property string $max_salary
 *
 * The followings are the available model relations:
 * @property Employer $email0
 */
class Employment extends CActiveRecord
{

const SEX_M='M';
	const SEX_F='F';
    const SEX_B='B';
    
    const ME_a='Elementary Grad';
	const ME_b='Attended HS';	
    const ME_c='Graduated HS';
    const ME_d='Attended College';
    const ME_e='Graduated College';
	const ME_f='Not Applicable';
    
    const MS_SINGLE='SINGLE';
	const MS_MARRIED='MARRIED';
    const MS_WIDOWED='WIDOWED';
    const MS_ANY = 'ANY';
	const MS_NOT='N/A';
	
	const Position_All='Any Position Level';
	const Position_CEO='CEO_SVP_AVP_VP_Director';
	const Position_Manager='Asst. Manager_Manager';
	const Position_Supervisor='Supervisor';
	const Position_Employee='Employee';
	
	const T_REGULAR='REGULAR';
	const T_CONTRACTUAL='CONTRACTUAL';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employment the static model class
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
		return 'employment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jobtitle, location, specialization , position ,minage,maxage, type,enddate','required'),
			array('minEduc, maxeduc', 'length', 'max'=>20),
			array('minexp, maxage, minage', 'numerical', 'allowEmpty'=>true,'integerOnly'=>true,'message'=>'{attribute} must be a number.'),
			array('maxage','default','value'=>65),
			array('minage','default','value'=>18),
			array('sex', 'length', 'max'=>1),
			array('maritalstatus', 'length', 'max'=>10),
			array('min_salary,max_salary', 'match','allowEmpty'=>true,'pattern'=>'/^(\d*?)(\.\d{1,2})?$/','message'=>'{attribute} must be in the form 1000 or 1000.00'),
			array('regstatus', 'length', 'max'=>15),
			array('username, jobtitle, type, companyname', 'length', 'max'=>50),
			array('location', 'length', 'max'=>60),
			array('specialization', 'length', 'max'=>100),
			array('position', 'length', 'max'=>40),
			array('description', 'length', 'max'=>10000),
			array('pic', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('minEduc, maxeduc, minexp, maxage, minage, sex, maritalstatus, regstatus, username, jobtitle, location, specialization, position, type, description, pic, companyname, min_salary, max_salary,enddate', 'safe', 'on'=>'search'),
			array('minEduc, maxeduc, minexp, maxage, minage, sex, maritalstatus, regstatus, username, jobtitle, location, specialization, position, type, description, pic, companyname, min_salary, max_salary,enddate', 'safe', 'on'=>'searchManage'),
			array('minEduc, maxeduc, minexp, maxage, minage, sex, maritalstatus, regstatus, username, jobtitle, location, specialization, position, type, description, pic, companyname, min_salary, max_salary,enddate', 'safe', 'on'=>'searchEmployment')
			//array('jobtitle','unique','message'=>'{attribute}:{value} already exists!'),

		);
	}
	
	//function for Sex values
	public function getSex()
	{
			return array(
				self::SEX_M=>'M',
				self::SEX_F=>'F',	
                self::SEX_B=>'B',	
			);
	}
    
	//function for miniimum Education
    public function getMinEduc()
	{
			return array(
				self::ME_a=>'Elementary Grad',
				self::ME_b=>'Attended HS',	
                self::ME_c=>'Graduated HS',
                self::ME_d=>'Attended College',
                self::ME_e=>'Graduated College',
				self::ME_f=>'Not Applicable',
			);
	}
    
	//function for Marital Status
    public function getMS()
	{
			return array(
				self::MS_ANY=>'ANY',
				self::MS_SINGLE=>'SINGLE',
				self::MS_MARRIED=>'MARRIED',
                self::MS_WIDOWED=>'WIDOWED',
				self::MS_NOT=>'N/A',
			);
	}
	
	//function for getting the Type
	public function getType()
	{
			return array(
				self::T_REGULAR=>'REGULAR',
				self::T_CONTRACTUAL=>'CONTRACTUAL',
			);
	}
	
	//function for getting the Position
	public function getPosition()
	{
			return array(
				self::Position_All=>'Any Position Level',
				self::Position_CEO=>'CEO_SVP_AVP_VP_Director',
				self::Position_Manager=>'Asst. Manager_Manager',
				self::Position_Supervisor=>'Supervisor',
				self::Position_Employee=>'Employee',
			);
	}
	
	//function for getting the location of an employment opportunity
	public function getLocation()
    {
		return array(
			array('id'=>'Anywhere','text'=>'Anywhere','group'=>'All Locations'),
            array('id'=>'NCR','text'=>'NCR','group'=>'Philippines'),
			array('id'=>'CAR','text'=>'CAR','group'=>'Philippines'),
			array('id'=>'Ilocos Region','text'=>'Ilocos Region','group'=>'Philippines'),
			array('id'=>'Cagayan Valley','text'=>'Cagayan Valley','group'=>'Philippines'),
			array('id'=>'Central Luzon','text'=>'Central Luzon','group'=>'Philippines'),
			array('id'=>'CALABARZON','text'=>'CALABARZON','group'=>'Philippines'),
			array('id'=>'MIMAROPA','text'=>'MIMAROPA','group'=>'Philippines'),
			array('id'=>'Bicol Region','text'=>'Bicol Region','group'=>'Philippines'),
			array('id'=>'Western Visayas','text'=>'Western Visayas','group'=>'Philippines'),
			array('id'=>'Central Visayas','text'=>'Central Visayas','group'=>'Philippines'),
			array('id'=>'Eastern Visayas','text'=>'Eastern Visayas','group'=>'Philippines'),
			array('id'=>'Zamboanga Peninsula','text'=>'Zamboanga Peninsula','group'=>'Philippines'),
			array('id'=>'Northern Mindanao','text'=>'Northern Mindanao','group'=>'Philippines'),
			array('id'=>'Davao Region','text'=>'Davao Region','group'=>'Philippines'),
			array('id'=>'SOCCSKSARGEN','text'=>'SOCCSKSARGEN','group'=>'Philippines'),
			array('id'=>'Caraga','text'=>'Caraga','group'=>'Philippines'),
			array('id'=>'ARMM','text'=>'ARMM','group'=>'Philippines'),
			array('id'=>'Africa','text'=>'Africa','group'=>'Overseas'),
			array('id'=>'Asia','text'=>'Asia','group'=>'Overseas'),
			array('id'=>'Australia','text'=>'Australia','group'=>'Overseas'),
			array('id'=>'Europe','text'=>'Europe','group'=>'Overseas'),
			
		);
	}
	
	
	//getting the Specialization
	public function getSpecialization()
    {
		$sql = "SELECT COUNT(*) FROM category";
		$numClients = Yii::app()->db->createCommand($sql)->queryScalar();
							$finals=array();
							
		//return array(
							for($i=0; $i<$numClients;$i++){
							$list= Yii::app()->db->createCommand('select * from category')->queryAll();

							$rs=array();
							foreach($list as $item){
								//process each item here
								$rs[]=$item['name'];

							}
								$hi = $rs[$i];
								$sql = "SELECT COUNT(*) FROM specialization where category='$hi'";
								$numSpecial = Yii::app()->db->createCommand($sql)->queryScalar();
								for($j=0; $j<$numSpecial;$j++){
								$specialization= Yii::app()->db->createCommand('select name from specialization where category=:category')->bindValue('category',$hi)->queryAll();
									$sp=array();
									foreach($specialization as $items){
										$sp[]=$items['name'];
									}
									$final= $sp[$j];
									$finals[]=array('id'=>$final,'text'=>$sp[$j],'group'=>$hi);
								}
							
							}
					//	);
					return $finals;
       
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'email0' => array(self::BELONGS_TO, 'Employer', 'username'),
			'matches'=>array(self::HAS_MANY,'Matches','job_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'minEduc' => 'Minimum Education',
			'maxeduc' => 'Maximum Education',
			'minexp' => 'Minimum Experience',
			'maxage' => 'Maximum Age',
			'minage' => 'Minimum Age',
			'sex' => 'Sex',
			'maritalstatus' => 'Marital Status',
			'regstatus' => 'Registration Status',
			'username' => 'Username',
			'jobtitle' => 'Job Title',
			'location' => 'Location',
			'specialization' => 'Specialization',
			'position' => 'Position',
			'min_salary' => 'Minimum Salary (pesos)',
			'max_salary' => 'Maximum Salary (pesos)',
			'type' => 'Type',
			'description' => 'Description',
			'pic' => 'Pic',
			'companyname' => 'Company Name',
			'enddate'=>'Post Expiration Date'
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

		$criteria->compare('minEduc',$this->minEduc,true);
		$criteria->compare('maxeduc',$this->maxeduc,true);
		//$criteria->compare('minexp',$this->minexp,true);
		//$criteria->compare('maxage',$this->maxage,true);
		//$criteria->compare('minage',$this->minage,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('maritalstatus',$this->maritalstatus,true);
		$criteria->compare('regstatus',$this->regstatus,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('min_salary',$this->min_salary,true);
		$criteria->compare('max_salary',$this->max_salary,true);
		$criteria->compare('enddate',$this->enddate,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/*
		* Search all employment opportunities (approved)
		* for all users
	*/
	public function searchAll()
	{
		//function to search All Approved Employmement Opportunities
		//search view for applicant and visitor 
		
		$criteria=new CDbCriteria;
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('regstatus','APPROVED',true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('specialization',$this->specialization,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
	
	/*
		* Approving an employment opportunity
	*/
	public function approve($id){
		$user = Yii::app()->db->createCommand()
					->update('employment', array(
					'regstatus'=>'APPROVED',
			   ),  'id=:id', array(':id'=>$id) );
	}	

	/*
		*To deactivate an employment opportunity
	*/
	public function deactivate($id){
		$user = Yii::app()->db->createCommand()
					->update('employment', array(
					'regstatus'=>'DEACTIVATED',
			   ),  'id=:id', array(':id'=>$id) );
	}

	/*
		*on hold employment opportunity
	*/
	public function hold($id){
		$user = Yii::app()->db->createCommand()
					->update('employment', array(
					'regstatus'=>'ON HOLD',
			   ),  'id=:id', array(':id'=>$id) );
	}	
	
	/*
		* Search PENDING employment opportunities
	*/
	public function searchPENDING()
	{
		//function to search All Approved Employmement Opportunities
		//search view for applicant and visitor 
		
		$criteria=new CDbCriteria;		
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('regstatus','PENDING',true);
		$criteria->compare('type',$this->type,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}

	public function searchEmployment(){
		$criteria=new CDbCriteria;	
		$date = new CDbExpression("Now()");	
		$criteria->addCondition('enddate > '.$date);
		$criteria->compare('regstatus','APPROVED',true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('minEduc',$this->minEduc,true);
		$criteria->compare('maxeduc',$this->maxeduc,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('maritalstatus',$this->maritalstatus,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('min_salary',$this->min_salary,true);
		$criteria->compare('max_salary',$this->max_salary,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
	
	//employment na sa kanya either kung anong status man un
	public function searchManage()
	{
		//function to search All Approved Employmement Opportunities
		//search view for applicant and visitor 
		$username = Yii::app()->session['username'];
		$criteria=new CDbCriteria;
		$criteria->compare('username',$username,true);
		$criteria->compare('minEduc',$this->minEduc,true);
		$criteria->compare('maxeduc',$this->maxeduc,true);
		//$criteria->compare('minexp',$this->minexp,true);
		//$criteria->compare('maxage',$this->maxage,true);
		//$criteria->compare('minage',$this->minage,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('maritalstatus',$this->maritalstatus,true);
		$criteria->compare('regstatus',$this->regstatus,true);
		//$criteria->compare('username',$this->username,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('min_salary',$this->min_salary,true);
		$criteria->compare('max_salary',$this->max_salary,true);
		$criteria->compare('enddate',$this->enddate,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
	
	//employment opportunities nya na pending pa
	public function searchPendingMatched(){
		$username = Yii::app()->session['username'];
		$criteria=new CDbCriteria;
		$criteria->compare('username',$username,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('regstatus','PENDING',true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('position',$this->position,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));	
	}
	
	/*
		*Function of a PESO officer
		*to deactivate an employer
	*/
	public function deactivatedEmployer($id){
		
			$i=0;
			$emp = Yii::app()->db->createCommand('select id from employment where username=:username')->bindValue('username',$id)->queryAll();
			$sp=array();
			foreach($emp as $items){
				//process each item here
				$sp[$i]=$items['id'];
				
				$user = Yii::app()->db->createCommand()
					->update('employment', array(
					'regstatus'=>'DEACTIVATED',
				), 'id=:id', array(':id'=>$sp[$i]) );
			   
			   
				$i++;
			}
			
		
	}
	
}
