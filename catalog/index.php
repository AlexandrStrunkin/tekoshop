<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");?>
<div class="catalog_section_list">
	 <?CModule::IncludeModule('iblock');
		global $catalogIDS;
		$res = CIBlock::GetList( Array("SORT"=>"ASC"),  Array('TYPE'=>'catalog', 'ACTIVE'=>'Y', 'ID' => $catalogIDS ), false);
		while($arIblock = $res->Fetch()){?>
	<div class="section_item">
		<a class="iblocktitle" href="/catalog/<?=$arIblock['CODE']?>/"><?=$arIblock['NAME']?></a>
	</div>
	 <? } ?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>