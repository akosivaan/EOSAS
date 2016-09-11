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

/*$this->breadcrumbs=array(
	'Employers'=>array('index'),
	$model->employeremail,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#applicant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

echo "<h2>Available Training Programs</h2>";
echo "</br>";
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model1->searchAvailable(),
	'filter'=>$model1,
	'columns'=>array(
		'title',
		'place',
		'category',
		'start',
		'ending',
		'schedule',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{join}',
			'viewButtonUrl' => 'Yii::app()->createUrl("trainings/view", array("id"=>$data->id))',
			'buttons' => array(
               'join' => array( 
                 'label' => 'Join', // text label of the button
					  'url'=>'Yii::app()->createUrl("trainings/addTrainiee", array("title"=>$data->id))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/join.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),
               ),
			   
			   
		),
	),
)); 
?>




