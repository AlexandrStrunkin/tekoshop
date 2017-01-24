<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("aspro.optimus");
$form_id = isset($_REQUEST["form_id"]) ? $_REQUEST["form_id"] : 1;
COptimus::GetValidFormIDForSite($form_id);
?>
<?if($form_id != 'one_click_buy' && $form_id != 'city_change'):?>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:form",
		"popup",
		Array(
			"AJAX_MODE" => "Y",
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $form_id,
			"START_PAGE" => "new",
			"SHOW_LIST_PAGE" => "N",
			"SHOW_EDIT_PAGE" => "N",
			"SHOW_VIEW_PAGE" => "N",
			"SUCCESS_URL" => "",
			"SHOW_ANSWER_VALUE" => "N",
			"SHOW_ADDITIONAL" => "N",
			"SHOW_STATUS" => "N",
			"EDIT_ADDITIONAL" => "N",
			"EDIT_STATUS" => "Y",
			"NOT_SHOW_FILTER" => "",
			"NOT_SHOW_TABLE" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_GROUPS" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600000",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"VARIABLE_ALIASES" => Array(
				"action" => "action"
			)
		)
	);?>
<?endif;?>
<?if ($form_id == 'city_change'){
	$cityname = $_REQUEST['cityname'];
	$cityid=0;
	
	CModule::IncludeModule('statistic');
	CModule::IncludeModule('iblock');

	$bFull = true;
	$bCities = $_REQUEST['cities'] === 'Y';
	$search = $_REQUEST['search'] ? $_REQUEST['search'] : '';

	// Кэшируем содержимое, если это не было сделано
	$obCache = new CPHPCache();
	$cacheLifetime = 604800;
	$cacheID = 'citiesListFull';
	$cachePath = '/'.$cacheID;
	if($obCache->InitCache($cacheLifetime, $cacheID, $cachePath)){
		$vars = $obCache->GetVars();
		$citiesResult = $vars['citiesResult'];
		$baseCityNames = $vars['baseCityNames'];
	}
	elseif($obCache->StartDataCache()){
		// Получаем список основных городов
		$baseCityNames = array();
		if(!$search){
			$baseCities = CIBlockElement::GetList(Array('SORT' => 'asc'), array('IBLOCK_ID' => 157), false, false, array('ID', 'NAME'));
			while($cityItem = $baseCities->fetch()){
				$baseCityNames[] = $cityItem['NAME'];
			}
		}

		// Получаем список всех городов
		/*
		$cityFilter = array('COUNTRY_ID'=>'RU','!CITY_NAME'=>false);
		$cities = CCity::GetList(array('CITY_NAME'=>'ASC'),$cityFilter);
		while($row = $cities->fetch()){
			if(in_array($row['CITY_NAME'],$baseCityNames))
				$citiesResult[] = array('NAME' => $row['CITY_NAME'], 'ID' => $row['CITY_ID'], 'BASE' => 'Y');
			else
				$citiesResult[] = array('NAME' => $row['CITY_NAME'], 'ID' => $row['CITY_ID'], 'BASE' => 'N');
		}
		*/

		$citiesResult = array();
		$res = CIBlockElement::GetList(Array('NAME' => 'asc'), array('IBLOCK_ID' => 145), false, false, array('ID', 'NAME'));
		while($row = $res->fetch()){
			if(in_array($row['NAME'], $baseCityNames)){
				$citiesResult[] = array('NAME' => $row['NAME'], 'ID' => $row['ID'], 'BASE' => 'Y');
			}
			else{
				$citiesResult[] = array('NAME' => $row['NAME'], 'ID' => $row['ID'], 'BASE' => 'N');
			}
		}

		$obCache->EndDataCache(
			array(
				'citiesResult' => $citiesResult,
				'baseCityNames' => $baseCityNames
			)
		);
	}

	// Фильтруем по имени
	$result = array();
	foreach($citiesResult as $cResultItem){
		if($search && strstr(strtolower($cResultItem['NAME']), strtolower($search))){
			$result[] = $cResultItem;
		}
		elseif(!$search && in_array($cResultItem['NAME'], $baseCityNames)){
			$result[] = $cResultItem;
		}
		if(count($result) > 20){
			break;
		}
	}
	
	foreach($citiesResult as $cResultItem){
		if ($cityname == $cResultItem['NAME'] || strtolower($cResultItem['NAME']) == strtolower($cityname)){
			$cityid = $cResultItem['ID'];
			break;
		}
	}

	$resBlocks = array();
	$cols = floor(count($result) / 5);
	foreach($result as $i => $rItem){
		$col = floor($i / $cols);
		$resBlocks[$col][] = $rItem;
	}
	?>
	<a href="#" class="close jqmClose"><i></i></a>
	<div class="form">
	<div class="form_head">
	<? if ($cityid) { ?>
		<h2>Ваш город <?=$cityname?>?</h2>
	<?} else {?>
		<h2>Выбрать город</h2>
	<? } ?>
	</div>
	<div class="form_body">
		<?if($bFull):?>
			<div class="city-popup-list">
				<div class="cpl-top">
					<input type="text" class="cpl-finder" value="" placeholder="Город">
				</div>
				<div class="cpl-bottom">
					<div class="cpl-clist">
		<?endif;?>
						<?foreach($resBlocks as $rBlock):?>
							<ul>
								<?foreach($rBlock as $rItem):?>
									<li data-id="<?=$rItem['ID']?>"><?=$rItem['NAME']?></li>
								<?endforeach;?>
							</ul>
						<?endforeach;?>
		<?if($bFull):?>
					</div>
				</div>
			</div>
		<?endif;?>
		<?if($bFull):?>
			<script type="text/javascript">
			var citiesFull = <?=json_encode($citiesResult)?>;
			$('.cpl-top input').donetyping(
				function(){
					loadCitiesList($(this).val())
				},
				100
			)
			</script>
		<?endif;?>
		<?if($bCities){
			$APPLICATION->RestartBuffer();
			echo json_encode($citiesResult);
			die();
		}
		?>
		
		<? if ($cityid) {?>
			<div class="popup_button_block">
				<span class="button medium js_my_city" data-id="<?=$cityid?>">Это мой город</span>
			</div>
			<br/>
		<? } ?>
		</div>
	</div>
<?}?>