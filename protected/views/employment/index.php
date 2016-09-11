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
	'Employments',
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type'];
if($id == ""){
	$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Home', 'url' => array('site/index')),
				array('name' => 'Employment List', 'url' => array('site/list')),
				array('name' => 'Employment List'),
			),
			'delimiter' => ' > ', // if you want to change it
		)); 
}
?>

</br>
<h1>Employments </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
