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

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

/*$this->breadcrumbs=array(
	'Announcements'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);*/
?>

<h1>Update Announcements <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
