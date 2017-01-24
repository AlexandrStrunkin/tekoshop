<?if(!COptimus::IsMainPage()):?>
	<?if(COptimus::IsCatalogPage()):?>
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"left_front_catalog",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => \Bitrix\Main\Config\Option::get("aspro.optimus","MAX_DEPTH_MENU",2),
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
	<?endif;?>
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"left_menu",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
<?else:?>
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"left_front_catalog",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(""),
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>								
<?endif;?>