<div id="ajaxcat">

</div>
<!--form action="" method="POST">
	<label for="offers_device">Оборудование</label>
	<input id="offers_device" name="OFFERS_DEVICE" value="">
	<br>
	<label for="offers_device">Стоимость оборудования</label>
	<input id="offers_device" name="OFFERS_DEVICE" value="">
	<br>
	<label for="offers_device">Стоимость услуг и дополнительного оборудования</label>
	<input id="offers_device" name="OFFERS_DEVICE" value="">
	<br>
	<label for="offers_device">Описание услуг *</label>
	<textarea id="offers_device" name="OFFERS_DEVICE"></textarea>
	<br>
	<label for="offers_device">Комментарий</label>
	<textarea id="offers_device" name="OFFERS_DEVICE"></textarea>
</form-->

<?if($view!="Y"):?>

<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"offersform", 
	array(
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "Orders",
		"IBLOCK_ID" => "136",
		"PROPERTY_CODES" => array(
			0 => "NAME",
			1 => "DETAIL_TEXT",
			2 => "3661",
			3 => "3662",
			4 => "3663",
			5 => "3664",
			6 => "3666",
			7 => "3667",
			8 => "3668",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "DETAIL_TEXT",
		),
		"GROUPS" => array(
			0 => "17",
			1 => "18",
			2 => "19",
		),
		"STATUS_NEW" => "N",
		"STATUS" => "ANY",
		"LIST_URL" => "/requests/?o=orders&a=list",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "",
		"USER_MESSAGE_ADD" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "N",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"SEF_FOLDER" => "/requests/",
		"ELEMENT_ASSOC_PROPERTY" => "3515",
		"ORDER_LINK" => $id
	),
	false
);?>

<?else:?>

<?$APPLICATION->IncludeComponent("bitrix:news.detail","offer",Array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "Orders",
        "IBLOCK_ID" => "136",
        "ELEMENT_ID" => $code,
        "ELEMENT_CODE" => "",
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => Array("ID"),
        "PROPERTY_CODE" => Array(
			0 => "NAME",
			1 => "DETAIL_TEXT",
			2 => "3661",
			3 => "3662",
			4 => "3663",
			5 => "3664",
			6 => "3666",
			7 => "3667",
			8 => "3668",
        ),
        "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Страница",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N"
    )
);?>

<?endif;?>