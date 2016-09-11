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
/* @var $this EnterController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Enters',
);*/

$this->menu=array(
	array('label'=>'Create Enter', 'url'=>array('create')),
	array('label'=>'Manage Enter', 'url'=>array('admin')),
);
?>

<h1>Enters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
