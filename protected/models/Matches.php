<?php

/**
 * This is the model class for table "matches".
 *
 * The followings are the available columns in table 'matches':
 * @property string $applicant
 * @property integer $job_id
 * @property string $status
 * @property string $id
 * @property string $employer
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $jobtitle
 */
class Matches extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Matches the static model class
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
		return 'matches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('applicant, employer,fname,mname,lname', 'length', 'max'=>50),
			array('jobtitle','length','max'=>100),
			array('status', 'length', 'max'=>15),
			//array('id', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('applicant, job_id, status, id, employer,fname,mname,lname,jobtitle', 'safe', 'on'=>'search'),
			//array('applicant, job_id, status, id, employer,fname,mname,lname,jobtitle', 'safe', 'on'=>'searchApplicant'),
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
			'job'=>array(self::BELONGS_TO, 'Employment', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'applicant' => 'Applicant',
			'job_id' => 'Job',
			'status' => 'Status',
			'id' => 'ID',
			'employer' => 'Employer',
			'fname' =>'First Name',
			'mname' => 'Middle Name',
			'lname'=> 'Last Name',
			'jobtitle'=>'Job Title',
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

		$criteria->compare('applicant',$this->applicant,true);
		$criteria->compare('job_id',$this->job_id,true);
		$criteria->compare('status','APPROVED',true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchApplicant($id){
		$criteria = new CDbCriteria;
		$criteria->addCondition('job_id = '.$id);
		$criteria->compare('status','MATCHED',true);
		$criteria->compare('applicant',$this->applicant,true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		return new CActiveDataProvider($this,array('criteria'=>$criteria));
	}

	public function searchApproveApplicant($id){
		$criteria = new CDbCriteria;
		$criteria->addCondition('job_id = '.$id);
		$criteria->compare('status','ACCEPTED',true);
		$criteria->compare('applicant',$this->applicant,true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		return new CActiveDataProvider($this,array('criteria'=>$criteria));
	}
	
	public function matchess()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$id = Yii::app()->session['username'];
		$criteria = new CDbCriteria;
		$criteria->compare('applicant',$this->applicant,true);
		$criteria->compare('job_id',$this->job_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('employer',$id,true);
		$criteria->compare('id',$this->id,true);
		//$criteria->compare('fname',$this->fname,true);
		//$criteria->compare('mname',$this->mname,true);
		//$criteria->compare('lname',$this->lname,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function approve($a , $b){
		//$b = str_replace("+" , " " , $b);
		$date = date('m-d-Y');
		$user = Yii::app()->db->createCommand()
					->update('matches', array(
					'status'=>'ACCEPTED','date'=>$date,
			   ),  'applicant=:applicant and job_id=:job_id', array(':applicant'=>$a , ':job_id'=>$b));
	}
	
	
}