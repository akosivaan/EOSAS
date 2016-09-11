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

</br>
<center><h1> List of Employers</h1></center>
<?php 
$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($type == 'PESO OFFICER'){
$status = Peso::model()->findByPK($id);

if($status->regstatus != 'PENDING'){ ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employer-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
		'employeremail',
	//	'password',
		'companyname',
		'companyaddress',
		'contactno',
	//	'facebook',
		'regstatus',
	
		
	),
)); 
}
}
?>

<form method="post" action="<?php echo Yii::app()->createAbsoluteURL("employer/PDF");?>">	
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
