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
	'Create',
);*/
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
?>

</br>
<h1>Create Employment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
