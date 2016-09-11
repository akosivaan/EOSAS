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
<script>
	function showPassport(){
		var val=document.getElementById('passNo').value;
		//alert (val);
		if(val){
			var passE =document.getElementById('passExp');
			passE.disabled=false;
			
		}
		else{
			var passE =document.getElementById('passExp');
			passE.readOnly=true;
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
	
	function validateAddress(id){
		/*var val=document.getElementById(id).value;
		var re = /[A-Za-z0-9\.\\,# ]+/;
		if(!val.match(re)){
			alert("Invalid input");
			document.getElementById(id).value = "";
		}*/
		
	}
	
	function validateNum(id){
		/*var val=document.getElementById(id).value;
		var re = /^[0-9]{2}$/;
		
		if(!val.match(re)){
			alert("Invalid input of Age.");
			document.getElementById(id).value = "";
		}*/
		
	}
	
	function validateHW(id){
		/*var val=document.getElementById(id).value;
		var re = /^[0-9]{1,3}$/;
		
		if(!val.match(re)){
			alert("Invalid input of Height. Please use in cm only");
			document.getElementById(id).value = "";
		}*/
		
	}
	
	function validateContact(id){
		var val=document.getElementById(id).value;
		var re = /^[0-9\-]{11}$/;
		
		if(!val.match(re)){
			alert("Invalid input of contact number. Must be 09XXXXXXXXX");
			document.getElementById(id).value = "";
		}
		
	}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'applicantemail'); ?>
		<?php echo $form->emailField($model,'applicantemail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'applicantemail'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('id'=>'fname', 'size'=>50,'maxlength'=>70 , 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('id'=>'lname', 'size'=>50,'maxlength'=>70 , 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mname'); ?>
		<?php echo $form->textField($model,'mname',array('id'=>'mname', 'size'=>50,'maxlength'=>70 , 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'mname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthdate'); ?>
		<?php 
		$year = date('Y')-15;
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
                'language'=>'',
                'model'=>$model, // Model object
                'attribute'=>'birthdate', // Attribute name
                'mode'=>'date', // Use "time", "date" or "datetime" (default)
                'options'=>array(
                	'showAnim'=>'fold',
                	'changeMonth'=>'true',
                	'changeYear'=>'true',
                	'yearRange'=>'1950:'.$year,
                ), // jquery plugin options
                'htmlOptions'=>array('readonly'=>false) // HTML options
        )); 
		?>
		<?php echo $form->error($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->dropDownList($model,'sex',$model->getSex()); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age'); ?>
		<?php echo $form->textField($model,'age',array('id'=>'age', 'size'=>2,'maxlength'=>2 , 'onChange'=> 'validateNum(id);')); ?>
		<?php echo $form->error($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'religion'); ?>
		<?php echo $form->textField($model,'religion',array('id'=>'religion' , 'size'=>15,'maxlength'=>20 , 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'religion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('id'=>'street' , 'size'=>20,'maxlength'=>30 , 'onChange'=> 'validateAddress(id);')); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brgy'); ?>
		<?php echo $form->textField($model,'brgy',array('id'=>'brgy' ,'size'=>20,'maxlength'=>50 , 'onChange'=> 'validateAddress(id);')); ?>
		<?php echo $form->error($model,'brgy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'municipality'); ?>
		<?php echo $form->textField($model,'municipality',array('id'=>'municipality' , 'size'=>50,'maxlength'=>50, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'municipality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'placeBirth'); ?>
		<?php echo $form->textField($model,'placeBirth',array('id'=>'placeBirth' , 'size'=>30,'maxlength'=>40, 'onChange'=> 'validateName(id);')); ?>
		<?php echo $form->error($model,'placeBirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('id'=>'height' ,'size'=>3,'maxlength'=>3, 'onChange'=> 'validateHW(id);')); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('id'=>'weight' , 'size'=>3,'maxlength'=>3, 'onChange'=> 'validateHW(id);')); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maritalstatus'); ?>
		<?php echo $form->dropDownList($model,'maritalstatus',$model->getMS()); ?>
		<?php echo $form->error($model,'maritalstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contactNo'); ?>
		<?php echo $form->textField($model,'contactNo',array('id'=>'contactNo' , 'size'=>11,'maxlength'=>11 , 'onChange'=> 'validateContact(id);')); ?>
		<?php echo $form->error($model,'contactNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employmentstatus'); ?>
		<?php echo $form->dropDownList($model,'employmentstatus',$model->getES()); ?>
		<?php echo $form->error($model,'employmentstatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wheretowork'); ?>
		<?php $data = CHtml::listData(Employment::model()->getLocation(),'id','text','group'); ?>
		<?php echo CHtml::activeDropDownList($model,'wheretowork',$data); ?>
		<?php echo $form->error($model,'wheretowork'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passportno'); ?>
		<?php echo $form->textField($model,'passportno',array('id'=>'passNo', 'size'=>20,'maxlength'=>20, 'onChange'=> 'showPassport();')); ?>
		<?php echo $form->error($model,'passportno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passportexp'); ?>
		<?php 
		$year = date('Y')+15;
		$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
    		'model'=>$model,
    		'attribute'=>'passportexp',
    		'id'=>'passExp',
    		'language'=>'',
    		'mode'=>'date',
    		'options'=>array(
    				'showAnim'=>'fold',
    				'changeMonth'=>'true',
                	'changeYear'=>'true',
                	'yearRange'=>'1940:'.$year,),
    		'htmlOptions'=>array('style'=>'width:100px;','disabled'=>'true')
    	));

		//echo $form->textField($model,'passportexp', array('id'=>'passExp','class'=>'hasDatepicker','disabled'=>true)); ?>
		<?php echo $form->error($model,'passportexp'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'position_wanted'); ?>
		<?php echo $form->dropDownList($model,'position_wanted', $model->getPosition()); ?>
		<?php echo $form->error($model,'position_wanted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specialization_wanted'); ?>
		<?php $data = CHtml::listData(Employment::model()->getSpecialization(),'id','text','group')?>
		<?php echo CHtml::activeDropDownList($model,'specialization_wanted',$data); ?>
		<?php echo $form->error($model,'specialization_wanted'); ?>
	</div>
	<input type="hidden" value='<?php echo $model->username?>' name="Applicant[username]"/>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<input type="hidden" value=<?php echo $model->username?>/>

<?php $this->endWidget(); ?>

</div><!-- form -->
