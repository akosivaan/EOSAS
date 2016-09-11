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
/* @var $this EmploymentController */
/* @var $model Employment */

/*$this->breadcrumbs=array(
	'Employments'=>array('index'),
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
	$('#employment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<br/>
<h1>View All Employment Opportunities </h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employment-grid',
	'dataProvider'=>$model->searchEmployment(),
	'filter'=>$model,
	//'filter'=>CHtml::dropDownList('specialization', '', CHtml::listData(employment::model()->getSpecialization(),'id','text','group') ),
	'columns'=>array(
		'jobtitle',
		'location',
		
		'specialization'=> array(
			'name' => 'specialization',
			//'value' => '$data->package->package_title',
			'filter'=> CHtml::listData(Employment::model()->getSpecialization(),'id','text','group')
		),
		
		'companyname',
		'position',
		//'type',
		'description',
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
		
		'pic',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',	
	
		),
	),
)); ?>
