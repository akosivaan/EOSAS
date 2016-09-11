<?php
	if(Yii::app()->user->hasFlash('error')){
?>
	<div class='err'>
		<p><?php echo Yii::app()->user->getFlash('error'); ?></p>
	</div>
<?php
	}
	else if(Yii::app()->user->hasFlash('success')){
?>
	<div class='succ'>
	<p><?php echo Yii::app()->user->getFlash('success'); ?></p>
	</div>
<?php
	}
?>
</br>
<?php
/* @var $this ApplicantController */
/* @var $model Applicant */

/*$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	'Manage',
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#applicant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php 
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($type == 'PESO OFFICER'){
$status = Peso::model()->findByPK($id);

if($status->regstatus != 'PENDING'){ ?>

</br>
<center><h1> List of All Actively Looking Applicants </h1></center>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'applicant-grid',
	'dataProvider'=>$model,
	//'filter'=>$model,
	'columns'=>array(
		'applicantemail',
		//'password',
		//'pin',
		'fname',
		'lname',
		'mname',
		//'municipality',
		'contactNo',
		//'regstatus',
		//'birthdate',
		'sex',
		'age',
		//'religion',
		//'street',
		//'brgy',
		//'placeBirth',
		//'height',
		//'weight',
		'maritalstatus',
		//'employmentstatus',
		'wheretowork',
		//'passportno',
		//'passportexp',
		//'facebook',
		'position_wanted',
		'specialization_wanted',		
	),
));
}
}
?>

<a href=<?php echo Yii::app()->createAbsoluteURL("Peso/ApplicantReport");?> ><button>Generate</button></a>
