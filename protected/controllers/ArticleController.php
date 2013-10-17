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
	    $arttheme = ArticleTheme::model()->findByPk($themeid);
	    $themelist = new CActiveDataProvider('ArticleTheme', array(
	        'criteria'=>array(
	            'condition'=>'parent='.$themeid
	        ),
	    ));
	    $articles = new CActiveDataProvider('ArticleBody', array(
		'criteria'=>array(
		    'condition'=>'theme='.$themeid,
		)
	    ));
	    
	    $this->render('theme', 
			  array('arttheme'=>$arttheme->title, 
				'parenttheme'=>ArticleTheme::model()->findByPk($arttheme->parent), 
				'id'=>$themeid,'articles'=>$articles, 
				'themelist'=>$themelist
				)
	    );
	}

	public function actionThemelist()
	{
	    $themes = new CActiveDataProvider('ArticleTheme',array(
		'criteria'=>array(
		    //'condition'=>'parent',
		)
	    ));
	    $this->render('themelist',array('themelist'=>$themes));
	}

	public function actionView($artid)
	{
	    $article = ArticleBody::model()->findByPk($artid);
	    if (isset($article->body)) {
		$this->render('view', array('article'=>$article));
	    } else {
		throw new CHttpException(404,'Запрашиваемая статья не найдена');
	    }
	}

	public function actionThemeadd($title, $parent)
	{
	  $article = new ArticleTheme;
	  $article->title = $title;
	  $article->parent = $parent;
	  /// @todo Добавить валидацию введенного значения
	  if ($article->save()) {
	    $this->redirect($this->createUrl('/article/theme', array('themeid'=>$parent)));
	  }
	}

	public function actionThemedel($themeid) {
	  $theme = ArticleTheme::model()->findByPk($themeid);
	  $parent = $theme->parent;
	  $theme->delete();
	  $this->redirect($this->createUrl('/article/theme', array('themeid'=>$parent)));
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
