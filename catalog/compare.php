<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение товаров");?>
<?
/*global $catalogIDS;
CModule::IncludeModule('iblock');
$res = CIBlock::GetList( Array("SORT"=>"ASC"),  Array('TYPE'=>'catalog', 'ACTIVE'=>'Y', 'ID' => $catalogIDS), true);
while($arIblock = $res->Fetch()){
	$count = 0;
	if(isset($_SESSION['CATALOG_COMPARE_LIST']) && is_array($_SESSION['CATALOG_COMPARE_LIST'])){
		if(isset($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]) && is_array($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']])){
			if(isset($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS']) && is_array($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS'])){
				$count = count($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS']);
			}
		}
	}
	echo '<a href="/catalog/'.$arIblock['CODE'].'/compare.php">'.$arIblock['NAME'].' ('.$count.')</a><br />';
}
?>
<br />
<?
global $catalog2IDS;
CModule::IncludeModule('iblock');
$res = CIBlock::GetList( Array("SORT"=>"ASC"),  Array('TYPE'=>'catalog', 'ACTIVE'=>'Y', 'ID' => $catalog2IDS), true);
while($arIblock = $res->Fetch()){
	$count = 0;
	if(isset($_SESSION['CATALOG_COMPARE_LIST']) && is_array($_SESSION['CATALOG_COMPARE_LIST'])){
		if(isset($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]) && is_array($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']])){
			if(isset($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS']) && is_array($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS'])){
				$count = count($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS']);
			}
		}
	}
	echo '<a href="/action/'.$arIblock['CODE'].'/compare.php">'.$arIblock['NAME'].' ('.$count.')</a><br />';
}*/
?>
<?
global $catalogIDS;
global $catalog2IDS;
$allIds = array_merge($catalogIDS, $catalog2IDS);
?>
<?$APPLICATION->IncludeComponent(
	"aspro:catalog.compare.result",
	"main",
	array(
		"NOAUTH_USER_PRICES" => '',
		"NOAUTH_MANUFACTURERS_PRICES" => array (
		  1748 => 
		  array (
			0 => '21',
		  ),
		),
		"IBLOCK_TYPE" => 'catalog',
		"IBLOCK_ID" => $allIds,
		"BASKET_URL" => '/basket/',
		"ACTION_VARIABLE" => 'action',
		"PRODUCT_ID_VARIABLE" => 'id',
		"SECTION_ID_VARIABLE" => 'SECTION_ID',
		"FIELD_CODE" => array ( 0 => 'PREVIEW_PICTURE', 1 => 'DETAIL_PICTURE', 2 => '', ),
		"PROPERTY_CODE" => array (
			  0 => 'CML2_ARTICLE',
			  1 => 'PROIZVODITEL',
			  2 => 'KORPUS',
			  3 => 'MATRITSA',
			  4 => 'PROTSESSOR',
			  5 => 'RAZRESHENIE_TVL',
			  6 => 'MAKSIMALNOE_RAZRESHENIE_MP',
			  7 => 'CHUVSTVITELNOST_LK',
			  8 => 'SKOROST_KODIROVANIYA_K_S',
			  9 => 'KOLICHESTVO_KANALOV_ZAPISI',
			  10 => 'MAKSIMALNOE_RAZRESHENIE_ZAPISI',
			  11 => 'RAZRESHENIE_I_SKOROST_ZAPISI',
			  12 => 'MAKSIMALNYY_POTOK_MBIT_S',
			  13 => 'KOLICHESTVO_HDD',
			  14 => 'EMKOST_ODNOGO_HDD_DO_TB',
			  15 => 'VIDEOVYKHODY',
			  16 => 'VIDEOVKHODY',
			  17 => 'AUDIO_VKHOD_VYKHOD',
			  18 => 'TREVOZHNYY_VKHOD_VYKHOD',
			  19 => 'KOLICHESTVO_SETEVYKH_PORTOV',
			  20 => 'KOLICHESTVO_SETEVYKH_PORTOV_S_POE',
			  21 => 'OBEKTIV',
			  22 => 'FOKUSNOE_RASSTOYANIE_MM',
			  23 => 'NALICHIE_IK_PODSVETKI',
			  24 => 'DALNOST_IK_PODSVETKI',
			  25 => 'NALICHIE_WI_FI_MODULYA',
			  26 => 'NALICHIE_POE',
			  27 => 'VSTROENNYY_MIKROFON',
			  28 => 'RAZEM_KARTY_PAMYATI',
			  29 => 'UPRAVLENIE_PTZ',
			  30 => 'NAPRYAZHENIE_PITANIYA_V',
			  31 => 'ISPOLNENIE',
			  32 => 'POTREBLYAEMYY_TOK_MA',
			  33 => 'STEPEN_ZASHCHITY',
			  34 => 'TEMPERATURA_EKSPLUATATSII_S',
			  35 => 'KOLICHESTVO_VYKHODOV',
			  36 => 'NOMINALNAYA_NAGRUZKA_VYKHODA_A',
			  37 => 'POTREBLYAEMAYA_MOSHCHNOST_VT',
			  38 => 'YARKOST_KD_M_KV',
			  39 => 'RAZMER_EKRANA_DYUYM',
			  40 => 'RAZRESHENIE_EKRANA',
			  41 => 'KONTRASTNOST',
			  42 => 'VYSOTA_USTANOVKI_M',
			  43 => 'PROCHEE',
			  44 => '',
			),
		"NAME" => 'CATALOG_COMPARE_LIST',
		"CACHE_TYPE" => 'A',
		"CACHE_TIME" => '36000',
		"PRICE_CODE" => array (
		  0 => 'Цена ИМ(СпецЦена2)',
		  1 => 'Исходная розничная',
		  2 => 'Распродажа',
		  3 => 'Розничная (Дилерская 10%)',
		  4 => 'СпЦ 1 - 1%',
		  5 => 'СпЦ 2',
		  6 => 'Д 12%',
		  7 => 'СпЦ 1',
		  8 => 'Розн.',
		  9 => 'Д 10%',
		),
		"USE_PRICE_COUNT" => 'N',
		"SHOW_PRICE_COUNT" => '1',
		"PRICE_VAT_INCLUDE" => 'Y',
		"PRICE_VAT_SHOW_VALUE" => 'N',
		"DISPLAY_ELEMENT_SELECT_BOX" => 'N',
		"ELEMENT_SORT_FIELD_BOX" => '',
		"ELEMENT_SORT_ORDER_BOX" => '',
		"ELEMENT_SORT_FIELD_BOX2" => '',
		"ELEMENT_SORT_ORDER_BOX2" => '',
		"ELEMENT_SORT_FIELD" => 'sort',
		"ELEMENT_SORT_ORDER" => 'asc',
		"DETAIL_URL" => '/catalog/video/#SECTION_CODE_PATH#/#ELEMENT_CODE#/',
		"OFFERS_FIELD_CODE" => '',
		"OFFERS_PROPERTY_CODE" => '',
		"OFFERS_CART_PROPERTIES" => '',
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => '',
		"HIDE_NOT_AVAILABLE" => "N",
		"TEMPLATE_THEME" => "blue",
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>