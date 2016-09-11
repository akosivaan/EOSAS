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
/* @var $this ApplicantSkillController */
/* @var $model ApplicantSkill */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applicant-skill-applicantSkill-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3> OTHER SKILLS ACQUIRED WITHOUT FORMAL TRAINING </h3>
    <p class="note"> Check as many as your actual experience</p>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

  <table class='tabSkill'>
    <tr>
      <th>People Skill</th>
      <th>Data Skill</th>
      <th>Thing Skill</th>
      <th>Idea Skill</th>
    </tr>
  <tr>
    <td>
	<?php 
    $skills = ApplicantSkill::model()->findAllByAttributes(array('username'=>$username));
    $arr = array();
    foreach($skills as $s){
      array_push($arr,$s->skill);
    }
    echo CHtml::checkBoxList('people',$arr,
      array(
        'Teaching'=>'Teaching',
        'Negotiating'=>'Negotiating',
        'Diverting'=>'Diverting',
        'Persuading'=>'Persuading',
        'Speaking'=>'Speaking',
        'Serving'=>'Serving',
        'Helping'=>'Helping',
        'Encouraging'=>'Encouraging',
        'Motivating'=>'Motivating',
        'Leading'=>'Leading',
        'Promoting'=>'Promoting',
        'Selling'=>'Selling'
      ),
      array(
        'class'=>'floating',
        'template'=>'<li class="checkBox">{input}{label}</li>'
      ));
  ?>
    </td>
    <td>
  <?php

    echo CHtml::checkBoxList('data',$arr,
      array(
        'Coordinating'=>'Coordinating',
        'Analyzing'=>'Analyzing',
        'Compiling'=>'Compiling',
        'Computing'=>'Computing',
        'Tabulating'=>'Tabulating',
        'Comparing'=>'Comparing',
        'Planning'=>'Planning',
        'Recording'=>'Recording',
        'Posting'=>'Posting',
        'Checking'=>'Checking',
        'Researching'=>'Researching',
        'Testing'=>'Testing',
        'Copying'=>'Copying'
      ),
      array(
        'class'=>'floating',
        'template'=>'<li class="checkBox">{input}{label}</li>'
      ));
  ?>
    </td>
    <td>
  <?php 
    echo CHtml::checkBoxList('thing',$arr,
      array(
        'Machine Work'=>'Machine Work',
        'Setting-up'=>'Setting-up',
        'Operating/Controlling'=>'Operating/Controlling',
        'Driving/Steering'=>'Driving/Steering',
        'Manipulating'=>'Manipulating',
        'Materials Handling'=>'Materials Handling',
        'Inspecting'=>'Inspecting',
        'Producing'=>'Producing',
        'Warehousing'=>'Warehousing',
        'Building'=>'Building',
        'Precision Working'=>'Precision Working',
        'Restoring'=>'Restoring',
        'Feeding/Loading'=>'Feeding/Loading',
        'Assembling'=>'Assembling',
        'Repairing/Adjusting'=>'Repairing/Adjusting',
      ),
      array(
        'class'=>'floating',
        'template'=>'<li class="checkBox">{input}{label}</li>'
      ));
  ?>
    </td>
    <td>
  <?php 
    echo CHtml::checkBoxList('idea',$arr,
      array(
        'Implementing'=>'Implementing',
        'Synthesizing'=>'Synthesizing',
        'Creating/Inventing'=>'Creating/Inventing',
        'Discovering'=>'Discovering',
        'Interpreting'=>'Interpreting',
        'Expressing'=>'Expressing',
        'Instructing'=>'Instructing',
        'Organizing'=>'Organizing',
        'Theorizing'=>'Theorizing',
        'Speculating'=>'Speculating',
        'Predicting'=>'Predicting',
        'Anticipating'=>'Anticipating',
        'Innovating'=>'Innovating',
      ),
      array(
        'class'=>'floating',
        'template'=>'<li class="checkBox">{input}{label}</li>'
      ));
  ?>
    </td>
  </tr>
  </table>

  <input type='hidden' value='val' name='updateSkills'/>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
