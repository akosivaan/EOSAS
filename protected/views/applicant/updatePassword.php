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
<h1>Change Password</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'update-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<label class='required' for='oldpass'>Old Password <span class='required'> * </span></label>
		<input type='password' name='oldpass' id='oldpass'/>
	</div>
	<div class="row">
		<label class='required' for='newpass'>New Password <span class='required'> * </span></label>
		<input type='password' name='newpass' id='newpass'/>
	</div>
	<div class="row">
		<label class='required' for='confnewpass'>Confirm New Password <span class='required'> * </span></label>
		<input type='password' name='confnewpass' id='confnewpass'/>
	</div>
	<input type='hidden' name='update' value='upd'/>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
	<br/>

<?php $this->endWidget(); ?>
</div><!-- form -->