<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>

<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.cancel","",Array(
        "PATH_TO_LIST" => "/personal/cancel/",
        "PATH_TO_DETAIL" => "/personal/detail/?ID=#ID#",
        "ID" => $ID,
        "SET_TITLE" => "Y"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
