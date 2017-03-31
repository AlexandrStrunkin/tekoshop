<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

foreach ($arResult["SEARCH"] as $key => $item){
    $res = CIBlockElement::GetByID($item["ITEM_ID"])->GetNext();

    // Выведем цену типа $PRICE_TYPE_ID товара с кодом $PRODUCT_ID
    $db_res_o = CPrice::GetList(array(), array( "PRODUCT_ID" => $res["ID"], "CATALOG_GROUP_ID" => 6), false, false);
    if ($ar_res = $db_res_o->GetNext())
    {
        if($ar_res["CATALOG_GROUP_ID"] == 6){
            $res["MIN_PRICE"]["VALUE"] = $ar_res["PRICE"];
            $res["MIN_PRICE"]["CURRENCY"] = $ar_res["CURRENCY"];
            $res["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] = CurrencyFormat($ar_res["PRICE"], $ar_res["CURRENCY"]);
        }
    }
    $db_res_r = CPrice::GetList(array(), array( "PRODUCT_ID" => $res["ID"], "CATALOG_GROUP_ID" => 4), false, false);
    if ($ar_res = $db_res_r->GetNext())
    {
        if($ar_res["CATALOG_GROUP_ID"] == 4){
            $res["PRICE"]["VALUE"] = $ar_res["PRICE"];
            $res["PRICE"]["CURRENCY"] = $ar_res["CURRENCY"];
            $res["PRICE"]["PRINT_DISCOUNT_VALUE"] = CurrencyFormat($ar_res["PRICE"], $ar_res["CURRENCY"]);
        }
    }
    $ar_quantity = CCatalogProduct::GetByID($res["ID"]);

    $res["QUANTITY"] = $ar_quantity["QUANTITY"];
    $arResult["SEARCH"][$key] = $res;
}             

?>
