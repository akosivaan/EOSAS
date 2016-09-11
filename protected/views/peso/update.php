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
		
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 


?>

</br></br>
<h1>Update Peso <?php echo $model->username; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
