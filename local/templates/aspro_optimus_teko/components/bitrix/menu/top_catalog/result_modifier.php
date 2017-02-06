<?
global $catalogIDS;
$allSections = array();
$res = CIBlock::GetList( Array("SORT"=>"ASC"),  Array('TYPE'=>'catalog', 'ACTIVE'=>'Y', 'ID' => $catalogIDS ), false);
while($arIblock = $res->GetNext()){
	$arSections = COptimusCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => COptimusCache::GetIBlockCacheTag($arIblock['ID']), 'GROUP' => array('ID'))), array('IBLOCK_ID' => $arIblock['ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => \Bitrix\Main\Config\Option::get("aspro.optimus", "MAX_DEPTH_MENU", 4)), false, array("ID", "NAME", "PICTURE", "LEFT_MARGIN", "RIGHT_MARGIN", "DEPTH_LEVEL", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID"));
	
	if ($arSections){
		$arTmpResult = array();
		
		foreach($arSections as $ID => $arSection){
			if($arSection['PICTURE']){
				$img=CFile::ResizeImageGet($arSection['PICTURE'], Array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$arSections[$ID]['IMAGES']=$img;
			}
			if($arSection['IBLOCK_SECTION_ID']){
				if(!isset($arSections[$arSection['IBLOCK_SECTION_ID']]['CHILD'])){
					$arSections[$arSection['IBLOCK_SECTION_ID']]['CHILD'] = array();
				}
				$arSections[$arSection['IBLOCK_SECTION_ID']]['CHILD'][] = &$arSections[$arSection['ID']];
			}

			if($arSection['DEPTH_LEVEL'] == 1){
				$arTmpResult[] = &$arSections[$arSection['ID']];
			}
		}
		
		$arIblock['CHILD'] = $arTmpResult;
	}
	$allSections[] = $arIblock;
}

if ($allSections){
	$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
	$cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);

	foreach($allSections as $k1 => $iblock){
		if($iblock['PICTURE']){
			$img=CFile::ResizeImageGet($iblock['PICTURE'], Array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$allSections[$k1]['IMAGES']=$img;
		}
		
		if ($iblock['CHILD']){
			/*foreach($iblock['CHILD'] as $k2 => $arSection){
				if($iblock['PICTURE']){
					$img=CFile::ResizeImageGet($arSection['PICTURE'], Array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$allSections[$k1][$k2]['IMAGES']=$img;
				}
			}*/
		}
	}
}

$arResult[0]["CHILD"] = $allSections; ?>