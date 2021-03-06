<?php

class OfficialController extends Controller
{

  public function init()
  {
    $this->defaultAction='history';
    parent::init();
  }

  public function actionHistory()
  {
      $artTheme = 2;
      $artTitle = 'История клуба';
      $article = ArticleBody::model()->findByAttributes(array('title'=>$artTitle,'theme'=>$artTheme));
      if (isset($article->artid)) {
          $this->redirect($this->createUrl('/article/view',array('artid'=>$article->artid)));
      } else {
          if (Yii::app()->user->isGuest)
          {
              throw new CHttpException(404, 'Искомая статья не найденна');
          } else {
              $this->redirect($this->createUrl('/article/post',array('theme'=>$artTheme, 'tEdit'=>false, 'title'=>$artTitle)));
          }          
      }
  }

  public function actionRules()
  {
    $this->render('rules');
  }

  
  // Uncomment the following methods and override them if needed
  /*
  public function filters()
  {
    // return the filter configuration for this controller, e.g.:
    return array(
      'inlineFilterName',
      array(
	'class'=>'path.to.FilterClass',
	'propertyName'=>'propertyValue',
      ),
    );
  }

  public function actions()
  {
    // return external action classes, e.g.:
    return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
	'class'=>'path.to.AnotherActionClass',
	'propertyName'=>'propertyValue',
      ),
    );
  }
*/
}
