<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Видеонаблюдение от ТЕКО - Казань, Чебоксары, Альметьевск, Набережные Челны");
$APPLICATION->SetPageProperty("keywords", "Видеорегистраторы, цветные видеокамеры, ip-оборудование, Sony Effio, камеры с ИК-подсветкой");
$APPLICATION->SetPageProperty("title", "Видеонаблюдение от ТЕКО: ТЕхника Которая Охраняет");
$APPLICATION->SetTitle("");

global $regionPriceCODE;
?><?$APPLICATION->IncludeComponent("bitrix:catalog", "teko2012", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "33",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/catalog/special/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"USE_FILTER" => "N",
	"USE_REVIEW" => "N",
	"USE_COMPARE" => "Y",
	"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
	"COMPARE_FIELD_CODE" => array(
		0 => "PREVIEW_TEXT",
		1 => "DETAIL_PICTURE",
		2 => "",
	),
	"COMPARE_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"COMPARE_ELEMENT_SORT_FIELD" => "sort",
	"COMPARE_ELEMENT_SORT_ORDER" => "asc",
	"DISPLAY_ELEMENT_SELECT_BOX" => "N",
	"PRICE_CODE" => array(
		0 => "Д  5%",
		1 => $regionPriceCODE,
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SHOW_TOP_ELEMENTS" => "N",
	"PAGE_ELEMENT_COUNT" => "16",
	"LINE_ELEMENT_COUNT" => "1",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "CML2_ARTICLE",
		1 => "",
	),
	"INCLUDE_SUBSECTIONS" => "N",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "NAME",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "BRAND",
		2 => "MOUNT_TYPE",
		3 => "FOCUS_DIM",
		4 => "LAN",
		5 => "USB",
		6 => "CONTROL",
		7 => "RESOLUTION",
		8 => "SENSITIVITY",
		9 => "DIAPHRAGM",
		10 => "PZS_SIZE",
		11 => "HDD_NUM",
		12 => "COLORS",
		13 => "SENSITIVITY2",
		14 => "OTHER",
		15 => "VIDEO_IN",
		16 => "AUDIO_IN",
		17 => "VIDEO_OUT",
		18 => "AUDIO_OUT",
		19 => "LENS",
		20 => "BODY_TYPE",
		21 => "VOLTAGE",
		22 => "IR",
		23 => "MODIFICATION",
		24 => "RECOMMEND",
		25 => "",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "NAME",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"USE_ALSO_BUY" => "Y",
	"ALSO_BUY_ELEMENT_COUNT" => "10",
	"ALSO_BUY_MIN_BUYES" => "1",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
	"PAGER_SHOW_ALL" => "N",
	"PATH_TO_SHIPPING" => "#SITE_DIR#about/delivery/",
	"DISPLAY_IMG_WIDTH" => "75",
	"DISPLAY_IMG_HEIGHT" => "225",
	"DISPLAY_DETAIL_IMG_WIDTH" => "350",
	"DISPLAY_DETAIL_IMG_HEIGHT" => "350",
	"DISPLAY_BIG_IMG_WIDTH" => "400",
	"DISPLAY_BIG_IMG_HEIGHT" => "400",
	"DISPLAY_MORE_PHOTO_WIDTH" => "50",
	"DISPLAY_MORE_PHOTO_HEIGHT" => "50",
	"SHARPEN" => "30",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_CODE#/",
		"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"compare" => "compare/",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>