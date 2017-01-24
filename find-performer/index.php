<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Установка систем безопасности, сигнализаций и камер видеонаблюдения по доступным ценам");
$APPLICATION->SetPageProperty("description", "У нас вы можете заказать установку купленной системы безопасности, сигнализации и системы видеонаблюдения.");
$APPLICATION->SetPageProperty("keywords", "заказать монтаж, монтажные организации, услуги монтажа");
$APPLICATION->SetTitle("Установка камер видеонаблюдения, цены, установка видеокамер");
?> 
<?
	$img_rand = rand (2,4);
?>
<div class="row"> 
  <div class="col-main col-xs-12 col-sm-9"> 
    <div class="padding-s"> 
      <div class="std find_performer"> 
        <div class="clear"></div>
		<div class="find_performer_slider ch_slider-1">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-<?=$img_rand?>.png" alt="">
			<div class="slider_float_block">
			
				<span>Поиск выгодного предложения</span>
				<ul>
					<!--<li>Разместите запрос и получите предложения от нескольких монтажных организаций</li>-->
					<li>Отправьте ваш запрос на монтаж нашим сотрудникам</li>
					<!--<li>Народный рейтинг инсталляторов</li>-->
					<li>Быстро подберем варианты монтажа по лучшей цене</li>
					<li>Обратитесь напрямую в известную Вам фирму</li>
					<li>Консультации по подбору оборудования от практиков</li>
				</ul>
<!--				<a rel="nofollow" href="/personal/requests/?edit=Y">Заявка на монтаж</a> -->
			</div>
			<div style="clear:both"></div>
		</div>
<!--		<div class="find_performer_top_links">
			<a rel="nofollow" href="/partner/" class="top_link"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-7.png" alt="Монтажные организации"><div><span>Монтажные организации</span></div></a>
			<a rel="nofollow" href="/reg-performer/" class="top_link"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-6.png" alt="Как стать партнером?"><div><span>Как стать партнером?</span></div></a>
			<div style="clear:both"></div>
		</div> 
		<div class="find_performer_why_me">
			<center><h2 style="display: inline;color:#F26522;font-size:x-large;">ВСЕ МОЖНО СДЕЛАТЬ ЛУЧШЕ ЧЕМ ДЕЛАЛОСЬ ДО СИХ ПОР.   </h2><h4 style="display: inline">Генри Форд</h4></center> <br /> <br>
			<div class="why_me_section">
				<div class="why_me_block"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-8.png" alt="Получение предложений от нескольких монтажных организаций"><br>Получение предложений сразу от нескольких монтажных организаций в короткие сроки</div>
				<div class="why_me_block"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-9.png" alt="Индивидуальный запрос услуг у монтажной организации"><br>Возможность индивидуального запроса услуг у монтажной организации</div>
				<div class="why_me_block"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-10.png" alt="Система интегрирована с интернет-магазином"><br>Сервис интегрирован с интернет-магазином</div>
			</div>
			<div class="why_me_section">
				<div class="why_me_block"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-11.png" alt="Последовательное согласование и покупка товаров и услуг"><br>Поэтапное согласование приобретения оборудования и монтажа </div>
				<div class="why_me_block"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-12.png" alt="Динамическая система рейтинга монтажных организаций"><br>Рейтинг монтажных организаций</div>
				<div class="why_me_block"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-13.png" alt="Рекомендации оборудования от монтажных организаций"><br>Рекомендации по подбору оборудования</div>
			</div>
		</div>
		<div class="ch_separator"></div>
		<div class="find_performer_links">
			<h2>Желаем Вам успешной работы с сервисом.</h2>
			<p>Регистрируясь в данном сервисе вы принимаете следующие условия работы:</p>
			<ul>
				<li><span class="ch_list">1</span><span class="ch_list_text">Данный сервис является разработкой ЗАО "ТЕКО". Проект не направлен на получение материальной выгоды нашей компанией и служит площадкой для контактов исполнителей и заказчиков и обсуждения содержания работ.</span></li>
				<li><span class="ch_list">2</span><span class="ch_list_text">Для улучшения работы сервиса мы проводим внутренний мониторинг и удаляем фиктивные или несерьезные заявки и предложения. </span></li>
				<li><span class="ch_list">3</span><span class="ch_list_text">Сервис доступен только зарегистрированным пользователям интернет-магазина ТЕКО (www.teko-shop.ru)</span></li>
				<li><span class="ch_list">4</span><span class="ch_list_text">Компания ТЕКО не несет ответственности за недобросовенность клиентов и партнеров, ненадлежащее исполнение и качество работ.</span></li>
				<li><span class="ch_list">5</span><span class="ch_list_text">Клиент может получить несколько предложений от исполнителей (тендерная основа) и выбрать наиболее интересное для него.</span></li>
				<li><span class="ch_list">6</span><span class="ch_list_text">Клиент может подать индивидуальную заявку одной компании, основываясь на своих предпочтениях, рейтинге компании в каталоге или более полной карточке партнера.</span></li>
				<li><span class="ch_list">7</span><span class="ch_list_text">Рейтинг расчитывается динамически и учитывает несколько факторов, он может как расти, так и падать</span></li>
				<li><span class="ch_list">8</span><span class="ch_list_text">Сервис производит отправку информационных уведомлений, с адреса: shop@teko.biz, просьба не отвечать на автоматические уведомления.</span></li>
				<li><span class="ch_list">9</span><span class="ch_list_text">По окончании работ, настоятельно просим оценить работу исполнителя (ссылку Вы получите уведомлением или в своем Личном кабинете). Это поможет нам улучшить работу сервиса и повысит качество работ исполнителей.</span></li>
			</ul>
		</div>
		<div class="ch_separator"></div>
		<div class="find_performer_bottom_links">
			<div class="bottom_link"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-15.png" alt="Руководство клиента"><div><span>Руководство клиента<br><a href="http://teko-shop.ru/help/manual/%D0%A0%D1%83%D0%BA%D0%BE%D0%B2%D0%BE%D0%B4%D1%81%D1%82%D0%B2%D0%BE%20%D0%BF%D0%BE%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B5%20%D1%81%20%D1%81%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%BE%D0%BC%20-%20%D0%BA%D0%BB%D0%B8%D0%B5%D0%BD%D1%82.pdf" rel="nofollow">Скачать pdf</a></span></div></div>
			<div class="bottom_link"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-16.png" alt="Руководство монтажника"><div><span>Руководство монтажника<br><a href="http://teko-shop.ru/help/manual/%D0%A0%D1%83%D0%BA%D0%BE%D0%B2%D0%BE%D0%B4%D1%81%D1%82%D0%B2%D0%BE%20%D0%BF%D0%BE%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B5%20%D1%81%20%D1%81%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%BE%D0%BC.pdf" rel="nofollow">Скачать pdf</a></span></div></div>
			<div style="clear:both"></div>
		</div>-->
		<?/*?>
		<div class="find_performer_peoples_count"><img src="<?=SITE_TEMPLATE_PATH?>/images/ch-find-performer-14.png" alt="262 698"><br>Человек уже воспользовалось нашим сервисом и остались довольны!	</div>
		<?*/?>
       </div>
     </div>
   </div>
 
  <div class="col-left sidebar col-xs-12 col-sm-3"><strong> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/left_menu.php",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"left_slider",
	Array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "140",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "РќРѕРІРѕСЃС&sbquo;Рё",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?><?$APPLICATION->IncludeComponent("miha:catalog.compare.list", "mc_compare", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"DETAIL_URL" => "",
	"COMPARE_URL" => "compare.php",
	"NAME" => "CATALOG_COMPARE_LIST",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"actions_menu",
	Array(
		"ROOT_MENU_TYPE" => "actions",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	)
);?> 
<!--<img id="bxid_572344" src="/bitrix/images/fileman/htmledit2/php.gif" border="0"  />-->
 <?$APPLICATION->IncludeComponent(
	"bitrix:voting.form",
	"mc_voting_form",
	Array(
		"VOTE_ID" => "9",
		"VOTE_RESULT_TEMPLATE" => "/catalog/vote_result.php?VOTE_ID=#VOTE_ID#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?> 
      <br />
     <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/price_list.php",
		"EDIT_TEMPLATE" => ""
	)
);?></strong></div>
 <strong> </strong></div>
 <b><b> </b></b>
<hr/>
<div class="d-t">
<h1>Установка систем безопасности, сигнализаций и камер видеонаблюдения</h1>
<p>Качественная установка видеокамер подразумевает под собой целый ряд действий, недостаточно просто приобрести дорогое оборудование, успех и безопасность объекта зависит от правильного монтажа, которую лучше доверить профессионалам. Фирма «ТЕКО» имеет 20 летний опыт на рынке систем безопасности. Мы не только реализуем товар для систем видеонаблюдения, но и предлагаем вам заказать монтаж видеокамер в Чебоксарах в проверенных и профессиональных агентствах, которые представлены в <a href="/partner/">каталоге на нашем сайте</a>. </p>
<h2>Установка камер видеонаблюдения в Нижнем Новгороде</h2>
<p>Наши партнеры, готовые профессионально выполнить установку и монтаж камер видеонаблюдения, находятся не только в Чебоксарах, но и в Нижнем Новгороде. Не имеет значения, для какого именно помещения вы планируете заказать установку видеокамер: для магазина, квартиры или офиса, она будет выполнена на высшем уровне.</p>
<p>Цены на установку и монтаж систем видеонаблюдения в Нижнем Новгороде вы всегда можете уточнить у менеджеров компании, в которую вы планируете обратиться.</p>
<p>Современный мир вынуждает человека особенно внимательно к своему имуществу. И если вы волнуетесь, что замки и двери, сейфы и потайные шкафы не помогут вам уберечь ценные вещи от грабителей или недобросовестных покупателей (если речь идет о магазине), лучшим выходом станут установленные по всему периметру (внутри или снаружи – зависит от типа помещения) видеокамеры. Записи с них можно просмотреть в любой момент, более того именно пленка сможет стать лучшим аргументом и прекрасным подтверждением ваших слов, если вы обратитесь в полицию или суд.</p>
<h2>Установка камер видеонаблюдения в Самаре</h2>
<p>Мы предлагаем заказать профессиональную установку и монтаж систем видеонаблюдения в Самаре по доступным ценам у наших партнеров, представленных в каталоге на сайте.  </p>
<h3>Установка камер видеонаблюдения в Казани</h3>
<p>Компания «ТЕКО» имеет несколько филиалов в республике Татарстан и в г. Чебоксары. В Казани мы сотрудничаем с зарекомендовавшими себя агентствами по установке систем видеонаблюдения. Мы гарантируем качество установки и монтажа систем видеонаблюдения по адекватным ценам, которые вы всегда можете уточнить у менеджеров монтажных компаний.</p>
<h3>Установка камер видеонаблюдения в Оренбурге</h3>
<p>Задача компании «ТЕКО» - помочь вам сохранить своё имущество в целости. Поэтому мы предлагаем надежное оборудование, а установку видеокамер для наблюдения рекомендуем доверить специалистам, которые предложат вам достойное качество и адекватные цены. В нашем <a href="/partner/">каталоге</a> организации-партнеры сортируются в соответствии с рейтинговой системой, учитывающей качество оказываемых услуг, а также проходят модерацию нашими специалистами. Для нас важны прочные и доброжелательные отношения с нашими реальными и потенциальными клиентами. Поэтому мы сотрудничаем только с проверенными организациями, выполняющими монтаж систем видеонаблюдения и ОПС.</p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>