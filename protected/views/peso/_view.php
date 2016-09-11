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
/* @var $data Peso */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pesoemail')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pesoemail), array('view', 'id'=>$data->pesoemail)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_no')); ?>:</b>
	<?php echo CHtml::encode($data->employee_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('municipality')); ?>:</b>
	<?php echo CHtml::encode($data->municipality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brgy')); ?>:</b>
	<?php echo CHtml::encode($data->brgy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mname')); ?>:</b>
	<?php echo CHtml::encode($data->mname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

</div>
