<?php
/* @var $this PesoController */
/* @var $model Peso */
/* @var $form CActiveForm */
?>

<script>

	function validateName(id){
		var val=document.getElementById(id).value;
		var re = /^[a-zA-Z\s]+[^0-9]+[a-zA-Z\s]+$/;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}
		
	}
	
	function validateEmployee(id){
		/*var val=document.getElementById(id).value;
		var re = /^[0-9]{15}$/;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}*/
		
	}
	
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'peso-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pesoemail'); ?>
		<?php echo $form->emailField($model,'pesoemail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pesoemail'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'employee_no'); ?>
		<?php echo $form->textField($model,'employee_no',array('id'=>'employee' , 'size'=>16,'maxlength'=>15, 'onChange'=> 'validateEmployee(id);')); ?>
		<?php echo $form->error($model,'employee_no'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('id'=>'fname', 'size'=>20,'maxlength'=>20, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mname'); ?>
		<?php echo $form->textField($model,'mname',array('id'=>'mname', 'size'=>20,'maxlength'=>20, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'mname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('id'=>'lname', 'size'=>20,'maxlength'=>20, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'lname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'municipality'); ?>
		<?php echo $form->textField($model,'municipality',array('id'=>'municipality', 'size'=>20,'maxlength'=>20, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'municipality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brgy'); ?>
		<?php echo $form->textField($model,'brgy',array('id'=>'brgy', 'size'=>20,'maxlength'=>20, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'brgy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position',array('id'=>'municipality', 'size'=>20,'maxlength'=>20, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
	<input type="hidden" value='<?php echo $model->username; ?>' name='Peso[username]'/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
