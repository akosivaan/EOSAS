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
/* @var $form CActiveForm */
?>

<script>

	function validateName(id){
		/*var val=document.getElementById(id).value;
		var re = /^[a-zA-Z\s]+[^0-9]+[a-zA-Z\s]+$/;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}*/
	}
	
	function validateContact(id){
		/*var val=document.getElementById(id).value;
		var re = /^[0-9]{11}$/;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}*/	
	}
	
	function validateAddress(id){
		/*var val=document.getElementById(id).value;
		var re = /[A-Za-z0-9\.\\,# ]+/;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}*/
	}
	function validateEmail(id){
		/*var val=document.getElementById(id).value;
		
		var atpos=val.indexOf("@");
		var dotpos=val.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=val.length)
		{
			alert("Not a valid e-mail address");
			document.getElementById('email').value = "";
			return false;
		}*/
	}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'employeremail'); ?>
		<?php echo $form->emailField($model,'employeremail',array('size'=>50,'maxlength'=>50,'onChange'=>'validateEmail(id);')); ?>
		<?php echo $form->error($model,'employeremail'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'companyname'); ?>
		<?php echo $form->textField($model,'companyname',array('id'=>'company' , 'size'=>50,'maxlength'=>120, 'onChange'=> 'validateName(id);'));?>
		<?php echo $form->error($model,'companyName'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'companyaddress'); ?>
		<?php echo $form->textField($model,'companyaddress',array('id'=>'address', 'size'=>50,'maxlength'=>120, 'onChange'=> 'validateAddress(id);'));?>
		<?php echo $form->error($model,'companyAddress'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'contactno'); ?>
		<?php echo $form->textField($model,'contactno',array('id'=>'contact', 'size'=>11,'maxlength'=>11, 'onChange'=> 'validateContact(id);'));?>
		<?php echo $form->error($model,'contactno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employertype'); ?>
		<?php echo $form->dropDownList($model,'employertype', $model->getType()); ?>
		<?php echo $form->error($model,'employertype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->dropDownList($model,'location', $model->getLocal()); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<input type="hidden" value='<?php echo $model->username; ?>' name='Employer[username]'/>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
