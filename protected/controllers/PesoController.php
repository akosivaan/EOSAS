<?php

class PesoController extends Controller
{
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
				'actions'=>array('index','view','Create','Announcement','CreateEmail','sendEmail'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('Homepage','admin','Generate','Report','PDF','Update','Delete','Deactivate','JobApplicant','ApplicantReport','UpdatePassword'),
				'roles'=>array('PESO OFFICER'),
			),
			array('allow',
				'actions'=>array('admin'),
				'roles'=>array('Applicant','Employer'),
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
	
	public function actionPDF()
    {
		$model = new ApplicantPlacement;
		$dateFrom = date('Y-m-d',strtotime($_POST['dateFrom']));
		$dateTo = date('Y-m-d',strtotime($_POST['dateTo']));
		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('applicantPlacement')
            ->where("date BETWEEN '$dateFrom' AND '$dateTo'")
            ->queryAll();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-l');
		
		# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		
				$mPDF1->WriteHTML($this->renderPartial('report2', array('query'=>$query, 'dateTo'=>$dateTo, 'dateFrom'=>$dateFrom), true));
				$mPDF1->Output();
	}

	public function actionReport(){
	
		$model = new ApplicantPlacement;
		
		$this->render('report',array(
			'model'=>$model,
		));
	}
	
	public function actionAnnouncement(){
	
		$model = new Trainings;
		$model2 = new Announcements;
		$model3 = new Employment('searchEmployment');
		$model3->unsetAttributes();  // clear any default values
		if(isset($_GET['Employment']))
			$model3->attributes=$_GET['Employment'];
		$this->render('announcements',array(
			'model'=>$model,
			'model2'=>$model2,
			'model3'=>$model3,
		));
	}
	
	public function actionGenerate(){
		$model = new Peso;
		
		$this->render('generate',array(
			'model'=>$model,
		));
	}

	public function ActionApplicantReport(){
		$model = new Applicant;
		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('applicant')
            ->where("employmentstatus = 'Actively looking for work'")
            ->queryAll();
		# You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-l');
		
		# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		
		$mPDF1->WriteHTML($this->renderPartial('report3', array('query'=>$query), true));
		$mPDF1->Output();
	}

	public function ActionJobApplicant(){
		$provider = Applicant::model()->searchActive();
		$this->render('activelyLooking',array('model'=>$provider));
	}

	public function getApplicantName($data,$row){
		$model = Applicant::model()->findByPK($data->username);
		return $model->fname." ".$model->mname." ".$model->lname;
	}
	public function getJobTitle($data,$row){
		$model = Employment::model()->findByPK($data->job_id);
		return $model->jobtitle;
	}
	public function getEmployer($data,$row){
		$employer = Employment::model()->findByPK($data->job_id);
		//$model = Employer::model()->findByPK($employer->username);
		return $employer->companyname;
	}

	public function actionUpdatePassword(){
		$model = new Enter;
		$id = $_GET['id'];
		if(isset($_POST['update'])){
			$old = $_POST['oldpass'];
			$new = $_POST['newpass'];
			$conf = $_POST['confnewpass'];
			if($old == '' || $new == '' || $conf == ''){
				Yii::app()->user->setFlash('error','All fields with * are required');
			}
			else{
				$password = Enter::model()->findByPK($id);
				if(md5($old) != $password->password){
					Yii::app()->user->setFlash('error','Old password does not match');
				}
				else if($old === $new){
					Yii::app()->user->setFlash('error','Please input a new password other than your old password');
				}
				else if($new != $conf){
					Yii::app()->user->setFlash('error','New password must match Confirm New password');
				}
				else{
					$password->password = md5($new);
					$password->conf_password = md5($new);
					$peso = Peso::model()->findByPK($id);
					$peso->password = md5($new);
					if($password->validate() && $peso->validate()){
						if($peso->save() && $password->save()){
						Yii::app()->user->setFlash('success','You have successfully change your password');
						}		
					}
					
				}
			}
		}
		$this->render('updatePassword',array());
	}
	
	public function actionSendEmail()
	{
		$model=new Peso;

		$to = Yii::app()->request->getQuery('id');
		$type = Enter::model()->findByPK($to);
		$from = Yii::app()->session['username'];
		$subject = $_POST['subject'];
		$messages=$_POST['message'];
		
		$mail = new YiiMailer();
		//$message = new YiiMailMessage;
		$mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
        $mail->SMTPAuth = true;
		$mail->SMTPSecure= 'tls';
        $mail->Username = "pesotrial@gmail.com";
		$mail->Password = "somq5sjt3eq";
			
        $mail->setFrom($from, Yii::app()->session['type']);
        $mail->setTo($to);
        $mail->setSubject($subject);
        $mail->setBody($messages);
        /*$message->subject = $subject;
        $message->setBody($messages, 'text/html');                
        $message->addTo($to);
        $message->from = $from; */  
		//$mail->setData(array('message' => $message, 'name' => Yii::app()->session['type']  , 'description' => 'REQUIREMENTS', 'mail' => $mail));
           
        if ($mail->send()) {
        	$type = Yii::app()->session['type'];
			if($type == 'Employer'){
				$this->redirect(Yii::app()->createAbsoluteURL("employer/admin")); 
			}
			else if($type == 'PESO OFFICER'){
				$this->redirect(Yii::app()->createAbsoluteURL("peso/admin"));
			}
			else{
				$this->redirect(Yii::app()->createAbsoluteURL("applicant/admin"));
			}
         }else {
			echo $mail->getError();exit(0);
            Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
		}
	}
	
	public function actionCreateEmail()
	{
		//show the template for the creation email
		$model=new Peso;
		$this->render('sendMail',array(
			'model'=>$model,
		));
	}
	
	public function actionHomepage()
	{
		//show the homepage of the PESO officer
		$model=new Peso;	
		
		$model1= new Employment('search');
		$model1->unsetAttributes();  // clear any default values
		if(isset($_GET['Employment']))
			$model1->attributes=$_GET['Employment'];
			
			
		$model2= new Employer('search');
		$model2->unsetAttributes();  // clear any default values
		if(isset($_GET['Employer']))
			$model2->attributes=$_GET['Employer'];
			
		$model3= new Applicant('search');
		$model3->unsetAttributes();  // clear any default values
		if(isset($_GET['Applicant']))
			$model3->attributes=$_GET['Applicant'];
			
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $id = Yii::app()->request->getQuery('id');
       
        $this->render('homepage',array(
			'model'=>$model,
			'model1'=>$model1,
			'model2'=>$model2,
			'model3'=>$model3,
		));
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
		$model=new Peso;
		if(isset($_POST['username'])){
			$model->username = $_POST["username"];
		}
		else{
			$model->pesoemail = $_POST['Peso']['pesoemail'];
		}
        $model->regstatus="PENDING";
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Peso']))
		{
			$model->attributes=$_POST['Peso'];
			$password = Enter::model()->findByPK($model->username);
        	$model->password = md5($password->password);
			if($model->save()){
				if(Yii::app()->session['type'] == 'PESO OFFICER'){
					$this->redirect(array('/peso/homepage'));
				}
				else{
					$this->redirect(array('/site/page','view'=>'message'));
				}
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
		$model= Peso::model()->findByPK($id);//$this->loadModel($id);
		if(!$model){
			$enter = Enter::model()->findByPK($id)->password;
			$model = new Peso;
			$model->password = $enter;
			$model->username = $id;
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Peso']))
		{
			if($model->validate()){
				$model->attributes=$_POST['Peso'];
				if($model->save()){
					Yii::app()->user->setFlash('success','Successfully updated your Peso Account');
					$this->redirect(array('view','id'=>$model->username));
				}
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
		$dataProvider=new CActiveDataProvider('Peso');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Peso('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Peso']))
			$model->attributes=$_GET['Peso'];
		$type = Yii::app()->session['type'];
		if($type == 'PESO OFFICER')
			$this->render('admin',array(
				'model'=>$model,
			));
		else{
			$this->render('pesoadmin',array(
				'model'=>$model,
			));
		}
	}

	public function getCompanyName($data,$row){
		$name = Employer::model()->findbyPK($data->username);
		return $name->companyname;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Peso the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Peso::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionDeactivate($id){
		$status = Peso::model()->findByPK($id);
		if($status->regstatus == 'APPROVED'){
			Peso::model()->deactivate($id);
			//echo "Pasok deactivate";
			$this->redirect(array('admin'));	//redirect back to  the list  
			//kulang pa ng deactivate ng lahat ng employment na sa kanya 
			}
		else{
			Peso::model()->approve($id);
			$this->redirect(array('admin'));	//redirect back to  the list  
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param Peso $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='peso-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
