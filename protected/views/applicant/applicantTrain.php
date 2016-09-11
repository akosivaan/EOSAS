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
/* @var $this ApplicantTrainController */
/* @var $model ApplicantTrain */
/* @var $form CActiveForm */
?>

<script>
	function showExp(){
		var val=document.getElementById('skill').value;
		//alert (val);
		if(val != ""){
			var exp =document.getElementById('exp');
			exp.disabled=false;
		}
		else{
			var exp =document.getElementById('exp');
			exp.disabled=true;
		}
	}
	
	function validateName(id){
		/*var val=document.getElementById(id).value;
		var re = /^[a-zA-Z\s]+[^0-9]+[a-zA-Z\s]+$/;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}*/
		
	}
	
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-train-applicantTrain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3> VOCATIONAL/TECHNICAL TRAINING & RELEVANT EXPERIENCE </h3>
    <p class="note"> Include courses taken as part of college education </p>
    
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('id'=>'name', 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'issuingAgency'); ?>
		<?php echo $form->textField($model,'issuingAgency',array('id'=>'issue', 'onChange'=> 'validateName(id);'));  ?>
		<?php echo $form->error($model,'issuingAgency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acquiredSkill'); ?>
		<?php echo $form->textField($model,'acquiredSkill' , array('id'=>'skill' , 'onChange'=>'showExp();')); ?>
		<?php echo $form->error($model,'acquiredSkill'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yearsExp'); ?>
		<?php echo $form->textField($model,'yearsExp' , array('id'=>'exp' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'yearsExp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'certRecieve'); ?>
		<?php echo $form->textField($model,'certRecieve' ,array('id'=>'cert', 'onChange'=> 'validateName(id);'));  ?>
		<?php echo $form->error($model,'certRecieve'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
