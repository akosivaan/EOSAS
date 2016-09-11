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

</br>
<h1>Peso Accounts</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'peso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'employee_no',
		//'municipality',
		//'brgy',
		'fname',
		'mname',
		'lname',
		'pesoemail',
		
		
		//'position',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{send}',
			
			'buttons' => array(
               'send' => array( 
                 'label' => 'Send Email', // text label of the button
					  'url'=>'Yii::app()->createUrl("peso/CreateEmail", array("id"=>$data->pesoemail))',
                      'imageUrl' => Yii::app()->baseUrl . '/images/send.jpg', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
                ),
         ),
		),
	),
)); ?>
