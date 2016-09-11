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
/* @var $this ApplicantEducController */
/* @var $model ApplicantEduc */
/* @var $form CActiveForm */
?>
<script>
	function showGrad(){
		var val=document.getElementById('degree').value;
		//alert (val);
		if(val != 'N/A'){
			var passY =document.getElementById('year');
			var passS =document.getElementById('school');
			passY.disabled=false;
			passS.disabled=false;
		}
		else{
			var passY =document.getElementById('year');
			var passS =document.getElementById('school');
			passY.disabled=true;
			passS.disabled=true;
		}
	}
	
	function showHigh(){
		var val=document.getElementById('high').value;
		//alert (val);
		if(val!='N/A'){
			var passY =document.getElementById('hyear');
			var passS =document.getElementById('hschool');
			passY.disabled=false;
			passS.disabled=false;
		}
		else{
			var passY =document.getElementById('hyear');
			var passS =document.getElementById('hschool');
			passY.disabled=true;
			passS.disabled=true;
		}
	}
	
	function showelem(){
		var val=document.getElementById('elem').value;
		//alert (val);
		if(val!='N/A'){
			var passY =document.getElementById('eyear');
			var passS =document.getElementById('eschool');
			passY.disabled=false;
			passS.disabled=false;
		}
		else{
			var passY =document.getElementById('eyear');
			var passS =document.getElementById('eschool');
			passY.disabled=true;
			passS.disabled=true;
		}
	}
	
	
</script>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-educ-applicantEduc-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3> FORMAL EDUCATION </h3>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <p class="note">Put N/A if Not Applicable</p>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'collegeDegree'); ?>
		<?php echo $form->textField($model,'collegeDegree',array('id'=>'degree','size'=>50,'maxlength'=>70, 'placeholder'=>'N/A' , 'onChange'=>'showGrad();')); ?>
		<?php echo $form->error($model,'collegeDegree'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'collegeGrad'); ?>
		<?php echo $form->textField($model,'collegeGrad',array('size'=>4,'maxlength'=>4, 'placeholder'=>'N/A' , 'id'=>'year' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'collegeGrad'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'collegeSchool'); ?>
		<?php echo $form->textField($model,'collegeSchool',array('size'=>50,'maxlength'=>70, 'placeholder'=>'N/A' , 'id'=>'school' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'collegeSchool'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'highSchool'); ?>
		<?php echo $form->dropDownList($model,'highSchool',$model->getCol() , array('id'=>'high', 'onChange'=>'showHigh();')); ?>
		<?php echo $form->error($model,'highSchool'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'highGrad'); ?>
		<?php echo $form->textField($model,'highGrad',array('size'=>4,'maxlength'=>4, 'placeholder'=>'N/A' , 'id'=>'hyear' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'highGrad'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'highschool'); ?>
		<?php echo $form->textField($model,'highschool',array('size'=>50,'maxlength'=>70, 'placeholder'=>'N/A', 'id'=>'hschool' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'highschool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elementary'); ?>
		<?php echo $form->dropDownList($model,'elementary',$model->getElem(), array('id'=>'elem' , 'onChange'=>'showelem();')); ?>
		<?php echo $form->error($model,'elementary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elementaryGrad'); ?>
		<?php echo $form->textField($model,'elementaryGrad',array('size'=>4,'maxlength'=>4, 'placeholder'=>'N/A' , 'id'=>'eyear' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'elementaryGrad'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'elementarySchool'); ?>
		<?php echo $form->textField($model,'elementarySchool',array('size'=>50,'maxlength'=>70, 'placeholder'=>'N/A' , 'id'=>'eschool' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'elementarySchool'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
