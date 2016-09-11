<?php

/**
 * This is the model class for table "trainings".
 *
 * The followings are the available columns in table 'trainings':
 * @property string $title
 * @property string $place
 * @property string $category
 * @property string $start
 * @property string $ending
 * @property string $schedule
 *
 * The followings are the available model relations:
 * @property Trainiees[] $trainiees
 */
class Trainings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Trainings the static model class
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
		return 'trainings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title , place  , category, start, ending , schedule', 'required'),
			array('title', 'length', 'max'=>30),
			array('place', 'length', 'max'=>20),
			array('category, schedule', 'length', 'max'=>50),
			array('start, ending', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, place, category, start, end, schedule', 'safe', 'on'=>'search'),
			//array('title','unique','message'=>'{attribute}:{value} already exists!'),
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
			'trainiees' => array(self::HAS_MANY, 'Trainiees', 'title'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'title' => 'Title',
			'place' => 'Place',
			'category' => 'Category',
			'start' => 'Start',
			'ending' => 'End',
			'schedule' => 'Description',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('category',$this->category,true);
	//	$criteria->compare('start',$this->start,true);
		$now = new CDbExpression("NOW()");
	//	$criteria->addCondition('ending >= '.$now);
		$criteria->compare('schedule',$this->schedule,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
		* Finding announcements that haven't started
	*/
	public function searchAnnouncement()
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
	
	/*
		* Produces announcements that are ongoing
	*/
	public function searchAnnouncements()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('title',$this->title,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('category',$this->category,true);
		
		$now = new CDbExpression("NOW()");
		$criteria->addCondition('ending >= '.$now);
		$criteria->addCondition('start <='.$now);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
		*Produces All Announcements
	*/
	public function searchAll()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$criteria->compare('title',$this->title,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('category',$this->category,true);
	//	$criteria->compare('start',$this->start,true);
	//	$criteria->compare('ending',$this->ending,true);
		$criteria->compare('schedule',$this->schedule,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
		* Search Available Employment Opportunities
	*/
	public function searchAvailable()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$id = Yii::app()->session['email']; 
		$i =0;
		$user = Yii::app()->db->createCommand()
		->select('title')
		->from('trainiees')
		->where('titlemail=:id', array(':id'=>$id))
		->queryAll();

		foreach($user as $need)
		{
		$pos = $need['title'];
		$i++;
		}   
			
		$criteria=new CDbCriteria;
		$criteria->compare('title', $this->title , true);
		$now = new CDbExpression("NOW()");
		
		if($i>0){
			$criteria->addCondition("NOT title = '" . $pos . "'" );
		}
		
		$criteria->addCondition('ending >= '.$now);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('schedule',$this->schedule,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
}
