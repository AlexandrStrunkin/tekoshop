<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Система автоматического аварийного перекрытия воды по доступной цене");
$APPLICATION->SetPageProperty("description", "Готовое решение автоматического аварийного перекрытия воды при первых признаках протечки купить в интернет-магазине Teko-Shop.");
$APPLICATION->SetPageProperty("keywords", "система охраны, сигнализация");
$APPLICATION->SetTitle("Аварийное перекрытие воды");

$id = 27654;

$arSetItems = CCatalogProductSet::getAllSetsByProduct($id, CCatalogProductSet::TYPE_GROUP);
$setID = array();
foreach($arSetItems as $asi):
    foreach($asi["ITEMS"] as $asii):
        $setID[] = $asii["ITEM_ID"];
    endforeach;
endforeach;

//print_r($setID);
global $arrFilter;
$arrFilter = array("ID"=>$setID, "IBLOCK_ID"=>array("123","114","115","116","117","118","119","120","121","129"));

$setInfo = CIBlockElement::GetByID($id);
$setInfo = $setInfo->GetNext();
?>



<div class="page-title category-title"> 
    <p class="d-z"><h1><?=$setInfo["NAME"]?></h1></p>
</div>


<div><?=$setInfo["DETAIL_TEXT"]?></div>

<br /><br />


<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.top", 
    "complect", 
    array(
        "VIEW_MODE" => "BANNER",
        "TEMPLATE_THEME" => "blue",
        "PRODUCT_DISPLAY_MODE" => "N",
        "ADD_PICT_PROP" => "-",
        "LABEL_PROP" => "-",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_CLOSE_POPUP" => "Y",
        "ROTATE_TIMER" => "30",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_FIELD2" => "",
        "ELEMENT_SORT_ORDER2" => "",
        "FILTER_NAME" => "arrFilter",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "DISPLAY_COMPARE" => "N",
        "CACHE_FILTER" => "N",
        "ELEMENT_COUNT" => "10",
        "LINE_ELEMENT_COUNT" => "3",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "VES_S_UPAKOVKOY_KG",
            2 => "GABARITNYE_RAZMERY_MM",
            3 => "CML2_ARTICLE",
            4 => "PROIZVODITEL",
            5 => "KOLICHESTVO_SHLEYFOV_SIGNALIZATSII",
            6 => "EMKOST_AKB_A_CH",
            7 => "VSTROENNYY_RIP",
            8 => "VARIANT_USTANOVKI",
            9 => "DIAGRAMMA_ZONY_OBNARUZHENIYA",
            10 => "ZASHCHITA_OT_ZHIVOTNYKH",
            11 => "TIP",
            12 => "PROCHEE",
            13 => "KOLICHESTVO_VYKHODOV",
            14 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
            15 => "VYSOTA_USTANOVKI_M",
            16 => "INTERFEYS_",
            17 => "KOLICHESTVO_NOMEROV_OPOVESHCHENIYA",
            18 => "UROVEN_ZVUKOVOGO_DAVLENIYA_DB",
            19 => "KOLICHESTVO_AKB",
            20 => "NALICHIE_INTERFEYSA_RS_485",
            21 => "ZASHCHISHCHAEMAYA_PLOSHCHAD_DO_KV_M",
            22 => "UGOL_ZONY_OBNARUZHENIYA_",
            23 => "DALNOST_DEYSTVIYA_DO_M",
            24 => "ELEMENT_PITANIYA",
            25 => "PODKLYUCHENIE",
            26 => "KOLICHESTVO_REGISTRIRUEMYKH_RPD",
            27 => "KOLICHESTVO_PTSN",
            28 => "TOK_KOMMUTATSII_A",
            29 => "NAPRYAZHENIE_KOMMUTATSII_V",
            30 => "TEMPERATURA_SRABATYVANIYA_S",
            31 => "UPRAVLENIE_PRIBOROM",
            32 => "TIP_USTROYSTVA",
            33 => "CHASTOTA_MGTS",
            34 => "PLOSHCHAD_TUSHENIYA_KV_M",
            35 => "OBEM_TUSHENIYA_KUB_M",
            36 => "NAPRYAZHENIE_PITANIYA_V",
            37 => "POTREBLYAEMYY_TOK_MA",
            38 => "STEPEN_ZASHCHITY",
            39 => "TEMPERATURA_EKSPLUATATSII_S",
            40 => "",
        ),
        "OFFERS_FIELD_CODE" => "",
        "OFFERS_PROPERTY_CODE" => "",
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_FIELD2" => "timestamp_x",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFERS_LIMIT" => "5",
        "PRICE_CODE" => array(
            0 => "Д 10%",
        ),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_PROPERTIES" => array(
        ),
        "ADD_TO_BASKET_ACTION" => "ADD",
        "USE_PRODUCT_QUANTITY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "HIDE_NOT_AVAILABLE" => "N",
        "OFFERS_CART_PROPERTIES" => "",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB"
    ),
    false
);?>




<? /*$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor","",
Array(
        "IBLOCK_TYPE_ID" => "books",
        "IBLOCK_ID" => "123",
        "ELEMENT_ID" => "27550",
        "BASKET_URL" => "/personal/basket.php",
        "PRICE_CODE" => array("BASE"),
        "PRICE_VAT_INCLUDE" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "OFFERS_CART_PROPERTIES" => array("SKU_PROP")
    )
);*/?>


<? /*$APPLICATION->IncludeComponent(
    "bitrix:catalog.element", 
    "only_nabor", 
    array(
        "TEMPLATE_THEME" => "blue",
        "ADD_PICT_PROP" => "-",
        "LABEL_PROP" => "-",
        "DISPLAY_NAME" => "Y",
        "DETAIL_PICTURE_MODE" => "IMG",
        "ADD_DETAIL_TO_SLIDER" => "N",
        "DISPLAY_PREVIEW_TEXT_MODE" => "E",
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_MAX_QUANTITY" => "Y",
        "ADD_TO_BASKET_ACTION" => array(
            0 => "BUY",
            1 => "ADD",
        ),
        "SHOW_CLOSE_POPUP" => "N",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "USE_VOTE_RATING" => "N",
        "USE_COMMENTS" => "N",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "123",
        "ELEMENT_ID" => "27550",
        "ELEMENT_CODE" => "",
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "CHECK_SECTION_ID_VARIABLE" => "N",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_STATUS_404" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "PROPERTY_CODE" => array(
            0 => "KOMPLEKTATSIYA",
            1 => "",
        ),
        "OFFERS_LIMIT" => "0",
        "PRICE_CODE" => array(
            0 => "Д 10%",
        ),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "USE_PRODUCT_QUANTITY" => "Y",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRODUCT_PROPERTIES" => array(
        ),
        "DISPLAY_COMPARE" => "N",
        "LINK_IBLOCK_TYPE" => "",
        "LINK_IBLOCK_ID" => "",
        "LINK_PROPERTY_SID" => "",
        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "USE_ELEMENT_COUNTER" => "Y",
        "HIDE_NOT_AVAILABLE" => "N",
        "CONVERT_CURRENCY" => "N",
        "SHOW_BASIS_PRICE" => "N"
    ),
    false
);*/?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>