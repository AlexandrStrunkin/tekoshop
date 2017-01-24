<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?> Text here....<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.full",
	"",
Array(),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>