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
/* @var $this EnterController */
/* @var $model Enter */
/* @var $form CActiveForm */
?>

<script>
	function validateEmail(){
		var val=document.getElementById('email').value;
		
		var atpos=val.indexOf("@");
		var dotpos=val.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=val.length)
		{
			alert("Not a valid e-mail address");
			document.getElementById('email').value = "";
			return false;
		}
	}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('id'=>'username', 'size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('id'=>'password','size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<label for='password2' class='required'>Confirm Password <span class='required'> * </span> </label>
		<input type='password' name='password2' id='password2' size='30' maxlength='50'/>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php 
			if(Yii::app()->session['type'] == "PESO OFFICER"){
				echo $form->dropDownList($model,'type', $model->getClassification());
			}
			else{
				echo $form->dropDownList($model,'type', $model->getClassificationOptions());
			}
		?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
