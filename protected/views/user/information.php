<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Пользователь'=>array('/user'),
	$dossier->name,
);
?>
<h1>Информация о спортсмене</h1>
<?php /*<table>
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
 * */
?>
<table>
    <tbody>
        <tr>
            <td>фото</td>
            <td><image src='<?php echo $dossier->photo;?>' alt='фото отсутствует'/></td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><?php echo $dossier->name;?></td>
        </tr>
        <tr>
            <td>родился(ась)</td>
            <td><?php echo $dossier->date_of_bethday;?></td>
        </tr>
        <tr>
            <td>cпортивный разряд</td>
            <td><?php echo $dossier->sport_range;?></td>
        </tr>        
        <tr>
            <td>жетон спаение в горах</td>
            <td><?php echo $dossier->mountain_resque ? 'жетон №':'не присваивался'; ?></td>
        </tr>
        <tr>
            <td>инструктор альпинизма (категория)</td>
            <td><?php echo $dossier->mountain_guide; ?></td>
        </tr>
    </tbody>

</table>
    <?php
        if (isset($dossier->about)) {
            echo $dossier->about;
        }
    ?>
<tt>Информация о восхождениях</tt>

<hr/>
<tt>Информация о членстве в клубе</tt>
<hr/>
<tt>Информация о членстве в федерации</tt>
<hr/>
<?php
if(isset($user->uid)) {
    ?>
<h4>Учетная запись пользователя</h4>
<?php
    var_dump($user);
}
?>
<hr/>
<tt>Список публикаций</tt>
