<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Запрос на изменение цен в интернет-магазине");
$APPLICATION->SetPageProperty("keywords", "Дисконтные карты ТЕКО");
$APPLICATION->SetTitle("Запрос на изменение цен");
?>
    <div class="padding-s"> 
      <div class="clear" style="font: 14px/1.4 Arial, Helvetica, sans-serif; font-size-adjust: none; font-stretch: normal;"></div>
    
      <div class="std" style="font: 14px/1.4 Arial, Helvetica, sans-serif; font-size-adjust: none; font-stretch: normal;"> Владельцы дисконтных карт &quot;ТЕКО&quot;! 
        <br />
       
        <br />
       Для получения &quot;ваших&quot; цен на сайте интернет-магазина, пожалуйста напишите письмо на <a href="mailto:shop@teko.biz">shop@teko.biz</a>, в письме укажите: 
        <br />
       
        <br />
       Учетная запись в интернет-магазине 
        <br />
       Название организации 
        <br />
       Номер карты. 
        <br />
       
        <br />
       После проверки соответствия - цены на сайте будут с учетом ваших накопленных скидок. 
        <br />
      </div>
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
);?>
<?require($_SERVER["DOCUMENT_ROOT"].'/include/left_news.php')?>
<?$APPLICATION->IncludeComponent("miha:catalog.compare.list", "mc_compare", array(
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
);?>
<!--<img id="bxid_330435" src="/bitrix/images/fileman/htmledit2/php.gif" border="0"/>-->
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
);?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>