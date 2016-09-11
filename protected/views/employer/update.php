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
	$model->employeremail=>array('view','id'=>$model->employeremail),
	'Update',
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type'];

?>

</br>
<h1>Update Employer <?php echo $model->employeremail; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
