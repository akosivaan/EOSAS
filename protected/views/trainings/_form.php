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
/* @var $this TrainingsController */
/* @var $model Trainings */
/* @var $form CActiveForm */
?>
<script>

	function checkDate(date1 , date2, sched){		
		var doc = document,
		dateBox1 = doc.getElementById("date1").value,
		dateBox2 = doc.getElementById("date2").value,
		d1, d2, diff;

		//if there is no value, Date() would return today
		if (dateBox1) {
			d1 = new Date(dateBox1);
		} else {
			doc.getElementById("sched").value = "";
		}
		if (dateBox2) {
			d2 = new Date(dateBox2);
		} else {
			doc.getElementById("sched").value = "";
		}
		if (d1 && d2) {
			//reduce the difference to days in absolute value
			diff = Math.floor(Math.abs((d1 - d2) /1000/60/60/24 ));
		} else {
			//handle not having both dates
			doc.getElementById("sched").value = "";
		}
		if (diff === 0) {
			//d1 and d2 are the same day
			alert("Ending date invalid!");
			doc.getElementById("sched").value = "";
		}
		if (diff && d1 > d2) {
			//d1 is diff days after d2 and the diff is not zero
			alert("Start date invalid!");
			doc.getElementById("sched").value = "";
		}
		if (diff && d1 < d2) {
			//d1 is diff days before d2 and the diff is not zero
		}
	}
	
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trainings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place'); ?>
		<?php echo $form->textField($model,'place',array('size'=>70,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'place'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php 
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
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
		<?php
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
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
		<?php echo $form->labelEx($model,'schedule'); ?>
		<?php echo $form->textArea($model,'schedule',array('id'=>'sched', 'rows'=>7, 'cols'=>50)); ?>
		<?php echo $form->error($model,'schedule'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
