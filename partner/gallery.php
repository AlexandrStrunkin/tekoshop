<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");?> 

    <div class="row">
        <div class="col-main col-xs-12 col-sm-9">
            <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add", 
	"gallery", 
	array(
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "Orders",
		"IBLOCK_ID" => "138",
		"PROPERTY_CODES" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "PREVIEW_PICTURE",
		),
		"GROUPS" => array(
			0 => "17",
			1 => "18",
			2 => "19",
		),
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"ALLOW_EDIT" => "Y",
		"ALLOW_DELETE" => "Y",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"NAV_ON_PAGE" => "10",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => "Изображение добавлено",
		"USER_MESSAGE_EDIT" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "N",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"CUSTOM_TITLE_NAME" => "Название",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "Изображение",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SEF_FOLDER" => "/partner/",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
        </div>

        <div class="col-left sidebar col-xs-12 col-sm-3">
<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH."/include_areas/r_left_menu.php",
			"EDIT_TEMPLATE" => ""
		)
	);?>
</div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>