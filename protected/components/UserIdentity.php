<?php

class UserIdentity extends CUserIdentity
{
  protected $_uid;
  public function authenticate()
  {
    $this->errorCode=self::ERROR_NONE;
    $user = SiteUser::model()->find('login=:Login',array(':Login'=>$this->username));
    if (isset($user->login)) {
      if (md5($this->password)!=$user->hash) {
	$this->errorCode=self::ERROR_PASSWORD_INVALID;
      } else {
	$this->username = $user->name;
	$this->_uid = $user->uid;
      }
    } else {
      $this->errorCode=self::ERROR_USERNAME_INVALID;
    }
    return !$this->errorCode;
  }

  /// @brief уникальный идентификатор пользователя в БД
  public function uid()
  {
    return isset($this->_uid) ? $this->_uid : 0;
  }
}
