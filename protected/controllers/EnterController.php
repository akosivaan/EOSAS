<?php

class EnterController extends Controller
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
				'actions'=>array('index','View' , 'Create' , 'View2' , 'View3' , 'back'),
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
	
	public function actionView2($id)
	{
		$this->render('view2',array(
			'model'=>$this->loadModel($id),
		));
	}
    
    public function actionView3($id)
	{
		$this->render('view3',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionBack(){
	
		$model = new Enter;
		
		$id = $_POST['username'];
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('username',$id);
		Enter::model()->deleteAll($criteria);
		
		$this->redirect(Yii::app()->createAbsoluteURL("Enter/Create"));
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Enter;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Enter']))
		{
			$model->attributes=$_POST['Enter'];
			$model->password = md5($_POST['Enter']['password']);
			$model->conf_password = md5($_POST['password2']);
			$model->status = 'PENDING';
			if(Yii::app()->session['type'] == 'PESO OFFICER')
				$model->status = 'APPROVED';
			if($model->save()){
                if($model->type == 'Employer'){
                    $this->redirect(array('view','id'=>$model->username));
                }
                else if($model->type == 'PESO OFFICER'){
                    $this->redirect(array('view3','id'=>$model->username));
                }
                else{
                    $this->redirect(array('view2','id'=>$model->username));
                } 
            }
		}
		$model->password = '';
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

		if(isset($_POST['Enter']))
		{
			$model->attributes=$_POST['Enter'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->username));
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
		$dataProvider=new CActiveDataProvider('Enter');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Enter('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Enter']))
			$model->attributes=$_GET['Enter'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Enter the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Enter::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Enter $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='enter-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
