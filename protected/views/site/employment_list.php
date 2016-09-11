<?php
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name;
?>
</br></br>

<div class="hi">


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employment-form',
	'method' => 'post',
	'enableAjaxValidation'=>false,
));

	if(Yii::app()->session['email'] == NULL){
	
		echo CHtml::button('Create Account', array('submit' => array('enter/create'))); 
		
	}
	
	echo "<br/>";

	echo CHtml::button( 'Search Jobs', 
    array('submit' => array('employment/VisitorSearch'))); 

 $this->endWidget(); ?>

</div>
</div>
<div class="employment">

<h3>EMPLOYMENT OPPPORTUNITIES</h3>

<?php
	
$sql = "SELECT COUNT(*) FROM category";
$numClients = Yii::app()->db->createCommand($sql)->queryScalar();

for($i=0; $i<$numClients;$i++){

if ($i == 0){ echo "<div class='red' >";}
if ($i == 7){ echo "<div class='grey '>";}

$list= Yii::app()->db->createCommand('select * from category')->queryAll();

$rs=array();
foreach($list as $item){
    //process each item here
    $rs[]=$item['name'];

}
echo $rs[$i];
echo "<br/>";
	$hi = $rs[$i];
	$sql = "SELECT COUNT(*) FROM specialization where category='$hi'";
	$numSpecial = Yii::app()->db->createCommand($sql)->queryScalar();
	
	for($j=0; $j<$numSpecial;$j++){
	$specialization= Yii::app()->db->createCommand('select name from specialization where category=:category')->bindValue('category',$hi)->queryAll();
		$sp=array();
		foreach($specialization as $items){
			//process each item here
			$sp[]=$items['name'];
		}
		$final= $sp[$j];
		$final = str_replace (" ", "+", $final);
		?>
		<a href=<?php echo Yii::app()->createAbsoluteURL("Employment/Specialization/id/$final");?>> 
		<?php
		echo $sp[$j];
		$final = str_replace ("+", " ", $final);
		$date = date('Y-m-d');
		$sql = "SELECT COUNT(*) FROM employment where specialization='$final' and regstatus='APPROVED' and enddate > '$date'";	
		$nums = Yii::app()->db->createCommand($sql)->queryScalar();
		echo "(" . $nums . ")";
		?>

		</a> <?php
		
		
		
		echo "<br/>";
	}
	
	echo "<br/> <br/>";

	if ($i == 6 || $i == $numClients-1){ echo "</div>"; }

}

?>

 </div>
 </div>
