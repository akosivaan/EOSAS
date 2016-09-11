<?php

class TrainingsController extends Controller
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
				'actions'=>array('index','view' , 'admin' ,'Report' , 'PDF', 'Attendees','create','update','delete'),
				'roles'=>array('PESO OFFICER'),
			),
			array('allow',
				'actions'=>array('addTrainiee','admin'),
				'roles'=>array('Applicant'),
				),
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*')
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/*
		*Generate pdf files for the list of all Trainings
		*generate2(view) = format of pdf file to be generated
	*/
	public function actionPDF()
    {
		$model = new Trainings;
		$dateFrom = date('Y-m-d',strtotime($_POST['dateFrom']));
		$dateTo = date('Y-m-d',strtotime($_POST['dateTo']));
		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('trainings')
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

	public function actionAttendees($id){

		$query= Yii::app()->db->createCommand()
            ->select('*')
            ->from('trainiees')
            ->where("title = '$id'")
            ->queryAll();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		# Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
		
				$mPDF1->WriteHTML($this->renderPartial('generate3', array('query'=>$query, 'id' => $id), true));
				$mPDF1->Output();
	}
	
	/*
		* Function called from the PESO Controller
		* Show view of pdf file to be generated 
	*/
	public function actionReport(){
		
		$model = new Trainings;
		$this->render('generate',array(
			'model'=>$model,
		));
	}
	
	/*
		*Function to add a Applicant to the training she wish to join
		*Trainings model => table for the trainings
		*Trainiees model => table for the applicants who join a training
	*/
	public function actionaddTrainiee($title)
	{
		$model = new Trainings;
		$model2 = new Trainiees;
		$data = $model2->insert($title);
		Yii::app()->user->setFlash('success','You are now enlisted to the training');
		$this->redirect(Yii::app()->createAbsoluteURL("Applicant/Homepage"));
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
		$model=new Trainings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Trainings']))
		{
			$model->attributes=$_POST['Trainings'];
			$model->date = date('m-d-Y');
			if($model->save()){
				Yii::app()->user->setFlash('success','You have successfully posted a training program');
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

		if(isset($_POST['Trainings']))
		{
			$model->attributes=$_POST['Trainings'];
			if($model->save()){
				Yii::app()->user->setFlash('success','You have successfully updated a training program');
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
		$dataProvider=new CActiveDataProvider('Trainings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Trainings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trainings']))
			$model->attributes=$_GET['Trainings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Trainings the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Trainings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Trainings $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trainings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
