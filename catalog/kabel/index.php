<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Кабельная продукция от ТЕКО - Казань, Чебоксары, Альметьевск, Набережные Челны");
$APPLICATION->SetPageProperty("keywords", "Кабель силовой, кабель слаботочный, кабельные каналы, кабель для видео, радиочастотный, огнестойкий, металлорукав, гофра");
$APPLICATION->SetPageProperty("title", "Кабельная продукция от ТЕКО: ТЕхника Которая Охраняет");
$APPLICATION->SetTitle("");

global $regionPriceCODE;
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"main", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "118",
		"HIDE_NOT_AVAILABLE" => "N",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/catalog/kabel/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "TIMESTAMP_X",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "PROIZVODITEL",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "Д 10%",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"CLOSED_PROPERTY_CODE" => "",
		"USE_REVIEW" => "Y",
		"MESSAGES_PER_PAGE" => "5",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "5",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "N",
		"POST_FIRST_MESSAGE" => "N",
		"USE_COMPARE" => "Y",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "VES_S_UPAKOVKOY_KG",
			1 => "GABARITNYE_RAZMERY_MM",
			2 => "KOMPLEKTATSIYA",
			3 => "CML2_ARTICLE",
			4 => "PROIZVODITEL",
			5 => "PROCHEE",
			6 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
			7 => "VYSOTA_USTANOVKI_M",
			8 => "POTREBLYAEMYY_TOK_MA",
			9 => "TEMPERATURA_EKSPLUATATSII_S",
			10 => "UROVEN_ZVUKOVOGO_DAVLENIYA_DB",
			11 => "NALICHIE_INTERFEYSA_RS_485",
			12 => "UGOL_ZONY_OBNARUZHENIYA_",
			13 => "DALNOST_DEYSTVIYA_DO_M",
			14 => "TOK_KOMMUTATSII_A",
			15 => "NAPRYAZHENIE_KOMMUTATSII_V",
			16 => "TEMPERATURA_SRABATYVANIYA_S",
			17 => "CHASTOTA_MGTS",
			18 => "VNESHNIY_DIAMETR_MM",
			19 => "KOLICHESTVO_I_DIAMETR_ZHIL",
			20 => "KOLICHESTVO_I_SECHENIE_ZHIL",
			21 => "",
		),
		"COMPARE_ELEMENT_SORT_FIELD" => "sort",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"PRICE_CODE" => array(
			0 => "Цена ИМ(СпецЦена2)",
			1 => "Исходная розничная",
			2 => "Розничная (Дилерская 10%)",
			3 => "СпЦ 1 - 1%",
			4 => "СпЦ 2",
			5 => "СпЦ 1",
			6 => "Розн.",
			7 => "Д 10%",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/basket/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
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
		"TOP_ELEMENT_SORT_FIELD2" => "CATALOG_AVAILABLE",
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
		"LINE_ELEMENT_COUNT" => "1",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "CATALOG_AVAILABLE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"LIST_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "VES_S_UPAKOVKOY_KG",
			1 => "GABARITNYE_RAZMERY_MM",
			2 => "KOMPLEKTATSIYA",
			3 => "CML2_ARTICLE",
			4 => "PROIZVODITEL",
			5 => "PROCHEE",
			6 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
			7 => "VYSOTA_USTANOVKI_M",
			8 => "POTREBLYAEMYY_TOK_MA",
			9 => "TEMPERATURA_EKSPLUATATSII_S",
			10 => "UROVEN_ZVUKOVOGO_DAVLENIYA_DB",
			11 => "NALICHIE_INTERFEYSA_RS_485",
			12 => "UGOL_ZONY_OBNARUZHENIYA_",
			13 => "DALNOST_DEYSTVIYA_DO_M",
			14 => "TOK_KOMMUTATSII_A",
			15 => "NAPRYAZHENIE_KOMMUTATSII_V",
			16 => "TEMPERATURA_SRABATYVANIYA_S",
			17 => "CHASTOTA_MGTS",
			18 => "VNESHNIY_DIAMETR_MM",
			19 => "KOLICHESTVO_I_DIAMETR_ZHIL",
			20 => "KOLICHESTVO_I_SECHENIE_ZHIL",
			21 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "3",
		"ALSO_BUY_MIN_BUYES" => "1",
		"USE_STORE" => "Y",
		"PAGER_TEMPLATE" => "main",
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
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_BLOG_USE" => "N",
		"DETAIL_VK_USE" => "N",
		"DETAIL_FB_USE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPONENT_TEMPLATE" => "main",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"SHOW_DEACTIVATED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"COMMON_SHOW_CLOSE_POPUP" => "Y",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "Y",
		"SIDEBAR_PATH" => "",
		"USE_SALE_BESTSELLERS" => "Y",
		"COMPARE_POSITION_FIXED" => "Y",
		"COMPARE_POSITION" => "top left",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "Y",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ADD_TO_BASKET_ACTION" => "BUY",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"USE_BIG_DATA" => "Y",
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"SHOW_DISCOUNT_TIME" => "Y",
		"SHOW_RATING" => "Y",
		"IBLOCK_STOCK_ID" => "183",
		"SHOW_MEASURE" => "N",
		"USE_RATING" => "Y",
		"DISPLAY_WISH_BUTTONS" => "Y",
		"DEFAULT_COUNT" => "1",
		"SALE_STIKER" => "-",
		"SHOW_HINTS" => "Y",
		"AJAX_FILTER_CATALOG" => "N",
		"SECTION_TOP_BLOCK_TITLE" => "Лучшие предложения",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "DESCRIPTION",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "Y",
		"SHOW_SECTION_LIST_PICTURES" => "Y",
		"SORT_BUTTONS" => array(
			0 => "POPULARITY",
			1 => "NAME",
			2 => "PRICE",
		),
		"DEFAULT_LIST_TEMPLATE" => "list",
		"SECTION_DISPLAY_PROPERTY" => "",
		"LIST_DISPLAY_POPUP_IMAGE" => "Y",
		"SECTION_PREVIEW_PROPERTY" => "DESCRIPTION",
		"SECTION_PREVIEW_DESCRIPTION" => "Y",
		"SHOW_SECTION_PICTURES" => "Y",
		"DISPLAY_ELEMENT_SLIDER" => "10",
		"PROPERTIES_DISPLAY_LOCATION" => "TAB",
		"SHOW_BRAND_PICTURE" => "Y",
		"SHOW_ASK_BLOCK" => "Y",
		"ASK_FORM_ID" => "14",
		"DETAIL_OFFERS_LIMIT" => "0",
		"DETAIL_EXPANDABLES_TITLE" => "Аксессуары",
		"DETAIL_ASSOCIATED_TITLE" => "Похожие товары",
		"SHOW_ADDITIONAL_TAB" => "N",
		"PROPERTIES_DISPLAY_TYPE" => "TABLE",
		"SHOW_KIT_PARTS" => "N",
		"SHOW_KIT_PARTS_PRICES" => "N",
		"SHOW_ONE_CLICK_BUY" => "Y",
		"SKU_DETAIL_ID" => "oid",
		"SORT_PRICES" => "MINIMUM_PRICE",
		"STORES" => array(
		),
		"USE_MIN_AMOUNT" => "Y",
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"MIN_AMOUNT" => "10",
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"STORE_PATH" => "/store/#store_id#",
		"MAIN_TITLE" => "Наличие на складах",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>