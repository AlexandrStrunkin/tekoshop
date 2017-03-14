<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="search-page">
    <?if($arParams["SHOW_TAGS_CLOUD"] == "Y")
    {
        $arCloudParams = Array(
            "SEARCH" => $arResult["REQUEST"]["~QUERY"],
            "TAGS" => $arResult["REQUEST"]["~TAGS"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "arrFILTER" => $arParams["arrFILTER"],
            "SORT" => $arParams["TAGS_SORT"],
            "PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
            "PERIOD" => $arParams["TAGS_PERIOD"],
            "URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
            "TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
            "FONT_MAX" => $arParams["FONT_MAX"],
            "FONT_MIN" => $arParams["FONT_MIN"],
            "COLOR_NEW" => $arParams["COLOR_NEW"],
            "COLOR_OLD" => $arParams["COLOR_OLD"],
            "PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
            "SHOW_CHAIN" => "N",
            "COLOR_TYPE" => $arParams["COLOR_TYPE"],
            "WIDTH" => $arParams["WIDTH"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "RESTART" => $arParams["RESTART"],
        );

        if(is_array($arCloudParams["arrFILTER"]))
        {
            foreach($arCloudParams["arrFILTER"] as $strFILTER)
            {
                if($strFILTER=="main")
                {
                    $arCloudParams["arrFILTER_main"] = $arParams["arrFILTER_main"];
                }
                elseif($strFILTER=="forum" && IsModuleInstalled("forum"))
                {
                    $arCloudParams["arrFILTER_forum"] = $arParams["arrFILTER_forum"];
                }
                elseif(strpos($strFILTER,"iblock_")===0)
                {
                    foreach($arParams["arrFILTER_".$strFILTER] as $strIBlock)
                        $arCloudParams["arrFILTER_".$strFILTER] = $arParams["arrFILTER_".$strFILTER];
                }
                elseif($strFILTER=="blog")
                {
                    $arCloudParams["arrFILTER_blog"] = $arParams["arrFILTER_blog"];
                }
                elseif($strFILTER=="socialnetwork")
                {
                    $arCloudParams["arrFILTER_socialnetwork"] = $arParams["arrFILTER_socialnetwork"];
                }
            }
        }
        $APPLICATION->IncludeComponent("bitrix:search.tags.cloud", ".default", $arCloudParams, $component, array("HIDE_ICONS" => "Y"));
    }
    ?>
    <form action="" method="get">
        <input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
        <input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <td style="width: 100%;">
                    <?if($arParams["USE_SUGGEST"] === "Y"):
                        if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
                        {
                            $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
                            $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
                            $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
                        }
                        ?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:search.suggest.input",
                            "",
                            array(
                                "NAME" => "q",
                                "VALUE" => $arResult["REQUEST"]["~QUERY"],
                                "INPUT_SIZE" => -1,
                                "DROPDOWN_SIZE" => 10,
                                "FILTER_MD5" => $arResult["FILTER_MD5"],
                            ),
                            $component, array("HIDE_ICONS" => "Y")
                        );?>
                    <?else:?>
                        <input class="search-query" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" />
                    <?endif;?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    <button class="button m " type="submit" value="<?echo GetMessage("CT_BSP_GO")?>"><span><?echo GetMessage("CT_BSP_GO")?></span></button>
                    <!--<input class="search-button" type="submit" value="<?echo GetMessage("CT_BSP_GO")?>" />-->
                </td>
            </tr>
        </tbody></table>

        <noindex>
        <div class="search-advanced">
            <div class="search-advanced-result">
                <?if(is_object($arResult["NAV_RESULT"])):?>
                    <div class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>: <?echo $arResult["NAV_RESULT"]->SelectedRowsCount()?></div>
                <?endif;?>
                <?
                $arWhere = array();

                if(!empty($arResult["TAGS_CHAIN"]))
                {
                    $tags_chain = '';
                    foreach($arResult["TAGS_CHAIN"] as $arTag)
                    {
                        $tags_chain .= ' '.$arTag["TAG_NAME"].' [<a href="'.$arTag["TAG_WITHOUT"].'" class="search-tags-link" rel="nofollow">x</a>]';
                    }

                    $arWhere[] = GetMessage("CT_BSP_TAGS").' &mdash; '.$tags_chain;
                }

                if($arParams["SHOW_WHERE"])
                {
                    $where = GetMessage("CT_BSP_EVERYWHERE");
                    foreach($arResult["DROPDOWN"] as $key=>$value)
                        if($arResult["REQUEST"]["WHERE"]==$key)
                            $where = $value;

                    $arWhere[] = GetMessage("CT_BSP_WHERE").' &mdash; '.$where;
                }

                if($arParams["SHOW_WHEN"])
                {
                    if($arResult["REQUEST"]["FROM"] && $arResult["REQUEST"]["TO"])
                        $when = GetMessage("CT_BSP_DATES_FROM_TO", array("#FROM#" => $arResult["REQUEST"]["FROM"], "#TO#" => $arResult["REQUEST"]["TO"]));
                    elseif($arResult["REQUEST"]["FROM"])
                        $when = GetMessage("CT_BSP_DATES_FROM", array("#FROM#" => $arResult["REQUEST"]["FROM"]));
                    elseif($arResult["REQUEST"]["TO"])
                        $when = GetMessage("CT_BSP_DATES_TO", array("#TO#" => $arResult["REQUEST"]["TO"]));
                    else
                        $when = GetMessage("CT_BSP_DATES_ALL");

                    $arWhere[] = GetMessage("CT_BSP_WHEN").' &mdash; '.$when;
                }

                if(count($arWhere))
                    echo GetMessage("CT_BSP_WHERE_LABEL"),': ',implode(", ", $arWhere);
                ?>
            </div><?//div class="search-advanced-result"?>
            <?if($arParams["SHOW_WHERE"] || $arParams["SHOW_WHEN"]):?>
                <script>
                function switch_search_params()
                {
                    var sp = document.getElementById('search_params');
                    var flag;

                    if(sp.style.display == 'none')
                    {
                        disable_search_input(sp, false);
                        sp.style.display = 'block'
                    }
                    else
                    {
                        disable_search_input(sp, true);
                        sp.style.display = 'none';
                    }
                    return false;
                }

                function disable_search_input(obj, flag)
                {
                    var n = obj.childNodes.length;
                    for(var j=0; j<n; j++)
                    {
                        var child = obj.childNodes[j];
                        if(child.type)
                        {
                            switch(child.type.toLowerCase())
                            {
                                case 'select-one':
                                case 'file':
                                case 'text':
                                case 'textarea':
                                case 'hidden':
                                case 'radio':
                                case 'checkbox':
                                case 'select-multiple':
                                    child.disabled = flag;
                                    break;
                                default:
                                    break;
                            }
                        }
                        disable_search_input(child, flag);
                    }
                }
                </script>
                <div class="search-advanced-filter"><a href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADVANCED_SEARCH')?></a></div>
        </div><?//div class="search-advanced"?>
                <div id="search_params" class="search-filter" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"] || $arResult["REQUEST"]["WHERE"]? 'block': 'none'?>">
                    <h2><?echo GetMessage('CT_BSP_ADVANCED_SEARCH')?></h2>
                    <table class="search-filter" cellspacing="0"><tbody>
                        <?if($arParams["SHOW_WHERE"]):?>
                        <tr>
                            <td class="search-filter-name"><?echo GetMessage("CT_BSP_WHERE")?></td>
                            <td class="search-filter-field">
                                <select class="select-field" name="where">
                                    <option value=""><?=GetMessage("CT_BSP_ALL")?></option>
                                    <?foreach($arResult["DROPDOWN"] as $key=>$value):?>
                                        <option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
                                    <?endforeach?>
                                </select>
                            </td>
                        </tr>
                        <?endif;?>
                        <?if($arParams["SHOW_WHEN"]):?>
                        <tr>
                            <td class="search-filter-name"><?echo GetMessage("CT_BSP_WHEN")?></td>
                            <td class="search-filter-field">
                                <?$APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar',
                                    '',
                                    array(
                                        'SHOW_INPUT' => 'Y',
                                        'INPUT_NAME' => 'from',
                                        'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
                                        'INPUT_NAME_FINISH' => 'to',
                                        'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
                                        'INPUT_ADDITIONAL_ATTR' => 'class="input-field" size="10"',
                                    ),
                                    null,
                                    array('HIDE_ICONS' => 'Y')
                                );?>
                            </td>
                        </tr>
                        <?endif;?>
                        <tr>
                            <td class="search-filter-name">&nbsp;</td>
                            <td class="search-filter-field"><input class="search-button" value="<?echo GetMessage("CT_BSP_GO")?>" type="submit"></td>
                        </tr>
                    </tbody></table>
                </div>
            <?else:?>
        </div><?//div class="search-advanced"?>
            <?endif;//if($arParams["SHOW_WHERE"] || $arParams["SHOW_WHEN"])?>
        </noindex>
    </form>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
    ?>
    <div class="search-language-guess">
        <?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
    </div><br /><?
endif;?>

    <div class="search-result">
    <?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
    <?elseif($arResult["ERROR_CODE"]!=0):?>
        <p><?=GetMessage("CT_BSP_ERROR")?></p>
        <?ShowError($arResult["ERROR_TEXT"]);?>
        <p><?=GetMessage("CT_BSP_CORRECT_AND_CONTINUE")?></p>
        <br /><br />
        <p><?=GetMessage("CT_BSP_SINTAX")?><br /><b><?=GetMessage("CT_BSP_LOGIC")?></b></p>
        <table border="0" cellpadding="5">
            <tr>
                <td align="center" valign="top"><?=GetMessage("CT_BSP_OPERATOR")?></td><td valign="top"><?=GetMessage("CT_BSP_SYNONIM")?></td>
                <td><?=GetMessage("CT_BSP_DESCRIPTION")?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?=GetMessage("CT_BSP_AND")?></td><td valign="top">and, &amp;, +</td>
                <td><?=GetMessage("CT_BSP_AND_ALT")?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?=GetMessage("CT_BSP_OR")?></td><td valign="top">or, |</td>
                <td><?=GetMessage("CT_BSP_OR_ALT")?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?=GetMessage("CT_BSP_NOT")?></td><td valign="top">not, ~</td>
                <td><?=GetMessage("CT_BSP_NOT_ALT")?></td>
            </tr>
            <tr>
                <td align="center" valign="top">( )</td>
                <td valign="top">&nbsp;</td>
                <td><?=GetMessage("CT_BSP_BRACKETS_ALT")?></td>
            </tr>
        </table>
    <?elseif(count($arResult["SEARCH"])>0):?>
        <?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
        <div class="top_wrapper rows_block">
            <div class="catalog_block items block_list">
            <?foreach($arResult["SEARCH"] as $arItem):?>
                 <div class="item_block col-3">
                    <div class="catalog_item_wrapp item">
                        <div class="basket_props_block" id="bx_basket_div_<?=$arItem["ID"];?>" style="display: none;">
                            <?if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])){
                                foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo){?>
                                    <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                                    <?if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
                                        unset($arItem['PRODUCT_PROPERTIES'][$propID]);
                                }
                            }
                            $arItem["EMPTY_PROPS_JS"]="Y";
                            $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                            if (!$emptyProductProperties){
                                $arItem["EMPTY_PROPS_JS"]="N";?>
                                <div class="wrapper">
                                    <table>
                                        <?foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo){?>
                                            <tr>
                                                <td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                                <td>
                                                    <?if('L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']    && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']){
                                                        foreach($propInfo['VALUES'] as $valueID => $value){?>
                                                            <label>
                                                                <input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
                                                            </label>
                                                        <?}
                                                    }else{?>
                                                        <select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                            foreach($propInfo['VALUES'] as $valueID => $value){?>
                                                                <option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
                                                            <?}?>
                                                        </select>
                                                    <?}?>
                                                </td>
                                            </tr>
                                        <?}?>
                                    </table>
                                </div>
                                <?
                            }?>
                        </div>
                        <?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                        $arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
                        $arItemIDs=COptimus::GetItemsIDs($arItem);

                        $totalCount = COptimus::GetTotalCount($arItem);
                        $arQuantityData = COptimus::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"]);

                        $item_id = $arItem["ID"];
                        $strMeasure = '';
                        if(!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'){
                            if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
                                $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                                $strMeasure = $arMeasure["SYMBOL_RUS"];
                            }
                            $arAddToBasketData = COptimus::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
                        }
                        elseif($arItem["OFFERS"]){
                            $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
                        }
                        ?>
                        <div class="catalog_item item_wrap <?=(($_GET['q'])) ? 's' : ''?>" id="<?=$arItemIDs["strMainID"];?>">
                            <div>
                                <div class="image_wrapper_block">
                                    <div class="stickers">
                                        <?if (is_array($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"])):?>
                                            <?foreach($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key=>$class){?>
                                                <div><div class="sticker_<?=strtolower($class);?>"><?=$arItem["PROPERTIES"]["HIT"]["VALUE"][$key]?></div></div>
                                            <?}?>
                                        <?endif;?>
                                        <?if($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
                                            <div><div class="sticker_sale_text"><?=$arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div></div>
                                        <?}?>
                                    </div>
                                    <?if((!$arItem["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N" ) || ($arParams["DISPLAY_COMPARE"] == "Y")):?>
                                        <div class="like_icons">
                                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                                <?if(!$arItem["OFFERS"]):?>
                                                    <div class="wish_item_button">
                                                        <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
                                                        <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
                                                    </div>
                                                <?elseif($arItem["OFFERS"] && !empty($arItem['OFFERS_PROP'])):?>
                                                    <div class="wish_item_button" style="display: none;">
                                                        <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to <?=$arParams["TYPE_SKU"];?>" data-item="" data-iblock="<?=$arItem["IBLOCK_ID"]?>" data-offers="Y" data-props="<?=$arOfferProps?>"><i></i></span>
                                                        <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="" data-iblock="<?=$arOffer["IBLOCK_ID"]?>"><i></i></span>
                                                    </div>
                                                <?endif;?>
                                            <?endif;?>
                                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                                <?if(!$arItem["OFFERS"] || $arParams["TYPE_SKU"] !== 'TYPE_1'):?>
                                                    <div class="compare_item_button">
                                                        <span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i></span>
                                                        <span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i></span>
                                                    </div>
                                                <?elseif($arItem["OFFERS"]):?>
                                                    <div class="compare_item_button">
                                                        <span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to <?=$arParams["TYPE_SKU"];?>" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="" ><i></i></span>
                                                        <span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item=""><i></i></span>
                                                    </div>
                                                <?endif;?>
                                            <?endif;?>
                                        </div>
                                    <?endif;?>
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
                                        <?
                                        $a_alt=($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] );
                                        $a_title=($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] );
                                        ?>
                                        <?if( !empty($arItem["PREVIEW_PICTURE"]) ):?>
                                            <img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                                        <?elseif( !empty($arItem["DETAIL_PICTURE"])):?>
                                            <?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 170, "height" => 170 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
                                            <img border="0" src="<?=$img["src"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                                        <?else:?>
                                            <img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                                        <?endif;?>
                                    </a>
                                </div>
                                <div class="item_info <?=$arParams["TYPE_SKU"]?>">
                                    <div class="item-title">
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span><?=$arItem["NAME"]?></span></a>
                                    </div>


                                    <? if($arItem['QUANTITY'] > 0) { ?>
                                        <div class="item-stock"><span class="icon stock"></span><span class="value"><?=$arQuantityData["OPTIONS"]["EXPRESSION_FOR_EXISTS"]?> (<?=$arItem['QUANTITY']?>)</span></div>
                                    <? } else { ?>
                                        <div class="item-stock"><span class="icon  order"></span><span class="value"><?=$arQuantityData["OPTIONS"]["EXPRESSION_FOR_NOTEXISTS"]?></span></div>
                                    <? } ?>
                                    <div class="cost prices clearfix">
                                        <?if( $arItem["OFFERS"]){?>
                                            <?$minPrice = false;
                                            if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE'])){
                                                // $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
                                                $minPrice = $arItem['MIN_PRICE'];
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
                                            $prefix = '';
                                            if('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] !== 'block' || empty($arItem['OFFERS_PROP'])){
                                                $prefix = GetMessage("CATALOG_FROM");
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
                                                <div class="price discount" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE_OLD']; ?>">
                                                    <strike <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>><?=$minPrice["PRINT_VALUE"];?></strike>
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
                                                <div class="price only_price" id="<?=$arItemIDs["ALL_ITEM_IDS"]['PRICE']?>">
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
                                            <?
                                            // Ценовая политика
                                            $min_price = $arItem['MIN_PRICE'];
                                            $old_price = $arItem['PRICE'];
                                            $min_price_id = 0;
                                            ?>
                                           <?if($min_price):?>
                                                <?$min_price_id = $min_price['ID'];?>
                                                <div class="price_name">Цена интернет-магазина</div>
                                                <div class="price"><?=$min_price["PRINT_DISCOUNT_VALUE"]?><?=($arParams["SHOW_MEASURE"] === "Y" && $strMeasure ? '/'.$strMeasure : '')?></div>
                                            <?endif;?>
                                            <?if($old_price && $old_price["VALUE"] != $min_price["VALUE"]):?>
                                                <div class="price_name"><?=($bManufacturerPrice ? 'Цена производителя' : 'Розничная цена')?></div>
                                                <div class="price discount"><?=$old_price["PRINT_DISCOUNT_VALUE"]?><?=($arParams["SHOW_MEASURE"] === "Y" && $strMeasure ? '/'.$strMeasure : '')?></div>
                                            <?endif;?>
                                        <?}?>
                                    </div>
                                    <?if($arParams["SHOW_DISCOUNT_TIME"]=="Y"){?>
                                        <?$arDiscounts = CCatalogDiscount::GetDiscountByProduct( $arItem["ID"], $USER->GetUserGroupArray(), "N", $min_price_id, SITE_ID );
                                        $arDiscount=array();
                                        if($arDiscounts)
                                            $arDiscount=current($arDiscounts);
                                        if($arDiscount["ACTIVE_TO"]){?>
                                            <div class="view_sale_block">
                                                <div class="count_d_block">
                                                    <span class="active_to hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
                                                    <div class="title"><?=GetMessage("UNTIL_AKC");?></div>
                                                    <span class="countdown values"></span>
                                                </div>
                                                <div class="quantity_block">
                                                    <div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
                                                    <div class="values">
                                                        <span class="item">
                                                            <span  <?=( count( $arItem["OFFERS"] ) > 0 ? 'style="opacity:0;"' : '')?>><?=$totalCount;?></span>
                                                            <div class="text"><?=GetMessage("TITLE_QUANTITY");?></div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?}?>
                                    <?}?>
                                    <div class="hover_block1 footer_button">
                                        <?if(!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'):?>
                                            <div class="counter_wrapp <?=($arItem["OFFERS"] && $arParams["TYPE_SKU"] == "TYPE_1" ? 'woffers' : '')?>">
                                                <?//if(($arItem["QUANTITY"] > 0 && $arAddToBasketData["ACTION"] == "ADD")):?>
                                                    <div class="counter_block" data-offers="<?=($arItem["OFFERS"] ? "Y" : "N");?>" data-item="<?=$arItem["ID"];?>">
                                                        <span class="minus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>">-</span>
                                                        <input type="text" class="text" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=$arAddToBasketData["RATIO_ITEM"]?>" />
                                                        <span class="plus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?=($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='".$arAddToBasketData["MAX_QUANTITY_BUY"]."'" : "")?>>+</span>
                                                    </div>

                                                <div id="<?=$arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>" class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER"/*&& !$arItem["CAN_BUY"]*/)  || !$arItem["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : "");?>">
                                                    <!--noindex-->
                                                    <span class="small to-cart button transition_bg" data-item="<?=$arItem['ID']?>" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_<?=$arItem['ID']?>" data-part_props="N" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="<?=$arItem['IBLOCK_ID']?>" data-quantity="1"><i></i>
                                                        <span>В корзину</span>
                                                    </span>
                                                    <a rel="nofollow" href="/basket/" class="small in-cart button transition_bg" data-item="<?=$arItem['ID']?>" style="display:none;"><i></i><span>В корзине</span></a>
                                                    <!--/noindex-->
                                                </div>
                                                <?//endif;?>
                                            </div>
                                        <?elseif($arItem["OFFERS"]):?>
                                            <?if(empty($arItem['OFFERS_PROP'])){?>
                                                <div class="offer_buy_block buys_wrapp woffers">
                                                    <?
                                                    $arItem["OFFERS_MORE"] = "Y";
                                                    $arAddToBasketData = COptimus::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small read_more1', $arParams);?>
                                                    <!--noindex-->
                                                        <?=$arAddToBasketData["HTML"]?>
                                                    <!--/noindex-->
                                                </div>
                                            <?}else{?>
                                                <div class="offer_buy_block buys_wrapp woffers" style="display:none;">
                                                    <div class="counter_wrapp"></div>
                                                </div>
                                            <?}?>
                                        <?endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?endforeach;?>
            </div>
        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
        <?if($arParams["SHOW_ORDER_BY"] != "N"):?>
            <div class="search-sorting"><label><?echo GetMessage("CT_BSP_ORDER")?>:</label>&nbsp;
            <?if($arResult["REQUEST"]["HOW"]=="d"):?>
                <a href="<?=$arResult["URL"]?>&amp;how=r"><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></a>&nbsp;<b><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></b>
            <?else:?>
                <b><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></b>&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></a>
            <?endif;?>
            </div>
        <?endif;?>
    <?else:?>
        <?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
    <?endif;?>

    </div>
</div>