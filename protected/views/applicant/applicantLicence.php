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
/* @var $this ApplicantlicenceController */
/* @var $model Applicantlicence */
/* @var $form CActiveForm */
?>

<script>
	function showExp(){
		/*var val=document.getElementById('title').value;
		//alert (val);
		if(val != ""){
			var exp =document.getElementById('exp');
			exp.disabled=false;
		}
		else{
			var exp =document.getElementById('exp');
			exp.disabled=true;
		}*/
	}
</script>

<?php Yii::app()->clientScript->registerScript('textFieldAdder','$("#additional-link").bind("click",function(){
    var id="title";
	var id2="date";
    var size=$("#additional-inputs > li input").size();
    $("#additional-inputs").append("Title");
    $("#additional-inputs").append("<li><input type=text id="+id+size+" name="+id+"["+size+"]></li>");
    $("#additional-inputs").append("Expiration Date");
	$("#additional-inputs").append("<li><input type=date id="+id2+size+" name="+id2+"["+size+"]></li>");
    })')?>
	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-licence-applicantlicence-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3> PROFESSIONAL LICENSE </h3>
    <p class="note">Include professional and non-professional driver's licence</p>
     
	 
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title' , array('id'=>'title' , 'onChange'=>'showExp();')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'expdate'); ?>

		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    		'model'=>$model,
    		'attribute'=>'expdate',
    		'id'=>'exp',
    			// additional javascript options for the date picker plugin
    		'options'=>array(
        		'showAnim'=>'fold',
                'changeMonth'=>'true',
                'changeYear'=>'true',
                'yearRange'=>'1940:',

    	),
    		'htmlOptions'=>array(
    			'style'=>'width:100px;'
    	),
    	));
		//echo $form->textField($model,'expdate', array('id'=>'exp' , 'disabled'=>true)); ?>
		<?php echo $form->error($model,'expdate'); ?>
	</div>

	<?php echo CHtml::link('Add input','#',array('id'=>'additional-link')); ?></br></br>
	<ul>
	<div id="additional-inputs">

	</div>
	</ul>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
