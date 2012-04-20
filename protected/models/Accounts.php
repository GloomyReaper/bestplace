<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property integer $id
 * @property string $login
 * @property string $pwd
 * @property string $salt
 * @property string $name
 * @property string $email
 * @property integer $disabled
 * @property string $create_dt
 */
class Accounts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Accounts the static model class
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
		return 'accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, pwd, salt, name, email, create_dt', 'required'),
			array('disabled', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>32),
			array('pwd', 'length', 'max'=>128),
			array('salt', 'length', 'max'=>16),
			array('name, email', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, pwd, salt, name, email, disabled, create_dt', 'safe', 'on'=>'search'),
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
			'login' => 'Login',
			'pwd' => 'Pwd',
			'salt' => 'Salt',
			'name' => 'Name',
			'email' => 'Email',
			'disabled' => 'Disabled',
			'create_dt' => 'Create Dt',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('disabled',$this->disabled);
		$criteria->compare('create_dt',$this->create_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/** проверка пароля */
    public function validatePassword($password)
    {
        return $this->hashPassword($password,$this->salt)===$this->pwd;
    }
 
    /** хеш пароля с солью */
    public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }

    /**
     * функция генерирует соль
     */
    public function generateSalt()
    {
		// набор символов для поля salt
		$chars = 'qwertyuiopasdfghjklzxcvbnm1234567890';

		// инициализируем возвращаемое значение
		$string = '';
    	
    	// случайно выберем длину строки	
		$length = rand(10, 15);
		$numChars = strlen($chars);
		for ($i = 0; $i < $length; $i++) {
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		}    	
    	
        return $string;
    }   	
}