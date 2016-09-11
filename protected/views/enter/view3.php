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
	$model->enteremail,
);*/
/*
$this->menu=array(
	array('label'=>'List Enter', 'url'=>array('index')),
	array('label'=>'Create Enter', 'url'=>array('create')),
	array('label'=>'Update Enter', 'url'=>array('update', 'id'=>$model->enteremail)),
	array('label'=>'Delete Enter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->enteremail),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Enter', 'url'=>array('admin')),
);*/

$this->widget('application.components.BreadCrumb', array(
  'crumbs' => array(
	array('name' => 'Home', 'url' => array('site/index')),
	array('name' => 'Confirm Account',),
  ),
  'delimiter' => ' >> ', // if you want to change it
)); 

?>


</br>
</br>
<h1> Confirm Account Details </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		//'password',
		'type',
	),
)); ?>

</br>

<form name="confirm" method="POST" action=<?php echo Yii::app()->createAbsoluteURL("Enter/Back");?>>

    <div class="row">
		<input type="hidden" value="<?php echo $model->username; ?>" name="username"/>
	</div>
            
	<div class="row buttons">
		<input type="submit" value="Back" name="submit"/>
	</div>
	
</form>

<form method="post" action=<?php echo Yii::app()->createAbsoluteURL("Peso/Create");?>>

    <div>
		<input type="hidden" value="<?php echo $model->username; ?>" name="username"/>
		<input type="submit" value="Confirm"/>
	</div>
	
</form>

