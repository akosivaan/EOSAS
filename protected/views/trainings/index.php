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
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Trainings',
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

if($type == 'PESO OFFICER'){
	$status = Peso::model()->findByPK($id);
	if($status->regstatus != 'PENDING'){
	
		$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Homepage', 'url' => array('peso/Homepage')),
				array('name' => 'Create Training', 'url' => array('trainings/create')),
				array('name' => 'Training Details',),
			),
			'delimiter' => ' > ', // if you want to change it
		)); 
	}
} 
?>

</br>
<h1>Trainings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
