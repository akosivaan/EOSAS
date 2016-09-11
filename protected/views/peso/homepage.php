<?php

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


echo "</br>";
echo "PENDING Employment Opportunities";

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employment-grid',
	'dataProvider'=>$model1->searchPENDING(),
	'filter'=>$model1,
	'columns'=>array(
		'jobtitle',
		'location',
		'specialization',
		'type',
		'companyname',
		/*
		'regstatus',
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
			'template'=>'{view}{approve}',
			'viewButtonUrl' => 'Yii::app()->createUrl("employment/view", array("id"=>$data->id))',
			'buttons' => array(
               'approve' => array( 
                 'label' => 'Approve', // text label of the button
					  'url'=>'Yii::app()->createUrl("employment/Approve", array("id"=>$data->id))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/approve.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),
               ),
		),
	),
));

echo "PENDING Employer";

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employer-grid',
	'dataProvider'=>$model2->searchPENDING(),
	'filter'=>$model2,
	'columns'=>array(
		'username',
		'employeremail',
		//'password',
		'companyname',
		'companyaddress',
		//'facebook',
		'regstatus',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{approve}',	
			'viewButtonUrl' => 'Yii::app()->createUrl("employer/view", array("id"=>$data->username))',
			'buttons' => array(
               'approve' => array( 
                 'label' => 'Approve', // text label of the button
					'url'=>'Yii::app()->createUrl("employer/Approve", array("id"=>$data->username))',
                   'imageUrl' => Yii::app()->baseUrl . '/images/approve.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),
               ),
		),
	),
)); 

echo "PENDING Applicants";
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'applicant-grid',
	'dataProvider'=>$model3->searchPENDING(),
	'filter'=>$model3,
	'columns'=>array(
		'username',
		'applicantemail',
		//'password',
		//'pin',
		'fname',
		'lname',
		'mname',
		'municipality',
		/*
		'birthdate',
		'sex',
		'age',
		'religion',
		'street',
		'brgy',
		
		'placeBirth',
		'height',
		'weight',
		'maritalstatus',
		'contactNo',
		'employmentstatus',
		'wheretowork',
		'passportno',
		'passportexp',
		'facebook',
		'regstatus',
		'position_wanted',
		'specialization_wanted',
		*/
		
		array( 
			'class'=>'CButtonColumn',
			'template'=>'{view}{approve}',	
			'viewButtonUrl' => 'Yii::app()->createUrl("applicant/view", array("id"=>$data->username))',
			'buttons' => array(
               'approve' => array( 
                 'label' => 'Approve', // text label of the button
					'url'=>'Yii::app()->createUrl("applicant/deactivate", array("id"=>$data->username))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/approve.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),
               ),
		),
	),
)
);

?>



