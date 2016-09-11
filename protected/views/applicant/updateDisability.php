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
/* @var $this ApplicantDisController */
/* @var $model ApplicantDis */
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
	
</script>

<?php Yii::app()->clientScript->registerScript('textFieldAdder','$("#additional-link").bind("click",function(){
    var id="optional_text";
    var size=$("#additional-inputs > li input").size();
    $("#additional-inputs").append("<li><input type=text id="+id+size+" name="+id+"["+size+"]></li>");
    })')?>
	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-dis-applicantDis-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<label>Disabilities</label>
	<?php echo $form->errorSummary($model); ?>
<?php
	if(count($model) == 0){
?>
	<div class="row">
		<input type="text" name="disability[0]"/>
	</div>
<?php
	}
	else{
		$counter = 0;
		foreach($model as $disability){
?>
	<input type="text" value='<?php echo $disability['disability']; ?>' name='disability[<?php echo $counter?>]'/><br/>
<?php
	$counter++;
		}
	}
?>
	<?php echo CHtml::link('Add input','#',array('id'=>'additional-link')); ?>
	<ul>
	<div id="additional-inputs">
		<!--<li><?php echo CHtml::textfield('optional_text[0]',''); ?></li>-->
	</div>
	</ul>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
<input type="hidden" value="updateDisability" name="updateDisability"/>
<?php $this->endWidget(); ?>

</div><!-- form -->
