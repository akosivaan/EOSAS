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
/* @var $this ApplicantController */
/* @var $model Applicant */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'applicantemail'); ?>
		<?php echo $form->textField($model,'applicantemail',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pin'); ?>
		<?php echo $form->textField($model,'pin',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mname'); ?>
		<?php echo $form->textField($model,'mname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birthdate'); ?>
		<?php echo $form->textField($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age'); ?>
		<?php echo $form->textField($model,'age',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'religion'); ?>
		<?php echo $form->textField($model,'religion',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'brgy'); ?>
		<?php echo $form->textField($model,'brgy',array('size'=>20,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'municipality'); ?>
		<?php echo $form->textField($model,'municipality',array('size'=>20,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'placeBirth'); ?>
		<?php echo $form->textField($model,'placeBirth',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maritalstatus'); ?>
		<?php echo $form->textField($model,'maritalstatus',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contactNo'); ?>
		<?php echo $form->textField($model,'contactNo',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employmentstatus'); ?>
		<?php echo $form->textField($model,'employmentstatus',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wheretowork'); ?>
		<?php echo $form->textField($model,'wheretowork',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passportno'); ?>
		<?php echo $form->textField($model,'passportno',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passportexp'); ?>
		<?php echo $form->textField($model,'passportexp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facebook'); ?>
		<?php echo $form->textField($model,'facebook',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'regstatus'); ?>
		<?php echo $form->textField($model,'regstatus',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position_wanted'); ?>
		<?php echo $form->textField($model,'position_wanted',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specialization_wanted'); ?>
		<?php echo $form->textField($model,'specialization_wanted',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
