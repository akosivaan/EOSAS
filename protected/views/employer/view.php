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
/* @var $this EmployerController */
/* @var $model Employer */

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

?>

</br>
<h1>Employer Name: <?php echo $model->employeremail; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'employeremail',
	//	'password',
		'companyname',
		'companyaddress',
	//	'facebook',
		'regstatus',
		'contactno',
	),
)); 

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($type == 'PESO OFFICER'){
	$id = Yii::app()->request->getQuery('id');	?>
		<form name="approveEmployer" method="post" action=<?php echo Yii::app()->createAbsoluteURL("employer/Edit/id/$id")?>>
        </br>     
    	<div class="row buttons">
    		<input type="submit" value="Approve" name="approve"/>
    	
    		<input type="submit" value="Deactivate" name="delete"/>
    	</div>
	
    </form>
	
<?php 
}
?>
