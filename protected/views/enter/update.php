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
/* @var $model Enter */

/*$this->breadcrumbs=array(
	'Enters'=>array('index'),
	$model->username=>array('view','id'=>$model->username),
	'Update',
);*/

$this->menu=array(
	array('label'=>'List Enter', 'url'=>array('index')),
	array('label'=>'Create Enter', 'url'=>array('create')),
	array('label'=>'View Enter', 'url'=>array('view', 'id'=>$model->username)),
	array('label'=>'Manage Enter', 'url'=>array('admin')),
);
?>

<h1>Update Enter <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
