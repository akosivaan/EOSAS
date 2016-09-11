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
/* @var $this ApplicantWorkExpController */
/* @var $model ApplicantWorkExp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-work-exp-applicantWorkExp-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3> WORK RELATED TO EDUCATION</h3>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Specialization'); ?>
		<?php $data = CHtml::listData(Employment::model()->getSpecialization(),'id','text','group' )?>
		<?php echo CHtml::activeDropDownList($model,'Specialization',$data); ?>
		<?php echo $form->error($model,'Specialization'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'yrsExp'); ?>
		<?php echo $form->textField($model,'yrsExp'); ?>
		<?php echo $form->error($model,'yrsExp'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
