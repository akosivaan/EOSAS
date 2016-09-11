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
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Employers',
);*/
/*
$this->menu=array(
	array('label'=>'Create Employer', 'url'=>array('create')),
	array('label'=>'Manage Employer', 'url'=>array('admin')),
);*/
?>

<h1>Employers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
