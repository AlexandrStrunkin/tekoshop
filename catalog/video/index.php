<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Видеооборудование, ip-камеры, регистраторы по выгодным ценам. Доставка по России - Казань, Чебоксары, Альметьевск, Набережные Челны");
$APPLICATION->SetPageProperty("keywords", "ip-видеооборудование, видеонаблюдение");
$APPLICATION->SetPageProperty("title", "Системы видеонаблюдения купить в интернет магазине по цене от 3900 руб");
$APPLICATION->SetTitle("");

global $regionPriceCODE;
?>
<? if ( $_SERVER['REQUEST_URI']=='/catalog/video/' ) {
$APPLICATION->SetPageProperty("title", "Бюджетный регистратор, ip камера | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Бюджетная IP-камера – это подходящий вариант для организации системы безопасности в доме или офисе.");
$APPLICATION->SetPageProperty("keywords", "бюджетный регистратор, ip камера");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/video/monitory/') {
$APPLICATION->SetPageProperty("title", "Монитор видеокамеры | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Монитор видеокамеры – это неотъемлемая честь системы видеонаблюдения, они передают информацию с камер или видеорегистраторов.");
$APPLICATION->SetPageProperty("keywords", "монитор видеокамеры");
}
else if ( $_SERVER['REQUEST_URI']=='/catalog/video/videokamery/' ) {
$APPLICATION->SetPageProperty("title", "Видеокамера для наблюдения, внутренняя цветная видеокамера | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "С появлением разных технологий появилась и цветная видеокамера для наблюдения, у которой множество преимуществ перед обычной чёрно-белой камерой.");
$APPLICATION->SetPageProperty("keywords", "видеокамера для наблюдения, внутренняя, цветная");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/video/videokamery/analogovye/') {
$APPLICATION->SetPageProperty("title", "Видеокамера аналоговая уличная | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Аналоговая видеокамера создана на основе ПЗС матрицы, она преобразует оптическое изображение в аналоговый сигнал, записывает информацию и являются чувствительными к инфракрасному излучению.");
$APPLICATION->SetPageProperty("keywords", "видеокамера аналоговая, уличная");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/video/videokamery/filter/korpus-kupolnyy/') {
$APPLICATION->SetPageProperty("title", "Видеокамера купольная цветная | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Внутренняя купольная видеокамера является самой популярной камерой из-за своего удобного корпуса, который идеально подходит для внутренней системы видеонаблюдения.");
$APPLICATION->SetPageProperty("keywords", "видеокамера купольная цветная");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/video/videokamery/ip/') {
$APPLICATION->SetPageProperty("title", "IP камеры видеонаблюдение, купить камеру с wifi | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Купить IP-камеру не сложно, в нашем интернет-магазине представлен большой выбор камер для видеонаблюдения, вы можете выбрать модель и оформить заказ, не выходя из дома, в любом городе России. ");
$APPLICATION->SetPageProperty("keywords", "ip камеры видеонаблюдение");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/video/videoregistratory/') {
$APPLICATION->SetPageProperty("title", "Купить видеорегистратор в Казани, в Самаре, в Оренбурге | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Купить видеорегистратор в Самаре, Оренбурге, Чебоксарах, Нижнем Новгороде вы можете, сделав заказ через интернет-магазин «Теко». Наш сайт гарантирует безопасность при оплате заказа банковской картой. ");
$APPLICATION->SetPageProperty("keywords", "купить видеорегистратор в Казани, в Самаре, в Оренбурге");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/domofon/videodomofony/fe_ve02_bronze_avtonomnyy_videoglazok_/') {
$APPLICATION->SetPageProperty("title", "Видеокамеры автономные FE-VE02 | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "Купить видеокамеры автономные FE-VE02 в Самаре, Оренбурге, Чебоксарах, Нижнем Новгороде вы можете, сделав заказ через интернет-магазин «Теко».  ");
$APPLICATION->SetPageProperty("keywords", "купить видеорегистратор в Казани, в Самаре, в Оренбурге");
}
else if ($_SERVER['REQUEST_URI']=='/catalog/video/videoregistratory/ip_1/') {
$APPLICATION->SetPageProperty("title", "ip регистратор | ТЕКО: Техника Которая Охраняет");
$APPLICATION->SetPageProperty("description", "IP-регистратор используют для записи и хранения информации с IP-камер. Записанная информация хранится на жестком диске IP-регистратора или на карте памяти.");
$APPLICATION->SetPageProperty("keywords", "ip регистратор, камера");
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"main", 
	array(
		"NOAUTH_USER_PRICES" => "",
		"NOAUTH_MANUFACTURERS_PRICES" => array(
			3717 => array(
				0 => "6",
			),
		),
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "114",
		"HIDE_NOT_AVAILABLE" => "L",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/catalog/video/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "OPTIMUS_SMART_FILTER",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "KORPUS",                   
			1 => "RAZRESHENIE_TVL",
			2 => "MAKSIMALNOE_RAZRESHENIE_MP",
			3 => "SKOROST_KODIROVANIYA_K_S",
			4 => "KOLICHESTVO_KANALOV_ZAPISI",
			5 => "KOLICHESTVO_HDD",
			6 => "VIDEOVYKHODY",
			7 => "OBEKTIV",                  
			8 => "FOKUSNOE_RASSTOYANIE_MM",
			9 => "NALICHIE_IK_PODSVETKI", 
			10 => "NALICHIE_WI_FI_MODULYA",
			11 => "NALICHIE_POE",
			12 => "VSTROENNYY_MIKROFON",
			13 => "RAZEM_KARTY_PAMYATI",
			14 => "UPRAVLENIE_PTZ",
			15 => "BREND",                  
			16 => "DIAGONAL_EKRANA",
			17 => "KOLICHESTVO_RAZEMOV_HDMI",
			18 => "VSTROENNAYA_AKUSTIKA",
			19 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "Д 10%",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"CLOSED_PROPERTY_CODE" => "",
		"USE_REVIEW" => "N",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"POST_FIRST_MESSAGE" => "N",
		"USE_COMPARE" => "Y",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "PROIZVODITEL",
			2 => "KORPUS",
			3 => "MATRITSA",
			4 => "PROTSESSOR",
			5 => "RAZRESHENIE_TVL",
			6 => "MAKSIMALNOE_RAZRESHENIE_MP",
			7 => "CHUVSTVITELNOST_LK",
			8 => "SKOROST_KODIROVANIYA_K_S",
			9 => "KOLICHESTVO_KANALOV_ZAPISI",
			10 => "MAKSIMALNOE_RAZRESHENIE_ZAPISI",
			11 => "RAZRESHENIE_I_SKOROST_ZAPISI",
			12 => "MAKSIMALNYY_POTOK_MBIT_S",
			13 => "KOLICHESTVO_HDD",
			14 => "EMKOST_ODNOGO_HDD_DO_TB",
			15 => "VIDEOVYKHODY",
			16 => "VIDEOVKHODY",
			17 => "AUDIO_VKHOD_VYKHOD",
			18 => "TREVOZHNYY_VKHOD_VYKHOD",
			19 => "KOLICHESTVO_SETEVYKH_PORTOV",
			20 => "KOLICHESTVO_SETEVYKH_PORTOV_S_POE",
			21 => "OBEKTIV",
			22 => "FOKUSNOE_RASSTOYANIE_MM",
			23 => "NALICHIE_IK_PODSVETKI",
			24 => "DALNOST_IK_PODSVETKI",
			25 => "NALICHIE_WI_FI_MODULYA",
			26 => "NALICHIE_POE",
			27 => "VSTROENNYY_MIKROFON",
			28 => "RAZEM_KARTY_PAMYATI",
			29 => "UPRAVLENIE_PTZ",
			30 => "NAPRYAZHENIE_PITANIYA_V",
			31 => "ISPOLNENIE",
			32 => "POTREBLYAEMYY_TOK_MA",
			33 => "STEPEN_ZASHCHITY",
			34 => "TEMPERATURA_EKSPLUATATSII_S",
			35 => "KOLICHESTVO_VYKHODOV",
			36 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
			37 => "POTREBLYAEMAYA_MOSHCHNOST_VT",
			38 => "YARKOST_KD_M_KV",
			39 => "RAZMER_EKRANA_DYUYM",
			40 => "RAZRESHENIE_EKRANA",
			41 => "KONTRASTNOST",
			42 => "VYSOTA_USTANOVKI_M",
			43 => "PROCHEE",
			44 => "",
		),
		"COMPARE_ELEMENT_SORT_FIELD" => "sort",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"PRICE_CODE" => array(
			0 => "Цена ИМ(СпецЦена2)",
			1 => "Исходная розничная",
			2 => "Распродажа",
			3 => "Розничная (Дилерская 10%)",
			4 => "СпЦ 1 - 1%",
			5 => "СпЦ 2",
			6 => "Д 12%",
			7 => "СпЦ 1",
			8 => "Розн.",
			9 => "Д 10%",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/basket/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"SHOW_TOP_ELEMENTS" => "Y",
		"TOP_ELEMENT_COUNT" => "15",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_FIELD2" => "",
		"TOP_ELEMENT_SORT_ORDER2" => "",
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_VIEW_MODE" => "SECTION",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_TOP_DEPTH" => "2",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"PAGE_ELEMENT_COUNT" => "16",
		"LINE_ELEMENT_COUNT" => "1",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "CATALOG_AVAILABLE",
		"ELEMENT_SORT_ORDER2" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "PROIZVODITEL",
			2 => "KORPUS",
			3 => "MATRITSA",
			4 => "PROTSESSOR",
			5 => "BRAND",
			6 => "RAZRESHENIE_TVL",
			7 => "MAKSIMALNOE_RAZRESHENIE_MP",
			8 => "CHUVSTVITELNOST_LK",
			9 => "SKOROST_KODIROVANIYA_K_S",
			10 => "KOLICHESTVO_KANALOV_ZAPISI",
			11 => "MAKSIMALNOE_RAZRESHENIE_ZAPISI",
			12 => "SUMMARNAYA_MOSHCHNOST_POE_VT",
			13 => "RAZRESHENIE_I_SKOROST_ZAPISI",
			14 => "MAKSIMALNYY_POTOK_MBIT_S",
			15 => "KOLICHESTVO_HDD",
			16 => "EMKOST_ODNOGO_HDD_DO_TB",
			17 => "VIDEOVYKHODY",
			18 => "VIDEOVKHODY",
			19 => "AUDIO_VKHOD_VYKHOD",
			20 => "TREVOZHNYY_VKHOD_VYKHOD",
			21 => "KOLICHESTVO_SETEVYKH_PORTOV",
			22 => "KOLICHESTVO_SETEVYKH_PORTOV_S_POE",
			23 => "MOSHCHNOST_POE_NA_PORT_VT",
			24 => "GABARITNYE_RAZMERY_UPAKOVKI_",
			25 => "OBEKTIV",
			26 => "FOKUSNOE_RASSTOYANIE_MM",
			27 => "NALICHIE_IK_PODSVETKI",
			28 => "DALNOST_IK_PODSVETKI",
			29 => "NALICHIE_WI_FI_MODULYA",
			30 => "NALICHIE_POE",
			31 => "VSTROENNYY_MIKROFON",
			32 => "RAZEM_KARTY_PAMYATI",
			33 => "UPRAVLENIE_PTZ",
			34 => "NAPRYAZHENIE_PITANIYA_V",
			35 => "ISPOLNENIE",
			36 => "POTREBLYAEMYY_TOK_MA",
			37 => "STEPEN_ZASHCHITY",
			38 => "TEMPERATURA_EKSPLUATATSII_S",
			39 => "GABARITNYE_RAZMERY_MM",
			40 => "KOLICHESTVO_VYKHODOV",
			41 => "NOMINALNAYA_NAGRUZKA_VYKHODA_A",
			42 => "POTREBLYAEMAYA_MOSHCHNOST_VT",
			43 => "YARKOST_KD_M_KV",
			44 => "SFP_SLOT",
			45 => "RAZMER_EKRANA_DYUYM",
			46 => "RAZRESHENIE_EKRANA",
			47 => "KONTRASTNOST",
			48 => "VYSOTA_USTANOVKI_M",
			49 => "PROCHEE",
			50 => "VES_S_UPAKOVKOY_KG",
			51 => "PODDERZHIVAEMYE_STANDARTY",
			52 => "DALNOST_IK_PODSVETKI_M",
			53 => "KORPUS_1",
			54 => "MAKSIMALNOE_RAZRESHENIE",
			55 => "MATRITSA_1",
			56 => "UGOL_OBZORA",
			57 => "BREND",
			58 => "GARANTIYA",
			59 => "VES_KG",
			60 => "OBEM",
			61 => "TSVET_PODSTAVKI",
			62 => "TSVET_RAMKI",
			63 => "YARKOST_EKRANA",
			64 => "DINAMICHESKAYA_KONTRASTNOST_K_1",
			65 => "SOOTNOSHENIE_STORON_EKRANA",
			66 => "STATICHESKAYA_KONTRASTNOST_K_1",
			67 => "DIAGONAL_EKRANA",
			68 => "POVERKHNOST_EKRANA",
			69 => "TIP_MATRITSY",
			70 => "MOSHCHNOST_ODNOGO_DINAMIKA",
			71 => "KOLICHESTVO_DINAMIKOV",
			72 => "KOLICHESTVO_RAZEMOV_HDMI",
			73 => "KOLICHESTVO_RAZEMOV_DVI",
			74 => "TIP_BLOKA_PITANIYA",
			75 => "RAZMER_KREPLENIYA_VESA",
			76 => "VSTROENNAYA_AKUSTIKA",
			77 => "NAKLON_EKRANA",
			78 => "POKRYTIE_KORPUSA",
			79 => "KOLICHESTVO_RAZEMOV_D_SUB",
			80 => "VREMYA_OTKLIKA",
			81 => "VYKHOD_NA_NAUSHNIKI",
			82 => "POVOROT_EKRANA",
			83 => "REGULIROVKA_VYSOTY",
			84 => "KOLICHESTVO_RAZEMOV_USB",
			85 => "VRASHCHENIE_EKRANA_PORTRETNYY_REZHIM",
			86 => "TIP_RAZEMA_USB",
			87 => "EKRAN_S_PODDERZHKOY_3D",
			88 => "RAZMERY_S_PODSTAVKOY",
			89 => "RAZRESHENIE_",
			90 => "OSOBENNOSTI",
			91 => "VERSIYA_RAZEMOV_HDMI",
			92 => "ZASHCHITA_OT_ATAK_DENIAL_OF_SERVICE_DOS",
			93 => "STANDART_WEP",
			94 => "STANDART_WPA",
			95 => "KOL_VO_PORTOV_WAN",
			96 => "STANDART_WI_FI_802_11B",
			97 => "STANDART_WI_FI_802_11G",
			98 => "VKHODNOY_INTERFEYS",
			99 => "TIP",
			100 => "WEB_INTERFEYS_UPRAVLENIYA",
			101 => "STANDART_WI_FI_802_11N_2_4_GGTS",
			102 => "MEZHSETEVOY_EKRAN_FIREWALL",
			103 => "KOLICHESTVO_VYKHODNYKH_PORTOV_10_100BASE_TX",
			104 => "VKHODNOY_RAZEM_RJ_11",
			105 => "VNESHNIE_ANTENNY",
			106 => "VKHODNOY_RAZEM_RJ_45",
			107 => "KOL_VO_USB_PORTOV",
			108 => "TESTIROVANIE_NA_OBRYV",
			109 => "TSVET",
			110 => "TESTIROVANIE_NA_KOROTKIE_ZAMYKANIYA",
			111 => "PODDERZHKA_4G_MODEMOV",
			112 => "MAKSIMALNAYA_DLINA_TESTIRUEMOGO_KABELYA",
			113 => "PODDERZHKA_3G_MODEMOV",
			114 => "NAZNACHENIE",
			115 => "STANDART_WPA2",
			116 => "CHEKHOL_V_KOMPLEKTE",
			117 => "RAZMERY",
			118 => "TESTIROVANIE_NA_PEREPUTANNYE_PARY_I_ZHILY",
			119 => "PODDERZHKA_WPS",
			120 => "OSOBENNOSTI_3",
			121 => "PODDERZHKA_QOS",
			122 => "OBZHIM_KONNEKTORA_RJ_45",
			123 => "PODDERZHKA_PROTOKOLA_IPV6",
			124 => "OBZHIM_KONNEKTORA_RJ_11",
			125 => "OBSHCHIY_DOSTUP_K_USB_NAKOPITELYU",
			126 => "TIP_INSTRUMENTA",
			127 => "OSOBENNOSTI_1",
			128 => "ELEMENT_PITANIYA",
			129 => "PODDERZHKA_VPN",
			130 => "TESTIROVANIE_NA_RASSHCHEPLENIYA",
			131 => "PODDERZHKA_UPNP",
			132 => "VKHODNOY_RAZEM_BNC",
			133 => "PODDERZHKA_DINAMICHESKOGO_DNS",
			134 => "TESTIROVANIE_NA_TSELOSTNOST_IZOLYATSII",
			135 => "KOLICHESTVO_VYKHODNYKH_PORTOV_10_100_1000BASE_TX",
			136 => "TIP_RAZDELYVAEMOGO_KABELYA",
			137 => "DHCP_SERVER",
			138 => "TIP_SMENNYKH_NOZHEY",
			139 => "VES",
			140 => "OBZHIM_KONNEKTORA_RJ_12",
			141 => "FTP_SERVER",
			142 => "DLINA_OBZHIMKI",
			143 => "STANDART_WIMAX",
			144 => "ADSL",
			145 => "STANDART_WI_FI_802_11N_5_GGTS",
			146 => "STANDART_WI_FI_802_11A_5_GGTS",
			147 => "RAZMERY_1",
			148 => "PORTY_10_100BASE_TX",
			149 => "USTANOVKA",
			150 => "TIP_1",
			151 => "VES_1",
			152 => "STEKIRUEMYY",
			153 => "KONSOLNYY_PORT_RS_232",
			154 => "WEB_INTERFEYS_UPRAVLENIYA_1",
			155 => "SOVMESTIMOST",
			156 => "PODDERZHKA_POWER_OVER_ETHERNET_POE",
			157 => "INTERFEYS_S_KOMPYUTEROM",
			158 => "STANDART_WI_FI_802_11B_1",
			159 => "STANDART_WI_FI_802_11G_1",
			160 => "STANDART_WI_FI_802_11N_150_MBPS",
			161 => "TIP_RAZEMA",
			162 => "ANTENNA_TIP",
			163 => "KOLICHESTVO_ANTENN",
			164 => "OSOBENNOSTI_2",
			165 => "TSVET_1",
			166 => "DLYA_USTANOVKI_VNE_POMESHCHENIY",
			167 => "TIP_2",
			168 => "OSOBENNOSTI_DOP_INFORMATSIYA",
			169 => "KOMBO_PORTY_10_100_1000BASE_T_MINI_GBIC_SFP",
			170 => "PORTY_10_100_1000BASE_T",
			171 => "KOL_VO_PORTOV_S_PODDERZHKOY_POE",
			172 => "PORTY_SFP",
			173 => "PORTY_SFP_1",
			174 => "PORTY_DLYA_STEKIROVANIYA",
			175 => "KOL_VO_PORTOV_S_PODDERZHKOY_POE_1",
			176 => "POE_BYUDZHET",
			177 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"LINK_IBLOCK_TYPE" => "catalog",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "RECOMEND",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "3",
		"ALSO_BUY_MIN_BUYES" => "1",
		"USE_STORE" => "Y",
		"USE_STORE_PHONE" => "N",
		"USE_STORE_SCHEDULE" => "N",
		"USE_MIN_AMOUNT" => "Y",
		"MIN_AMOUNT" => "10",
		"STORE_PATH" => "/store/#store_id#",
		"MAIN_TITLE" => "Наличие на складах",
		"PAGER_TEMPLATE" => "main",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"LABEL_PROP" => "-",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "Добавить в корзину",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Ожидается поступление",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_BLOG_USE" => "N",
		"DETAIL_VK_USE" => "N",
		"DETAIL_FB_USE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPONENT_TEMPLATE" => "main",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"SHOW_DEACTIVATED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"COMMON_SHOW_CLOSE_POPUP" => "Y",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "Y",
		"SIDEBAR_PATH" => "",
		"USE_SALE_BESTSELLERS" => "Y",
		"COMPARE_POSITION_FIXED" => "Y",
		"COMPARE_POSITION" => "top left",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "Y",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ADD_TO_BASKET_ACTION" => "BUY",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"USE_BIG_DATA" => "Y",
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"DETAIL_BRAND_USE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"SHOW_DISCOUNT_TIME" => "Y",
		"SHOW_RATING" => "Y",
		"IBLOCK_STOCK_ID" => "183",
		"SHOW_MEASURE" => "Y",
		"USE_RATING" => "Y",
		"DISPLAY_WISH_BUTTONS" => "Y",
		"DEFAULT_COUNT" => "1",
		"SALE_STIKER" => "-",
		"SHOW_HINTS" => "Y",
		"AJAX_FILTER_CATALOG" => "N",
		"SECTION_TOP_BLOCK_TITLE" => "Лучшие предложения",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "DESCRIPTION",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "Y",
		"SHOW_SECTION_LIST_PICTURES" => "Y",
		"SORT_BUTTONS" => array(
			0 => "POPULARITY",
			1 => "NAME",
			2 => "PRICE",
            3 => "QUANTITY",
		),
		"DEFAULT_LIST_TEMPLATE" => "list",
		"SECTION_DISPLAY_PROPERTY" => "",
		"LIST_DISPLAY_POPUP_IMAGE" => "Y",
		"SECTION_PREVIEW_PROPERTY" => "DESCRIPTION",
		"SECTION_PREVIEW_DESCRIPTION" => "Y",
		"SHOW_SECTION_PICTURES" => "Y",
		"DISPLAY_ELEMENT_SLIDER" => "10",
		"PROPERTIES_DISPLAY_LOCATION" => "TAB",
		"SHOW_BRAND_PICTURE" => "Y",
		"SHOW_ASK_BLOCK" => "Y",
		"ASK_FORM_ID" => "14",
		"DETAIL_OFFERS_LIMIT" => "0",
		"DETAIL_EXPANDABLES_TITLE" => "Аксессуары",
		"DETAIL_ASSOCIATED_TITLE" => "Похожие товары",
		"SHOW_ADDITIONAL_TAB" => "N",
		"PROPERTIES_DISPLAY_TYPE" => "TABLE",
		"SHOW_KIT_PARTS" => "N",
		"SHOW_KIT_PARTS_PRICES" => "N",
		"SHOW_ONE_CLICK_BUY" => "Y",
		"SKU_DETAIL_ID" => "oid",
		"SORT_PRICES" => "MINIMUM_PRICE",
		"STORES" => array(
		),
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?>

<?
if($_SERVER['REQUEST_URI']=="/catalog/video/"){
echo "<div class='d-t'>
<h1>Бюджетный регистратор: на что обратить внимание</h1>
<p>Если вы самостоятельно хотите выбрать бюджетный видеорегистратор, то вам необходимо определить, чего именно вы хотите, а именно, где вы будете его использовать, так как от объекта использования будет завесить количество камер, а соответственно, и каналов видеорегистратора. Оптимальным вариантом будет 4х канальный регистратор. Бюджетная IP-камера – это подходящий вариант для организации системы безопасности в доме или офисе. Она транслирует, записывает и хранит информацию, вы можете подключить её к интернету и всегда будете в курсе того, что происходит на объекте наблюдения. </p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/monitory/"){
echo "<div class='d-t'>
<h1>Купить монитор для видеокамеры в интернет-магазине «Теко»</h1>
<p>Монитор видеокамеры – это неотъемлемая честь системы видеонаблюдения, они передают информацию с камер или видеорегистраторов. Система безопасного видеонаблюдения зависит от каждого её элемента, камеры, видеорегистратора, монитора и т.д. Мы предлагаем большой выбор мониторов для видеокамеры, которые имеют все необходимые параметры для создания максимально эффективной системы видеонаблюдения. </p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/videokamery/"){
echo "<div class='d-t'>
<h1>Видеокамеры для наблюдения </h1>
<p>Сегодня, в современном мире, для того чтобы чувствовать себя безопасно и знать что происходит вокруг, нужно использовать видеокамеры для видеонаблюдения. Видеокамеры в современной жизни используют повсеместно в офисах, частных домах и других объектах, парковках, магазинах и так далее. Цели могут быть разными, но в основном это гарантия вашей безопасности. Видеокамеры можно установить на улицу или в помещение.</p>
<p>С появлением разных технологий появилась и цветная видеокамера для наблюдения, у которой множество преимуществ перед обычной чёрно-белой камерой. Цветная уличная видеокамера позволяет с точностью записывать все события, и следить за происходящим без лишнего напряжения и если понадобиться восстановить все детали происходящих событий, внешность людей, цвет машин и т.д. Внутренняя видеокамера используется не только в домах и офисах, а также в магазинах на кассовых аппаратах, дабы избежать краж и мошенничества.</p>
<p>Купить видеокамеру для наблюдения можно в нашем интернет-магазине. На сайте вы можете подробно ознакомиться с характеристиками камеры и выбрать подходящую уличную, внутреннюю, цветную или любую другую. Широкий ассортимент видеокамер для видеонаблюдения позволит подобрать камеру для любых целей. Цена на видеокамеры для наблюдения различная, так как зависит от технических параметров, чем больше новшеств, тем дороже будет камера, и тем безопаснее вы себя будете чувствовать.</p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/videokamery/analogovye/"){
echo "<div class='d-t'>
<h1>Аналоговая видеокамера для системы видеонаблюдения</h1>
<p>Аналоговая видеокамера создана на основе ПЗС матрицы, она преобразует оптическое изображение в аналоговый сигнал, записывает информацию и являются чувствительными к инфракрасному излучению. Аналоговые камеры бывают уличные и внутренние, цветные и чёрно-белые, некоторые из них при низком уровне освещённости могут переходить на чёрно-белую съёмку. Аналоговые камеры имеют различный конструкцию корпуса и объектива: купольный, цилиндрический или стандартный корпус, фиксированный или поворотный объектив и т.д. Для создания аналоговой системы видеонаблюдения, мы предлагаем видеорегистратор Dahua и большой выбор мониторов. </p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/videokamery/filter/korpus-kupolnyy/"){
echo "<div class='d-t'>
<h1>Купольная цветная видеокамера для видеонаблюдения</h1>
<p>Внутренняя купольная видеокамера является самой популярной камерой из-за своего удобного корпуса, который идеально подходит для внутренней системы видеонаблюдения. Такой корпус предполагает установку камеры на потолок или на стену, внутри помещений или снаружи. Также имеются различия объектива: фиксированный и подвижный, который меняет угол обзора.</p>
<p>Внутренняя цветная купольная видеокамера с определённым разрешением и светочувствительностью, передаёт четкую цветную картинку, которая помогает детально идентифицировать людей и объекты.</p>
<p>Внутренняя видеокамера, цена которой зависит от параметров и характеристик, служит незаменимым помощником в системах видеонаблюдения.</p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/videokamery/ip/"){
echo "<div class='d-t'>
<h1>IP-камеры для видеонаблюдения: наружные и внутренние </h1>
<p>Компания «Теко» реализует современные IP-камеры для видеонаблюдения.  IP-видеокамера – это прорыв в сфере технологий наблюдения. Они обладают большими возможностями, нежели аналоговые:</p>
<ul>
<li>создают цветное, максимально детализированное изображение с разрешением full hd и помогают точно идентифицировать человека или объект;</li>
<li>имеют сотни полезных настроек (технология питания poe, передача данных через wi-fi, ИК порт, подсветка) и удобные форматы записи на карту памяти.</li>
</ul>
<p>IP-видеокамеры можно разделить по чёткости изображения на стандартные и мегапиксельные. Мегапиксельные камеры создают более чёткое изображение и увеличивают зону обзора. Использовать IP-видеокамеры можно для наружного наблюдения и как скрытый миниатюрный вариант для помещений. В нашем каталоге вы можете выбрать и купить IP-камеры для видеонаблюдения в  любых условиях. В комплектах IP-камер для  наружного наблюдения, как правило, предусмотрена защита от влияния внешней среды и вандализма, если ее нет, для уличных IP-видеокамер нужен специальный кожух. </p>
<p>IP-камера с Wi-Fi – это беспроводная видеокамера с максимальной зоной передачи сигнала 100 метров, для усиления сигнала можно использовать внешние дополнительные антенны.</p>
<p>Цена IP-видеокамеры значительно выше аналоговых предшественниц, которые можно и сейчас недорого купить. IPС-камеры – это современные и передовые готовые комплекты, оснащенные высокочувствительной электроникой. Цена на IP-камеры будет колебаться в зависимости от параметров устройства, с которыми вы можете ознакомиться в описании. В нашем интернет-магазине представлен большой выбор камер для видеонаблюдения, вы можете выбрать модель и оформить заказ, не выходя из дома, в любом городе России. Чтобы купить IP-камеры в Казани, Оренбурге, Самаре или другом городе свяжитесь со специалистами компании «Теко» по телефону +7 (843) 299-77-33 или задайте напрямую вопросы в диалоговом окне на сайте.</p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/videoregistratory/"){
echo "<div class='d-t'>
<h1>Купить канальный видеорегистратор в интернет-магазине «Теко»</h1>
<p>С прогрессом в сфере цифровых технологий появились цифровые видеорегистраторы которые бывают – 4, 6, 8, 9, 16, 32 – канальными, количество каналов видеорегистратора говорит о количестве камер, с которыми он может работать. Цифровое изображение с частотой 25 кадров в секунду, позволяет максимально отображать происходящее вокруг.</p>
<p>Видеорегистраторы – это видеокамеры, которые ведут наблюдение и записывают информацию на жесткий диск, могут быть подключены к удалённому компьютеру и работать в сети онлайн. В целях безопасности канальные видеорегистраторы используют практически везде, где это возможно.</p>
<p>Для максимальной безопасности объектов используют канальный видеорегистратор, который позволяет оптимально построить систему наблюдения и сократить количество «мёртвых зон». </p>
<p>Купить видеорегистратор в Самаре, Оренбурге, Чебоксарах, Нижнем Новгороде вы можете, сделав заказ через интернет-магазин «Теко». Наш сайт гарантирует безопасность при оплате заказа банковской картой. </p>
<p>Выбрать и купить видеорегистратор в Казани можно по адресу: ул. Чистопольская 10/8 или Пр. Победы, 19.</p>
</div>";
}
elseif($_SERVER['REQUEST_URI']=="/catalog/video/videoregistratory/ip_1/"){
echo "<div class='d-t'>
<h1>IP-регистратор для систем видеонаблюдения</h1>
<p>IP-регистратор используют для записи и хранения информации с IP-камер. Записанная информация хранится на жестком диске IP-регистратора или на карте памяти. Также регистратор имеет разный набор функциональных возможностей, среди которых: детектор движения, запись по расписанию, просмотр записи по времени, удалённый доступ. Вы можете заказать регистратор для IP-камер в интернет-магазине «Теко» с доставкой в любой город России.
</p>
</div>";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
