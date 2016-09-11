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
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name;

?>
</br></br>
<h2>Job Opening</h2>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employment-grid',
	'dataProvider'=>$model3->searchEmployment(),
	'filter'=>$model3,
	//'filter'=>CHtml::dropDownList('specialization', '', CHtml::listData(employment::model()->getSpecialization(),'id','text','group') ),
	'columns'=>array(
		'jobtitle',
		'location',
		
		'specialization'=> array(
			'name' => 'specialization',
			//'value' => '$data->package->package_title',
			'filter'=> CHtml::listData(Employment::model()->getSpecialization(),'id','text','group')
		),
		
		'companyname',
		'type',
		/*
		'regstatus',
		'email',
		'minEduc',
		'maxeduc',
		'minexp',
		'maxage',
		'minage',
		'sex',
		'maritalstatus',
		'position',
		'min_salary',
		'max_salary',
		'description',
		'pic',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',	
			'viewButtonUrl'=>'Yii::app()->createUrl("employment/view", array("id"=>$data->id))'
		),
	),
));
?>
<h2>Upcoming Job Fair:</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'announcements-grid',
	'dataProvider'=>$model2->searchUpcoming(),
	//'filter'=>announcements::model(),
	'columns'=>array(
		//'id',
		'title',
		'start',
		'ending',
		'companies',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->createUrl("announcements/view", array("id"=>$data->id))',
		),
	),
)); ?>
<h2>Ongoing Job Fair:</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'announcements-grid',
	'dataProvider'=>$model2->searchOngoing(),
	//'filter'=>announcements::model(),
	'columns'=>array(
		//'id',
		'title',
		'start',
		'ending',
		'companies',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->createUrl("announcements/view", array("id"=>$data->id))',
		),
	),
)); ?>

<h2>Upcoming Trainings:</h2>

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model->searchAnnouncement(),
//	'filter'=>$model,
	'columns'=>array(
		'title',
		'place',
		'category',
		'start',
		'ending',
		'schedule',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->createUrl("trainings/view", array("id"=>$data->id))',
		),
	),
)); 
?>

<h2>Ongoing Trainings:</h2>

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model->searchAnnouncements(),
//	'filter'=>$model,
	'columns'=>array(
		'title',
		'place',
		'category',
		'start',
		'ending',
		'schedule',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->createUrl("trainings/view", array("id"=>$data->id))',
		),
	),
)); 
?>

