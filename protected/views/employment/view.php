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
/* @var $model Employment */

/*$this->breadcrumbs=array(
	'Employments'=>array('index'),
	$model->jobtitle,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 
if($id == ""){
		$this->widget('application.components.BreadCrumb', array(
			'crumbs' => array(
				array('name' => 'Home', 'url' => array('site/index')),
				array('name' => 'Employment Lists', 'url' => array('site/list')),
				array('name' => 'Employment Detail',),
			),
			'delimiter' => ' > ', // if you want to change it
		)); 
}
?>

</br>
<h1> Employment Title: <?php echo $model->jobtitle; ?> </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'jobtitle',
		'location',
		'specialization',
		'position',
		'companyname',
		'minEduc',
		'maxeduc',
		'minexp',
		'maxage',
		'minage',
		'sex',
		'maritalstatus',
		array(
			'name'=>'Minimum Salary',
			'value'=>Yii::app()->controller->getCurrency($model->min_salary)
		),
		array(
			'name'=>'Maximum Salary',
			'value'=>Yii::app()->controller->getCurrency($model->max_salary)
		),
		'type',
	//	'regstatus',
		'description',
	//	'pic',
	),
)); ?>

<?php
	$id = Yii::app()->session['username']; 
	$type = Yii::app()->session['type']; 
	if($id != ""){
	  $id = Yii::app()->request->getQuery('id');
	  $id = str_replace(' ', '_', $id);
		if($type == 'PESO OFFICER'){ ?>
		
	<form name="approveEmployment" method="post" action=<?php echo Yii::app()->createAbsoluteURL("employment/employment/id/$id");?>>
        
        </br>
        
    	<div class="row buttons">
    		<input type="submit" value="Approve" name="approve"/>

    		<input type="submit" value="Deactivate" name="delete"/>
			
    	</div>
	
    </form>
		
	<?php
	
	}
	else if($type == 'Applicant'){
		$myid = Yii::app()->session['username'];
		if(Matches::model()->findByAttributes(array('applicant'=>$myid,'job_id'=>$id))){
	?>
		<h5>Application on process</h5>
	<?php	
		}
		else{
	?>
		<form name="approveEmployer" method="post" action=<?php echo Yii::app()->createAbsoluteURL("applicant/apply/id/$id")?>>

		<input type="hidden"  name="companyname" value=<?php echo CHtml::encode($model->username); ?> />
		
    	<div class="row buttons">
    	<input type="submit" value="Apply" name="apply"/>
<?php
		}
	?>
<?php
	}
	}
?>
