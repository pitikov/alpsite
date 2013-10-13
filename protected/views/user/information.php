<?php
/** @var $this UserController */
$this->breadcrumbs=array(
	'Персоны'=>array('/user/dossierlist'),
	$dossier->name,
);

$this->layout='/layouts/column1';
?>
<div id='competitor_info'>
<h1>Информация о спортсмене</h1>
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
            <td>спортивный разряд</td>
            <td><?php echo $dossier->sport_range;?></td>
        </tr>
        <tr>
            <td>жетон спасение в горах</td>
            <td><?php echo $dossier->mountain_resque ? 'жетон №'.$dossier->mountain_resque :'не присваивался'; ?></td>
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
</div>
<?php
if (isset($climb->model)) {
  echo '<div id=\'climbing_list\'>';

  echo '<h2>Список восхождений</h2>';
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$climb,
    'columns'=>array(
	'date',
	'peak',
	'route',
	'difficulty'=>array(
	    'header'=>'к.с.',
	    'name'=>'difficulty'
	),
	'ingroup'
    )
));
echo '</div>';

}
if (isset($fmember->dossier)) {
?>
    <div id='federation_member'>
	<h2>Федерация альпинизма</h2>
	Является членом c <?php echo $fmember->member_from; ?> по <?php echo isset($fmember->member_to) ? $fmember->member_to : 'настоящее время.' ;?>
	<br/>
	<?php
	    if (isset($fmember->federation_role)) {
		echo 'Занимаемая должность: '.$fmember->federationRole->role;
	    }
	?>
	<br/>
	<?php echo $fmember->special_service; ?>
    </div>
<?php
}
if (isset($cmember->dossier)) {
?>
    <div id='club_member'>
	<h2>Альпклуб Пенза</h2>
	Является членом c <?php echo $cmember->member_from; ?> по <?php echo isset($cmember->member_to) ? $cmember->member_to : 'настоящее время.' ;?>
	<br/>
	<?php
	    if (isset($cmember->federation_role)) {
		echo 'Занимаемая должность: '.$cmember->federationRole->role;
	    }
	?>
	<br/>
	<?php echo $cmember->special_service; ?>
    </div>
<?php
}
if(isset($user->uid)) {
    ?>
<h2>Учетная запись пользователя</h2>
<table>
    <tbody>
	<tr>
	    <td>логин</td>
	    <td><?php echo $user->login;?></td>
	</tr>
	<tr>
	    <td>отображаемое имя</td>
	    <td><?php echo $user->name;?></td>
	</tr>
	<tr>
	    <td>e-mail</td>
	    <td><?php echo CHtml::link($user->mail, 'mailto:'.$user->mail);?></td>
	</tr>
    </tbody>
</table>
<?php
}

if (isset($publications->model)) {
  echo '<h2>Список публикаций</h2>';
  $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$publications,
    'columns'=>array(
	array(
	    'name'=>'title',
	    'class'=>'ArticleGridLink',
	    /// @todo Реализовать класс ссылки на статью
	),
	array(
	    'header'=>'в теме',
	    'name'=>'theme0.title',
	    'class'=>'ArticleFolderGridLink'
    	    /// @todo Реализовать класс ссылки на статью
	),
	array(
	    'name'=>'timestamp',
	    'header'=>'опубликованно'
    	    /// @todo Реализовать нормальное отображение даты
	),
    ),
));
}
?>
