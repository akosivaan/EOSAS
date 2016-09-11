<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
</br></br>

<h1>Public Employment Service Office Online System</h1>
<div class="hi">


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employment-form',
	'method' => 'post',
	'enableAjaxValidation'=>false,
));

	
	
	echo "<br/>";
 ?>
 	<a href=<?php echo Yii::app()->createAbsoluteURL("employment/VisitorSearch");?>> Search Employment Opportunities</a>
 <?php 
 $this->endWidget(); ?>

</div>

</br>
 <script language="JavaScript1.2">

//Translucent scroller- By Dynamic Drive
//For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
//This credit MUST stay intact for use

var scroller_width='100%'
var scroller_height='160px'
var bgcolor='#E0EFD1'
var pause=3000 //SET PAUSE BETWEEN SLIDE (3000=3 seconds)

var scrollercontent=new Array()
//Define scroller contents. Extend or contract array as needed
scrollercontent[0]='The Public Employment Service Office or PESO is a non-fee charging multi-employment service facility or entity established or accredited pursuant to Republic Act No. 8759 otherwise known as the PESO Act of 1999.'
scrollercontent[1]="Activities" + '</br>' + " => Job Fairs" + '</br>' + " => Livelihood and Self-employment Bazaars" + '</br>' + " => Special Credit Assistance for Placed Overseas Workers"


////NO need to edit beyond here/////////////

var ie4=document.all
var dom=document.getElementById&&navigator.userAgent.indexOf("Opera")==-1

if (ie4||dom)
document.write('<div style="position:relative;width:'+scroller_width+';height:'+scroller_height+';overflow:hidden"><div id="canvas0" style="position:absolute;background-color:'+bgcolor+';width:'+scroller_width+';height:'+scroller_height+';top:'+scroller_height+';filter:alpha(opacity=20);-moz-opacity:0.2;"></div><div id="canvas1" style="position:absolute;background-color:'+bgcolor+';width:'+scroller_width+';height:'+scroller_height+';top:'+scroller_height+';filter:alpha(opacity=20);-moz-opacity:0.2;"></div></div>')
else if (document.layers){
document.write('<ilayer id=tickernsmain visibility=hide width='+scroller_width+' height='+scroller_height+' bgColor='+bgcolor+'><layer id=tickernssub width='+scroller_width+' height='+scroller_height+' left=0 top=0>'+scrollercontent[0]+'</layer></ilayer>')
}

var curpos=scroller_height*(1)
var degree=10
var curcanvas="canvas0"
var curindex=0
var nextindex=1

function moveslide(){
if (curpos>0){
curpos=Math.max(curpos-degree,0)
tempobj.style.top=curpos+"px"
}
else{
clearInterval(dropslide)
if (crossobj.filters)
crossobj.filters.alpha.opacity=100
else if (crossobj.style.MozOpacity)
crossobj.style.MozOpacity=1
nextcanvas=(curcanvas=="canvas0")? "canvas0" : "canvas1"
tempobj=ie4? eval("document.all."+nextcanvas) : document.getElementById(nextcanvas)
tempobj.innerHTML=scrollercontent[curindex]
nextindex=(nextindex<scrollercontent.length-1)? nextindex+1 : 0
setTimeout("rotateslide()",pause)
}
}

function rotateslide(){
if (ie4||dom){
resetit(curcanvas)
crossobj=tempobj=ie4? eval("document.all."+curcanvas) : document.getElementById(curcanvas)
crossobj.style.zIndex++
if (crossobj.filters)
document.all.canvas0.filters.alpha.opacity=document.all.canvas1.filters.alpha.opacity=20
else if (crossobj.style.MozOpacity)
document.getElementById("canvas0").style.MozOpacity=document.getElementById("canvas1").style.MozOpacity=0.2
var temp='setInterval("moveslide()",50)'
dropslide=eval(temp)
curcanvas=(curcanvas=="canvas0")? "canvas1" : "canvas0"
}
else if (document.layers){
crossobj.document.write(scrollercontent[curindex])
crossobj.document.close()
}
curindex=(curindex<scrollercontent.length-1)? curindex+1 : 0
}

function resetit(what){
curpos=parseInt(scroller_height)*(1)
var crossobj=ie4? eval("document.all."+what) : document.getElementById(what)
crossobj.style.top=curpos+"px"
}

function startit(){
crossobj=ie4? eval("document.all."+curcanvas) : dom? document.getElementById(curcanvas) : document.tickernsmain.document.tickernssub
if (ie4||dom){
crossobj.innerHTML=scrollercontent[curindex]
rotateslide()
}
else{
document.tickernsmain.visibility='show'
curindex++
setInterval("rotateslide()",pause)
}
}

if (ie4||dom||document.layers)
window.onload=startit


</script>
</div>
<div class="employment">

<img border="3" src="/EOSAS/images/PESO.jpg" alt="PESO OFFICE" width="304" height="260">
<img border="3" src="/EOSAS/images/alaminos.jpg" alt="Alaminos Logo" width="300" height="240">
</br>
<?php

$num_employment =0;

$sql = "SELECT COUNT(*) FROM category";
$numClients = Yii::app()->db->createCommand($sql)->queryScalar();

for($i=0; $i<$numClients;$i++){
	$list= Yii::app()->db->createCommand('select * from category')->queryAll();
	$rs=array();
	foreach($list as $item){
		//process each item here
		$rs[]=$item['name'];
	}
	
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
		$final = str_replace ("+", " ", $final);
		$date = date('Y-m-d');
		$sql = "SELECT COUNT(*) FROM employment where specialization='$final' and regstatus='APPROVED' and enddate > '$date'";	
		$nums = Yii::app()->db->createCommand($sql)->queryScalar();
		if($nums != 0){
			$o=0;
			while($o < $nums){
			$num_employment++;
				$o++;
			}
		}
	}
}	

	$start =  date("Y-m-d");	
	$sql = "SELECT COUNT(*) FROM trainings where ending>='$start'";
	$numTrain = Yii::app()->db->createCommand($sql)->queryScalar();
	
?>
	<a href=<?php echo Yii::app()->createAbsoluteURL("Site/list");?>> 
		EMPLOYMENT OPPPORTUNITIES ( <?php echo $num_employment; ?> )
	</a>

	</br>
	</br>
	
	<a href=<?php echo Yii::app()->createAbsoluteURL("Site/listTrain");?>> 
		TRAINING LIST ( <?php echo $numTrain; ?> )
	</a>
	
 </div>
 </div>
 

 
