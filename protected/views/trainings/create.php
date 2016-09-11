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

/*$this->breadcrumbs=array(
	'Trainings'=>array('index'),
	'Create',
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

if($type == 'PESO OFFICER'){
	$status = Peso::model()->findByPK($id);
	
	$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Homepage', 'url' => array('peso/Homepage')),
				array('name' => 'Create Training'),
			),
			'delimiter' => ' > ', // if you want to change it
		)); 
}

?>

</br>
<h1>Create Training</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
