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
	'Manage',
);*/
/*
$this->menu=array(
	array('label'=>'List Trainings', 'url'=>array('index')),
	array('label'=>'Create Trainings', 'url'=>array('create')),
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($id != "" && $type == 'Applicant'){
	$status = Enter::model()->findByAttributes(array('username'=>$id));
	if($status->status != 'PENDING'){
	
		/*$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Homepage', 'url' => array('applicant/Homepage')),
				//array('name' => '', 'url' => array('employment/admin')),
				array('name' => 'List of Trainings',),
			),
			'delimiter' => ' > ', // if you want to change it
		));*/ 
		?>
		
		</br>
	<h1>LIST TRAININGS</h1>
	<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model->searchAnnouncements(),
	'filter'=>$model,
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

	}
}
if($type == 'PESO OFFICER'){
	$status = Peso::model()->findByPK($id);
	
	$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Homepage', 'url' => array('peso/Homepage')),
				array('name' => 'Training List',),
			),
			'delimiter' => ' > ', // if you want to change it
	)); 
		
	/*if($status->regstatus != 'PENDING'){
		$this->menu=array(
		array('label'=>'Update Peso', 'url'=>array('peso/update', 'id'=>$id)),
		array('label'=>'Manage Applicants', 'url'=>array('applicant/admin')),
		array('label'=>'Manage Employers', 'url'=>array('employer/admin')),
		array('label'=>'Manage Employment Opportunities', 'url'=>array('employment/admin')),
		array('label'=>'Manage Trainings', 'url'=>array('trainings/admin')),
		array('label'=>'Manage Announcements', 'url'=>array('Announcements/admin')),
		array('label'=>'View All Employment Opportunities', 'url'=>array('employment/visitorSearch')),
		array('label'=>'Add Trainings', 'url'=>array('Trainings/Create')),
		array('label'=>'Generate Reports', 'url'=>array('Peso/Generate')),
		);
	}*/
	
	?>
	</br>
	<h1>LIST OF TRAININGS</h1>
	<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model->searchAll(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'place',
		'category',
		'start',
		'ending',
		'schedule',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 

}
if($id == ""){
	/*$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Home', 'url' => array('site/index')),
				//array('name' => 'Training Lists', 'url' => array('site/listTrain')),
				array('name' => 'Training List',),
			),
			'delimiter' => ' > ', // if you want to change it
		));*/ 
		?>
		
	</br>
	<h1>LIST TRAININGS</h1>
	<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model->searchAnnouncements(),
	'filter'=>$model,
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
		),
	),
)); 
	
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#trainings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


$id = Yii::app()->session['username'];
$type = Yii::app()->session['type']; 

	//visitor?>
	
