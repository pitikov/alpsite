<?php

class ArticleController extends Controller
{

	public function init()
	{
	    $this->defaultAction=Yii::app()->user->isGuest ? 'themelist':'post';
	    parent::init();
	}

	public function actionEdit($artId)
	{
		$this->render('edit');
	}

	public function actionPost()
	{
		$this->render('post');
	}

	public function actionTheme($themeid)
	{
		$this->render('theme');
	}

	public function actionThemelist()
	{
		$this->render('themelist');
	}

	public function actionView($artid)
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
