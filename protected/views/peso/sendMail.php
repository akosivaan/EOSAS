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
	$model->pesoemail,
);*/

$id = Yii::app()->session['username']; 
$type = Yii::app()->session['type']; 


$id = Yii::app()->request->getQuery('id');

echo "<br/>";
echo "Message: " . $id . "<br/>";
?>

<br/>

<form name="input" action=<?php echo Yii::app()->createAbsoluteURL("Peso/SendEmail/id/$id");?> method="post">
<p> Subject:<p>
<input type="text" name="subject" style="width: 400px; height: 20px;"/>
<p> Your Message:<p>
<textarea name="message" rows="10" cols="75">
</textarea>

<br/><br/>
	
<input type="submit" value="Send">
</form>
