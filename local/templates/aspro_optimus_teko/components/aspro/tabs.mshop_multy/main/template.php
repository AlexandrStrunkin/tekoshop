<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);
	
	$class_block="s_".randString();
	$arTab=array();
	$col=4;
	if($arParams["LINE_ELEMENT_COUNT"]>=3 && $arParams["LINE_ELEMENT_COUNT"]<4)
		$col=3;
	if($arResult["SHOW_SLIDER_PROP"]){?>
		<div class="tab_slider_wrapp specials <?=$class_block;?> best_block clearfix">
			<div class="top_blocks">
				<ul class="tabs">
					<?$i=1;
					foreach($arResult["TABS"] as $code=>$title):?>
						<li data-code="<?=$code?>" <?=($i==1 ? "class='cur'" : "")?>><span><?=$title;?></span></li>
						<?$i++;?>
					<?endforeach;?>
					<li class="stretch"></li>
				</ul>
			</div>
			<ul class="tabs_content">
				<?$j=1;?>
				<?foreach($arResult["TABS"] as $code=>$title){?>
					<li class="tab <?=$code?>_wrapp <?=($j++ ==1 ? "cur" : "");?>" data-code="<?=$code?>" data-col="<?=$col;?>">
						<ul class="tabs_slider <?=$code?>_slides wr">
							<?
							$GLOBALS[$arParams["FILTER_NAME"]]=array("PROPERTY_HIT_VALUE" => array($title));
							if($arParams["SECTION_ID"]){
								$GLOBALS[$arParams["FILTER_NAME"]]["SECTION_ID"]=$arParams["SECTION_ID"];
								$GLOBALS[$arParams["FILTER_NAME"]]["INCLUDE_SUBSECTIONS"] = "Y"; 
							}?>
							<?$APPLICATION->IncludeComponent(
								"aspro:catalog.top",
								"main",
								array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams['IBLOCK_ID'],
									"FILTER_NAME" => $arParams["FILTER_NAME"],
									"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
									"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
									"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
									"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
									"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
									"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
									"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
									"BASKET_URL" => $arParams["BASKET_URL"],
									"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
									"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
									"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
									"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
									"ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
									"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
									"PROPERTY_CODE" => $arParams["PROP_CODE"],
									"PRICE_CODE" => $arParams["PRICE_CODE"],
									"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
									"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
									"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
									"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
									"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
									"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
									"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
									"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"CACHE_FILTER" => "Y",
									"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
									"OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
									"OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
									"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
									"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
									"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
									"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
									"OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
									'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
									'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									'LABEL_PROP' => $arParams['LABEL_PROP'],
									'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
									'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
									"SALE_STIKER" => $arParams["SALE_STIKER"],

									'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
									'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
									'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
									'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
									'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
									'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
									'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
									"HIT_CODE" => $code,
								),
								false, array("HIDE_ICONS"=>"Y")
							);?>
						</ul>
					</li>
				<?}?>
			</ul>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.catalog_block .catalog_item_wrapp .catalog_item .item_info:visible .item-title').sliceHeight({item:'.catalog_item'});
				$('.catalog_block .catalog_item_wrapp .catalog_item .item_info:visible').sliceHeight({classNull: '.footer_button', item:'.catalog_item'});
				$('.catalog_block .catalog_item_wrapp .catalog_item:visible').sliceHeight({classNull: '.footer_button', item:'.catalog_item'});
			});
		</script>
	<?}?>