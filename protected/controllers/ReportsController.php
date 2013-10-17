<?php

class ReportsController extends Controller
{
	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
	  $theme = ArticleTheme::model()->findByAttributes(array('title'=>'Отчеты'));
	  if (isset($theme->id)) {
	    $this->redirect($this->createUrl('/article/theme',array('themeid'=>$theme->id)));
	  } else {
	    throw new CHttpException('404','Тематика "Отчеты" не найдена в БД');
	  }
	}

	public function actionPost()
	{
		$this->render('post');
	}

	public function actionSubmit()
	{
		$this->render('submit');
	}

	public function actionView()
	{
		$this->render('view');
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
