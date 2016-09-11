<?php

class EmploymentController extends Controller
{

	public $userid;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view' , 'Specialization' , 'admin' , 'Employment' , 'Deactivate' , 'Approve'
				, 'DeactivateEmployer' , 'VisitorSearch' , 'Matched' , 'Report' , 'PDF','applicantList','selectJob','setApplicantsJob','applicantPDF','approveList','approvePDF'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	//Id of the job opportunities
	public function actionapplicantList($id){

		$matches = new Matches;
		$matches->unsetAttributes();  // clear any default values
		if(isset($_GET['Matches']))
			$matches->attributes=$_GET['Matches'];

		$this->render('applicantListAll',array('model'=>$matches,'myid'=>$id));
		
	}

	public function actionApproveList($id){
		$matches = new Matches;
		$matches->unsetAttributes();  // clear any default values
		if(isset($_GET['Matches']))
			$matches->attributes=$_GET['Matches'];
		$this->render('approveList',array('model'=>$matches,'myid'=>$id));
	}

	public function actionApprovePDF($id){
		$job = Employment::model()->findByPK($id);
		$matches = Yii::app()->db->createCommand()->select('*')->from('matches')->where("job_id = '$id' AND status = 'ACCEPTED'")->queryAll();
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-l');
		
		# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		
				$mPDF1->WriteHTML($this->renderPartial('approveApplicantList', array('query'=>$matches,'job'=>$job), true));
				$mPDF1->Output();
	}

	public function getContact($data,$row){
		$applicant = Applicant::model()->findByPK($data->applicant);
		return $applicant->contactNo;
	}

	public function getEmail($data,$row){
		$applicant = Applicant::model()->findByPK($data->applicant);
		return $applicant->applicantemail;
	}

	public function actionApplicantPDF($id){
		$job = Employment::model()->findByPK($id);
		$matches = Yii::app()->db->createCommand()->select('*')->from('matches')->where("job_id = '$id' AND status = 'MATCHED'")->queryAll();
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-l');
		
		# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		
				$mPDF1->WriteHTML($this->renderPartial('applicantList', array('query'=>$matches,'job'=>$job), true));
				$mPDF1->Output();
	}

	public function getCurrency($value){
		if($value){
			return Yii::app()->numberFormatter->formatCurrency($value, "PHP");
		}
		else{
			return '';
		}
	}
	
	/*
		* generate a pdf of the list of  all employment opportunities
		* generate2 = view of the pdf to be generated
	*/
	public function actionPDF()
    {
		$model = new Employment;
		$dateFrom = date('Y-m-d',strtotime($_POST['dateFrom']));
		$dateTo = date('Y-m-d',strtotime($_POST['dateTo']));
		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('employment')
            ->where("date BETWEEN '$dateFrom' AND '$dateTo'")
            ->queryAll();
		# You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-l');
		
		# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		
				$mPDF1->WriteHTML($this->renderPartial('generate2', array('query'=>$query,'dateFrom'=>$dateFrom,'dateTo'=>$dateTo), true));
				$mPDF1->Output();
	}
	
	/*
		* Shows the PESO officer the form of the file to be generated
	*/
	public function actionReport(){
		
		$model = new Employment;
		
		$this->render('generate',array(
			'model'=>$model,
		));
	}
	
	/*
		* Action to determine which employment opportunities matched the applicants
	*/
	public function actionMatched()
	{
		//function to get matched employment opportunities to the applicant
		$model = new Applicant;
		
		$id = Yii::app()->session['username']; //get the currently registered applicant
		$data = $model->getMatched($id);	//call to the employment model
		
		$i=0;
		$criteria=new CDbCriteria();
		$date = date('Y-m-d');	
		foreach($data as $need)
		{
			$jobtitle[$i] = $need['jobtitle'];
			$criteria->compare('jobtitle',$jobtitle[$i],true,'OR');
			$criteria->addColumnCondition(array('regstatus'=>'APPROVED'),'AND');
			$criteria->addCondition("enddate > '$date'");
			$i++;
		}
		//$criteria->compare('jobtitle', $jobtitle[$i] ,true);
		//echo $criteria->condition;
		
		//$criteria->condition="jobtitle = '" . $jobtitle[$i] . "' and regstatus = 'APPROVED' and enddate > '$date'";
		
			
		$dataProvider=new CActiveDataProvider('Employment', array('criteria' => $criteria,'pagination' => array('pageSize' => 3)));
		$this->render('employmentindex',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSelectJob($id){
		$this->userid = $id;

		$model = new Employment;
		$this->render('selectJob',array(
			'model'=>$model,
		));
	}

	public function actionSetApplicantsJob($id,$userid){
		$placement = new ApplicantPlacement;
		$matches = new Matches;
		$date = date('m-d-Y');
		$match = Matches::model()->findByAttributes(array('job_id'=>$id,'applicant'=>$userid));
		if($match){
			echo "Enter here";
			$match->date = $date;
			$match->status = "ACCEPTED";
		}
		else{
			$employer = Employment::model()->findByPK($id);
			$stat = "ACCEPTED";
			$app = Applicant::model()->findByAttributes(array('username'=>$userid));
			$fname = $app->fname;
			$mname = $app->mname;
			$lname = $app->lname;
			/*$matches->date = $date;
			$matches->jobtitle = $employer->jobtitle;
			$matches->fname = $fname;
			$matches->mname = $mname;
			$matches->lname = $lname;
			$matches->job_id = $id;
			$matches->applicant = $userid;
			$matches->employer = $employer->username;
			$matches->save();*/
			$sql = "insert into matches (date,jobtitle,fname,mname,lname,status,job_id,applicant,employer ) 
							values (:date, :jobtitle,:fname,:mname,:lname,:status,:job_id,:applicant,:employer )";
			$parameters = array( ':date'=>$date,':jobtitle'=>$employer->jobtitle,':fname'=>$fname,':mname'=>$mname,':lname'=>$lname,':status'=>$stat,':job_id'=>$id,':applicant'=>$userid,':employer'=>$employer->username);
			var_dump($parameters);
			Yii::app()->db->createCommand($sql)->execute($parameters);
		}
		$placement->date = $date;
		$placement->job_id=$id;
		$placement->username=$userid;
		$placement->save();
		Yii::app()->user->setFlash('success','You have successfully placed an applicant to an employment opportunity');
		$this->redirect(array('peso/report'));
	}
	
	/*
		* Action showing all the approve employment opportunities
		* Visitor Search => view for all the users showing the list of approve employment opportunities
	*/
	public function actionVisitorSearch()
	{
		//view of employment opportunities for all
		$model=new Employment('searchEmployment');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employment']))
			$model->attributes=$_GET['Employment'];

		$this->render('adminAll',array(
			'model'=>$model,
		));
	}
	
	/*
		* Deactivate or Activate an Employment Opportunity
		* Action initiated by the employer who created the job
	*/
	public function actionDeactivateEmployer($id){
		$status = Employment::model()->findByPK($id);
		if($status->regstatus == 'ON HOLD'){
			Employment::model()->approve($id);
			Yii::app()->user->setFlash('success','You have successfully activate an employment opportunity');
			$this->redirect(array('admin'));	//redirect back to  the list  
			//kulang pa ng deactivate ng lahat ng employment na sa kanya 
		}
		else{
			if($status->regstatus != 'PENDING'){
				Yii::app()->user->setFlash('success','You have successfully set on hold an employment opportunity');
				Employment::model()->hold($id);
			}
			$this->redirect(array('admin'));	//redirect back to  the list  
		}
	}
	
	/*
		* Approve an employment opportunity
		* Action initiated by the PESO Officer
	*/
	public function actionApprove($id){
		Employment::model()->approve($id);
		Yii::app()->user->setFlash('success','You have successfully approved an employment opportunity');
		$this->redirect(array('peso/homepage'));
	}
	
	/*	
		* Deactivate an employment opportunity
		* Action initiated by the PESO officer
	*/
	public function actionDeactivate($id){
		$status = Employment::model()->findByPK($id);
		if($status->regstatus == 'APPROVED'){
			Yii::app()->user->setFlash('success','You have successfully deactivated an employment opportunity');
			Employment::model()->deactivate($id);
			$this->redirect(array('admin'));	//redirect back to  the list  
			}
		else{
			Yii::app()->user->setFlash('success','You have successfully approved an employment opportunity');
			Employment::model()->approve($id);
			$this->redirect(array('admin'));	//redirect back to  the list  
		}
	}
	
	/*
		* Approve or deactivate an employment opportunity 
	*/
	public function actionEmployment()
	{
		//action by the PESO officer 
		//approve or deactivate ans employment opportunity
		$id = Yii::app()->request->getQuery('id');
		$id = str_replace('_', ' ', $id);
        if(isset($_POST["approve"])){
        	
			Employment::model()->approve($id);
			Yii::app()->user->setFlash('success','You have successfully approved an employment opportunity');
			$this->redirect(array('admin'));
        }
        else{	
		/*	$delete=employment::model()->findByPk($id); 	// find the data using the primary key
			$delete->delete(); 								// delete the row from the database table    */
			Yii::app()->user->setFlash('success','You have successfully deactivated an employment opportunity');
			Employment::model()->deactivate($id);
			$this->redirect(array('admin'));	//redirect back to  the list
        }
    }
	
	/*
		* $id = id
		* Shows the list of employment opportunities that have specialization=id
	*/
	public function actionSpecialization()
	{
		//function to get the employment having matched specialization
		//with the list of all employments
		//used for search in the main page
		
		$model = new Employment;
		
		$id = Yii::app()->request->getQuery('id');
		$criteria=new CDbCriteria();
		$now = new CDbExpression("NOW()");
		$criteria->compare('specialization', $id ,true);
		$criteria->compare('regstatus', 'APPROVED' ,true);
		$criteria->addCondition('enddate > '.$now);
		$dataProvider=new CActiveDataProvider('Employment', array('criteria' => $criteria));
		
		$this->render('index',array('dataProvider'=>$dataProvider,));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Employment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employment']))
		{
			
			
			$model->regstatus="PENDING";		
			//automatically set status of an employment to PENDING upon creation
			$pk = $_GET['id'];
			$model->username= $pk;
			$model->attributes=$_POST['Employment'];
			$status = Employer::model()->findByPK($pk);
			$model->date = date('m-d-Y');
			$model->companyname = $status->companyname; 
			if(Yii::app()->session['type'] == 'PESO OFFICER'){
				$model->regstatus = 'APPROVED';
			}
			if($model->save()){
				Yii::app()->user->setFlash('success','You have successfully post an employment opportunity');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employment']))
		{
			$model->attributes=$_POST['Employment'];
			if($model->save()){
				Yii::app()->user->setFlash('success','You have successfully updated your Employment Details');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Employment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Employment('searchManage');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employment']))
			$model->attributes=$_GET['Employment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employment::model()->findByPK($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}
