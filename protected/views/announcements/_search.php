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

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start'); ?>
		<?php 
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'start', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'options'=>array(
                	'showAnim'=>'fold',
                	'changeMonth'=>'true',
                	//'changeYear'=>'true',
                	//'yearRange'=>'1940:',
                ), // jquery plugin options
                'htmlOptions'=>array('readonly'=>false) // HTML options
        )); 
		//echo $form->textField($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end'); ?>
		<?php 
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'ending', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'options'=>array(
                	'showAnim'=>'fold',
                	'changeMonth'=>'true',
                	//'changeYear'=>'true',
                	//'yearRange'=>'1940:',
                ), // jquery plugin options
                'htmlOptions'=>array('readonly'=>false) // HTML options
        )); 

		//echo $form->textField($model,'end'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'companies'); ?>
		<?php echo $form->textField($model,'companies'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
