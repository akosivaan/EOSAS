<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				//use 'contact' view from views/mail
				$mail = new YiiMailer('contact', array('message' => $model->body, 'name' => $model->name, 'description' => 'Contact form'));
				
				//set properties
				$mail->setFrom($model->email, $model->name);
				$mail->setSubject($model->subject);
				$mail->setTo(Yii::app()->params['adminEmail']);
				//send
				if ($mail->send()) {
					Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				} else {
					Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
				}
				
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                $hi = $model->username;
                //getting the type of the user who logged in
                //to determine which user homepage to redirect
                $sql = "SELECT type FROM enter WHERE username='$hi'";
                $type = Yii::app()->db->createCommand($sql)->queryScalar();
				
				Yii::app()->session['username'] = $hi;
				Yii::app()->session['type'] = $type;
    
                if($type == 'Employer'){
					//$status = Employer::model()->findByPK($hi);
					$stat = Enter::model()->findByAttributes(array('username'=>$hi));
					if($stat->status != 'PENDING'){
						$this->redirect(Yii::app()->createAbsoluteURL("Employer/Homepage")); 
					}
					else{
						$this->redirect(Yii::app()->createAbsoluteURL("Employer/Homepage"));
					}
                }
                else if($type == 'PESO OFFICER'){
					//$status = Peso::model()->findByPK($hi);
					$stat = Enter::model()->findByAttributes(array('username'=>$hi));
					if($stat->status != 'PENDING'){
						$this->redirect(Yii::app()->createAbsoluteURL("Peso/Homepage"));
					}
					else{
						$this->redirect(Yii::app()->createAbsoluteURL("Peso/Homepage"));
					}
                }
                else{
					//$status = Applicant::model()->findByPK($hi);
					$stat = Enter::model()->findByAttributes(array('username'=>$hi));
					if($stat->status != 'PENDING'){
						$this->redirect(Yii::app()->createAbsoluteURL("Applicant/Homepage"));
					}
					else{
						$this->redirect(Yii::app()->createAbsoluteURL("Applicant/Homepage"));
					}
                }
                
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	public function actionHomepage()
	{
		//to determine to which homepage to redirect 
		$type = Yii::app()->session['type'];
		
		if($type == 'Employer'){
			$this->redirect(Yii::app()->createAbsoluteURL("Employer/Homepage")); 
		}
		else if($type == 'PESO OFFICER'){
			$this->redirect(Yii::app()->createAbsoluteURL("Peso/Homepage"));
		}
		else if($type == 'Applicant'){
			$this->redirect(Yii::app()->createAbsoluteURL("Applicant/Homepage"));
		}
	}
	
	public function actionList()
	{
		$this->render('employment_list',array(
			//'model'=>$this->loadModel($id),
		));
	}
	
	public function actionListTrain()
	{
		$this->render('training_list',array(
			//'model'=>$this->loadModel($id),
		));
	}
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}