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
/* @var $this AnnouncementsController */
/* @var $model Announcements */

/*$this->breadcrumbs=array(
	'Announcements'=>array('index'),
	$model->title,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

?>

<h1>View Announcements #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'title',
		'start',
		'ending',
		'companies',
	),
)); ?>
