<?$APPLICATION->IncludeComponent(
	"slobel:price.generation", 
	".default", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"CHECK_SECTION" => "Y",
		"CHECK_STOCK" => "N",
		"COLOR" => "#C0C0C0",
		"CURRENCY" => "iblock",
		"FIELD_CODE" => array(
		),
		"FONT" => "Arial",
		"FONT_COLOR" => "#000000",
		"FONT_SIZE" => "10",
		"FORMATED_FILE" => "xlsx",
		"FORMATED_FILE_DIR" => "/upload/",
		"FORMATED_FILE_NAME" => "price",
		"HEADER" => "Y",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "news",
		"MULTI_SEPARATOR" => ",",
		"NAME_COLS" => "Y",
		"NULL" => "-",
		"PRICE_CODE" => "1",
		"PROPERTY_CODE" => array(
		),
		"COMPONENT_TEMPLATE" => ".default",
		"COLS_SECTION" => "N",
		"CHECK_PARENT" => "N",
		"SECTION_SORT_BY" => "NAME",
		"SECTION_SORT" => "ASC"
	),
	false
);?>