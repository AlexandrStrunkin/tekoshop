<? define("COMPARE_RESULT", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->IncludeComponent("teko:catalog.compare.result", ".default", array(
	"NAME" => "CATALOG_COMPARE_LIST",
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "",
	"FIELD_CODE" => array(
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "PREVIEW_PICTURE",
	),
	"PROPERTY_CODE" => "",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"PRICE_CODE" => array(
		0 => "Д  5%",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"CONVERT_CURRENCY" => "Y",
	"CURRENCY_ID" => "RUB",
	"DISPLAY_ELEMENT_SELECT_BOX" => "N",
	"ELEMENT_SORT_FIELD_BOX" => "name",
	"ELEMENT_SORT_ORDER_BOX" => "asc",
	"ELEMENT_SORT_FIELD_BOX2" => "id",
	"ELEMENT_SORT_ORDER_BOX2" => "desc",
	"HIDE_NOT_AVAILABLE" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>