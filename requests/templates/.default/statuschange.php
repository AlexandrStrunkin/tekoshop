<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="answer">
	<?
		if($answer) echo 'Статус успешно изменен';
		else echo 'Неудалось изменить статус';
	?>
	<p><a href="<?=$_SERVER['HTTP_REFERER'];?>">Вернуться назад</a></p>
</div>