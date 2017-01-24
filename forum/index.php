<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetPageProperty("title", "Интернет-магазин ТЕКО - Оборудование для систем безопасности");
$APPLICATION->SetPageProperty("description", "Предлагаем продукцию известных производителей на рынке СКУД, видеонаблюдения, сигнализаций. Самые низкие цены на продукцию АСТРА.");
$APPLICATION->SetPageProperty("keywords", "Интернет-магазин ТЕКО, доставка по России, ЗАО ТЕКО Казань, Системы безопасности Казань, ТЕКО АСТРА, видеонаблюдение, аудио- видеодомофоны");
$APPLICATION->SetTitle("ТЕКО: ТЕхника Которая Охраняет");
?>

<div class="padding-s">
<?$APPLICATION->IncludeComponent("bitrix:forum", ".default", array(
	"THEME" => "green",
	"SHOW_TAGS" => "Y",
	"SHOW_AUTH_FORM" => "Y",
	"TMPLT_SHOW_ADDITIONAL_MARKER" => "",
	"USE_LIGHT_VIEW" => "Y",
	"FID" => array(
	),
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/forum/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_TIME_USER_STAT" => "60",
	"CACHE_TIME_FOR_FORUM_STAT" => "3600",
	"FORUMS_PER_PAGE" => "10",
	"TOPICS_PER_PAGE" => "10",
	"MESSAGES_PER_PAGE" => "10",
	"IMAGE_SIZE" => "500",
	"ATTACH_MODE" => array(
		0 => "NAME",
	),
	"SET_TITLE" => "Y",
	"USE_RSS" => "Y",
	"SHOW_VOTE" => "N",
	"SHOW_RATING" => "",
	"RATING_ID" => array(
	),
	"RATING_TYPE" => "",
	"SEO_USER" => "Y",
	"SHOW_FORUM_USERS" => "Y",
	"SHOW_SUBSCRIBE_LINK" => "N",
	"SHOW_NAVIGATION" => "Y",
	"SHOW_LEGEND" => "Y",
	"SHOW_STATISTIC_BLOCK" => array(
		0 => "STATISTIC",
		1 => "BIRTHDAY",
		2 => "USERS_ONLINE",
	),
	"SHOW_FORUMS" => "Y",
	"SHOW_FIRST_POST" => "N",
	"SHOW_AUTHOR_COLUMN" => "N",
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
	"PAGE_NAVIGATION_TEMPLATE" => "forum",
	"PAGE_NAVIGATION_WINDOW" => "5",
	"AJAX_POST" => "N",
	"WORD_WRAP_CUT" => "23",
	"WORD_LENGTH" => "50",
	"USER_PROPERTY" => array(
	),
	"USER_FIELDS" => array(
	),
	"HELP_CONTENT" => "",
	"RULES_CONTENT" => "",
	"CHECK_CORRECT_TEMPLATES" => "Y",
	"PATH_TO_AUTH_FORM" => "",
	"TIME_INTERVAL_FOR_USER_STAT" => "10",
	"DATE_FORMAT" => "d.m.Y",
	"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
	"USE_NAME_TEMPLATE" => "N",
	"NAME_TEMPLATE" => "",
	"ATTACH_SIZE" => "90",
	"EDITOR_CODE_DEFAULT" => "N",
	"SEND_MAIL" => "E",
	"SEND_ICQ" => "A",
	"SET_NAVIGATION" => "Y",
	"SET_DESCRIPTION" => "Y",
	"SET_PAGE_PROPERTY" => "Y",
	"SHOW_FORUM_ANOTHER_SITE" => "Y",
	"VARIABLE_ALIASES" => array(
		"FID" => "FID",
		"TID" => "TID",
		"MID" => "MID",
		"UID" => "UID",
	)
	),
	false
);?>
</div>
</div>
<div class="col-left sidebar col-xs-12 col-sm-3">
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH."/include_areas/left_menu.php",
        "EDIT_TEMPLATE" => ""
    )
);?><?/*$APPLICATION->IncludeComponent("bitrix:news.list", "left_slider", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "2",
	"NEWS_COUNT" => "4",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "DETAIL_PICTURE",
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
	"PREVIEW_TRUNCATE_LEN" => "150",
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
);?><?$APPLICATION->IncludeComponent("miha:catalog.compare.list", "mc_compare", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"DETAIL_URL" => "",
	"COMPARE_URL" => "compare.php",
	"NAME" => "CATALOG_COMPARE_LIST",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?><?$APPLICATION->IncludeComponent("bitrix:menu", "actions_menu", array(
	"ROOT_MENU_TYPE" => "actions",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?><!--<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH."/include_areas/popular_tags.php",
        "EDIT_TEMPLATE" => ""
    )
);?>--><?$APPLICATION->IncludeComponent("bitrix:voting.form", "mc_voting_form", array(
	"VOTE_ID" => "7",
	"VOTE_RESULT_TEMPLATE" => "/catalog/vote_result.php?VOTE_ID=#VOTE_ID#",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?><?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH."/include_areas/price_list.php",
        "EDIT_TEMPLATE" => ""
    )
);*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>