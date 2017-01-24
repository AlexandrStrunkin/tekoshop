<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рассылка - редактирование шаблона");

global $USER;
if(!($USER->IsAuthorized())){
	$APPLICATION->RestartBuffer();
	die();
}

include($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/subscribe/templates/news_test/template.php');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>