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
?>
<?php 
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($type == 'PESO OFFICER'){
$status = Peso::model()->findByPK($id);

if($status->regstatus != 'PENDING'){ ?>

</br></br>
<h1>Manage Applicants</h1>

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
		'username',
		//'password',
		'applicantemail',
		//'password',
		//'pin',
		'fname',
		'lname',
		'mname',
		
		//'birthdate',
		'brgy',
		'sex',
		//'age',
		'contactNo',
		'employmentstatus',
		//'position_wanted',
		'specialization_wanted',
		'regstatus',
		/*'religion',
		'street',
		'brgy',
		'municipality',
		'placeBirth',
		'height',
		'weight',
		'maritalstatus',
		,
		
		'wheretowork',
		'passportno',
		'passportexp',
		'facebook',
		'
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{deactivate}{send}{match}',
			'buttons' => array(
               'deactivate' => array( 
                 'label' => 'Activate/Deactivate', // text label of the button
					'url'=>'Yii::app()->createUrl("applicant/Deactivate", array("id"=>$data->username))',
                   'imageUrl' => Yii::app()->baseUrl . '/images/deactivate.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                ),
				
				'send' => array( 
                 'label' => 'Send Email', // text label of the button
					  'url'=>'Yii::app()->createUrl("peso/CreateEmail", array("id"=>$data->applicantemail))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/send.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                ),
                'match' => array(
                	'label'=>'Placed Applicants',
                	'url'=>'Yii::app()->createUrl("employment/selectJob", array("id"=>$data->username))',
                	'imageUrl'=> Yii::app()->baseUrl . '/images/match.png',
                ),
             ),
		),
	),
));
}
}
else if($type == 'Employer'){ ?>
</br>
<h1>Applicants</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'applicant-grid',
	'dataProvider'=>$model->searchApproved(),
	'filter'=>$model,
	'columns'=>array(
		'applicantemail',
		//'password',
		//'pin',
		'fname',
		'lname',
		'mname',
		//'brgy',
		//'municipality',	
		//'regstatus',
		
		//'birthdate',
		'sex',
		'age',
		//'religion',
		//'street',
		//'placeBirth',
		//'height',
		//'weight',
		//'maritalstatus',
		'contactNo',
		'employmentstatus',
		//'wheretowork',
		//'passportno',
		//'passportexp',
		//'facebook',
		'position_wanted',
		'specialization_wanted',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{send}',
			'viewButtonUrl' => 'Yii::app()->createUrl("applicant/view", array("id"=>$data->username))',
			'buttons' => array(
               'send' => array( 
                 'label' => 'Send Email', // text label of the button
					  'url'=>'Yii::app()->createUrl("peso/CreateEmail", array("id"=>$data->applicantemail))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/send.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                ),
            ),
			
		),
	),
)); 
}?>
