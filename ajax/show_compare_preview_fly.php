<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/*$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list",
	"compare_fly",
	Array(
		"IBLOCK_TYPE" => "aspro_optimus_catalog",
		"IBLOCK_ID" => "185",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_ID#/",
		"COMPARE_URL" => "/catalog/compare.php",
		"NAME" => "CATALOG_COMPARE_LIST",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);

if(CModule::IncludeModule('aspro.optimus')){
	COptimus::clearBasketCounters();
} */
global $catalogIDS;
global $catalogIDS2;
$compare_items = array();
CModule::IncludeModule('iblock');
$res = CIBlock::GetList( Array("SORT"=>"ASC"),  Array('TYPE'=>'catalog', 'ACTIVE'=>'Y', 'ID' => array_merge($catalogIDS, $catalogIDS2)), false);
while($arIblock = $res->Fetch()){
	if($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]){
		$compare_items = array_merge((array)$compare_items, (array)array_keys($_SESSION['CATALOG_COMPARE_LIST'][$arIblock['ID']]['ITEMS']));
	}
}
?>
<?$count=count($compare_items);?>
<div class="count <?=($count ? '' : 'empty_items');?>">
	<span>
		<div class="items">
			<div><?=$count;?></div>
		</div>
	</span>
</div><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>