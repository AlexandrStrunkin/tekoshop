<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>

<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.detail","",Array(
        "PATH_TO_LIST" => "/personal/orders/",
        "PATH_TO_CANCEL" => "/personal/cancel/?ID=#ID#",
        "PATH_TO_PAYMENT" => "/personal/orders/detail/payment/",
        "PATH_TO_COPY" => "",
        "ID" => $ID,
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "PICTURE_WIDTH" => "110",
        "PICTURE_HEIGHT" => "110",
        "PICTURE_RESAMPLE_TYPE" => "1",
        "CUSTOM_SELECT_PROPS" => array(),
        "PROP_1" => Array(),
        "PROP_2" => Array()
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
