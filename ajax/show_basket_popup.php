<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $GROUP_POLICY;
$GROUP_POLICY = true;
?>
<div id="basket_preload">
<?include_once("action_basket.php");?>
<?$arParams = unserialize(urldecode($_REQUEST["PARAMS"]));?>

<?$APPLICATION->IncludeComponent( "bitrix:sale.basket.basket.line", "normal", $arParams, false, array("HIDE_ICONS" =>"Y") );?>
</div>