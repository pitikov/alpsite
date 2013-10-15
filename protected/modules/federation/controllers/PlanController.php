<?php

class PlanController extends Controller
{

  public function init()
  {
    $this->defaultAction='calendar';
    parent::init();
  }

  public function actionAddevent()
  {
    $this->render('addevent');
  }

  public function actionCalendar()
  {
    $this->render('calendar');
  }

  public function actionDropevent()
  {
    $this->render('dropevent');
  }

  public function actionEditevent()
  {
    $this->render('editevent');
  }

  public function actionEvent()
  {
    $this->render('event');
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
