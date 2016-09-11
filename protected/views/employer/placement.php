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
	'Manage',
);*/

/*$this->menu=array(
	array('label'=>'List Employer', 'url'=>array('index')),
	array('label'=>'Create Employer', 'url'=>array('create')),
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($type == 'PESO OFFICER'){
$status = Peso::model()->findByPK($id);

if($status->regstatus != 'PENDING'){ ?>
</br></br>
<h1>Manage Employers</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'employeremail',
		//'password',
		'companyname',
		'companyaddress',
		//'facebook',
		'location',
		'employertype',
		'contactno',
		'regstatus',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{select}',
			'buttons' => array(
               'select' => array( 
                 'label' => 'Select', // text label of the button
					'url'=>'Yii::app()->createUrl("employment/selectJob/", array("id"=>$data->username,"userid"=>$this->grid->owner->userid))',
                   'imageUrl' => Yii::app()->baseUrl . '/images/match.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                ),
             ),
			   
			   
		),
	),
)); 
}
}
?>
