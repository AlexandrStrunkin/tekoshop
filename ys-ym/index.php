<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Yandex market");
//global $arrFilter; $arrFilter = array("!PROPERTY_SALE" => false);
?><?$APPLICATION->IncludeComponent(
	"yenisite:yandex.market_new", 
	".default", 
	array(
		"ADDRESS" => "EMPTY",
		"AGENT_CATEGORY" => "EMPTY",
		"AGENT_EMAIL" => "EMPTY",
		"AGENT_FEE" => "EMPTY",
		"AGENT_ID" => "EMPTY",
		"AGENT_NAME" => "EMPTY",
		"AGENT_ORGANIZATION" => "EMPTY",
		"AGENT_PARTNER" => "EMPTY",
		"AGENT_PHONE" => "EMPTY",
		"AGENT_URL" => "EMPTY",
		"ALARM" => "EMPTY",
		"AREA" => "EMPTY",
		"AREA_UNIT" => "кв.м",
		"BALCONY" => "EMPTY",
		"BATHROOM_UNIT" => "EMPTY",
		"BILLIARD" => "EMPTY",
		"BUILDING_NAME" => "EMPTY",
		"BUILDING_SERIES" => "EMPTY",
		"BUILDING_STATE" => "EMPTY",
		"BUILDING_TYPE" => "EMPTY",
		"BUILT_YEAR" => "EMPTY",
		"CACHE_FILTER" => "N",
		"CACHE_NON_MANAGED" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CATEGORY" => "DEFAULT_CATEGORY",
		"CEILING_HEIGHT" => "EMPTY",
		"COMPANY" => "ТЕКО",
		"COMPONENT_TEMPLATE" => ".default",
		"COND_PARAMS" => array(
		),
		"COUNTRY" => "EMPTY",
		"CREATION_DATE" => "EMPTY",
		"CURRENCIES_CONVERT" => "NOT_CONVERT",
		"DATATOUR" => "EMPTY",
		"DAYS" => "EMPTY",
		"DETAIL_TEXT_PRIORITET" => "N",
		"DEVELOPER" => "CML2_MANUFACTURER",
		"DIRECTION" => "EMPTY",
		"DISCOUNTS" => "DISCOUNT_CUSTOM",
		"DISTANCE" => "EMPTY",
		"DISTRICT" => "EMPTY",
		"DO_NOT_INCLUDE_SUBSECTIONS" => "N",
		"ELECTRICITY_SUPPLY" => "EMPTY",
		"EXPIRE_DATE" => "EMPTY",
		"FILTER_NAME" => "arrFilter",
		"FLOOR" => "EMPTY",
		"FLOORS_TOTAL" => "EMPTY",
		"FLOOR_COVERING" => "EMPTY",
		"GAS_SUPPLY" => "EMPTY",
		"GOOGLE_GTIN" => "",
		"HAGGLE" => "EMPTY",
		"HEATING_SUPPLY" => "EMPTY",
		"HOTEL_STARS" => "EMPTY",
		"IBLOCK_AS_CATEGORY" => "Y",
		"IBLOCK_CATALOG" => "Y",
		"IBLOCK_ID_IN" => array(
			0 => "114",
		),
		"IBLOCK_ORDER" => "N",
		"IBLOCK_SECTION" => array(
			0 => "1398",
		),
		"IBLOCK_TYPE" => "catalog%",
		"IBLOCK_TYPE_LIST" => "",
		"INCLUDED" => "EMPTY",
		"INTERNET" => "EMPTY",
		"IS_ELITE" => "EMPTY",
		"KITCHEN" => "EMPTY",
		"KITCHEN_FURNITURE" => "EMPTY",
		"KITCHEN_SPACE" => "EMPTY",
		"KITCHEN_SPACE_UNIT" => "кв.м",
		"LAST_UPDATE_DATE" => "EMPTY",
		"LATITUDE" => "EMPTY",
		"LIFT" => "EMPTY",
		"LIVING_SPACE" => "EMPTY",
		"LIVING_SPACE_UNIT" => "кв.м",
		"LOCALITY_NAME" => "EMPTY",
		"LOCAL_DELIVERY_COST" => "",
		"LONGITUDE" => "EMPTY",
		"LOT_AREA" => "EMPTY",
		"LOT_AREA_UNIT" => "кв.м",
		"LOT_TYPE" => "EMPTY",
		"MANUALLY_ADDED" => "EMPTY",
		"MANUFACTURER_WARRANTY" => "EMPTY",
		"MARKET_CATEGORY_CHECK" => "N",
		"MARKET_CATEGORY_PROP" => "EMPTY",
		"MEAL" => "EMPTY",
		"METRO_NAME" => "EMPTY",
		"METRO_TIME_ON_FOOT" => "EMPTY",
		"METRO_TIME_ON_TRANSPORT" => "EMPTY",
		"MODEL" => "EMPTY",
		"MORE_PHOTO" => "MORE_PHOTO",
		"MORTGAGE" => "EMPTY",
		"MULTI_STRING_PROP" => "",
		"NAME_PROP" => "0",
		"NEW_FLAT" => "EMPTY",
		"NON_ADMIN_SUB_LOCALITY_NAME" => "EMPTY",
		"NOT_FOR_AGENTS" => "EMPTY",
		"OPEN_PLAN" => "EMPTY",
		"PARAMS" => array(
		),
		"PARKING" => "EMPTY",
		"PAYED_ADV" => "EMPTY",
		"PHONE" => "EMPTY",
		"PMG" => "EMPTY",
		"POOL" => "EMPTY",
		"PREPAYMENT" => "EMPTY",
		"PRICE_CODE" => array(
			0 => "Цена ИМ(СпецЦена2)",
		),
		"PRICE_FROM_IBLOCK" => "N",
		"PRICE_PERIOD" => "EMPTY",
		"PRICE_REQUIRED" => "Y",
		"PRICE_UNIT" => "EMPTY",
		"PROPERTY_TYPE" => "EMPTY",
		"RAILWAY_STATION" => "EMPTY",
		"READY_QUARTER" => "EMPTY",
		"REFRIGERATOR" => "EMPTY",
		"REGION" => "EMPTY",
		"RENOVATION" => "EMPTY",
		"RENT_PLEDGE" => "EMPTY",
		"ROOM" => "EMPTY",
		"ROOMS" => "EMPTY",
		"ROOMS_OFFERED" => "EMPTY",
		"ROOMS_TYPE" => "EMPTY",
		"ROOM_FURNITURE" => "EMPTY",
		"RUBBISH_CHUTE" => "EMPTY",
		"SAUNA" => "EMPTY",
		"SECTION_AS_VENDOR" => "N",
		"SEWERAGE_SUPPLY" => "EMPTY",
		"SHOWER" => "EMPTY",
		"SITE" => "teko-shop.ru",
		"SKU_NAME" => "PRODUCT_AND_SKU_NAME",
		"SKU_PROPERTY" => "",
		"SUB_LOCALITY_NAME" => "EMPTY",
		"TELEVISION" => "EMPTY",
		"TOILET" => "EMPTY",
		"TRANSPORT" => "EMPTY",
		"TYPE" => "EMPTY",
		"VENDOR_CODE" => "CMD",
		"WASHING_MACHINE" => "EMPTY",
		"WATER_SUPPLY" => "EMPTY",
		"WINDOW_VIEW" => "EMPTY",
		"WITH_CHILDREN" => "EMPTY",
		"WITH_PETS" => "EMPTY",
		"WORLDREGION" => "EMPTY"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>