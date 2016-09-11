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
</br>
<center><h1> List of Approved Applicants for <?php echo Employment::model()->findByPK($myid)->jobtitle; ?> </h1></center>
<div class="search-form" style="display:none">
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'applicant-grid',
	'dataProvider'=>$model->searchApproveApplicant($myid),
	'filter'=>$model,
	'columns'=>array(
		'applicant',
		'fname',
		'mname',
		'lname',
		'jobtitle',
		array(
			'header'=>'Contact Number',
			'value'=>array($this,'getContact'),
		),
		array(
			'header'=>'Email',
			'value'=>array($this,'getEmail'),
		),
		'status',
		
	),
)); 

?>
<a href=<?php echo Yii::app()->createAbsoluteURL("Employment/ApprovePDF",array('id'=>$myid));?> ><button>Generate PDF List</button></a>
