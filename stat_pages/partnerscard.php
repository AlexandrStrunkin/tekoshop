<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта партнера");
?> 
<div class="col-left sidebar col-xs-12 col-sm-3"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/left_menu.php",
		"EDIT_TEMPLATE" => ""
	)
);?>
<?/*$APPLICATION->IncludeComponent(
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
);*/?> 
<!--<img id="bxid_913954" style="cursor: default;" src="/bitrix/components/bitrix/main.include/images/include.gif"  />-->
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
 
<p align="CENTER"><strong>Уважаемые партнеры!</strong></p>
 
<p align="JUSTIFY"> 	Для четкой работы при оформлении договоров, платежных и отгрузочных документов представляем Вам нашу карту партнера и просим Вас сделать то же самое, предоставив нам Вашу.</p>
 
<p align="JUSTIFY"> Карта партнера ЗАО &quot;ТЕКО&quot; (<strong><a rel="nofollow" href="/upload/Partnerscard_TEKO.pdf" target="_blank" >.pdf</a></strong>)</p>
 
<p align="JUSTIFY">Карта клиента (<strong><a rel="nofollow" href="/upload/Partnerscard.pdf" target="_blank" >.pdf</a><a href="/upload/Partnerscard.xls" target="_blank" >.xls</a></strong>) 
 </p>  <br />
<p align="JUSTIFY">Заполненную карту, отправьте нам, любым удобным для вас способом. Спасибо. </p>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>