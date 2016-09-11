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
/* @var $this EmploymentController */
/* @var $model Employment */
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
	
	function validateSalary(id){
		var val=document.getElementById(id).value;
		var re = /^(\d{1,3}\,)*\d{3}(\.\d{1,2})?$/ ;
		
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}
		
	}
	
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'jobtitle'); ?>
		<?php echo $form->textField($model,'jobtitle',array('id'=>'title', 'size'=>50,'maxlength'=>50 , /*'onChange'=> 'validateName(id);'*/)); ?>
		<?php echo $form->error($model,'jobtitle'); ?>
	</div>
	
	<p class="hint"> Choose B for both F and M. </p>
	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'maritalstatus'); ?>
			<?php echo $form->dropDownList($model,'maritalstatus',$model->getMS()); ?>
		<?php echo $form->error($model,'maritalstatus'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'minage'); ?>
		<?php echo $form->textField($model,'minage',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'minage'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'maxage'); ?>
		<?php echo $form->textField($model,'maxage',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'maxage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minEduc'); ?>
		<?php echo $form->dropDownList($model,'minEduc',$model->getMinEduc()); ?>
		<?php echo $form->error($model,'minEduc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maxeduc'); ?>
		<?php echo $form->dropDownList($model,'maxeduc',$model->getMinEduc()); ?>
		<?php echo $form->error($model,'maxeduc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minexp'); ?>
		<?php echo $form->textField($model,'minexp',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'minexp'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php $data = CHtml::listData($model->getLocation(),'id','text','group'); ?>
		<?php echo CHtml::activeDropDownList($model,'location',$data); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'specialization'); ?>
		<?php $data = CHtml::listData($model->getSpecialization(),'id','text','group' )?>
		<?php echo CHtml::activeDropDownList($model,'specialization',$data); ?>
		<?php echo $form->error($model,'specialization'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->dropDownList($model,'position',$model->getPosition()); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'min_salary'); ?>
		<?php echo $form->textField($model,'min_salary',array('id'=>'min','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'min_salary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_salary'); ?>
		<?php echo $form->textField($model,'max_salary',array('id'=>'max','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'max_salary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->getType()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enddate'); ?>
		<?php //echo $form->textArea($model,'description',array('rows'=>7,'cols'=>50)); 
			$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'enddate', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'options'=>array(
                	'showAnim'=>'fold',
                	'changeMonth'=>'true',
                	//'changeYear'=>'true',
                ), // jquery plugin options
                'htmlOptions'=>array('readonly'=>false) // HTML options
        ));
		?>
		<?php echo $form->error($model,'enddate'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>7,'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
