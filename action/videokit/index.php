<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Акция - Распродажа Wi-Fi IP-камер");
$APPLICATION->SetPageProperty("keywords", "ОПС, Извещатели, Радиоканальное оборудование, Пожарное оборудование, Сигнальные устройства");
$APPLICATION->SetPageProperty("title", "Оборудование ОПС от ТЕКО: ТЕхника Которая Охраняет");
$APPLICATION->SetTitle("Акция - Распродажа Wi-Fi IP-камер");
?> 

 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"mc_catalog",//"actions", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "160",
		"HIDE_NOT_AVAILABLE" => "N",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/action/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "PROIZVODITEL",
			1 => "STEPEN_ZASHCHITY",
			2 => "VARIANT_USTANOVKI",
			3 => "EMKOST_AKB_A_CH",
			4 => "TIP",
			5 => "KOLICHESTVO_AKB",
			6 => "NALICHIE_INTERFEYSA_RS_485",
			7 => "DIAGRAMMA_ZONY_OBNARUZHENIYA",
			8 => "PODKLYUCHENIE",
			9 => "KOLICHESTVO_PTSN",
			10 => "ZASHCHITA_OT_ZHIVOTNYKH",
			11 => "INTERFEYS_",
			12 => "",
		),
		"FILTER_PRICE_CODE" => array(
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "Y",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "GABARITNYE_RAZMERY_MM",
			1 => "KOMPLEKTATSIYA",
			2 => "PROCHEE",
			3 => "VYSOTA_USTANOVKI_M",
			4 => "PROIZVODITEL",
			5 => "NAPRYAZHENIE_PITANIYA_V",
			6 => "POTREBLYAEMYY_TOK_MA",
			7 => "TEMPERATURA_EKSPLUATATSII_S",
			8 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
			9 => "STEPEN_ZASHCHITY",
			10 => "KOLICHESTVO_VYKHODOV",
			11 => "VARIANT_USTANOVKI",
			12 => "UROVEN_ZVUKOVOGO_DAVLENIYA_DB",
			13 => "VSTROENNYY_RIP",
			14 => "EMKOST_AKB_A_CH",
			15 => "TIP",
			16 => "KOLICHESTVO_AKB",
			17 => "NALICHIE_INTERFEYSA_RS_485",
			18 => "ZASHCHISHCHAEMAYA_PLOSHCHAD_DO_KV_M",
			19 => "UGOL_ZONY_OBNARUZHENIYA_",
			20 => "DALNOST_DEYSTVIYA_DO_M",
			21 => "DIAGRAMMA_ZONY_OBNARUZHENIYA",
			22 => "PODKLYUCHENIE",
			23 => "KOLICHESTVO_SHLEYFOV_SIGNALIZATSII",
			24 => "KOLICHESTVO_PTSN",
			25 => "TOK_KOMMUTATSII_A",
			26 => "NAPRYAZHENIE_KOMMUTATSII_V",
			27 => "TEMPERATURA_SRABATYVANIYA_S",
			28 => "UPRAVLENIE_PRIBOROM",
			29 => "CHASTOTA_MGTS",
			30 => "KOLICHESTVO_NOMEROV_OPOVESHCHENIYA",
			31 => "ZASHCHITA_OT_ZHIVOTNYKH",
			32 => "INTERFEYS_",
			33 => "ELEMENT_PITANIYA",
			34 => "KOLICHESTVO_REGISTRIRUEMYKH_RPD",
			35 => "TIP_USTROYSTVA",
			36 => "PLOSHCHAD_TUSHENIYA_KV_M",
			37 => "OBEM_TUSHENIYA_KUB_M",
			38 => "",
		),
		"COMPARE_ELEMENT_SORT_FIELD" => "sort",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"PRICE_CODE" => array(
			0 => "RETAIL",
			1 => "Д 10%",
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
		"PAGE_ELEMENT_COUNT" => "9",
		"LINE_ELEMENT_COUNT" => "1",
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
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "GABARITNYE_RAZMERY_MM",
			2 => "KOMPLEKTATSIYA",
			3 => "PROCHEE",
			4 => "VYSOTA_USTANOVKI_M",
			5 => "PROIZVODITEL",
			6 => "NAPRYAZHENIE_PITANIYA_V",
			7 => "POTREBLYAEMYY_TOK_MA",
			8 => "TEMPERATURA_EKSPLUATATSII_S",
			9 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
			10 => "STEPEN_ZASHCHITY",
			11 => "KOLICHESTVO_VYKHODOV",
			12 => "VARIANT_USTANOVKI",
			13 => "UROVEN_ZVUKOVOGO_DAVLENIYA_DB",
			14 => "VSTROENNYY_RIP",
			15 => "EMKOST_AKB_A_CH",
			16 => "TIP",
			17 => "KOLICHESTVO_AKB",
			18 => "NALICHIE_INTERFEYSA_RS_485",
			19 => "ZASHCHISHCHAEMAYA_PLOSHCHAD_DO_KV_M",
			20 => "UGOL_ZONY_OBNARUZHENIYA_",
			21 => "DALNOST_DEYSTVIYA_DO_M",
			22 => "DIAGRAMMA_ZONY_OBNARUZHENIYA",
			23 => "PODKLYUCHENIE",
			24 => "KOLICHESTVO_SHLEYFOV_SIGNALIZATSII",
			25 => "KOLICHESTVO_PTSN",
			26 => "TOK_KOMMUTATSII_A",
			27 => "NAPRYAZHENIE_KOMMUTATSII_V",
			28 => "TEMPERATURA_SRABATYVANIYA_S",
			29 => "UPRAVLENIE_PRIBOROM",
			30 => "CHASTOTA_MGTS",
			31 => "KOLICHESTVO_NOMEROV_OPOVESHCHENIYA",
			32 => "ZASHCHITA_OT_ZHIVOTNYKH",
			33 => "INTERFEYS_",
			34 => "ELEMENT_PITANIYA",
			35 => "KOLICHESTVO_REGISTRIRUEMYKH_RPD",
			36 => "TIP_USTROYSTVA",
			37 => "PLOSHCHAD_TUSHENIYA_KV_M",
			38 => "OBEM_TUSHENIYA_KUB_M",
			39 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "DESCRIPTION",
		"DETAIL_BROWSER_TITLE" => "TITLE",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "3",
		"ALSO_BUY_MIN_BUYES" => "1",
		"USE_STORE" => "Y",
		"USE_STORE_PHONE" => "N",
		"USE_STORE_SCHEDULE" => "N",
		"USE_MIN_AMOUNT" => "Y",
		"MIN_AMOUNT" => "10",
		"STORE_PATH" => "/store/#store_id#",
		"MAIN_TITLE" => "Наличие на складах",
		"PAGER_TEMPLATE" => "mc_visual",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"LABEL_PROP" => "-",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
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
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPONENT_TEMPLATE" => "actions",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"SHOW_DEACTIVATED" => "N",
		"STORES" => array(
		),
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "#IBLOCK_CODE#/",
			"section" => "",
			"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
			"compare" => "/action/wificamsale/compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>