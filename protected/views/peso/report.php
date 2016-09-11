<?php
/* @var $this PesoController */
/* @var $model Peso */

/*$this->breadcrumbs=array(
	'Pesos'=>array('index'),
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
	$('#peso-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="search-form" style="display:none">

</div><!-- search-form -->
</br>
<center><h1> List of Placed Applicant</h1></center>
<?php

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'peso-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'username',
		array(
			'header'=>'Applicant Name', 'value'=>array($this,'getApplicantName'),
		),
		array(
			'header'=>'Job Title', 'value'=>array($this,'getJobTitle'),
		),
		array(
			'header'=>'Employer','value'=>array($this,'getEmployer'),
		),
		'date',
		
	),
)); ?>

<form method="post" action="<?php echo Yii::app()->createAbsoluteURL("/peso/PDF");?>">	
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
