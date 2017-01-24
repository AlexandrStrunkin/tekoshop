<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Pricegen");

global $arrFilter;
$arrFilter["!PROPERTY_ARKHIVNAYA_MODEL"] = "ДА";
?><?$APPLICATION->IncludeComponent(
	"yenisite:catalog.price_generator", 
	"mc_pricegen", 
	array(
		"IBLOCK_TYPE" => array(
			0 => "catalog",
		),
		/*"IBLOCK_ID" => array(
			0 => "120",
			1 => "119",
			2 => "118",
			3 => "117",
			4 => "116",
			5 => "115",
			6 => "114",
			7 => "123",
			8 => "124",
			9 => "121"
		),*/
		"IBLOCK_ID" => array(
			0 => "123",
			1 => "114",
			2 => "115",
			3 => "116",
			4 => "117",
			5 => "118",
			6 => "119",
			7 => "120"
		),
        "HIDE_PROPERTIES" => array("SERTIFIKAT_DEYSTVITELEN_DO","IS_AVAILABLE","PROIZVODITEL_DLYA_OTCHETA"),
		"PAGE_ELEMENT_COUNT" => "10000",
		"FILE_NAME" => "/cataloge/price",
		"FILE_TYPE" => "xls",
		"FILTER_NAME" => "arrFilter",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
			0 => "Розн.",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>