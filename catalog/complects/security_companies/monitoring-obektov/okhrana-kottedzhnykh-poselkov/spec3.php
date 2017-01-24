<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Охрана коттеджных поселков");

$id = 27666;

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
 
<br />

<br />
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	"complect",
	Array(
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
		"ELEMENT_COUNT" => "12",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(0=>"",1=>"VES_S_UPAKOVKOY_KG",2=>"GABARITNYE_RAZMERY_MM",3=>"CML2_ARTICLE",4=>"PROIZVODITEL",5=>"KOLICHESTVO_SHLEYFOV_SIGNALIZATSII",6=>"EMKOST_AKB_A_CH",7=>"VSTROENNYY_RIP",8=>"VARIANT_USTANOVKI",9=>"DIAGRAMMA_ZONY_OBNARUZHENIYA",10=>"ZASHCHITA_OT_ZHIVOTNYKH",11=>"TIP",12=>"PROCHEE",13=>"KOLICHESTVO_VYKHODOV",14=>"NOMINALNAYA_NAGRUZKA_VYKHODA_A",15=>"VYSOTA_USTANOVKI_M",16=>"INTERFEYS_",17=>"KOLICHESTVO_NOMEROV_OPOVESHCHENIYA",18=>"UROVEN_ZVUKOVOGO_DAVLENIYA_DB",19=>"KOLICHESTVO_AKB",20=>"NALICHIE_INTERFEYSA_RS_485",21=>"ZASHCHISHCHAEMAYA_PLOSHCHAD_DO_KV_M",22=>"UGOL_ZONY_OBNARUZHENIYA_",23=>"DALNOST_DEYSTVIYA_DO_M",24=>"ELEMENT_PITANIYA",25=>"PODKLYUCHENIE",26=>"KOLICHESTVO_REGISTRIRUEMYKH_RPD",27=>"KOLICHESTVO_PTSN",28=>"TOK_KOMMUTATSII_A",29=>"NAPRYAZHENIE_KOMMUTATSII_V",30=>"TEMPERATURA_SRABATYVANIYA_S",31=>"UPRAVLENIE_PRIBOROM",32=>"TIP_USTROYSTVA",33=>"CHASTOTA_MGTS",34=>"PLOSHCHAD_TUSHENIYA_KV_M",35=>"OBEM_TUSHENIYA_KUB_M",36=>"NAPRYAZHENIE_PITANIYA_V",37=>"POTREBLYAEMYY_TOK_MA",38=>"STEPEN_ZASHCHITY",39=>"TEMPERATURA_EKSPLUATATSII_S",40=>"",),
		"OFFERS_FIELD_CODE" => "",
		"OFFERS_PROPERTY_CODE" => "",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "timestamp_x",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"PRICE_CODE" => array(0=>"Д 10%",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"USE_PRODUCT_QUANTITY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"OFFERS_CART_PROPERTIES" => "",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB"
	)
);?>
<div>
  <br />

  <div><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; color: rgb(70, 70, 70); background-color: rgb(255, 255, 255);">* </span><i style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; color: rgb(70, 70, 70); background-color: rgb(255, 255, 255);">Комплект оборудования может быть изменен или дополнен в соответствии с пожеланием заказчика. </i><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; color: rgb(70, 70, 70); background-color: rgb(255, 255, 255);"></span><span style="color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; background-color: rgb(255, 255, 255);"> </span>
    <br style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; color: rgb(70, 70, 70); background-color: rgb(255, 255, 255);" />
  <span style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; color: rgb(70, 70, 70); background-color: rgb(255, 255, 255);">** </span><i style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19.6000003814697px; color: rgb(70, 70, 70); background-color: rgb(255, 255, 255);">Количество извещателей выбирается в зависимости от числа охраняемых помещений. </i></div>
</div>
