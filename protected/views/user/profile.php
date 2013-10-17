<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Пользователь'=>array('/user'),
	Yii::app()->user->name,
);
?>
<h1>Профиль пользователя</h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<div class='flash-error'>
<?php
echo 'User type: '.Yii::app()->user->identType();
echo '<br/>';
echo 'User UID : '.Yii::app()->user->uid();
echo '<br/>';
echo 'User ID : '.Yii::app()->user->id;
echo '<br/>';
echo 'User name : '.Yii::app()->user->name;

?>
</div>
