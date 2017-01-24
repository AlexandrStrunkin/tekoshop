<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<form method="post">
	<input type="submit" name="submitted" value="Отправить тестовые письма" />
</form>
<?
if($_REQUEST["result"]=="ok"){
	?>
	<div>Сообщения успешно отправлены!</div>
	<?
}

if($_POST["submitted"]){
	checkRemovedFromSets();
	//LocalRedirect($APPLICATION->GetCurPageParam("result=ok",array("result")));
}
?> 