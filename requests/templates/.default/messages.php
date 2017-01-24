<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	// Получаем комментарий данного пользователя по id
	$arFilter = Array("ID"=>$code, "PROPERTY_OFFER_ORDER_ID"=>$id, "CREATED_BY"=>$USER->GetID(), "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, array("ID"));
	if($res->GetNext()):
?>

    <? /*$APPLICATION->IncludeComponent(
	"bitrix:catalog.comments",
	"",
	array(
		"ELEMENT_ID" => $code,
		"ELEMENT_CODE" => "",
		"IBLOCK_ID" => 136,
		"URL_TO_COMMENT" => "/requests/?o=orders&a=get&id=".$id."&v=1&view=Y&CODE=".$code."&oidVal=".$code,
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
        "ELEMENT_ID" => $code,
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