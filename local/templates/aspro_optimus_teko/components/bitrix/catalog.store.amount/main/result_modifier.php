<?
if(!isset($arProperty["NUM_AMOUNT"])){
	$arSelect=array("ID", "PRODUCT_AMOUNT", 'ADDRESS');
	if($arParams["SHOW_GENERAL_STORE_INFORMATION"] != "Y"){
		foreach($arResult["STORES"] as $pid => $arProperty){
			$arStore = CCatalogStore::GetList(array('TITLE' => 'ASC', 'ID' => 'ASC'), array("ACTIVE" => "Y", "PRODUCT_ID" => $arParams["ELEMENT_ID"], "ID" => $arProperty["ID"]), false, false, $arSelect)->Fetch();
			$arResult["STORES"][$pid]["NUM_AMOUNT"] = $arStore["PRODUCT_AMOUNT"];
			$arResult["STORES"][$pid]["ADDRESS"] = $arStore["ADDRESS"];
		}
	}else{
		$filter = array( "ACTIVE" => "Y", "PRODUCT_ID" => $arParams["ELEMENT_ID"], "+SITE_ID" => SITE_ID, "ISSUING_CENTER" => 'Y' );
		$rsProps = CCatalogStore::GetList( array('TITLE' => 'ASC', 'ID' => 'ASC'), $filter, false, false, $arSelect );
		while ($prop = $rsProps->GetNext()){
			$amount = (is_null($prop["PRODUCT_AMOUNT"])) ? 0 : $prop["PRODUCT_AMOUNT"];
			$quantity += $amount;
			$arResult["STORES"][$prop['ID']]["ADDRESS"] = $prop["ADDRESS"];
		}
		$arResult["STORES"][0]["NUM_AMOUNT"] = $quantity;
		if(!$arResult["STORES"][0]["ID"] && $arResult["STORES"] && !$arResult["STORES"][0]["NUM_AMOUNT"] ){
			$res = CCatalogProduct::GetList(
				array(),
				array("ID" => $arParams["ELEMENT_ID"]),
				false,
				false,
				array("TYPE", "QUANTITY", "ID")
			);
			$data = $res->Fetch();
			$arResult["STORES"][0]["NUM_AMOUNT"] = $data["QUANTITY"];
		}
	}
}
foreach($arResult["STORES"] as $key => $store){
    if($store['ID'] == 3 || $store['ID'] == 10 || $store['ID'] == 4){
        if($store['ID'] == 3){
            $arResult["STORES_NEW"][1][] = $store;
            $arResult["STORES_NEW"][1]['MESSAGE'] = $store["ADDRESS"];
        }
        $arResult["STORES_NEW"][1]['AMOUNT_NUM'] += $store["REAL_AMOUNT"];
    } else if ($store['ID'] == 8  || $store['ID'] == 1){
        if($store['ID'] == 8){
            $arResult["STORES_NEW"][2][] =  $store;
            $arResult["STORES_NEW"][2]['MESSAGE'] .= $store["ADDRESS"] ;
        }
        $arResult["STORES_NEW"][2]['AMOUNT_NUM'] += $store["REAL_AMOUNT"];
    } else if ($store['ID'] == 5  || $store['ID'] == 9){
        if($store['ID'] == 5){
            $arResult["STORES_NEW"][3][] = $store;
            $arResult["STORES_NEW"][3]['MESSAGE'] .= $store["ADDRESS"];
        }
        $arResult["STORES_NEW"][3]['AMOUNT_NUM'] += $store["REAL_AMOUNT"];
    } else if ($store['ID'] == 6 ){
        $arResult["STORES_NEW"][4][] = $store;
        $arResult["STORES_NEW"][4]['MESSAGE'] .= $store["ADDRESS"] ;
        $arResult["STORES_NEW"][4]['AMOUNT_NUM'] += $store["REAL_AMOUNT"];
    } else if ($store['ID'] == 7){
        $arResult["STORES_NEW"][5][] = $store;
        $arResult["STORES_NEW"][5]['MESSAGE'] .= $store["ADDRESS"] ;
        $arResult["STORES_NEW"][5]['AMOUNT_NUM'] += $store["REAL_AMOUNT"];
    } else if ($store['ID'] == 11 ){
        $arResult["STORES_NEW"][6][] = $store;
        $arResult["STORES_NEW"][6]['MESSAGE'] .= $store["ADDRESS"] ;
        $arResult["STORES_NEW"][6]['AMOUNT_NUM'] += $store["REAL_AMOUNT"];
    }
}
$store_text = explode('   ' , $arResult["STORES_NEW"][5]['MESSAGE']);
krsort($store_text);
$arResult["STORES_NEW"][5]['MESSAGE'] = implode(' ' , $store_text);
ksort($arResult["STORES_NEW"], SORT_NUMERIC);

if(!isset($arProperty["NUM_AMOUNT"])){
	$arSelect=array("ID", "PRODUCT_AMOUNT", 'ADDRESS');
	if($arParams["SHOW_GENERAL_STORE_INFORMATION"] != "Y"){
		foreach($arResult["STORES"] as $pid => $arProperty){
			$arStore = CCatalogStore::GetList(array('TITLE' => 'ASC', 'ID' => 'ASC'), array("ACTIVE" => "Y", "PRODUCT_ID" => $arParams["ELEMENT_ID"], "ID" => $arProperty["ID"]), false, false, $arSelect)->Fetch();
			$arResult["STORES"][$pid]["NUM_AMOUNT"] = $arStore["PRODUCT_AMOUNT"];
			$arResult["STORES"][$pid]["ADDRESS"] = $arStore["ADDRESS"];
		}
	}else{
		$filter = array( "ACTIVE" => "Y", "PRODUCT_ID" => $arParams["ELEMENT_ID"], "+SITE_ID" => SITE_ID, "ISSUING_CENTER" => 'Y' );
		$rsProps = CCatalogStore::GetList( array('TITLE' => 'ASC', 'ID' => 'ASC'), $filter, false, false, $arSelect );
		while ($prop = $rsProps->GetNext()){
			$amount = (is_null($prop["PRODUCT_AMOUNT"])) ? 0 : $prop["PRODUCT_AMOUNT"];
			$quantity += $amount;
			$arResult["STORES"][$prop['ID']]["ADDRESS"] = $prop["ADDRESS"];
		}
		$arResult["STORES"][0]["NUM_AMOUNT"] = $quantity;
		if(!$arResult["STORES"][0]["ID"] && $arResult["STORES"] && !$arResult["STORES"][0]["NUM_AMOUNT"] ){
			$res = CCatalogProduct::GetList(
				array(),
				array("ID" => $arParams["ELEMENT_ID"]),
				false,
				false,
				array("TYPE", "QUANTITY", "ID")
			);
			$data = $res->Fetch();
			$arResult["STORES"][0]["NUM_AMOUNT"] = $data["QUANTITY"];
		}
	}
}
?>