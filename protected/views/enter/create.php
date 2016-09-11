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
	'Create',
);*/

/*
$this->menu=array(
	array('label'=>'List Enter', 'url'=>array('index')),
	array('label'=>'Manage Enter', 'url'=>array('admin')),
);*/
$this->widget('application.components.BreadCrumb', array(
		  'crumbs' => array(
			array('name' => 'Home', 'url' => array('site/index')),
			array('name' => 'Create Account', ),
			
		  ),
		  'delimiter' => ' >> ', // if you want to change it
		)); 
		
?>

</br>
<h1>Create Account</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
