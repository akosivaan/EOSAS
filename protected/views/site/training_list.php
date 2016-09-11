<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

</br></br>


<h1> List of Trainings </h1>

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>Trainings::model()->searchAnnouncements(),
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
			'viewButtonUrl' => 'Yii::app()->createUrl("trainings/view", array("id"=>$data->title))',
		),
	),
)); 
?>
