<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$naborSum = 0;?>

<?foreach($arSetItems as $i=>$item):?>
     
    <?
    $arPrice = CCatalogProduct::GetOptimalPrice($item["ID"], 1, $USER->GetUserGroupArray(), "N");
	$arSetItems[$i]["PRICE"] = $arPrice;
	$naborSum += $arPrice["PRICE"]["PRICE"]*($item["QTY"]?$item["QTY"]:1);
    ?>
<?endforeach;?>

<div id="setItemsCont">

	<h3><?=$item["SET_INFO"]["NAME"]?></h3>

    <?if($item["SET_INFO"]["DETAIL_TEXT"]):?>
        <div style="margin-bottom:15px;"><?=$item["SET_INFO"]["DETAIL_TEXT"]?></div>
    <?endif;?>
    
    <div class="naborsum">Сумма набора: <span><?=$naborSum?></span> руб.</div>
    <div class="naborbuy"><a href="#" id="buy_complect">Купить набор</a></div>
    <div>Рекомендация от
		<?global $complectUsers;?>
        <?if(in_array($item["USER_INFO"]["ID"],$complectUsers)):?>
        	ТЕКО
        <?else:?>
    :</div>
    <div>            <a target="_blank" href="/partner/?a=detail&id=<?=$item["USER_INFO"]["ID"]?>"><?=$item["USER_INFO"]["WORK_COMPANY"]?></a>
        <?endif;?>
    </div>


    <ul id="setitems">
        <?foreach($arSetItems as $item):?>
        
            <?
            	$arPrice = $item["PRICE"];
		//$naborSum += $arPrice["PRICE"]["PRICE"];
	    ?>
    
            <li class="setitem clearfix">
                <form id="mc_add_detail_form" action="<?=$item['URL']?>" method="post"> 
                <div class="col-xs-3 img-block">
                    <img src="<?=$item['SRC']?>" alt="<?=$item['NAME']?>">
                </div>
                <div class="col-xs-9 inf-block">
                    <h2><a href="<?=$item['URL']?>"><?=$item['NAME']?></a></h2>
                    <?=$item['PREVIEW_TEXT']?>
                    <br>
                    <a class="btn btn-default" href="<?=$item['URL']?>">Подробнее</a>
                    <button type="submit" title="Добавить в корзину" class="button btn-cart"><span><span>Добавить в корзину</span></span></button>
                        <div class="add-to-cart">
                            <div class="qty-block">
                                <label for="qty">Количество:</label>
                                <span class="qty_down">-</span>
                                <input type="text" name="qty" data-for="qtyfor<?=$item['ID']?>" data-price="<?=$arPrice["PRICE"]["PRICE"]?>" maxlength="12" value="<?if($item["QTY"]):?><?=$item["QTY"]?><?else:?>1<?endif;?>" title="Кол-во" class="input-text qty form-control">
                                <span class="qty_up">+</span>
                                <input type="hidden" name="action" value="mc_add_element">
                                <input type="hidden" name="id" value="<?=$item['ID']?>">
                            </div>
                        </div>
                    <div class="btns-block">
                    
                    
                        <a href="<?=$item['URL']?>?action=ADD_TO_COMPARE_LIST&amp;id=<?=$item['ID']?>" class="link-compare">Добавить в сравнение</a><br />
                        <a href="<?=$item['URL']?>?action=mc_delay&id=<?=$item['ID']?>" class="link-wishlist">Добавить в избранное</a>
        
                        <div>Цена: <span id="qtyfor<?=$item['ID']?>"><?=$arPrice["PRICE"]["PRICE"]?></span> руб.</div>
                    </div>
                </div>
                </form>            
            </li>
        <?endforeach;?>
    </ul>

    
    <div class="naborsum">Сумма набора: <span><?=$naborSum?></span> руб.</div>
    <div class="naborbuy"><a href="#" id="buy_complect">Купить набор</a></div>


</div>