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
	'Create',
);*/
/*
$this->menu=array(
	array('label'=>'List Employer', 'url'=>array('index')),
	array('label'=>'Manage Employer', 'url'=>array('admin')),
);*/
?>

<h1>Create Employer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
