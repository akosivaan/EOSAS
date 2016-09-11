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

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

if($type == 'PESO OFFICER'){
	$status = Peso::model()->findByPK($id);
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
</br>
<center><h1>LIST  OF TRAININGS</h1></center>
	<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trainings-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'title',
		'place',
		'category',
		'start',
		'ending',
		'schedule',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{attendee}',
			//'viewButtonUrl' => 'Yii::app()->createUrl("employment/view")',
			'buttons' => array(
			   'attendee' => array(
			  		'label' => 'Attendees',
			  		'id' => 'attendee',
			  		'url'=>'Yii::app()->createUrl("trainings/Attendees", array("id"=>$data->id))',
			   	),
		),
	),
))); 

?>

<form method="post" action="<?php echo Yii::app()->createAbsoluteURL("trainings/PDF");?>">	
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


