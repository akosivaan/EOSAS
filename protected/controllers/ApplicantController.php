<?php

class ApplicantController extends Controller
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
				'actions'=>array('index','View', 'create','admin' ,'ApplicantEduc' , 'ApplicantWorkExp' , 'Applicantlicence', 'ApplicantTrain' , 'ApplicantLast2Years' , 'ApplicantSkill' , 'Applicantlanguagespoken',
				'Applicantlanguageknown' , 'ApplicantDis' , 'views' , 'view2'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('PDF','Report','Deactivate','AApp','Delete'),
				'roles'=>array('PESO OFFICER'),
				),
			array('allow',
				'actions'=>array('Employer','employerSearch'),
				'roles'=>array('Employer'),
				),
			array('allow',
				'actions'=>array('Apply','Homepage','Update','Applicantlanguageknown','Applicantlanguagespoken','Applicantlicence','Applicantdisability','ApplicantSkill','ApplicantDis','ApplicantEduc','ApplicantWorkExp','ApplicantTrain','ApplicantLast2Years','UpdateEducationalAttainment','updateSkills','updateLicenses','updateTrain','updateLanguageKnown','updateLanguageSpoken','updateWorkExp','updateDisability','updateLast2Years','updatePassword'),
				'roles'=>array('Applicant'),
				),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/*
		* Approve applicants that apply to an employer's job post
		* Employer who posted the employment opportunity applied by the applicant
	*/
	public function actionEmployer(){
		$model = new Applicant;
		$model1=new Matches('search');
		$model1->unsetAttributes();  // clear any default values
		if(isset($_GET['Matches'])){
			$model1->attributes=$_GET['Matches'];
		}
		$this->render('employerManage',array(
			'model'=>$model1,		
		));
	}
	public function getJobTitle($data,$row){
		$model = Employment::model()->findByPK($data->job_id);
		return $model->jobtitle;
	}

	public function getApplicantName($data,$row){
		$model = Applicant::model()->findByPK($data->applicant);
		return $model->fname." ".$model->mname." ".$model->lname;
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
					$peso = Applicant::model()->findByPK($id);
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
		* Action to generate a PDF
	*/
	public function actionPDF()
    {
		$model = new Applicant;
		$dateFrom = date('Y-m-d',strtotime($_POST['dateFrom']));
		$dateTo = date('Y-m-d',strtotime($_POST['dateTo']));
		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('applicant')
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
		*redirects to the view that shows the interface for generating a report
	*/
	public function actionReport(){
		$model = new Applicant;
		$this->render('generate',array(
			'model'=>$model,
		));
	}
	
	/*
		*Produces All the matched employment Opportunities
	*/
	public function actionApply($id){
		$model = new Applicant;
		$username = $_POST['companyname'];
		$model->insertMatch($id , $username);
		//may kulang pa pano kung nakalagay na..
		Yii::app()->user->setFlash('success','You have applied for an employment opportunity');
		$this->redirect(array('employment/matched'));	//redirect back to  the list  
		
	}
	
	/*
		*action to redirect to  the Applicant Homepage
	*/
	public function actionHomepage()
	{
		//shows the  homepage of the applicant
		$model=new Applicant;
		$model1= new Trainings('search');
		$model1->unsetAttributes();  // clear any default values
		if(isset($_GET['Trainings']))
			$model1->attributes=$_GET['Trainings'];

		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $id = Yii::app()->request->getQuery('id');
      
        $this->render('homepage',array(
			'model'=>$model,
			'model1'=>$model1,
		));
	}
	
	
	public function actionemployerSearch()
	{
		//view of list of applicants for the employer
		$model=new Applicant('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Applicant']))
			$model->attributes=$_GET['Applicant'];

		$this->render('employerSearch',array(
			'model'=>$model,
		));
	}

	public function actionDeactivate($id){
		$status = Applicant::model()->findByPK($id);
		if($status->regstatus == 'APPROVED'){
			Applicant::model()->deactivate($id);
			Yii::app()->user->setFlash('success','You have successfully deactivated an applicant');
			$this->redirect(array('admin'));	//redirect back to  the list  
			//kulang pa ng deactivate ng lahat ng employment na sa kanya 
			}
		else if($status->regstatus == 'PENDING'){
			Yii::app()->user->setFlash('success','You have successfully approved an applicant');
			Applicant::model()->approve($id);
			$this->redirect(array('admin'));	
		}
		else{
			Applicant::model()->approve($id);
			Yii::app()->user->setFlash('success','You have successfully approved an applicant');
			$this->redirect(array('admin'));	//redirect back to  the list  
		}
			
	}
	
	public function actionAApp(){		
		//approve or delete an applicant
		//can only be done by a PESO officer
		$id = Yii::app()->request->getQuery('id');
        if(isset($_POST["approve"])){
				/*$pin = $_POST['ewan'];					//the pin given by the PESO officer to the applicant
				$user = Yii::app()->db->createCommand()
					->update('applicant', array(
					'pin'=> $pin,
			   ),  'applicantemail=:applicantemail', array(':applicantemail'=>$id) );
			   */
				//$app = Applicant::model()->findByPK($id);
				Yii::app()->user->setFlash('success','You have successfully approved an applicant');
				Applicant::model()->approve($id);
				$this->redirect(array('admin'));
		}
		else{
			/*
				//unahin muna idelete ung mga dependent
				//$count = applicantdisability::Model()->count("email=:email", array("email" => $id));	
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantdisability::model()->deleteAll($criteria);
				//}
				//$count = applicantlanguagespoken::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantlanguagespoken::model()->deleteAll($criteria);
				//}
				//$count = applicantlanguageknown::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantlanguageknown::model()->deleteAll($criteria);
				//}
				//$count = applicantEduc::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantEduc::model()->deleteAll($criteria);
				//}
				//$count = applicantLast2Years::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantLast2Years::model()->deleteAll($criteria);
				//}
				//$count = applicantlicence::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantlicence::model()->deleteAll($criteria);
				//}
				//$count = applicantSkill::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantSkill::model()->deleteAll($criteria);
				//}
				//$count = applicantTrain::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantTrain::model()->deleteAll($criteria);
				//}
				//$count = applicantWorkExp::Model()->count("email=:email", array("email" => $id));
				//if($count > 0){
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('email',$id);
					applicantWorkExp::model()->deleteAll($criteria);
				//}
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('applicantemail',$id);
					applicant::model()->deleteAll($criteria);
					
					$criteria = new CDbCriteria;
					$criteria->addSearchCondition('enteremail',$id);
					enter::model()->deleteAll($criteria);*/
				//$app = Applicant::model()->findByPK($id);
				Applicant::model()->deactivate($id);
				Yii::app()->user->setFlash('success','You have successfully deactivated an applicant');
				$this->redirect(array('admin'));
		}
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$educ = ApplicantEduc::model()->findByAttributes(array('username'=>$id));
		$langs = ApplicantLanguageSpoken::model()->findAll(
                  array(
                      'condition'=>'username = :username',
                      'params'=>array(':username' => $id)
                  )
              );
		$li = ApplicantLicence::model()->findAllByAttributes(array('username'=>$id));
		$ly = ApplicantLast2Years::model()->findByAttributes(array('username'=>$id));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'model2'=>$educ,
			'model3'=>$langs,
			'model4'=>$li,
			'model5'=>$ly,
		));
	}
	
	public function actionView2($id)
	{	
		$educ = ApplicantEduc::model()->findByAttributes(array('username'=>$id));
		$langs = ApplicantLanguageSpoken::model()->findAll(
                  array(
                      'condition'=>'username = :username',
                      'params'=>array(':username' => $id)
                  )
              );
		$li = ApplicantLicence::model()->findAllByAttributes(array('username'=>$id));
		$ly = ApplicantLast2Years::model()->findByAttributes(array('username'=>$id));
		$this->render('view2',array(
			'model'=>$this->loadModel($id),
			'model2'=>$educ,
			'model3'=>$langs,
			'model4'=>$li,
			'model5'=>$ly,
		));
	}
	
	public function actionViews($id , $job)
	{
		$educ = ApplicantEduc::model()->findByAttributes(array('username'=>$id));
		$langs = ApplicantLanguageSpoken::model()->findAll(
                  array(
                      'condition'=>'username = :username',
                      'params'=>array(':username' => $id)
                  )
              );
		$li = ApplicantLicence::model()->findAllByAttributes(array('username'=>$id));
		$ly = ApplicantLast2Years::model()->findByAttributes(array('username'=>$id));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'job'=>$job,
			'model2' => $educ,
			'model3' => $langs,
			'model4'=>$li,
			'model5'=>$ly,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Applicant;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['username'])){
			$id = $_POST['username'];
		}
		else{
			$id = $_POST['Applicant']['username'];
		}
		$password = Enter::model()->findByPK($id);
		$model->username = $id;
        $model->password = md5($password->password);
        $model->regstatus = "PENDING";
		
		if(isset($_POST['Applicant']))
		{
			$model->attributes=$_POST['Applicant'];
			if(Yii::app()->session['type'] == 'PESO OFFICER')
				$model->regstatus = 'APPROVED';
			$model->date = date('m-d-Y');
			if($model->save())
				$this->redirect(array('applicantlanguagespoken','id'=>$model->username));
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
		$model=Applicant::model()->findByPK($id);//$this->loadModel($id);
		if(!$model){
			$enter = Enter::model()->findByPK($id)->password;
			$model = new Applicant;
			$model->password = $enter;
			$model->username = $id;
			$model->date = date('Y-m-d');
		}
		//$model = Applicant::model()->findByPK($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Applicant']))
		{
			$model->attributes=$_POST['Applicant'];
			if($model->save()){
				//$this->redirect(array('applicantlanguagespoken','username'=>$model->username));
				$this->redirect(array('updateLanguageSpoken','username'=>$model->username));
			}
				//$this->redirect(array('view','id'=>$model->applicantemail));
				
		}
		//echo "I enter here";
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
		$dataProvider=new CActiveDataProvider('Applicant');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Applicant('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Applicant']))
			$model->attributes=$_GET['Applicant'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Applicant the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Applicant::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Applicant $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionApplicantEduc()
	{
		$model=new ApplicantEduc;

				// uncomment the following code to enable ajax-based validation
				/*
				if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-educ-applicantEduc-form')
					{
							echo CActiveForm::validate($model);
						Yii::app()->end();
						}
				*/
		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;
			if(isset($_POST['ApplicantEduc']))
			{
				$model->attributes=$_POST['ApplicantEduc'];
				if($model->validate())
				{
					// form inputs are valid, do something here
					if($model->save())
					$this->redirect(array('applicantWorkExp','id'=>$model->username));     
				}
			}
		$this->render('applicantEduc',array('model'=>$model));
	}
	
	public function actionApplicantLast2Years()
	{
		$model=new ApplicantLast2Years;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-last2-years-applicantLast2Years-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;
		
		if(isset($_POST['ApplicantLast2Years']))
		{
			$model->attributes=$_POST['ApplicantLast2Years'];
			if($model->validate())
			{
				if($model->save()){
					if(Yii::app()->session['type'] == 'PESO OFFICER'){
						$this->redirect(array('applicantSkill','id'=>$model->username));
					}
					else{
						 $this->redirect(array('applicantSkill','id'=>$model->username)); 
						//$this->redirect(array('/site/page','view'=>'message'));
					}
				}
					
                   
			}
		}
		$this->render('applicantLast2Years',array('model'=>$model));
	}

	public function actionApplicantlicence()
	{
		$model=new ApplicantLicence;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-licence-applicantlicence-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;
		
		if(isset($_POST['Applicantlicence']))
		{
			$model->attributes=$_POST['Applicantlicence'];
			if($model->validate())
			{
				if($model->save()){
					if(isset($_POST['title']) && isset($_POST['date'])){
	                    $title = $_POST['title'];
						$date = $_POST['date'];
						$arrlength=count($title);
						for($i=0; $i<$arrlength;$i++){
							if($date[$i] == ""){
								$date[$i] = "01/01/0001";
							}
							$sql = "insert into Applicantlicence (title,expdate, username ) 
									values (:title, :expdate , :username )";
							$parameters = array( ':title'=>$title[$i], ':expdate'=>$date[$i], ':username'=>$id);
							Yii::app()->db->createCommand($sql)->execute($parameters);
						}
					}
                    $this->redirect(array('applicantTrain','id'=>$model->username)); 
					}
			}
		}
		$this->render('applicantLicence',array('model'=>$model));
	}
	
	public function actionApplicantSkill()
	{
		$model=new ApplicantSkill;
		if(isset($_POST['skillSet'])){
			$username = $_GET['id'];
			if(isset($_POST['people'])){
				$people = $_POST['people'];
				foreach($people as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'people';
					$mod->save();
				}
			}
			if(isset($_POST['data'])){
				$data = $_POST['data'];
				foreach($data as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'data';
					$mod->save();
				}
			}
			
			if(isset($_POST['thing'])){
				$thing = $_POST['thing'];
				foreach($thing as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'thing';
					$mod->save();
				}
			}
			
			if(isset($_POST['idea'])){
				$idea = $_POST['idea'];
				foreach($idea as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'idea';
					$mod->save();
				}
			}
			if(Yii::app()->session['type'] == 'PESO OFFICER'){
				Yii::app()->user->setFlash('success','You have successfully encoded an applicant');
				$this->redirect(array('enter/create'));
			}
			else{
				$this->redirect(array('/site/page','view'=>'message'));	
			}
		}
		$this->render('applicantSkill',array('model'=>$model));
	}

	public function actionApplicantTrain()
	{
		$model=new ApplicantTrain;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-train-applicantTrain-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;
		
		if(isset($_POST['ApplicantTrain']))
		{
			$model->attributes=$_POST['ApplicantTrain'];
			if($model->validate())
			{
				if($model->save())
                    $this->redirect(array('applicantLast2Years','id'=>$model->username)); 
			}
		}
		$this->render('applicantTrain',array('model'=>$model));
	}

	public function actionApplicantWorkExp()
	{
		$model=new ApplicantWorkExp;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-work-exp-applicantWorkExp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;
		
		if(isset($_POST['ApplicantWorkExp']))
		{
			$model->attributes=$_POST['ApplicantWorkExp'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				if($model->save())
                    $this->redirect(array('applicantlicence','id'=>$model->username)); 
			}
		}
		$this->render('applicantWorkExp',array('model'=>$model));
	}
	
	public function actionApplicantDis()
	{
		$model=new ApplicantDisability;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-dis-applicantDis-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/
		
		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;

		if(isset($_POST['Applicantdisability']))
		{
			$model->attributes=$_POST['Applicantdisability'];
			if($model->validate())
			{
				
				if($model->save())
					{
					if(isset($_POST['optional_text'])){
	                    $erika = $_POST['optional_text'];
						$arrlength=count($erika);
						for($i=0; $i<$arrlength;$i++){
							$sql = "insert into Applicantdisability (disability, username ) 
									values (:disability, :username )";
							$parameters = array( ':disability'=>$erika[$i], ':username'=>$id);
							Yii::app()->db->createCommand($sql)->execute($parameters);
						}
					}
					$this->redirect(array('applicantEduc','id'=>$model->username)); 
					}
                
				
			}
		}
		$this->render('applicantDis',array('model'=>$model));
	}
	
	public function actionApplicantlanguageknown()
	{	
		$model=new ApplicantLanguageKnown;

		$id = Yii::app()->request->getQuery('id');
        $model->username = $id;
		
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-language-known-applicantlanguageknown-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if(isset($_POST['Applicantlanguageknown']))
		{
			$model->attributes=$_POST['Applicantlanguageknown'];
			if($model->validate())
			{
				if($model->save()){
					if(isset($_POST['optional_text'])){
	                    $erika = $_POST['optional_text'];
						$arrlength=count($erika);
						for($i=0; $i<$arrlength;$i++){
							if($erika[$i] == "")
								continue;
							$sql = "insert into applicantlanguageknown (known, username ) 
									values (:known, :username )";
							$parameters = array( ':known'=>$erika[$i], ':username'=>$id);
							Yii::app()->db->createCommand($sql)->execute($parameters);
						}
					}
					$this->redirect(array('applicantDis','id'=>$model->username)); 
				}
			}
		}
		$this->render('applicantLanguageKnown',array('model'=>$model));
	}
	public function actionUpdateLanguageSpoken(){
		$model = ApplicantLanguageSpoken::model()->findAllByAttributes(array('username'=>$_GET['username']));
		if(isset($_POST['updateLanguageSpoken'])){
			$size = sizeOf($_POST['language']);
			$username = $_GET['username'];
			$language = $_POST['language'];
			$sql = "delete from applicantlanguagespoken where username= :username";
			$param = array(':username'=>$username);
			Yii::app()->db->createCommand($sql)->execute($param);
			echo $size;
			for($i=0;$i<$size;$i++){
				if($language[$i] == "")
					continue;
				$sql = "insert into applicantlanguagespoken (language, username ) 
								values (:known, :username )";
				$parameters = array( ':known'=>$language[$i], ':username'=>$username);
				Yii::app()->db->createCommand($sql)->execute($parameters);
			}
			if(isset($_POST['optional_text'])){
				$language2 = $_POST['optional_text'];
				$arrlength=count($language2);
				echo $arrlength;
				for($i=0; $i<$arrlength;$i++){
					if($language2[$i] == "")
						continue;
					$sql = "insert into applicantlanguagespoken (language, username ) 
							values (:known, :username )";
					$parameters = array( ':known'=>$language2[$i], ':username'=>$username);
					Yii::app()->db->createCommand($sql)->execute($parameters);
				}
			}
			$this->redirect(array('updateDisability','username'=>$username));
		}
		else{
			$this->render('updateLanguageSpoken',array(
			'model'=>$model,
		));
		}
	}

	public function actionUpdateSkills(){
		$username = $_GET['username'];
		if(isset($_POST['updateSkills'])){
			ApplicantSkill::model()->deleteAll('username = :username',array(':username'=>$username));
			if(isset($_POST['people'])){
				$people = $_POST['people'];
				foreach($people as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'people';
					$mod->save();
				}
			}
			if(isset($_POST['data'])){
				$data = $_POST['data'];
				foreach($data as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'data';
					$mod->save();
				}
			}
			
			if(isset($_POST['thing'])){
				$thing = $_POST['thing'];
				foreach($thing as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'thing';
					$mod->save();
				}
			}
			
			if(isset($_POST['idea'])){
				$idea = $_POST['idea'];
				foreach($idea as $skill){
					$mod = new ApplicantSkill;
					$mod->username = $username;
					$mod->skill = $skill;
					$mod->type = 'idea';
					$mod->save();
				}
			}
			Yii::app()->user->setFlash('success','Successfully updated your Applicant account');
			$this->redirect(array('view','username'=>$username));
		}
		$this->render('updateSkills',array(
			'username'=>$username,
		));
	}

	public function actionUpdateLicenses(){
		$model = ApplicantLicence::model()->findAllByAttributes(array('username'=>$_GET['username']));

		if(isset($_POST['updateLicenses'])){
			$size = sizeOf($_POST['license']);
			$username = $_GET['username'];
			$license = $_POST['license'];
			$dates = $_POST['dates'];
			$sql = "delete from applicantlicence where username= :username";
			$param = array(':username'=>$username);
			Yii::app()->db->createCommand($sql)->execute($param);
			echo $size;
			for($i=0;$i<$size;$i++){
				if($license[$i] == "" || $dates[$i] == "")
					continue;
				$sql = "insert into applicantlicence (title,expdate,username ) 
								values (:title,:expdate,:username )";
				$parameters = array( ':title'=>$license[$i],':expdate'=>$dates[$i],':username'=>$username);
				Yii::app()->db->createCommand($sql)->execute($parameters);
			}
			if(isset($_POST['title'])){
				$language2 = $_POST['title'];
				$date = $_POST['date'];
				$arrlength=count($language2);
				echo $arrlength;
				for($i=0; $i<$arrlength;$i++){
					if($language2[$i] == "" || $date == "")
						continue;
					$sql = "insert into applicantlicence (title,expdate,username ) 
								values (:title,:expdate,:username )";
				$parameters = array( ':title'=>$license[$i],':expdate'=>$date[$i],':username'=>$username);
					Yii::app()->db->createCommand($sql)->execute($parameters);
				}
			}
			$this->redirect(array('updateTrain','username'=>$username));
		}else{
			$this->render('updateLicence',array(
				'model'=>$model,
			));
		}

	}

	public function actionUpdateLanguageKnown(){
		$model = ApplicantLanguageKnown::model()->findAllByAttributes(array('username'=>$_GET['username']));
		if(isset($_POST['updateLanguageKnown'])){
			$size = sizeOf($_POST['language']);
			$username = $_GET['username'];
			$language = $_POST['language'];
			$sql = "delete from applicantlanguageknown where username= :username";
			$param = array(':username'=>$username);
			Yii::app()->db->createCommand($sql)->execute($param);
			echo $size;
			for($i=0;$i<$size;$i++){
				if($language[$i] == "")
					continue;
				$sql = "insert into applicantlanguageknown (known, username ) 
								values (:known, :username )";
				$parameters = array( ':known'=>$language[$i], ':username'=>$username);
				Yii::app()->db->createCommand($sql)->execute($parameters);
			}
			if(isset($_POST['optional_text'])){
				$language2 = $_POST['optional_text'];
				$arrlength=count($language2);
				echo $arrlength;
				for($i=0; $i<$arrlength;$i++){
					if($language2[$i] == "")
						continue;
					$sql = "insert into applicantlanguageknown (known, username ) 
							values (:known, :username )";
					$parameters = array( ':known'=>$language2[$i], ':username'=>$username);
					Yii::app()->db->createCommand($sql)->execute($parameters);
				}
			}
			$this->redirect(array('updateDisability','username'=>$username));
		}
		else{
			$this->render('updateLanguageKnown',array(
			'model'=>$model,
		));
		}
	}

	public function actionUpdateEducationalAttainment(){
		$model = ApplicantEduc::model()->findByAttributes(array('username'=>$_GET['username']));
		$flag = true;;
		if(!$model){
			$model = new ApplicantEduc;
			$flag = false;
		}
		if(isset($_POST['ApplicantEduc'])){
			if($flag){
				$model2 = ApplicantEduc::model()->findByPK($model->id);
			}
			else{
				$model2 = new ApplicantEduc;
				$model2->username = $_GET['username'];
			}
			$model2->attributes=$_POST['ApplicantEduc'];
				if($model2->validate())
				{
					$model2->save();
					$this->redirect(array('updateWorkExp','username'=>$model2->username));
				}
		}
		$this->render('applicantEduc',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdateLast2Years(){
		$model = ApplicantLast2Years::model()->findByAttributes(array('username'=>$_GET['username']));
		$flag = true;
		if(!$model){
			$model = new ApplicantLast2Years;
			$flag = false;
		}
		if(isset($_POST['ApplicantLast2Years'])){
			if($flag){
				$model2 = ApplicantLast2Years::model()->findByPK($model->id);
			}
			else{
				$model2 = new ApplicantLast2Years;
				$model2->username = $_GET['username'];
			}
			$model2->attributes=$_POST['ApplicantLast2Years'];
			if($model2->validate())
			{
				// form inputs are valid, do something here
				if($model2->save())
					$this->redirect(array('updateSkills','username'=>$model2->username)); 
                   // $this->redirect(array('Homepage','username'=>$model2->username)); 
			}
		}
		$this->render('applicantLast2Years',array(
			'model'=>$model,
		));
	}

	public function actionUpdateDisability(){
		$model = ApplicantDisability::model()->findAllByAttributes(array('username'=>$_GET['username']));
		if(isset($_POST['updateDisability'])){
			$size = sizeOf($_POST['disability']);
			$username = $_GET['username'];
			$dis = $_POST['disability'];
			$sql = "delete from applicantdisability where username= :username";
			$param = array(':username'=>$username);
			Yii::app()->db->createCommand($sql)->execute($param);
			echo $size;
			for($i=0;$i<$size;$i++){
				if($dis[$i] == "")
					continue;
				$sql = "insert into applicantdisability (disability, username ) 
								values (:disability, :username )";
				$parameters = array( ':disability'=>$dis[$i], ':username'=>$username);
				Yii::app()->db->createCommand($sql)->execute($parameters);
			}
			if(isset($_POST['optional_text'])){
				$language2 = $_POST['optional_text'];
				$arrlength=count($language2);
				echo $arrlength;
				for($i=0; $i<$arrlength;$i++){
					if($language2[$i] == "")
						continue;
					$sql = "insert into applicantdisability (disability, username ) 
							values (:disability, :username )";
					$parameters = array( ':disability'=>$language2[$i], ':username'=>$username);
					Yii::app()->db->createCommand($sql)->execute($parameters);
				}
			}
			$this->redirect(array('UpdateEducationalAttainment','username'=>$username)); 
		}
		else{
			$this->render('updateDisability',array(
			'model'=>$model,
			));
		}

		
	}

	public function actionUpdateWorkExp(){
		$model = ApplicantWorkExp::model()->findByAttributes(array('username'=>$_GET['username']));
		$flag = true;
		if(!$model){
			$model = new ApplicantWorkExp;
			$flag = false;
		}
		if(isset($_POST['ApplicantWorkExp'])){
			if($flag){
				$model2 = ApplicantWorkExp::model()->findByPK($model->id);
			}
			else{
				$model2 = new ApplicantWorkExp;
				$model2->username = $_GET['username'];
			}
			$model2->attributes=$_POST['ApplicantWorkExp'];
			if($model2->validate())
			{
				// form inputs are valid, do something here
				if($model2->save())
                    $this->redirect(array('updateLicenses','username'=>$model2->username)); 
			}
		}
		$this->render('applicantWorkExp',array(
			'model'=>$model,
		));
	}

	public function actionUpdateTrain(){
		$model = ApplicantTrain::model()->findByAttributes(array('username'=>$_GET['username']));
		$flag = true;
		if(!$model){
			$model = new ApplicantTrain;
			$flag = false;
		}
		if(isset($_POST['ApplicantTrain'])){
			if($flag){
				$model2 = ApplicantTrain::model()->findByPK($model->id);
			}
			else{
				$model2 = new ApplicantWorkExp;
				$model2->username = $_GET['username'];
			}
			$model2->attributes=$_POST['ApplicantTrain'];
			if($model2->validate())
			{
				// form inputs are valid, do something here
				if($model2->save())
                    $this->redirect(array('updateLast2Years','username'=>$model2->username)); 
			}
		}
		$this->render('applicantTrain',array(
			'model'=>$model,
		));
	}
	
	public function actionApplicantLanguageSpoken()
	{	
		$model=new ApplicantLanguageSpoken;
		
		$id = Yii::app()->request->getQuery('id');
		$model->username = $id;
	
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-language-spoken-applicantlanguagespoken-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if(isset($_POST['Applicantlanguagespoken']))
		{
			$model->attributes=$_POST['Applicantlanguagespoken'];
			if($model->validate())
			{
				if($model->save()){
					if(isset($_POST['optional_text'])){
						$erika = $_POST['optional_text'];
						$arrlength=count($erika);
						for($i=0; $i<$arrlength;$i++){
							$sql = "insert into applicantlanguagespoken (language, username ) 
									values (:language, :username )";
							$parameters = array( ':language'=>$erika[$i], ':username'=>$id);
							Yii::app()->db->createCommand($sql)->execute($parameters);
						}
					}
                    $this->redirect(array('applicantDis','id'=>$model->username)); 
				}
			}
		}
		$this->render('applicantLanguageSpoken',array('model'=>$model));
	}
	
}
