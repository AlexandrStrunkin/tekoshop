<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ТЕКО Снижение цены");
?> 
<p align="center"><span style="font-family: 'Times New Roman', serif; font-size: 14pt; line-height: 115%;">Уважаемые клиенты!</span></p>
 
<p align="left"> </p>
 
<p class="MsoNormal"><span style="font-size: 14pt; line-height: 115%; font-family: 'Times New Roman', serif;">         Сообщаем Вам о снижении цен в наших магазинах по многим позициям.</span></p>
 
<p class="MsoNormal"><span style="font-size: 14pt; line-height: 115%; font-family: 'Times New Roman', serif;">Например:</span></p>

<p class="MsoNormal"></p>
 
<p class="MsoNormal" style="text-align: center;"><?$APPLICATION->IncludeComponent("bitrix:store.catalog.top", "leader", array(
	"IBLOCK_TYPE_ID" => "catalog",
	"IBLOCK_ID" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_COUNT" => "12",
	"LINE_ELEMENT_COUNT" => "12",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"FLAG_PROPERTY_CODE" => "SPECIALOFFER",
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"DISPLAY_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "Д 10%",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?><a href="http://teko-shop.ru/catalog/video/ip_videokamery/dahuatech/nvr3204_p_4_kanalnyy_ip_videoregistrator/" ><img src="/upload/medialibrary/dd7/action01-1.jpg" title="action01-1.jpg" border="0" alt="action01-1.jpg" width="171" height="270"  /></a><a href="http://teko-shop.ru/catalog/video/ip_videokamery/dahuatech/ipc_hfw3200s_0360_ulichnaya_ip_videokamera/" ><img src="/upload/medialibrary/721/action01-2.jpg" title="action01-2.jpg" border="0" alt="action01-2.jpg" width="174" height="270"  /></a><a href="http://teko-shop.ru/catalog/video/ip_videokamery/dahuatech/nvr3208_p_8_kanalnyy_ip_videoregistrator/" ><img src="/upload/medialibrary/20a/action01-3.jpg" title="action01-3.jpg" border="0" alt="action01-3.jpg" width="172" height="270"  /></a><a href="http://teko-shop.ru/catalog/ups/akkumulyatory_i_batarei/akkumulyator_12v_7a_ch/" ><img src="/upload/medialibrary/172/action01-4.jpg" title="action01-4.jpg" border="0" alt="action01-4.jpg" width="173" height="270"  /></a></p>
 
<p class="MsoNormal"> <font size="2" color="#ff0000">*цена при покупке в интернет-магазине</font> </p>
 
<p class="MsoNormal"><span style="font-size: 14pt; line-height: 115%; font-family: 'Times New Roman', serif;"> <o:p></o:p></span><span style="font-family: 'Times New Roman', serif; font-size: 14pt; line-height: 115%;">Одновременно информируем о введении новой системы скидок, позволяющей постоянным клиентам нашей компании получить минимальные цены на предлагаемые нами товары.</span></p>
 
<p class="MsoNormal"><span style="font-size: 14pt; line-height: 115%; font-family: 'Times New Roman', serif;">         Рады будем видеть Вас в наших магазинах!<o:p></o:p></span></p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>