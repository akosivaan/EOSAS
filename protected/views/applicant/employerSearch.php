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
/* @var $this ApplicantController */
/* @var $model Applicant */

/*$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	'Manage',
);*/

$id = Yii::app()->session['username'];
$type= Yii::app()->session['type'];

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
?>

</br></br>
<h1>Search Applicant</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'applicant-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'fname',
		'lname',
		'mname',
		'position_wanted',
		'specialization_wanted',
		'contactNo',
		/*
		'applicantemail',
		'password',
		'pin',
		'birthdate',
		'sex',
		'age',
		'religion',
		'street',
		'brgy',
		'municipality',
		'placeBirth',
		'height',
		'weight',
		'maritalstatus',
		'employmentstatus',
		'wheretowork',
		'passportno',
		'passportexp',
		'facebook',
		'regstatus',
		
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{send}',
			'viewButtonUrl' => 'Yii::app()->createUrl("applicant/view2", array("id"=>$data->username))',
			'buttons' => array(
               'send' => array( 
                 'label' => 'Send Email', // text label of the button
					  'url'=>'Yii::app()->createUrl("peso/CreateEmail", array("id"=>$data->applicantemail))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/send.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                ),
            ),
		),
	),
)); ?>
