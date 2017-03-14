<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"catalog",
	Array(
		"CATEGORY_0" => array("iblock_catalog"),    
		"CATEGORY_0_TITLE" => GetMessage("CATEGORY_PRODUСTCS_SEARCH_NAME"),
		"CATEGORY_0_iblock_aspro_optimus_catalog" => array(0=>"185",),
		"CATEGORY_0_iblock_catalog" => array("114","115","116","117","118","119","120","123","132","171"),
		"CHECK_DATES" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTAINER_ID" => "title-search",
		"CONVERT_CURRENCY" => "N",
		"INPUT_ID" => "title-searchs-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => SITE_DIR."catalog/search/",
		"PREVIEW_HEIGHT" => "38",
		"PREVIEW_TRUNCATE_LEN" => "50",
		"PREVIEW_WIDTH" => "38",
		"PRICE_CODE" => array("Д  5%","Цена ИМ(СпецЦена2)","Исходная розничная","Ручная_2","Розничная (Дилерская 10%)","СпЦ 1 - 1%","СпЦ 2","Д 12%","СпЦ 1","Розн.","Д 10%"),
		"PRICE_VAT_INCLUDE" => "Y",
		"SHOW_ANOUNCE" => "N",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"SHOW_PREVIEW" => "Y",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y"
	),
    false,
    Array(
	    'ACTIVE_COMPONENT' => 'Y'
    )                                               
);?>