<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Готовые комплекты систем безопасности для защиты от проникновения и пожара купить");
$APPLICATION->SetPageProperty("description", "В интернет-магазине Teko-Shop вы можете купить готовые комплекты систем безопасности для защиты от проникновения и пожара купить по доступным ценам.");
$APPLICATION->SetPageProperty("keywords", "система охраны, сигнализация");
$APPLICATION->SetTitle("Для частного использования");
?>
<div class="row">
<div class="col-main col-xs-12 col-sm-9">
<div class="padding-s">
<div class="std"><div class="clear"></div>
<h1>Готовые комплекты систем безопасности для защиты от проникновения и пожара</h1>
<?$APPLICATION->IncludeComponent("bitrix:menu", "vertical_multilevel1", array(
    "ROOT_MENU_TYPE" => "sub",
    "MENU_CACHE_TYPE" => "N",
    "MENU_CACHE_TIME" => "3600",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_GET_VARS" => array(
    ),
    "MAX_LEVEL" => "2",
    "CHILD_MENU_TYPE" => "sub",
    "USE_EXT" => "N",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N"
    ),
    false
);?>

<?include($_SERVER["DOCUMENT_ROOT"].'/include/setsSlider.php')?>

</div></div></div>


<div class="col-left sidebar col-xs-12 col-sm-3">
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH."/include_areas/left_menu.php",
        "EDIT_TEMPLATE" => ""
    )
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>