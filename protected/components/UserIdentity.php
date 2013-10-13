<?php

class UserIdentity extends CUserIdentity
{
  public function authenticate()
  {
    $this->errorCode=self::ERROR_NONE;
    $user = SiteUser::model()->find('login=:Login',array(':Login'=>$this->username));
    if (isset($user->login)) {
      if (md5($this->password)!=$user->hash) {
	$this->errorCode=self::ERROR_PASSWORD_INVALID;
      }
      $this->username = $user->name;
    } else {
      $this->errorCode=self::ERROR_USERNAME_INVALID;
    }
    return !$this->errorCode;
  }
}
