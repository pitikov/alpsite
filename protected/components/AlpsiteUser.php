<?php
    class AlpsiteUser extends CWebUser {
        public function init()
        {
            parent::init();
        }

        /** @fn login
        * @brief Авториязация пользователя в системе
        */
        public function login($identity, $duration = 0)
        {
            $ret = parent::login($identity, $duration);

	    $identType = get_class($identity);
	    Yii::app()->request->cookies['identType'] = new CHttpCookie('identType',$identType);
	    if ( $identType == 'UserIdentity') {
		Yii::app()->request->cookies['uid'] = new CHttpCookie('uid', $identity->uid());
	    } elseif ( $identType == 'EAuthUserIdentity') {
		$openId = SiteUserOpenid::model()->findByAttributes(array('token'=>md5($identity->id)));
		Yii::app()->request->cookies['uid'] = new CHttpCookie('uid', $openId->uid);
	    }

            return $ret;
        }


        public function logout($destroySession = true)
        {
	    unset(Yii::app()->request->cookies['uid']);
	    unset(Yii::app()->request->cookies['identType']);
            parent::logout($destroySession);
        }


        public function getId()
        {
            $ret = parent::getId();
            return $ret;
        }

        /** @fn uid()
          * @brief получить уникальный id пользователя в БД */
        public function uid()
        {
	    return isset(Yii::app()->request->cookies['uid']) ? Yii::app()->request->cookies['uid']->value : 0;
        }

        /** @fn identType
	  * @brief Получить тип аутентификации текущего пользователя
	  */
        public function identType()
        {
	    return isset(Yii::app()->request->cookies['identType']) ? Yii::app()->request->cookies['identType']->value : 'NoIdentity';
        }
    }

?>
