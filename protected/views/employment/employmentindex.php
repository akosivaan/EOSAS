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
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Employment',
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

?>

</br>
<h1>Employment</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'enablePagination'=>true,
	'itemView'=>'_viewemployment',
)); ?>
