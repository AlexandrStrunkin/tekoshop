<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#",
		"RULE" => "REQUEST_OBJECT=\$1&METHOD=\$4",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/catalog/vzryvozashhishhennoe-oborudovanie/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/vzryvozashhishhennoe-oborudovanie/index.php",
	),
	array(
		"CONDITION" => "#^/action/redlinesummerprice2015/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/action/redlinesummerprice2015/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/personal/history-of-orders/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/history-of-orders/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/action/ipvideotoall/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/action/ipvideotoall/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/catalog/discounts/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/discounts/index.php",
	),
	array(
		"CONDITION" => "#^/contacts/stores/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/about/contacts/index.php",
	),
	array(
		"CONDITION" => "#^/contacts/stores/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/contacts/stores/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/catalog/domofon/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/domofon/index.php",
	),
	array(
		"CONDITION" => "#^/about/contacts/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/about/contacts/index.php",
	),
	array(
		"CONDITION" => "#^/personal/order/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/order/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/catalog/video/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/video/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/kabel/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/kabel/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/audio/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/audio/index.php",
	),
	array(
		"CONDITION" => "#^/info/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/articles/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/catalog/skud/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/skud/index.php",
	),
	array(
		"CONDITION" => "#^/company/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#^/company/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/news/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/info/article/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/article/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/catalog/ops/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/ops/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/ups/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/ups/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/sks/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/sks/index.php",
	),
	array(
		"CONDITION" => "#^/info/brand/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/brand/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/personal/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.section",
		"PATH" => "/personal/index.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/services/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/brands/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/brands/index.php",
	),
	array(
		"CONDITION" => "#^/sale/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/sale/index.php",
		"SORT" => "100",
	),
);

?>