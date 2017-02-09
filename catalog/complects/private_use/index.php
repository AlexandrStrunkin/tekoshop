<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Готовые комплекты систем видеонаблюдения и безопасности для частного использования");
$APPLICATION->SetPageProperty("description", "В интернет-магазине Teko-Shop вы можете купить готовые комплекты систем безопасности, сигнализации и видеонаблюдения для частного использования по доступным ценам.");
$APPLICATION->SetPageProperty("keywords", "система охраны, сигнализация");
$APPLICATION->SetTitle("Для частного использования");
?>

<div class="row">
<div class="col-main col-xs-12 col-sm-9">
<div class="padding-s">
<div class="std"><div class="clear"></div>
<h1>Готовые комплекты систем видеонаблюдения и безопасности для частного использования</h1>


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
);?><?$APPLICATION->IncludeComponent("bitrix:news.list", "left_slider", array(
    "IBLOCK_TYPE" => "news",
    "IBLOCK_ID" => "2",
    "NEWS_COUNT" => "4",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_ORDER1" => "DESC",
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "",
    "FIELD_CODE" => array(
        0 => "",
        1 => "",
    ),
    "PROPERTY_CODE" => array(
        0 => "",
        1 => "",
    ),
    "CHECK_DATES" => "Y",
    "DETAIL_URL" => "",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",
    "PREVIEW_TRUNCATE_LEN" => "140",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "SET_TITLE" => "N",
    "SET_STATUS_404" => "N",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "PARENT_SECTION" => "",
    "PARENT_SECTION_CODE" => "",
    "INCLUDE_SUBSECTIONS" => "Y",
    "PAGER_TEMPLATE" => ".default",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "PAGER_TITLE" => "Новости",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "Y",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);?></div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>