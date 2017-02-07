<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$arDefaultParams = array(
	'TYPE_SKU' => 'N',
	'OFFER_TREE_PROPS' => array('-'),
);
$arParams = array_merge($arDefaultParams, $arParams);

if ('TYPE_2' != $arParams['TYPE_SKU'] )
	$arParams['TYPE_SKU'] = 'N';

if ('TYPE_2' == $arParams['TYPE_SKU'] && $arParams['DISPLAY_TYPE'] !='table' ){
	if (!is_array($arParams['OFFER_TREE_PROPS']))
		$arParams['OFFER_TREE_PROPS'] = array($arParams['OFFER_TREE_PROPS']);
	foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
	{
		$value = (string)$value;
		if ('' == $value || '-' == $value)
			unset($arParams['OFFER_TREE_PROPS'][$key]);
	}
	if (empty($arParams['OFFER_TREE_PROPS']) && isset($arParams['OFFERS_CART_PROPERTIES']) && is_array($arParams['OFFERS_CART_PROPERTIES']))
	{
		$arParams['OFFER_TREE_PROPS'] = $arParams['OFFERS_CART_PROPERTIES'];
		foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
		{
			$value = (string)$value;
			if ('' == $value || '-' == $value)
				unset($arParams['OFFER_TREE_PROPS'][$key]);
		}
	}
}else{
	$arParams['OFFER_TREE_PROPS'] = array();
}
                    
if (!empty($arResult["ELEMENTS"]) && CModule::IncludeModule("iblock")){ 
    /*convert currency*/
    $arConvertParams = array();
    if ('Y' == $arParams['CONVERT_CURRENCY'])
    {
        if (!CModule::IncludeModule('currency'))
        {
            $arParams['CONVERT_CURRENCY'] = 'N';
            $arParams['CURRENCY_ID'] = '';
        }
        else
        {
            $currencyIterator = CurrencyTable::getList(array(
                'select' => array('CURRENCY'),
                'filter' => array('=CURRENCY' => $arParams['CURRENCY_ID'])
            ));
            if ($currency = $currencyIterator->fetch())
            {
                $arParams['CURRENCY_ID'] = $currency['CURRENCY'];
                $arConvertParams['CURRENCY_ID'] = $currency['CURRENCY'];
            }
            else
            {
                $arParams['CONVERT_CURRENCY'] = 'N';
                $arParams['CURRENCY_ID'] = '';
            }
            unset($currency, $currencyIterator);
        }
    }
    $strBaseCurrency = '';
    $boolConvert = isset($arConvertParams['CURRENCY_ID']);
    if (!$boolConvert)
        $strBaseCurrency = CCurrency::GetBaseCurrency();

    $obParser = new CTextParser;

    if (is_array($arParams["PRICE_CODE"]))
        $arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices(0, $arParams["PRICE_CODE"]);
    else
        $arResult["PRICES"] = array();

    $arSelect = array(
        "ID",
        "IBLOCK_ID",
        "PREVIEW_TEXT",
        "PREVIEW_PICTURE",
        "DETAIL_PICTURE",
    );
    $arFilter = array(
        "IBLOCK_LID" => SITE_ID,
        "IBLOCK_ACTIVE" => "Y",
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
        "MIN_PERMISSION" => "R",
    );
    foreach($arResult["PRICES"] as $value)
    {                              
        $arSelect[] = $value["SELECT"];
        $arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = 1;
    }
    $arFilter["=ID"] = $arResult["ELEMENTS"];
    $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while($arElement = $rsElements->Fetch())
    {
        $arElement["PRICES"] = CIBlockPriceTools::GetItemPrices($arElement["IBLOCK_ID"], $arResult["PRICES"], $arElement, $arParams['PRICE_VAT_INCLUDE'], $arConvertParams);   
        if($arParams["PREVIEW_TRUNCATE_LEN"] > 0)
            $arElement["PREVIEW_TEXT"] = $obParser->html_cut($arElement["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);

        $arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
        
        /*offers*/
        $offersFilter = array(
            'IBLOCK_ID' => $arElement['IBLOCK_ID'],
            'HIDE_NOT_AVAILABLE' => "N"
        );
        $arOffers = CIBlockPriceTools::GetOffersArray(
            $offersFilter,
            array($arElement["ID"]),
            array(),
            array("ID"),
            array(),
            10,
            $arResult["PRICES"],
            $arParams['PRICE_VAT_INCLUDE'],
            $arConvertParams
        );
        if($arOffers){
            $arResult["ELEMENTS"][$arElement["ID"]]["OFFERS"]=$arOffers;
            $arResult["ELEMENTS"][$arElement["ID"]]["MIN_PRICE"]=COptimus::getMinPriceFromOffersExt(
                    $arOffers,
                    $boolConvert ? $arConvertParams['CURRENCY_ID'] : $strBaseCurrency
                );
        }
    }
}                            

//Код формирования списка цен у элементов, скопирован из формирования списка в search.title

if (!empty($arResult['ITEMS'])){
	$arEmptyPreview = false;
	$strEmptyPreview = SITE_TEMPLATE_PATH . '/images/no_photo_medium.png';
	if (file_exists($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview))
	{
		$arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview);
		if (!empty($arSizes))
		{
			$arEmptyPreview = array(
				'SRC' => $strEmptyPreview,
				'WIDTH' => intval($arSizes[0]),
				'HEIGHT' => intval($arSizes[1])
			);
		}
		unset($arSizes);
	}
	unset($strEmptyPreview);

	$arSKUPropList = array();
	$arSKUPropIDs = array();
	$arSKUPropKeys = array();
	$boolSKU = false;
	$strBaseCurrency = '';
	$boolConvert = isset($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);
	if (!$boolConvert)
		$strBaseCurrency = CCurrency::GetBaseCurrency();
	
	$arNewItemsList = array();
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$arItem['CHECK_QUANTITY'] = false;
		if (!isset($arItem['CATALOG_MEASURE_RATIO']))
			$arItem['CATALOG_MEASURE_RATIO'] = 1;
		if (!isset($arItem['CATALOG_QUANTITY']))
			$arItem['CATALOG_QUANTITY'] = 0;
		$arItem['CATALOG_QUANTITY'] = (
			0 < $arItem['CATALOG_QUANTITY'] && is_float($arItem['CATALOG_MEASURE_RATIO'])
			? floatval($arItem['CATALOG_QUANTITY'])
			: intval($arItem['CATALOG_QUANTITY'])
		);
		$arItem['CATALOG'] = false;
		if (!isset($arItem['CATALOG_SUBSCRIPTION']) || 'Y' != $arItem['CATALOG_SUBSCRIPTION'])
			$arItem['CATALOG_SUBSCRIPTION'] = 'N';

		if ($arResult['MODULES']['catalog'])
		{
			$arItem['CATALOG'] = true;
			if (!isset($arItem['CATALOG_TYPE']))
				$arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_PRODUCT;
			if (
				(CCatalogProduct::TYPE_PRODUCT == $arItem['CATALOG_TYPE'] || CCatalogProduct::TYPE_SKU == $arItem['CATALOG_TYPE'])
				&& !empty($arItem['OFFERS'])
			)
			{
				$arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_SKU;
			}
			switch ($arItem['CATALOG_TYPE'])
			{
				case CCatalogProduct::TYPE_SET:
					$arItem['OFFERS'] = array();
					$arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
					break;
				case CCatalogProduct::TYPE_SKU:
					break;
				case CCatalogProduct::TYPE_PRODUCT:
				default:
					$arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
					break;
			}
		}
		else
		{
			$arItem['CATALOG_TYPE'] = 0;
			$arItem['OFFERS'] = array();
		}

		if ($arItem['CATALOG'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
		{
			
			$arItem['MIN_PRICE'] = COptimus::getMinPriceFromOffersExt(
				$arItem['OFFERS'],
				$boolConvert ? $arResult['CONVERT_CURRENCY']['CURRENCY_ID'] : $strBaseCurrency
			);
		}

		if (
			$arResult['MODULES']['catalog']
			&& $arItem['CATALOG']
			&&
				($arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT
				|| $arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET)
		)
		{
			CIBlockPriceTools::setRatioMinPrice($arItem, false);
			$arItem['MIN_BASIS_PRICE'] = $arItem['MIN_PRICE'];
		}

		if (!empty($arItem['DISPLAY_PROPERTIES']))
		{
			foreach ($arItem['DISPLAY_PROPERTIES'] as $propKey => $arDispProp)
			{
				if ('F' == $arDispProp['PROPERTY_TYPE'])
					unset($arItem['DISPLAY_PROPERTIES'][$propKey]);
			}
		}
		$arItem['LAST_ELEMENT'] = 'N';
		$arNewItemsList[$key] = $arItem;
	}
	$arNewItemsList[$key]['LAST_ELEMENT'] = 'Y';
	$arResult['ITEMS'] = $arNewItemsList;
	$arResult['SKU_PROPS'] = $arSKUPropList;
	$arResult['DEFAULT_PICTURE'] = $arEmptyPreview;

	$arResult['CURRENCIES'] = array();

	if($GLOBALS[$arParams["FILTER_NAME"]]["ID"] && $arParams["IS_VIEWED"]=="Y"){
		$arTmp=array();
		foreach($GLOBALS[$arParams["FILTER_NAME"]]["ID"] as $id){
			foreach($arResult["ITEMS"] as $arItem){
				if($arItem["ID"]==$id){
					$arTmp[]=$arItem;
				}
			}
		}
		$arResult["ITEMS"]=$arTmp;
		unset($arTmp);
	}
}               
      
//Конец скопированного кода

//Привязка ID производителей из свойства к элементам      
                                                    
foreach($arResult["ELEMENTS"] as $i => $arItem) { 
    if(!empty($arItem["ID"])) {
        $arElementID[] = $arItem["ID"];
    }                                   
} 
                                                              
$arSelect = Array("ID", "NAME", "PROPERTY_PROIZVODITEL");
$arFilter = Array("ID" => $arElementID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
if (!empty($arElementID)) {
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect); 
    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields(); 
        if(!empty($arFields['PROPERTY_PROIZVODITEL_ENUM_ID'])) {
            $arProizvoditelEnumID[$arFields["ID"]] = $arFields['PROPERTY_PROIZVODITEL_ENUM_ID'];        
        }                                                                                  
    }                
}                                                                                

foreach($arResult["ITEMS"] as $i => $arItem) {
    foreach($arProizvoditelEnumID as $proizvditelID => $proizvoditelEnumID) {
        if($arItem['ID'] == $proizvditelID) {
            $arResult["ELEMENTS"][$arItem['ID']]["PROPERTIES"]["PROIZVODITEL"]["VALUE_ENUM_ID"] = $proizvoditelEnumID;   
        }                                                                    
    }                                                                      
}  
?>