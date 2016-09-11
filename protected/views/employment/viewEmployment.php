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
	$model->jobtitle,
);*/

/*$this->menu=array(
	array('label'=>'List Employment', 'url'=>array('index')),
	array('label'=>'Create Employment', 'url'=>array('create')),
	array('label'=>'Update Employment', 'url'=>array('update', 'id'=>$model->jobtitle)),
	array('label'=>'Delete Employment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->jobtitle),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employment', 'url'=>array('admin')),
);*/
?>

<h1>View Employment#<?php echo $model->jobtitle; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'minEduc',
		'maxEduc',
		'minExp',
		'maxAge',
		'minAge',
		'sex',
		'maritalStatus',
		'regstatus',
		'email',
		'jobtitle',
		'location',
		'specialization',
		'position',
		'min_salary',
		'max_salary',
		'type',
		'description',
	//	'pic_add',
	),
)); ?>

<?php

$id = Yii::app()->request->getQuery('id');
echo CHtml::link('Delete',"#", array("submit"=>array('delete', 'id'=>$id), 'confirm' => 'Are you sure?'));

 ?>

