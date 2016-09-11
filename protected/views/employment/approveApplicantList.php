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
	'Manage',
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#applicant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
	body{background-color: #ffffff; color: #0000000;}
	table {width: 100%; border-collapse: collapse;}
	table, th{border: 1px solid black; text-align:center; padding: 5px;}
	td{text-align: left; border:1px solid black;padding:5px;}
	h1 {text-align:center;margin-bottom: 5px;}
	.cent{text-align:center; line-height: 0px;}
	.alaminos{float:right;}
	.tophead p{
		position:relative;
		float:right;
		margin:0px;
	}
	.prepared{
		width: 200px;
		float:right;
		font-size: 14px;
	}
	#focal{
		text-align:center;
		margin-top:0px;
	}
	.prepared h5{
		font-size: 15px;
		text-align:center;
		margin-bottom: 0px;
	}
	#manager{
		font-size: 14px;
		width: 200px;
	}
	#manager h5{
		margin-bottom:0px;
		font-size: 15px;
	}
	#manager .man{
		font-size:15px;
		margin-left: 15%;
		margin-top:0px;
	}
</style>
<body>

</br>
<center><h1>Approved Applicant List</h1></center>
<h4 class='cent'>For the job 
<?php
	echo $job->jobtitle;
?></h4>
<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email Address</th>
				<th>Contact Number</th>
				<th>Address</th>
				<th>Employment Status</th>
				<th>Specialization</th>
				<th>Position</th>
			</tr>
		</thead>
<?php
	$count = 1;
	foreach($query as $app){
		$a = Applicant::model()->findByPK($app['applicant']);
?>
	<tbody>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $a['fname']." ".$a['mname']." ".$a['lname']; ?></td>
			<td><?php echo $a['applicantemail']; ?></td>
			<td><?php echo $a['contactNo']; ?></td>
			<td><?php echo $a['street']." ".$a['brgy']." ".$a['municipality']; ?></td>
			<td><?php echo $a['employmentstatus']; ?></td>
			<td><?php echo $a['specialization_wanted']; ?></td>
			<td><?php echo $a['position_wanted']; ?></td>
		</tr>
	</tbody>
<?php
	}
?>
</table>
<br/><br/>
</body>
