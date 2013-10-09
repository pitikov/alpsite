<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Пользователь'=>array('/user'),
	$user->name,
);
?>
<h1><?php echo $user->name;?></h1>
<h2>Учетная запись</h2>
<table>
    <tbody>
        <tr>
            <td>Логин</td>
            <td><?php echo $user->login;?></td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><?php echo $user->name;?></td>
        </tr>
        <tr>
            <td>e-mail</td>
            <td><?php echo CHtml::link($user->mail,'mailto:'.$user->mail);?></td>
        </tr>        
    </tbody>
</table>
<?php
    if (isset($dossier->uid)) {
        echo '<h2>Досье</h2>';
    } else {
        echo '<tt>Досье не доступно</tt>';
    }
?>