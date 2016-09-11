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
<h1>View <?php echo $model->pesoemail; ?> Details </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pesoemail',
	//	'employee_no',
		'municipality',
	//	'brgy',
		'fname',
		'mname',
		'lname',
		'position',
	//	'regstatus',
		
	),
)); ?>
