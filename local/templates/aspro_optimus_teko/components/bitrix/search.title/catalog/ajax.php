<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["CATEGORIES"])):?>
	<table class="title-search-result">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<tr>
				<?if($category_id === "all"):?>
					<td class="title-search-all" colspan="<?=($arParams["SHOW_PREVIEW"]=="Y") ? '3' : '2'?>" >
						<a href="<?=$arItem["URL"]?>"><span class="text"><?=$arItem["NAME"]?></span><span class="icon"><i></i></span></a>
					</td>
				<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
					$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
				?>
					<?if ($arParams["SHOW_PREVIEW"]=="Y"):?>
						<td class="picture">
							<?if (is_array($arElement["PICTURE"])):?>
								<img class="item_preview" align="left" src="<?=$arElement["PICTURE"]["src"]?>" width="<?=$arElement["PICTURE"]["width"]?>" height="<?=$arElement["PICTURE"]["height"]?>">
							<?else:?>
								<img align="left" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_small.png" width="38" height="38">
							<?endif;?>
						</td>
					<?endif;?>
					<td class="main">
						<div class="item-text">
							<a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a>
							<?if ($arParams["SHOW_ANOUNCE"]=="Y"):?><p class="title-search-preview"><?=$arElement["PREVIEW_TEXT"];?></p><?endif;?>
						</div>
						<div class="price cost prices">
							<div class="title-search-price">
                                <?// Ценовая политика                 
                                $min_price_id = 0;            
                                list($min_price, $old_price, $region_price, $bManufacturerPrice) = GetItemPrices($arResult["ELEMENTS"][$arItem["ITEM_ID"]]["PRICES"], $arElement["IBLOCK_ID"], $arElement["PROPERTIES"]["PROIZVODITEL"]["VALUE_ENUM_ID"]);      
                                                                                
                                ?>

                                <?if( count( $arElement["OFFERS"] ) > 0 ){
                                    $minPrice = false;
                                    $min_price_id=0;
                                    if (isset($arElement['MIN_PRICE']) || isset($arElement['RATIO_PRICE'])){
                                        // $minPrice = (isset($arElement['RATIO_PRICE']) ? $arElement['RATIO_PRICE'] : $arElement['MIN_PRICE']);
                                        $minPrice = $arElement['MIN_PRICE'];
                                    }
                                    $offer_id=0;
                                    if($arParams["TYPE_SKU"]=="N"){
                                        $offer_id=$minPrice["MIN_ITEM_ID"];
                                    }
                                    $min_price_id=$minPrice["MIN_PRICE_ID"];
                                    if(!$min_price_id)
                                        $min_price_id=$minPrice["PRICE_ID"];
                                    if($minPrice["MIN_ITEM_ID"])
                                        $item_id=$minPrice["MIN_ITEM_ID"];
                                    $prefix='';
                                    if('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] =='table' || empty($arElement['OFFERS_PROP'])){
                                        $prefix=GetMessage("CATALOG_FROM");
                                    }
                                    if($arParams["SHOW_OLD_PRICE"]=="Y"){?>
                                        <div class="price" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE']; ?>">
                                            <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                                <?=$prefix;?> <?=$minPrice["PRINT_DISCOUNT_VALUE"];?>
                                                <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                    /<?=$strMeasure?>
                                                <?}?>
                                            <?endif;?>
                                        </div>
                                        <div class="price discount" >
                                            <strike id="<?=$arItemIDs["ALL_ITEM_IDS"]['OLD_PRICE']?>" <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>><?=$minPrice["PRINT_VALUE"];?></strike>
                                        </div>
                                        <?/*if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
                                            <div class="sale_block" <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>>
                                                <?$percent=round(($minPrice["DISCOUNT_DIFF"]/$minPrice["VALUE"])*100, 2);?>
                                                <div class="value">-<?=$percent;?>%</div>
                                                <div class="text"><?=GetMessage("CATALOG_ECONOMY");?> <span><?=$minPrice["PRINT_DISCOUNT_DIFF"];?></span></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?}*/?>
                                    <?}else{?>
                                        <div class="price" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE']; ?>">
                                            <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                                <?=$prefix;?> <?=$minPrice['PRINT_DISCOUNT_VALUE'];?>
                                                <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                    /<?=$strMeasure?>
                                                <?}?>
                                            <?endif;?>
                                        </div>
                                    <?}?>
                                <?}
                                else{?>
                                    <?if($min_price):?>
                                        <?$min_price_id = $min_price['ID'];?>                  
                                        <div class="price"><?=$min_price["PRINT_VALUE"]?><?=($arParams["SHOW_MEASURE"] === "Y" && $strMeasure ? '/'.$strMeasure : '')?></div>
                                    <?endif;?>
                                <?}?>
								<?/*if($arElement["MIN_PRICE"]){?>
									<?if($arElement["MIN_PRICE"]["DISCOUNT_VALUE"] < $arElement["MIN_PRICE"]["VALUE"]):?>
										<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?></div>
										<div class="price discount">
											<strike><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></strike>
										</div>
									<?else:?>
										<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></div>
									<?endif;?>
								<?}else{?>
									<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
										<?if($arPrice["CAN_ACCESS"]):?>
											<?if (count($arElement["PRICES"])>1):?>
												<div class="price_name"><?=$arResult["PRICES"][$code]["TITLE"];?></div>
											<?endif;?>
											<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
												<div class="price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
												<div class="price discount">
													<strike><?=$arPrice["PRINT_VALUE"]?></strike>
												</div>
											<?else:?>
												<div class="price"><?=$arPrice["PRINT_VALUE"]?></div>
											<?endif;?>
										<?endif;?>
									<?endforeach;?>
								<?}*/?>
							</div>
						</div>
					</td>
				<?elseif(isset($arItem["ICON"])):?>
					<td class="main" colspan="<?=($arParams["SHOW_PREVIEW"]=="Y") ? '3' : '2'?>">
						<div class="item-text">
							<a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a>
						</div>
					</td>
				<?endif;?>
			</tr>
			<?endforeach;?>
		<?endforeach;?>
	</table>

<?endif;?>
