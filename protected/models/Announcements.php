<?php

/**
 * This is the model class for table "announcements".
 *
 * The followings are the available columns in table 'announcements':
 * @property string $id
 * @property string $title
 * @property string $start
 * @property string $ending
 * @property string $companies
 */
class Announcements extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Announcements the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'announcements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title , start, ending, companies', 'required'),
			array('title', 'length', 'max'=>100),
			array('companies','numerical','min'=>1),
			array('start, ending, companies', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, start, ending, companies', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'start' => 'Start Date',
			'ending' => 'End Date',
			'companies' => 'No. of Companies',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		//$criteria->addcondition('start',$this->start,true);
		//$criteria->compare('end',$this->end,true);
		$criteria->compare('companies',$this->companies,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchUpcoming()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$now = new CDbExpression("NOW()");
		$criteria->addCondition('start > '.$now);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchOngoing(){
		$criteria=new CDbCriteria;
		$criteria->compare('title',$this->title,true);
		
		$now = new CDbExpression("NOW()");
		$criteria->addCondition('ending >= '.$now);
		$criteria->addCondition('start <='.$now);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}