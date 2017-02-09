<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Видеонаблюдение от ТЕКО - Казань, Чебоксары, Альметьевск, Набережные Челны");
$APPLICATION->SetPageProperty("keywords", "Видеорегистраторы, цветные видеокамеры, ip-оборудование, Sony Effio, камеры с ИК-подсветкой");
$APPLICATION->SetPageProperty("title", "Видеонаблюдение от ТЕКО: ТЕхника Которая Охраняет");
$APPLICATION->SetTitle("");
?><?$APPLICATION->IncludeComponent("bitrix:catalog", "mc_catalog", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "76",
	"HIDE_NOT_AVAILABLE" => "N",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/catalog/videos/",
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
	"USE_ELEMENT_COUNTER" => "Y",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "CATALOG_FILTER",
	"FILTER_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "PROIZVODITEL",
		1 => "CML2_TRAITS",
		2 => "CML2_BASE_UNIT",
		3 => "CML2_TAXES",
		4 => "CML2_MANUFACTURER",
		5 => "NAPRYAZHENIE_PITANIYA_V",
		6 => "IK_PODSVETKA",
		7 => "UGOL_PODSVETKI",
		8 => "MAKS_DALNOST_PODSVETKI",
		9 => "MOSHCHNOST",
		10 => "TOK_POTREBLENIYA_A",
		11 => "BRAND",
		12 => "",
	),
	"FILTER_PRICE_CODE" => array(
		0 => "Д  5%",
	),
	"FILTER_VIEW_MODE" => "VERTICAL",
	"USE_REVIEW" => "Y",
	"MESSAGES_PER_PAGE" => "5",
	"USE_CAPTCHA" => "Y",
	"REVIEW_AJAX_POST" => "Y",
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
	"FORUM_ID" => "1",
	"URL_TEMPLATES_READ" => "",
	"SHOW_LINK_TO_FORUM" => "N",
	"POST_FIRST_MESSAGE" => "N",
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "Д  5%",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"CONVERT_CURRENCY" => "N",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"USE_PRODUCT_QUANTITY" => "N",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"SHOW_TOP_ELEMENTS" => "Y",
	"TOP_ELEMENT_COUNT" => "9",
	"TOP_LINE_ELEMENT_COUNT" => "3",
	"TOP_ELEMENT_SORT_FIELD" => "sort",
	"TOP_ELEMENT_SORT_ORDER" => "asc",
	"TOP_ELEMENT_SORT_FIELD2" => "id",
	"TOP_ELEMENT_SORT_ORDER2" => "desc",
	"TOP_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"TOP_VIEW_MODE" => "SECTION",
	"SECTION_COUNT_ELEMENTS" => "Y",
	"SECTION_TOP_DEPTH" => "2",
	"SECTIONS_VIEW_MODE" => "LIST",
	"SECTIONS_SHOW_PARENT_NAME" => "Y",
	"PAGE_ELEMENT_COUNT" => "16",
	"LINE_ELEMENT_COUNT" => "3",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER2" => "desc",
	"LIST_PROPERTY_CODE" => array(
		0 => "CML2_ARTICLE",
		1 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "NAME",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "PROCHEE",
		1 => "ISPOLNENIE",
		2 => "PROIZVODITEL",
		3 => "",
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
	"USE_STORE" => "N",
	"PAGER_TEMPLATE" => "visual",
	"DISPLAY_TOP_PAGER" => "Y",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
	"PAGER_SHOW_ALL" => "N",
	"TEMPLATE_THEME" => "blue",
	"ADD_PICT_PROP" => "-",
	"LABEL_PROP" => "-",
	"DETAIL_DISPLAY_NAME" => "Y",
	"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
	"SHOW_DISCOUNT_PERCENT" => "N",
	"SHOW_OLD_PRICE" => "N",
	"DETAIL_SHOW_MAX_QUANTITY" => "N",
	"MESS_BTN_BUY" => "Купить",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_COMPARE" => "Сравнение",
	"MESS_BTN_DETAIL" => "Подробнее",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"DETAIL_USE_VOTE_RATING" => "N",
	"DETAIL_USE_COMMENTS" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_CODE#/",
		"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"compare" => "compare/",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>