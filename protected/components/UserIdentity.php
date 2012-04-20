<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	// const ERROR_NONE=0;
    // const ERROR_USERNAME_INVALID=1;
    // const ERROR_PASSWORD_INVALID=2;
    // const ERROR_UNKNOWN_IDENTITY=100;
    const ERROR_USER_DISABLED=3;	
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	/* public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	} */
	
    private $_id;
 
    public function authenticate()
    {
        $username=strtolower($this->username);
        $account=Accounts::model()->find('LOWER(login)=?',array($username));
        if($account===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$account->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if($account->disabled!=0) // проверяем не отключен ли пользователь
            $this->errorCode=self::ERROR_USER_DISABLED;            
        else
        {
            $this->_id=$account->id;
            $this->username=$account->login;
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }	
}