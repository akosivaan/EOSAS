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
	$model->title,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

/*if($id == ""){
	$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Home', 'url' => array('site/index')),
				array('name' => 'Announcements', 'url' => array('peso/Announcement')),
				array('name' => 'Training Detail',),
			),
			'delimiter' => ' > ', // if you want to change it
	)); 
}*/
?>

</br>
<h1>Training Title: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'place',
		'category',
		'start',
		'ending',
		'schedule',
	),
));

