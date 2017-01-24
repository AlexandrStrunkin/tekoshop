<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule('statistic');
CModule::IncludeModule('iblock');

$bFull = $_REQUEST['view'] === 'full';
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
		$baseCities = CIBlockElement::GetList(Array('NAME' => 'asc'), array('IBLOCK_ID' => 157), false, false, array('ID', 'NAME'));
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

$resBlocks = array();
$cols = floor(count($result) / 5);
foreach($result as $i => $rItem){
	$col = floor($i / $cols);
	$resBlocks[$col][] = $rItem;
}
?>
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