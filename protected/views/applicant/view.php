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
/* @var $this ApplicantController */
/* @var $model Applicant */

/*$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	$model->applicantemail,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 

?>

</br>
<h3>Applicant: <?php echo $model->fname." ".$model->mname." ".$model->lname; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'applicantemail',
	//	'password',
	//	'pin',
		'fname',
		'lname',
		'mname',
		'birthdate',
		'sex',
		'age',
		'religion',
		'street',
		'brgy',
		'municipality',
		'placeBirth',
		'height',
		'weight',
		'maritalstatus',
		'contactNo',
		'employmentstatus',
		'wheretowork',
		'passportno',
		'passportexp',
	//	'facebook',
	//	'regstatus',
		'position_wanted',
		'specialization_wanted',
	),
)); 
	echo "<br/><h3>Educational Attainment</h3>";
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model2,
	'attributes'=>array(
		'collegeDegree',
		'collegeSchool',
		'collegeGrad',
		'highSchool',
		'highschool',
		'highGrad',
		'elementarySchool',
		'elementary',
		'elementaryGrad',
	),
));
	echo "<br/><h3>Language Spoken</h3>";
	$size = sizeOf($model3);
	for($i=0;$i<$size;$i++){
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model3[$i],
		'attributes'=>array(
		'language',
		),
	));
	}
	
	echo "<br/><h3>Professional Licenses</h3>";
	$size = sizeOf($model4);
	for($i=0;$i<$size;$i++){
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model4[$i],
		'attributes'=>array(
		'title',
		'expdate',
		),
	));
	}

	echo "<br/><h3>Work Experience in Last 2 Years</h3>";
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model5,
	'attributes'=>array(
		'companyName',
		'companyAddress',
		'designation',
		'position',
		'advisor',
		'dateFrom',
		'dateTo',
	)));
?>

<?php
$id = Yii::app()->session['username']; 
	$type = Yii::app()->session['type']; 
	if($id != ""){
	  $id = Yii::app()->request->getQuery('id');
		if($type == 'PESO OFFICER'){ ?>
		
		<form name="approveApplicant" method="post" action=<?php echo Yii::app()->createAbsoluteURL("Applicant/AApp/id/$id");?>>
        
        </br>
        
    	<div class="row buttons">
    		<input type="submit" value="Approve" name="approve" /><!--onclick="myFunction()"/>-->
    	
    		<input type="submit" value="Deactivate" name="delete"/>
			
			<input type="hidden" name="ewan" id="txt1" />
    	</div>
	
</form>


<script>
	function myFunction()
	{
	var person=prompt("Enter the applicant's PIN","");

	if (person!=null)
	  {
	  document.getElementById("txt1").value = person;
	  }
	}
</script>
	
	<?php		
		}
		if($type == 'Employer'){
				//$job = str_replace(" " , "+" , $job);
				$id = Yii::app()->request->getQuery('id');
				?>
			<form name="approveApplicant" method="post" action=<?php echo Yii::app()->createAbsoluteURL("employer/Approves");?>>
        
				</br>
        
				<div class="row buttons">
						<input type="submit" value="Approve" name="approve" />
				</div>
	
				<input type="hidden" value=<?php echo $id ?> name="applicant" />
				<input type="hidden" value=<?php echo $job ?> name="job" />
				<input type="hidden" value=<?php 
				$id = Yii::app()->session['username']; 
				echo $id; ?> name="empemail" />
			</form>

		<?php }
	}
	
?>
