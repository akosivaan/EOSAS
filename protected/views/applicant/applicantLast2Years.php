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
/* @var $this ApplicantLast2YearsController */
/* @var $model ApplicantLast2Years */
/* @var $form CActiveForm */
?>

<script>
	function showDate(){
		var val=document.getElementById('super').value;
		validateName('super');
		val=document.getElementById('super').value;
		//alert (val);
		if(val != ""){
			var to =document.getElementById('to');
			var from =document.getElementById('from');
			to.disabled=false;
			from.disabled=false;
		}
		else{
			var to =document.getElementById('to');
			var from =document.getElementById('from');
			to.disabled=true;
			from.disabled=true;
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
	'id'=>'applicant-last2-years-applicantLast2Years-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3> EMPLOYMENT DURING THE LAST 2 YEARS, IF ANY</h3>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'companyName'); ?>
		<?php echo $form->textField($model,'companyName',array('id'=>'companyName' , 'size'=>50,'maxlength'=>70 , 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'companyName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'companyAddress'); ?>
		<?php echo $form->textField($model,'companyAddress'); ?>
		<?php echo $form->error($model,'companyAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'designation'); ?>
		<?php echo $form->textField($model,'designation',array('id'=>'designation' , 'size'=>50,'maxlength'=>120 , 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'designation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->dropDownList($model,'position',Employment::model()->getPosition()); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'supervisor'); ?>
		<?php echo $form->textField($model,'supervisor' , array('id'=>'super', 'size'=>50,'maxlength'=>70 ,'onChange'=>'showDate();')); ?>
		<?php echo $form->error($model,'supervisor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateFrom'); ?>
		<?php 
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',       
                'model'=>$model, // Model object
                'attribute'=>'dateFrom', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'id'=>'from',
                'options'=>array(
                	'showAnim'=>'fold',
                	'changeMonth'=>'true',
                	'changeYear'=>'true',
                	'yearRange'=>'1940:',
                ), // jquery plugin options
                'htmlOptions'=>array('disabled'=>true) // HTML options
        )); 
		
		//echo $form->textField($model,'dateFrom' , array('id'=>'from' , 'disabled'=>true));?>
		<?php echo $form->error($model,'dateFrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateTo'); ?>
		<?php 
			$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'dateTo', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'id'=>'to',
                'options'=>array(
                	'showAnim'=>'fold',
                	'changeMonth'=>'true',
                	'changeYear'=>'true',
                	'yearRange'=>'1940:',
                ), // jquery plugin options
                'htmlOptions'=>array('disabled'=>true) // HTML options
        )); 

		//echo $form->textField($model,'dateTo' , array('id'=>'to' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'dateTo'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
