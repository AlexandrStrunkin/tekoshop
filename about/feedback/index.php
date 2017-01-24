<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задайте вопрос");
?>
<div class="row">
	<div class="col-main col-xs-12 <?if($USER->IsAuthorized()):?>col-sm-9<?endif;?>">
		<div class="padding-s">
			<div class="my-account">
				<div class="dashboard">
					<div class="page-title">
						<h1>Обратная связь</h1>
					</div>
					<p>Уважаемые покупатели!</p>
					 
					<p>Прежде чем задать свой вопрос, обратите внимание на раздел <a href="../faq/">Помощь покупателю</a>. Возможно, там уже есть исчерпывающая информация по решению вашей проблемы.</p>

					<?/*$APPLICATION->IncludeComponent("bitrix:main.feedback", ".default", array(
						"USE_CAPTCHA" => "Y",
						"OK_TEXT" => "Спасибо, ваше сообщение принято.",
						"EMAIL_TO" => "info@zaoteko.ru",
						"REQUIRED_FIELDS" => array(
							0 => "EMAIL",
							1 => "MESSAGE",
						),
						"EVENT_MESSAGE_ID" => array(
						)
						),
						false
					);*/?>
					<?$APPLICATION->IncludeComponent(
	"reaspekt:iblock.form", 
	"r_feedback", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "r_feedback",
		"EMAIL_PROP_CODE" => "EMAIL",
		"EVENT_MESSAGE_ID" => "R_FEEDBACK",
		"FILE_PROP_CODE" => "",
		"IBLOCK" => "168",
		"IBLOCK_TYPE" => "iu_feedback",
		"NAME_CAPTION" => "Тема письма",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "TEXT",
			2 => "DEPARTMENT_MAIL",
			3 => "EMAIL",
		),
		"TEXT_CAPTION" => "Ваше сообщение",
		"SHOW_PROPERTIES" => array(
			0 => "DEPARTMENT_MAIL",
			1 => "EMAIL",
		),
		"EVENT_USER_MESSAGE_ID" => "NONE",
		"USE_UA_MARKING" => "N",
		"B24_SERVER" => "https://",
		"UA_PAGE_URL" => ""
	),
	false
);?>
				</div>
			</div>
		</div>
	</div>
	<?if($USER->IsAuthorized()):?>
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
	<?endif;?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>