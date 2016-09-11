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
/* @var $data Employer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeremail')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->employeremail), array('view', 'id'=>$data->employeremail)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('companyname')); ?>:</b>
	<?php echo CHtml::encode($data->companyName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyaddress')); ?>:</b>
	<?php echo CHtml::encode($data->companyAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook')); ?>:</b>
	<?php echo CHtml::encode($data->facebook); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regstatus')); ?>:</b>
	<?php echo CHtml::encode($data->regstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactno')); ?>:</b>
	<?php echo CHtml::encode($data->contactno); ?>
	<br />


</div>
