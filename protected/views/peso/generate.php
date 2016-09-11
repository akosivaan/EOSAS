<?php
/* @var $this PesoController */
/* @var $model Peso */

/*$this->breadcrumbs=array(
	'Pesos'=>array('index'),
	$model->pesoemail,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 



?>

</br>
<h1> Generate Reports </h1>
<a href=<?php echo Yii::app()->createAbsoluteURL("Applicant/Report");?>>  List of Applicants </a> </br>
<a href=<?php echo Yii::app()->createAbsoluteURL("Employer/Report");?>> List of Employers </a> </br>
<a href=<?php echo Yii::app()->createAbsoluteURL("Employment/Report");?>> List of Employment Opportunities</a> </br>
<a href=<?php echo Yii::app()->createAbsoluteURL("Trainings/Report");?>> List of Trainings </a> </br>
<a href=<?php echo Yii::app()->createAbsoluteURL("Peso/JobApplicant");?>> List of Looking for Job Applicant </a> </br>
<a href=<?php echo Yii::app()->createAbsoluteURL("Peso/Report");?>> List of Approved Applicants by Employer </a> </br>