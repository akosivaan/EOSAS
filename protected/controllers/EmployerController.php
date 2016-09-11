<?php

class EmployerController extends Controller
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
				'actions'=>array('index','view','admin','create'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('PDF','Report','Approve','Deactivate','Edit','Delete'),
				'roles'=>array('PESO OFFICER'),
			),
			array('allow',
				'actions'=>array('Approves','Homepage','Edit','Admin','Update','updatePassword'),
				'roles'=>array('Employer'),
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
					$peso = Employer::model()->findByPK($id);
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
	
	
	/*
		* action performed by a employer
		* approve applicant
		* $id = id of applicant to be approved
		* matches table for applicant that are matched to the employer		
	*/
	public function actionApproves(){
		$id = $_POST['applicant'];
		$job = $_POST['job'];
		Matches::model()->approve($id, $job);
		$email = $_POST['empemail'];
		/*Insert new applicant placement here code!*/
		$date = date('m-d-Y');
		$model = new ApplicantPlacement;
		$model->job_id = $job;
		$model->username = $id;
		$model->date = $date;
		if($model->save()){
			Yii::app()->user->setFlash('success','You have successfully approved an applicant to your company');
		}
		/*create an execute sql insert command here to insert in applicantPlacement Command!*/
		$this->redirect(array('employment/applicantList','id'=>$job));
		
	}
	
	/*
		*Generate pdf file of all employers
		*generate2 = format of file to be generated 
	*/
	public function actionPDF()
    {
		$model = new Employer;
		//# You can easily override default constructor's params
		$dateFrom = date('Y-m-d',strtotime($_POST['dateFrom']));
		$dateTo = date('Y-m-d',strtotime($_POST['dateTo']));
		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('employer')
            ->where("date BETWEEN '$dateFrom' AND '$dateTo'")
            ->queryAll();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-l');
		//# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		$mPDF1->WriteHTML($this->renderPartial('generate2', array('query'=>$query,'dateFrom'=>$dateFrom,'dateTo'=>$dateTo), true));
		$mPDF1->Output();
	}
	
	/*
		* action called by the PESO controller
		* shows the peso the format of file to be generated
	*/
	public function actionReport(){
		
		$model = new Employer;
		
		$this->render('generate',array(
			'model'=>$model,
		));
	}
	
	/*
		* Generates the homepage for the employer
		* Employment = model for the employment
	*/
	public function actionHomepage()
	{
		$model=new Employer;
		$model1 = new Employment('search');
		$model1->unsetAttributes();  // clear any default values
		if(isset($_GET['Employment']))
			$model1->attributes=$_GET['Employment'];
	
        $id = Yii::app()->request->getQuery('id');
        $this->render('homepage',array(
			'model'=>$model,
			'model1'=>$model1,
		));
	}
	
	/*
		* action initiated by the peso 
		* Approve an employer
	*/
	public function actionApprove($id){
		Employer::model()->approve($id);
		Yii::app()->user->setFlash('success','You have successfully approved an employer');
		$this->redirect(array('peso/homepage'));
	}
	
	/*
		* action to be initiated by the peso officer
		* deactivate an account of the employer
	*/
	public function actionDeactivate($id){
		$status = Employer::model()->findByPK($id);
		if($status->regstatus == 'APPROVED'){
			Employer::model()->deactivate($id);
			Employment::model()->deactivatedEmployer($id);
			Yii::app()->user->setFlash('success','You have successfully deactivate an employer account');
			$this->redirect(array('admin'));	//redirect back to  the list  
			}
		else{
			Employer::model()->approve($id);
			Yii::app()->user->setFlash('success','You have successfully approved an employer');
			$this->redirect(array('admin'));	//redirect back to  the list  
		}
	}

	/*
		* Activate or Deactivate an employer based on the selected button
	*/
	public function actionEdit()
	{
		//approve or deactivate an employment opportunity
        $id = Yii::app()->request->getQuery('id');
        if(isset($_POST["approve"])){
            $status = Enter::model()->findByPK($id);
			if($status->type == 'Employer'){
				Employer::model()->approve($id);
				Yii::app()->user->setFlash('success','You have successfully activate an employment opportunity');
				$this->redirect(array('admin'));
			}
        }
        else{
            $status = Enter::model()->findByPK($id);
			if($status->type == 'Employer'){
			/*	$count = employment::Model()->count("email=:email", array("email" => $id));
				if($count > 0){
					while($count!=0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					employment::model()->deleteAll($criteria);
					$count--;
					}
				}
				$delete=employer::model()->findByPk($id); 	// find the data using the primary key
				$delete->delete(); 							// delete the row from the database table
				
				$delete=enter::model()->findByPk($id); 	// find the data using the primary key
				$delete->delete(); 							// delete the row from the database table
			}*/
			Employer::model()->deactivate($id);
			Employment::model()->deactivatedEmployer($id);
			Yii::app()->user->setFlash('success','You have successfully deactivate an employment opportunity');
			$this->redirect(array('admin'));	//redirect back to  the list   
        }
		}
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
		$model=new Employer;

		
		if(isset($_POST['username'])){
			$id = $_POST["username"];
		}
		else{
			$id = $_POST['Employer']['username'];
		}
		$password = Enter::model()->findByPK($id);
		$model->username = $id;
        $model->password = md5($password->password);
        $model->regstatus = "PENDING";
		
		// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Employer']))
			{
				$model->attributes=$_POST['Employer'];
				if(Yii::app()->session['type'] == "PESO OFFICER")
					$model->regstatus = 'APPROVED';
				$model->date = date('m-d-Y');
				if($model->save()){
					if(Yii::app()->session['type'] == "PESO OFFICER"){
						Yii::app()->user->setFlash('success','You have successfully encoded an employer');
						$this->redirect(array('enter/create'));
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
		$model=Employer::model()->findByPK($id);//$this->loadModel($id);
		if(!$model){
			$enter = Enter::model()->findByPK($id)->password;
			$model = new Employer;
			$model->password = $enter;
			$model->username = $id;
			$model->date = date('Y-m-d');
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employer']))
		{
			$model->attributes=$_POST['Employer'];
			if($model->save()){
				Yii::app()->user->setFlash('success','Successfully updated your Employer account');
				$this->redirect(array('view','id'=>$model->username));
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
		$dataProvider=new CActiveDataProvider('Employer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Employer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employer']))
			$model->attributes=$_GET['Employer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employer::model()->findByPK($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
