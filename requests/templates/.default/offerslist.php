<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($id):?><div><a href="/requests/?o=offers&a=list">Все предложения</a></div><br /><?endif;?>

<div class="clearfix">
		<?if($id):?><div class="col-xs-4"><b>Заявка №<?=$id;?></b></div><br /><?endif;?>

		<div class="col-xs-8 corange"></div>
</div>
<?//echo '<pre>', print_r($offers), '</pre>';?>
<?foreach ($offers as $key => $offer):?>

	<?
		if($offer['PROPERTY_OFFER_ORDER_ID_VALUE']!=$lastorder)
			$key = 0;
		$lastorder = $offer['PROPERTY_OFFER_ORDER_ID_VALUE'];
    ?>
	
    
	<?
	$priceA =  preg_replace('/[^0-9]/', '', $offer['PROPERTY_OFFER_PRICE_DEVICE_VALUE']);
	$priceB =  preg_replace('/[^0-9]/', '', $offer['PROPERTY_OFFERS_PRICE_WORK_VALUE']);
	?>
	<h3><a href="/requests/?o=offers&a=list&oid=<?=$offer["ID"]?>">Предложение №<?=$offer['PROPERTY_OFFER_ORDER_ID_VALUE'];?>-<?=$key+1;?></a></h3>
	
	<div class="clearfix">
		<div class="col-xs-4"><b>Организация:</b></div>
		<div class="col-xs-8"><a href="/partner/?a=detail&id=<?=$offer['CREATED_INFO']['ID'];?>"><?=$offer['CREATED_INFO']['WORK_COMPANY'];?></a></div>
	</div>
	<div class="clearfix">
		<div class="col-xs-4"><b>Оборудование:</b></div>
		<div class="col-xs-8"><?=$offer['PROPERTY_OFFER_DEVICE_HTML_VALUE'];?></div>
	</div>
	<div class="clearfix">
		<div class="col-xs-4"><b>Стоимость оборудования:</b></div>
		<div class="col-xs-8"><?=$priceA;?></div>
	</div>
	<div class="clearfix">
		<div class="col-xs-4"><b>Стоимость работ дополнительного оборудования:</b></div>
		<div class="col-xs-8"><?=$priceB;?></div>
	</div>
	<div class="clearfix">
		<div class="col-xs-4"><b>Общая стоимость:</b></div>
		<div class="col-xs-8"><?=$priceA+$priceB;?></div>
	</div>
	<div class="clearfix">
		<div class="col-xs-4"><b>Описание:</b></div>
		<div class="col-xs-8"><?=$offer['DETAIL_TEXT'];?></div>
	</div>
	<div class="clearfix">
		<div class="col-xs-4"><b>Комментарий:</b></div>
		<div class="col-xs-8"><?=$offer['PROPERTY_OFFER_COMMENT_VALUE'];?></div>
	</div>

	<?if($offer['PROPERTY_OFFERS_FILE_VALUE']):?>
		<div class="col-xs-4"><b>Приложенный файл:</b></div>
		<div class="col-xs-8"><a href="<?=CFile::GetPath($offer['PROPERTY_OFFERS_FILE_VALUE']);?>">Скачать</a></div>
	<?endif;?>

	<?if(!$offer["WORKER"]):?>
	<form action="/requests/?o=offers&a=accept&id=<?=$offer['ID'];?>" method="POST">
		<label>
			<input type="checkbox" name="accept_devices" value="Y">Создать заказ на оборудование в интернет-магазине
			<input type="hidden" name="accept_offers" value="<?=$id;?>">
		</label>
		<div>
			<button type="submit">Согласовать</button>
		</div>
	</form>
    <?endif;?>
    
    <br /><br />
    
    <?
		CModule::IncludeModule("blog");
    	$arBlog = CBlogComment::GetByID(143);
		//print_r($arBlog);
	?>
    
    <?if($oid || $of=="current"):?>
    <? /*$APPLICATION->IncludeComponent(
	"bitrix:catalog.comments",
	"",
	array(
		"ELEMENT_ID" => $offer["ID"],
		"ELEMENT_CODE" => "",
		"IBLOCK_ID" => 136,
		"URL_TO_COMMENT" => "/requests/?o=offers&a=list&oid=".$offer["ID"]."&oidVal=".$offer["ID"],
		"WIDTH" => "",
		"COMMENTS_COUNT" => "5",
		"BLOG_USE" => "Y",
		"FB_USE" => "N",
		"FB_APP_ID" => "",
		"VK_USE" => "N",
		"VK_API_ID" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => 3600000,
		"BLOG_TITLE" => "",
		"BLOG_URL" => "",
		"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
		"EMAIL_NOTIFY" => "N",
		"AJAX_POST" => "Y",
		"SHOW_SPAM" => "Y",
		"SHOW_RATING" => "N",
		"FB_TITLE" => "",
		"FB_USER_ADMIN_ID" => "",
		"FB_APP_ID" => "",
		"FB_COLORSCHEME" => "light",
		"FB_ORDER_BY" => "reverse_time",
		"VK_TITLE" => "",
	),
	$component,
	array("HIDE_ICONS" => "N")
    );*/?>
    
    
    
    
    
    <?$APPLICATION->IncludeComponent("custom:forum.topic.reviews","",Array(
        "SHOW_LINK_TO_FORUM" => "N",
        "FILES_COUNT" => "0",
        "FORUM_ID" => "10",
        "IBLOCK_TYPE" => "Orders",
        "IBLOCK_ID" => "136",
        "ELEMENT_ID" => $offer["ID"],
        "AJAX_POST" => "N", 
        "POST_FIRST_MESSAGE" => "Y",
        "POST_FIRST_MESSAGE_TEMPLATE" => "#IMAGE#[url=#LINK#]#TITLE#[/url]#BODY#",
        "URL_TEMPLATES_READ" => "read.php?FID=#FID#&TID=#TID#",
        "URL_TEMPLATES_DETAIL" => "photo_detail.php?ID=#ELEMENT_ID#",
        "URL_TEMPLATES_PROFILE_VIEW" => "profile_view.php?UID=#UID#",
        "MESSAGES_PER_PAGE" => "10",
        "PAGE_NAVIGATION_TEMPLATE" => "",
        "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
        "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
        "EDITOR_CODE_DEFAULT" => "Y",
        "SHOW_AVATAR" => "Y",
        "SHOW_RATING" => "Y",
        "RATING_TYPE" => "like",
        "SHOW_MINIMIZED" => "Y",    
        "USE_CAPTCHA" => "Y",
        "PREORDER" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "0"
    )
    );?>
    
    
    
    
    
    
    <?endif;?>


<?endforeach;?>