<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<pre>', print_r($orders), '</pre>';?>

<div id="orders-switch" class="well clearfix">
	<div class="col-xs-2">
		<?if(($_GET['s'] == 3 || $_GET['s']<1) && !$view):?>
			<span class="switch">Новые Заявки</span>
		<?else:?>
			<a href="/requests/?o=orders&a=list" class="switch">Новые Заявки</a>
		<?endif;?>
	</div>
	<div class="col-xs-2">
		<?if($_GET['s'] == 2 && !$view):?>
			<span class="switch">Заявки в работе</span>
		<?else:?>
			<a class="switch" href="/requests/?o=orders&a=list&s=2">Заявки в работе</a>
		<?endif;?>
	</div>
	<div class="col-xs-2">
		<?if($_GET['s'] == 4 && !$view):?>
			<span class="switch">Архив заявок</span>
		<?else:?>
			<a class="switch" href="/requests/?o=orders&a=list&s=4">Архив заявок</a>
		<?endif;?>
	</div>

</div>


<div id="answer">
<?if ($orders){
	$label_col_size = 3;
	foreach($orders as $key => $arOrder):?>
	<? if ($arOrder['VISIBLE'] != 'Y' && empty($arOrder['PRIVATE'])) continue;?>
	<div class="<?=isset($arOrder['PRIVATE'])?'well':'';?>">
		<h3>№ <?=$key;?><?=isset($arOrder['PRIVATE'])?'(ИНДИВИДУАЛЬНАЯ)':'';?></h3>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Заголовок</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['NAME'];?></div>
		</div>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Город</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['PROPERTY_ORDER_CITY_VALUE'];?></div>
		</div>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Описание</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['DETAIL_TEXT'];?></div>
		</div>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Сроки выполнения</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['ACTIVE_FROM'];?> - <?=$arOrder['ACTIVE_TO'];?></div>
		</div>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Бюджет</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['PROPERTY_ORDER_ACCOUNT_VALUE'];?></div>
		</div>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Оборудование</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['PROPERTY_ORDER_DEVICE_VALUE'];?></div>
		</div>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"><b>Вид объекта</b></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>"><?=$arOrder['PROPERTY_ORDER_OBJECTS_INPUT_VALUE'];?></div>
		</div>

		<?if (!empty($arOrder['PROPERTY_ORDER_FILE_VALUE'])):?>
			<div class="clearfix">
				<div class="col-xs-3"><b>Приложенный файл:</b></div>
				<div class="col-xs-3"><a href="<?=CFile::GetPath($arOrder['PROPERTY_ORDER_FILE_VALUE']);?>">Скачать</a></div>
			</div>
		<?endif;?>

		<?if(!$value):?>
		<div class='clearfix'>
			<div class="col-xs-<?=$label_col_size;?>"></div>
			<div class="col-xs-<?=(12 - $label_col_size);?>">

				<?
				$stat = 3;
				if ($uid && $arOrder['PROPERTY_ORDER_STATUS_ENUM_ID'] == $order->getStatusByCode("ORDER_NEW")) {
					$stat = 1;
					if (in_array($uid, explode(',', $arOrder['PROPERTY_ORDER_OFFERS_COUNT_VALUE'])))
					{ ?>
						<a href="/requests/?o=orders&a=get&id=<?=$key;?>&v=1&edit=Y&CODE=<?=$arOrder['OFFERS'][0];?>">Редактировать предложение</a>
						<?if(!$view):?><br /><a href="/requests/?o=orders&a=get&view=Y&id=<?=$key;?>&CODE=<?=$arOrder['OFFERS'][0];?>">Комментарии</a><?endif;?>
					<?
					}
					else
					{?>
						<a href="/requests/?o=orders&a=get&id=<?=$key;?>&v=1">Составить предложение</a>
					<?}
				}elseif($uid && $arOrder['PROPERTY_ORDER_STATUS_ENUM_ID'] == $order->getStatusByCode("ORDER_INPROGRESS")){
					$stat = 2;
					?>
						<a href="/requests/?o=status&a=change&id=<?=$key;?>&v=1">Согласовать выполнение</a>
						<?if(!$view):?><br /><a href="/requests/?o=orders&a=get&view=Y&id=<?=$key;?>&CODE=<?=$arOrder['OFFERS'][0];?>">Комментарии</a><?endif;?>
				<?}?>
			</div>
		</div>
		<?endif;?>


			<?if($action!="get"):?>
                    <?if($arOrder['OFFERSDATA'][0]):?>
                    <div class="col-xs-12">
                        <div class="order-offers-open">
                        	<a href="#" data-for="oflist<?=$arOrder['OFFERSDATA'][0]["ID"]?>">Ваше предложение</a>
                        </div>
                    </div>
                    <div class="order_offerlist order_offerlist_worker" id="oflist<?=$arOrder['OFFERSDATA'][0]["ID"]?>">
                         <div class="ool_item">
                            <div class="ooli_title">
                            <? /*<a href="/requests/?o=orders&a=get&id=<?=$key;?>&v=1&edit=Y&CODE=<?=$arOrder['OFFERSDATA'][0]["ID"]?>">*/?>
                            	<a href="/requests/?o=orders&a=get&id=<?=$key;?>&v=1&<?if($stat==1):?>edit<?else:?>view<?endif;?>=Y&CODE=<?=$arOrder['OFFERS'][0];?>">Предложение №<?=$arOrder['OFFERSDATA'][0]["ID"]?></a>
                            <? /*</a>*/?>
                            </div>
                            <div class="ooli_row">
                                Оборудование: <?=$arOrder['OFFERSDATA'][0]["PROPERTY_OFFER_DEVICE_HTML_VALUE"]?>
                                <? if($arOrder['OFFERSDATA'][0]["SUM"]):?>
                                    (стоимость: <?=$arOrder['OFFERSDATA'][0]["SUM"]?> руб.)
                                <?endif;?>
                            </div>
                            <div class="ooli_row">Комментарий: <?=$arOrder['OFFERSDATA'][0]["PROPERTY_OFFER_COMMENT_VALUE"]?></div>
                            <div><a href="/requests/?o=orders&a=get&id=<?=$key;?>&v=1&view=Y&CODE=<?=$arOrder['OFFERS'][0];?>">Обсудить детали предложения</a>
</div>
                        </div>
                    </div>
                    <?endif;?>
        	 <?endif;?>
        
		</div>
        
        
		<hr>
	<?endforeach;
}
?>
</div>