<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Помощь покупателю");
?>
<p>В этом разделе Вы можете найти ответы на многие вопросы, касающиеся работы нашего сайта. Если Вы не нашли интересующей Вас информации, то можете отправить нам запрос с помощью <a href="../feedback/" >формы обратной связи</a>.</p>
<?$APPLICATION->IncludeComponent(
	"bitrix:support.faq.element.list",
	".default",
	Array(
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => "18",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>