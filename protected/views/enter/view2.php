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
/* @var $this EnterController */
/* @var $model Enter */

/*$this->breadcrumbs=array(
	'Enters'=>array('index'),
	$model->enteremail,
);*/

$this->widget('application.components.BreadCrumb', array(
		  'crumbs' => array(
			array('name' => 'Home', 'url' => array('site/index')),
			array('name' => 'Create Account', 'url' => array('enter/create')),
			array('name' => 'Confirm', ),
			
		  ),
		  'delimiter' => ' >> ', // if you want to change it
		)); 
		
		
?>

</br>
</br>
<h1> Confirm Account Details </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		//'password',
		'type',
	),
)); ?>

<form name="confirm" method="POST" action=<?php echo Yii::app()->createAbsoluteURL("Enter/Back");?>>

    <div class="row">
		<input type="hidden" value="<?php echo $model->username; ?>" name="username"/>
	</div>
            
   
	<div class="row buttons">
		<input type="submit" value="Back" name="submit"/>
	</div>
	
</form>

<form name="confirm" method="POST" action=<?php echo Yii::app()->createAbsoluteURL("Applicant/Create");?>>

    <div class="row">
		<input type="hidden" value="<?php echo $model->username; ?>" name="username"/>
		<input type="submit" value="Confirm" name="submit"/>
	</div>
	
</form>



