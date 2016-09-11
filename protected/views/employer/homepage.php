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
/* @var $this EmployerController */
/* @var $model Employer */

/*$this->breadcrumbs=array(
	'Employers'=>array('index'),
	$model->employeremail,
);*/


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


$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
echo "List of Pending Employment Opportunities";

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employment-grid',
	'dataProvider'=>$model1->searchPendingMatched(),
	'filter'=>$model1,
	'columns'=>array(
		'jobtitle',
		'location',
		'specialization',
		'type',
		'position',
		/*
		'regstatus',
		'email',
		'minEduc',
		'maxeduc',
		'minexp',
		'maxage',
		'minage',
		'sex',
		'maritalstatus',
		'min_salary',
		'max_salary',
		'description',
		'pic',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'viewButtonUrl' => 'Yii::app()->createUrl("employment/view", array("id"=>$data->id))',
			'updateButtonUrl' => 'Yii::app()->createUrl("employment/update", array("id"=>$data->id))',
		),
	),
)); 

?>



