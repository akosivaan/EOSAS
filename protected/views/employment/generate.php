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
/* @var $this EmploymentController */
/* @var $model Employment */

/*$this->breadcrumbs=array(
	'Employments'=>array('index'),
	'Manage',
);*/

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
?>

</br>
<center><h1> List of All Employment Opportunities </h1></center>
<?php
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($type == 'PESO OFFICER'){
$status = Peso::model()->findByPK($id);

if($status->regstatus != 'PENDING   '){ ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employment-grid',
	'dataProvider'=>$model->searchAll(),
	//'filter'=>$model,
	'columns'=>array(
		'jobtitle',
		'companyname',
		'email',
		'location',
		'specialization',
		//'position',
		'regstatus',
		/*
		'sex',
		'minEduc',
		'maxeduc',
		'minexp',
		'maxage',
		'minage',
		'maritalstatus',
		'min_salary',
		'max_salary',
		'type',
		'description',
		'pic',
		*/
	),
));
}
} 
else if($type == 'Employer'){
	$status = Employer::model()->findByPK($id);
	if($status->regstatus != 'PENDING'){ ?>
		
	</br>
<h1>Manage Employment Opportunities </h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employment-grid',
	'dataProvider'=>$model->searchManage(),
	'filter'=>$model,
	'columns'=>array(
		'jobtitle',
		'location',
		'specialization',
		'type',
		'regstatus',
		'email',
		/*
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
			'template'=>'{view}{update}{deactivate}',
			'buttons' => array(
               'deactivate' => array( 
                 'deactivate' => 'activate', // text label of the button
					  'url'=>'Yii::app()->createUrl("employment/DeactivateEmployer", array("id"=>$data->id , "type"=>$data->regstatus))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/deactivate.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                   ),	   
            ),  
		),
	),
)); 
}
}

?>

<form method="post" action="<?php echo Yii::app()->createAbsoluteURL("employment/PDF");?>">	
<label>Date Range:</label><br/>
<div class="row buttons">
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    		'name'=>'dateFrom',
    			// additional javascript options for the date picker plugin
    		'options'=>array(
        		'showAnim'=>'fold',
    	),
    		'htmlOptions'=>array(
    			'style'=>'width:100px;'
    	),
    	));
    	echo '-';
    	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    		'name'=>'dateTo',
    			// additional javascript options for the date picker plugin
    		'options'=>array(
        		'showAnim'=>'fold',
    	),
    		'htmlOptions'=>array(
    			'style'=>'width:100px;'
    	),
    	));
		?>
		<input type="submit" value="Generate"/>	
</div>

</form>	

