<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Видеооборудование, ip-камеры, регистраторы по выгодным ценам. Доставка по России - Казань, Чебоксары, Альметьевск, Набережные Челны");
$APPLICATION->SetPageProperty("keywords", "ip-видеооборудование, видеонаблюдение");
$APPLICATION->SetPageProperty("title", "Видеонаблюдение от ТЕКО: ТЕхника Которая Охраняет");
$APPLICATION->SetTitle("");
global $USER;
?><?$APPLICATION->IncludeComponent(
	"slobel:price.generation",
	"",
	Array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"CHECK_PARENT" => "Y",
		"CHECK_SECTION" => "Y",
		"CHECK_STOCK" => "N",
		"COLOR" => "#176337",
		"COLS_SECTION" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"CURRENCY" => "руб.",
		"ELEMENT_SORT" => "ASC",
		"ELEMENT_SORT_BY" => "0",
		"FIELD_CODE" => array("ID","NAME"),
		"FONT" => "Arial",
		"FONT_COLOR" => "#000000",
		"FONT_SIZE" => "10",
		"FORMATED_FILE" => "xlsx",
		"FORMATED_FILE_DIR" => "/cataloge/",
		"FORMATED_FILE_NAME" => $USER->IsAdmin() ? "admin_price" : "new_price",
		"HEADER" => "Y",
		"IBLOCK_ID" => array("114","115","116","117","123","118","119","120","142"),
		"IBLOCK_TYPE" => "catalog",
		"MULTI_SEPARATOR" => ",",
		"NAME_COLS" => "Y",
		"NULL" => "-",
		"PRICE_CODE" => "4",
		"PROPERTY_CODE" => array("PROIZVODITEL","KORPUS","RAZRESHENIE_TVL","MAKSIMALNOE_RAZRESHENIE_MP","CHUVSTVITELNOST_LK"),
		"SECTION_SORT" => "ASC",
		"SECTION_SORT_BY" => "NAME",
        "HIDE_PROPERTIES" => array("SERTIFIKAT_DEYSTVITELEN_DO","IS_AVAILABLE","PROIZVODITEL_DLYA_OTCHETA","FILES_BY_KEY","ANALOGI","SOPUTSTVUYUSHCHEE_OBORUDOVANIE","ARKHIVNAYA_MODEL","GABARITNYE_RAZMERY_MM","VES_S_UPAKOVKOY_KG","GABARITNYE_RAZMERY_UPAKOVKI_","KRATNOST_UPAKOVKI"),
		//"GENERATE_PERMANENTLY" => "Y",
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>