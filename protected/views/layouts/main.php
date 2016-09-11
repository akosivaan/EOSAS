<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<style>
	#mainmenu ul { list-style: none; margin: 0; padding: 0; position: relative; height: 26px; }
	#mainmenu ul li { display: block; height: 26px; float: left; overflow: visible; margin: 3px; }
	#mainmenu ul li:hover > ul { display: block; }
	#mainmenu ul li a { float: left; display: block;}
	#mainmenu ul li ul { display: none; position: absolute; top: 100%; background: #589FC8; color: #fff; height: auto; width: auto; }
	#mainmenu ul li ul li a { color: #fff; padding: 4px 14px; display: block; width: 200px;}
	#mainmenu ul li ul li.active a, #mainmenu ul li ul li a:hover { color: #589FC8; }
	#mainmenu ul li ul li { clear: left; margin-bottom:px;}
	.button-column a{
		margin: 2px;
	}
	#footer{
		clear: both;
	}
	a {
		color:green;
	}
	.center{
		border: 1px solid skyblue;
		border-radius: 5px;
		width: 400px;
		padding: 10px;
		margin:0 auto;
		font-size: 15spx;
	}
	.checkBox{
    list-style:none;
  }
  .floating{
    float:left;
  }
  .skillset{
    float:left;
  }
  .tabSkill{
      border: 1px solid black;
  }
  .tabSkill tr td{
      border:1px solid black;
      vertical-align: top;
  }
  .tabSkill tr td li label{
      margin-left: 10px;
  }
  .tabSkill tr th{
      text-align:center;
      border:1px solid black;
  }
  .err{
  	/*padding-top: 10px;
  	padding-bottom: 1px;
  	padding-left: 10px;
  	background-color: #FFBABA;*/
  	border: 2px solid #C00;
  	padding: 7px 7px 12px 7px;
  	margin: 0 0 20px 0;
  	background: #FEE;
  	font-size: 0.9em;
  }
  .err p{
  	/*font-size: 1.1em;
  	color: #D8000C;*/
  	margin: 0;
  padding: 5px;
  }
  .succ{
  	padding-top: 10px;
  	padding-bottom: 1px;
  	padding-left: 10px;
  	color: #4F8A10;
    background-color: #DFF2BF;
  }
	</style>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
	<?php
		$id = Yii::app()->session['username']; 
		$type = Yii::app()->session['type'];
		$ok1 = false;
		$ok2 = false;
		$ok3 = false;
		$ok4 = false;
		$ok5 = false;
		$ok6 = false;
		$status = Enter::model()->findByAttributes(array('username'=>$id));
		if($type == 'Employer'){
			//$status = Employer::model()->findByPK($id);
			$ok4 = true;
			if($status->status != 'PENDING'){
				$ok1 = true;
			}
		}
		else if($type == 'Applicant'){
			//$status = Applicant::model()->findByPK($id);
			$ok5 = true;
			if($status->status != 'PENDING'){
				$ok2 = true;
			}
		}
		else if($type == 'PESO OFFICER'){
			//$status = Peso::model()->findByPK($id);
			$ok6 = true;
			if($status->status != 'PENDING'){
				$ok3 = true;
			}
		}
		//echo $status;
	?>
	<div id="mainmenu" class='menu-top'>
		<?php $this->widget('zii.widgets.CMenu',array(
			//'activeCssClass'=>'active',
  			//'activateParents'=>true,
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			//	array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Announcements', 'url'=>array('/peso/announcement')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'My Account',
					'url'=>array('/site/Homepage'),
					'linkOptions'=>array('id'=>'menuCompany'),
      				'itemOptions'=>array('id'=>'itemCompany'),
					'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
							array('label'=>'Update Applicant', 'url'=>array('applicant/update', 'id'=>$id),'visible'=>$ok5), 
							array('label'=>'Update Password', 'url'=>array('applicant/updatePassword','id'=>$id),'visible'=>$ok2), 
							array('label'=>'View All Employment', 'url'=>array('employment/visitorSearch'),'visible'=>$ok2),	
							array('label'=>'View Matched Employment', 'url'=>array('employment/Matched' , 'id'=>$id),'visible'=>$ok2),
							array('label'=>'Search Training Programs', 'url'=>array('trainings/admin'),'visible'=>$ok2),
							array('label'=>'Send Message PESO', 'url'=>array('peso/admin'),'visible'=>$ok2),

							array('label'=>'Update Employer', 'url'=>array('employer/update', 'id'=>$id),'visible'=>$ok4),
							array('label'=>'Update Password', 'url'=>array('employer/updatePassword', 'id'=>$id),'visible'=>$ok1),
							array('label'=>'Add Local Recruitment Activity' , 'url'=>array('localRecruitment/create'),'visible'=>$ok1),
							array('label'=>'Add Employment' , 'url'=>array('employment/create' , 'id'=>$id),'visible'=>$ok1),
							array('label'=>'Manage Employment', 'url'=>array('employment/admin'),'visible'=>$ok1),
							array('label'=>'Manage Local Recruitment Activity' , 'url'=>array('localRecruitment/admin'),'visible'=>$ok1),
							//array('label'=>'Manage Applicants', 'url'=>array('applicant/employer'),'visible'=>$ok1),
							array('label'=>'View All Employment', 'url'=>array('employment/VisitorSearch'),'visible'=>$ok1),
							array('label'=>'Send Email to Admin', 'url'=>array('peso/Admin'),'visible'=>$ok1),	
						//	array('label'=>'Send Email to Applicant', 'url'=>array('applicant/Admin')),	
							array('label'=>'Search Applicants' , 'url'=>array('applicant/employerSearch'),'visible'=>$ok1),

							array('label'=>'Update Peso', 'url'=>array('peso/update', 'id'=>$id),'visible'=>$ok6),
							array('label'=>'Update Password', 'url'=>array('peso/updatePassword', 'id'=>$id),'visible'=>$ok3),
							array('label'=>'Add Account', 'url'=>array('enter/create', 'id'=>$id),'visible'=>$ok3),
							array('label'=>'Add Announcements', 'url'=>array('announcements/Create'),'visible'=>$ok3),
							array('label'=>'Add Trainings', 'url'=>array('Trainings/Create'),'visible'=>$ok3),
							array('label'=>'Manage Announcements', 'url'=>array('Announcements/admin'),'visible'=>$ok3),
							array('label'=>'Manage Applicants', 'url'=>array('applicant/admin'),'visible'=>$ok3),
							array('label'=>'Manage Employers', 'url'=>array('employer/admin'),'visible'=>$ok3),
							array('label'=>'Manage Employment', 'url'=>array('employment/admin'),'visible'=>$ok3),
							array('label'=>'Manage PESO Officer', 'url'=>array('peso/admin'),'visible'=>$ok3),
							//array('label'=>'View All Employment', 'url'=>array('employment/visitorSearch'),'visible'=>$ok3),
							array('label'=>'Manage Trainings', 'url'=>array('trainings/admin'),'visible'=>$ok3),
							//array('label'=>'Add Trainings', 'url'=>array('Trainings/Create'),'visible'=>$ok3),
							array('label'=>'Generate Reports', 'url'=>array('Peso/Generate'),'visible'=>$ok3),
			      ),

				),
				//array('label'=>'Homepage ('.Yii::app()->user->name.')', 'url'=>array('/site/Homepage'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				),
		)); ?>
	</div><!-- mainmenu -->
	<?php //if(isset($this->breadcrumbs)):?>
		<?php //$this->widget('zii.widgets.CBreadcrumbs', array(
			//'links'=>$this->breadcrumbs,
		//)); ?><!-- breadcrumbs -->
	<?php //endif ?>

	<?php echo $content; ?>

	<!--<div class="clear"></div>-->

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by OpenLGU UPLB.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
