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
<div class="view">
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$data,
	'attributes'=>array(
		'jobtitle',
		'location',
		'specialization',
		'position',
		'companyname',
		'minEduc',
		'maxeduc',
		'minexp',
		'maxage',
		'minage',
		'sex',
		'maritalstatus',
		'min_salary',
		'max_salary',
		'type',
		'description',
		),
	)); ?>

<br/>

<?php
	$id = Yii::app()->session['username']; 
	$type = Yii::app()->session['type']; 
	if($id){
		$job = CHtml::encode($data->id);
		//$job = str_replace (" ", "+", $job);
		 ?>
		<form name="approveEmployer" method="post" action=<?php echo Yii::app()->createAbsoluteURL("applicant/apply/id/$job")?>>

		<input type="hidden"  name="companyname" value=<?php echo CHtml::encode($data->username); ?> />
		
    	<div class="row buttons">
    		<?php 

    		if(!Matches::model()->findByAttributes(array('applicant'=>$id,'job_id'=>$job))){
    		?>
    		<input type="submit" value="Apply" name="apply"/>
			<?php }
			else{
				echo "<h5>Application on process</h5>";
			}
			?>
    	</div>
	
    </form>
	<?php
		
	}
?>
</div>

