<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

?><hr />

<?$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", "green.tags.cloud", array(
	"SORT" => "NAME",
	"PAGE_ELEMENTS" => "30",
	"PERIOD" => "",
	"URL_SEARCH" => "/blog/search.php",
	"TAGS_INHERIT" => "Y",
	"CHECK_DATES" => "N",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
		0 => "blog",
	),
	"arrFILTER_blog" => array(
		0 => "1",
	),
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"FONT_MAX" => "20",
	"FONT_MIN" => "10",
	"COLOR_NEW" => "007D00",
	"COLOR_OLD" => "C0C0C0",
	"PERIOD_NEW_TAGS" => "",
	"SHOW_CHAIN" => "Y",
	"COLOR_TYPE" => "Y",
	"WIDTH" => "200"
	),
	false
);?> 
