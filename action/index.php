<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Новости, новинки, акции от ТЕКО - Казань, Чебоксары, Альметьевск, Набережные Челны");
$APPLICATION->SetPageProperty("keywords", "Новинки, информация, внимание, акции");
$APPLICATION->SetTitle("Новости ТЕКО");
?>
<div class="row"> 
  <div class="col-main col-xs-12 col-sm-9"> 
    <div class="padding-s">
		<div class="std" style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: 1.4; font-family: Arial, Helvetica, sans-serif;"> 
        <div class="clear"></div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"actions_section", 
	array(
		"IBLOCK_TYPE" => "actions",
		"IBLOCK_ID" => "126",
		"NEWS_COUNT" => "10",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "360",
		"YANDEX" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"CATEGORY_IBLOCK" => array(
			0 => "2",
		),
		"CATEGORY_CODE" => "THEMES",
		"CATEGORY_ITEMS_COUNT" => "4",
		"CATEGORY_THEME_2" => "photo",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "0",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "SOURCE",
			2 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Акции",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"USE_SHARE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "actions_section",
		"SET_LAST_MODIFIED" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"TEMPLATE_THEME" => "blue",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => "",
		"TAGS_CLOUD_ELEMENTS" => "150",
		"PERIOD_NEW_TAGS" => "",
		"DISPLAY_AS_RATING" => "rating",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"TAGS_CLOUD_WIDTH" => "100%",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?></div>
     </div>
   </div>
 
  <div class="col-left sidebar col-xs-12 col-sm-3"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/left_menu.php",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"left_slider",
	Array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"",),
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
	)
);?><?$APPLICATION->IncludeComponent(
	"miha:catalog.compare.list",
	"mc_compare",
	Array(
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
	)
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
);?>
<!--<img id="bxid_163119" style="cursor: default;" src="/bitrix/components/bitrix/main.include/images/include.gif"  />-->
 <?$APPLICATION->IncludeComponent("bitrix:voting.form", "mc_voting_form", array(
	"VOTE_ID" => "9",
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
);?></div>
 </div>

<?
if($_SERVER['REQUEST_URI']=="/news/16/13304/"){
echo "<div class='d-t' style='width: 700px; margin: 15px 0px 0px 299px;'>
<h1>Мегапиксельная IP-камера  с вариофокальным объективом</h1>
<p>Вариофокальный объектив – это подвижный объектив, благодаря которому вы самостоятельно настраиваете угол обзора и корректируете фокусное расстояник, чтобы достичь максимально точного результата. Угол обзора будет соответствовать точно поставленой задаче. Мегапиксельная <a href='/catalog/video/videokamery/ip/'>IP-камера</a> оснащенная вариофокальным объективом является надёжной основой системы видеонаблюдения. Вариофокальный мегапиксельный объектив является упрощенным вариантом зум-объектива, по его размерам и стоимости.</p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/news/16/20315/"){
echo "<div class='d-t' style='width: 700px; margin: 15px 0px 0px 299px;'>
<h1>Поворотная IP-камера для видеонаблюдения</h1>
<p>Поворотная IP-камера обладает преимуществом среды обычных IP-камер, она может поворачиваться в заданный угол обзора и давать детальную картинку объекта наблюдения. Такая камера может работать как с оператором, так и самостоятельно в режиме «автопатрулирования».</p>
<p>Скоростная видеокамера предназначена для использования внутри и вне помещений, работает даже при плохом освещении, переходит в режим «день-ночь». Поворотная уличная IP-камера охватывает большее пространство, нежели обычная камера. Различие между поворотными IP-камерами в их корпусах. <a href='http://teko-shop.ru/catalog/video/videokamery/filter/korpus-kupolnyy/'>Купольная  поворотная IP-камера</a> является самым удобным вариантом, её можно крепить на потолок или на стену, она имеет защитное покрытие и может функционировать практически в любых условиях.</p>
</div>";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>