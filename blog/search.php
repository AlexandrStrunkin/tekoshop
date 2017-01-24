<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?> <?$APPLICATION->IncludeComponent("bitrix:search.page", ".default", array(
	"RESTART" => "N",
	"NO_WORD_LOGIC" => "N",
	"CHECK_DATES" => "N",
	"USE_TITLE_RANK" => "N",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
		0 => "blog",
	),
	"SHOW_WHERE" => "N",
	"SHOW_WHEN" => "N",
	"PAGE_RESULT_COUNT" => "10",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"DISPLAY_TOP_PAGER" => "Y",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Результаты поиска",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "arrows",
	"USE_LANGUAGE_GUESS" => "Y",
	"USE_SUGGEST" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>