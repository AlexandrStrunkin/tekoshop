<?
if($arResult){
	$arResult = COptimus::getChilds($arResult);
	$isCatalog=false;
	$arCatalogItem=array();
	foreach($arResult as $key=>$arItem){
		if(isset($arItem["PARAMS"]["CLASS"]) && $arItem["PARAMS"]["CLASS"]=="catalog"){
			$isCatalog=true;
			$arCatalogItem=$arItem;
			unset($arResult[$key]);
		}
		if(isset($arItem["PARAMS"]["NOT_SHOW"]) && $arItem["PARAMS"]["NOT_SHOW"]=="Y"){
			unset($arResult[$key]);
		}
		if($arItem["CHILD"]){
			foreach($arItem["CHILD"] as $key2=>$arChild){
				if(isset($arChild["PARAMS"]["NOT_SHOW"]) && $arChild["PARAMS"]["NOT_SHOW"]=="Y"){
					unset($arResult[$key]["CHILD"][$key2]);
				}
				if($arChild["PARAMS"]["PICTURE"]){
					$img=CFile::ResizeImageGet($arChild["PARAMS"]["PICTURE"], Array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$arResult[$key]["CHILD"][$key2]["PARAMS"]["IMAGES"]=$img;
				}
			}
		}
	}
	if($isCatalog){
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
			}
		}
		array_unshift($arResult, $arCatalogItem);
		$arResult[0]["CHILD"] = $allSections;
		
		/*
		$catalog_id=\Bitrix\Main\Config\Option::get("aspro.optimus", "CATALOG_IBLOCK_ID", COptimusCache::$arIBlocks[SITE_ID]['aspro_optimus_catalog']['aspro_optimus_catalog'][0]);
		$arSections = COptimusCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => COptimusCache::GetIBlockCacheTag($catalog_id), 'GROUP' => array('ID'))), array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' =>\Bitrix\Main\Config\Option::get("aspro.optimus", "MAX_DEPTH_MENU", 2)), false, array("ID", "NAME", "PICTURE", "LEFT_MARGIN", "RIGHT_MARGIN", "DEPTH_LEVEL", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID"));
		$arTmpResult = array();
		if($arSections){

			$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
			$cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);

			foreach($arSections as $ID => $arSection){
				$arSections[$ID]['SELECTED'] = CMenu::IsItemSelected($arSection['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index);
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
		}
		array_unshift($arResult, $arCatalogItem);
		$arResult[0]["CHILD"]=$arTmpResult;*/
	}
}?>