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
/* @var $this AnnouncementsController */
/* @var $model Announcements */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'announcements-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'start', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'options'=>array(), // jquery plugin options
                'htmlOptions'=>array('readonly'=>false), // HTML options
				'id'=>'date1',
		)); 
		?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ending'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'ending', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'options'=>array(), // jquery plugin options
                'htmlOptions'=>array('readonly'=>false), // HTML options
				'id'=>'date2',
		)); 
		?>
		<?php echo $form->error($model,'ending'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'companies'); ?>
		<?php echo $form->textField($model,'companies'); ?>
		<?php echo $form->error($model,'companies'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
