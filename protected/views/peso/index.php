<?php
/* @var $this PesoController */
/* @var $dataProvider CActiveDataProvider */


?>

<h1>Pesos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
