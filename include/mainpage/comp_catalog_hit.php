<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
global $catalogIDS;
?>
<?$APPLICATION->IncludeComponent(
	"aspro:tabs.mshop_multy", 
	"main", 
	array(
		"IBLOCK_TYPE" => "aspro_optimus_catalog",
		"IBLOCK_ID" => $catalogIDS,
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"TABS_CODE" => "HIT",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterProp",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "8",
		"LINE_ELEMENT_COUNT" => "4",
		"TOP_LINE_ELEMENT_COUNT" => "4",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "0",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/basket/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"CACHE_FILTER" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
        "PRICE_CODE" => array(   
            0 => "Д  5%",
            1 => "Цена ИМ(СпецЦена2)",
            2 => "Исходная розничная",
            3 => "Ручная_2",
            4 => "Розничная (Дилерская 10%)",
            5 => "СпЦ 1 - 1%",
            6 => "СпЦ 2",
            7 => "Д 12%",
            8 => "СпЦ 1",
            9 => "Розн.",
            10 => "Д 10%",
        ),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISCOUNT_PRICE_CODE" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SHOW_ADD_FAVORITES" => "Y",
		"SECTION_NAME_FILTER" => "",
		"SECTION_SLIDER_FILTER" => "21",
		"COMPONENT_TEMPLATE" => "main",
		"OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"SHOW_MEASURE" => "Y",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"DISPLAY_WISH_BUTTONS" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_RATING" => "Y",
		"SALE_STIKER" => "SALE_TEXT",
		"SHOW_DISCOUNT_TIME" => "N"
	),
	false
);?>
<?
/*
0 => "Д  5%",
1 => "Цена ИМ(СпецЦена2)",
2 => "Исходная розничная",
3 => "Ручная_2",
4 => "Розничная (Дилерская 10%)",
5 => "СпЦ 1 - 1%",
6 => "СпЦ 2",
7 => "Д 12%",
8 => "СпЦ 1",
9 => "Розн.",
10 => "Д 10%",
*/
?>