<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");




/*$arFilter = Array("IBLOCK_ID"=>134, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("PROPERTY_HASH"=>"asc", "PROPERTY_STATUS_DATE"=>"desc"), $arFilter, false, false, array("ID", "PROPERTY_HASH", "PROPERTY_NAKLAD_NUM", "PROPERTY_ITEM_NAME"));
$curHash = "";
while($row = $res->Fetch())
{
	if($curHash==$row["PROPERTY_HASH_VALUE"])
		CIBlockElement::Delete($row["ID"]);
	
	$curHash = $row["PROPERTY_HASH_VALUE"];
}

die();*/


if(file_exists(__DIR__.'/ORDERS.xml')){

	if(!function_exists("simplexml_load_file")) {
		echo "no library found!";
		die();
	}
	
	$xml = simplexml_load_file('ORDERS.xml');
	
	$loadingData = array();
	$ids = array();
	
	$addedItems = array();
	$updatedItems = array();
	$errorItems = array();
	
	
	foreach($xml->{'Документ'} as $x){
		$loadingRow = array();
		$rqs = $x->{'ЗначенияРеквизитов'}->{'ЗначениеРеквизита'};
		foreach($rqs as $rq){
			if($rq->{'Наименование'}=='Дата по 1С') {
				$date = $rq->{'Значение'}->__toString();
				$date = $DB->FormatDate($date, 'YYYY-MM-DD', 'DD.MM.YYYY')." 00:00:00";
				$loadingRow["ORDERDATE"] = $date;
			}
			if($rq->{'Наименование'}=='Дата оплаты по 1С') {
				$date = $rq->{'Значение'}->__toString();
				$date = $DB->FormatDate($date, 'YYYY-MM-DD', 'DD.MM.YYYY')." 00:00:00";
				$loadingRow["PAYMENTDATE"] = $date;
			}
			if($rq->{'Наименование'}=='Сумма документа') $loadingRow["SUM"] = $rq->{'Значение'}->__toString();
			if($rq->{'Наименование'}=='Оплачено') $loadingRow["PAYED"] = $rq->{'Значение'}->__toString();
			if($rq->{'Наименование'}=='Номер по 1С') $loadingRow["ID"] = $rq->{'Значение'}->__toString();
		}
		if($loadingRow["PAYED"]=="true") $loadingRow["PAYED"] = "Y";
		else $loadingRow["PAYED"] = false;
		if(!isset($loadingRow["ID"]) || !$loadingRow["ID"]) continue;
		$ids[] = $loadingRow["ID"];
		$loadingData[$loadingRow["ID"]] = $loadingRow;
	}
	
	
	//print_r($loadingData); die();
	
	$arFilter = Array("IBLOCK_ID"=>131, "PROPERTY_ORDERID"=>$ids, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), array("ID", "PROPERTY_ORDERID"));
	while($ob = $res->GetNext())
	{
		$orderid = $ob["PROPERTY_ORDERID_VALUE"];
		$id = $ob["ID"];
		if(in_array($orderid,$ids)){ // if order exists, then update
			
			$ld = $loadingData[$orderid];
			
			$el = new CIBlockElement;
			
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(),
			  "IBLOCK_SECTION_ID" => false,
			  "IBLOCK_ID"      => 131,
			  "PROPERTY_VALUES"=> array(
				"ORDERID"=>$ld["ID"],
				"ORDERSUM"=>$ld["SUM"],
				"PAYED"=>$ld["PAYED"],
				"ORDERDATE"=>$ld["ORDERDATE"],
				"PAYMENTDATE"=>$ld["PAYMENTDATE"],
			  ),
			  "NAME"           => "Заказ номер ".$ld["ID"],
			  "ACTIVE"         => "Y"
			  );
			
			
			$PRODUCT_ID = $id;
			if($upd = $el->Update($PRODUCT_ID, $arLoadProductArray)){
				$updatedItems[] = $ld;
			} else {
				$errorItems[] = $ld;
			}
			unset($loadingData[$orderid]);
		}
	}
	
	
	
	foreach($loadingData as $ld){
		$el = new CIBlockElement;
		
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(),
		  "IBLOCK_SECTION_ID" => false,
		  "IBLOCK_ID"      => 131,
		  "PROPERTY_VALUES"=> array(
			"ORDERID"=>$ld["ID"],
			"ORDERSUM"=>$ld["SUM"],
			"PAYED"=>$ld["PAYED"],
			"ORDERDATE"=>$ld["ORDERDATE"],
			"PAYMENTDATE"=>$ld["PAYMENTDATE"],
		  ),
		  "NAME"           => "Заказ номер ".$ld["ID"],
		  "ACTIVE"         => "Y"
		  );

		if($PRODUCT_ID = $el->Add($arLoadProductArray)){
			$addedItems[] = $ld;
		} else {
			print_r($el->LAST_ERROR);
			$errorItems[] = $ld;
		}
	}
	
	
	if($addedItems)
		echo 'Добавленных элементов заказов: '.count($addedItems).'<br />';
	if($updatedItems)
		echo 'Обновленных элементов заказов: '.count($updatedItems).'<br />';
	if($errorItems)
		echo 'Не получилось добавить/обновить элементов заказов: '.count($errorItems).'<br />';
	
	
	if(count($addedItems) || count($updatedItems)){
		copy(__DIR__."/ORDERS.xml", __DIR__."/orders/ORDERS_".date("d.m.Y_H.i.s",time()).".xml");
		unlink(__DIR__.'/ORDERS.xml');
	}

}







if(file_exists(__DIR__.'/NAKLAD.xml')){

	if(!function_exists("simplexml_load_file")) {
		echo "no library found!";
		die();
	}
	
	$xml = simplexml_load_file('NAKLAD.xml');
	
	$loadingData = array();
	
	$addedItems = array();
	$updatedItems = array();
	$errorItems = array();
	
	$hashList = array();
	
	foreach($xml->{'Документ'} as $x){
		$loadingRow = array();
		$loadingRow["NAKLAD_NUM"] = $x->{'НомерНакладной'}->__toString();
		$loadingRow["CLIENT_NAME"] = $x->{'НаименованиеКлиента'}->__toString();
		$loadingRow["NAKLAD_DATE"] = $x->{'ДатаНакладной'}->__toString();
		
		$nakladList[] = $loadingRow["NAKLAD_NAME"];
		
		$row = $x->{'ЗначенияРеквизитов'};
		foreach($row as $r){
			$rqs = $r->{'ЗначениеРеквизита'};
			foreach($rqs as $rq){
				if($rq->{'Наименование'}=='ДатаИзмененияСтатуса') {
					$loadingRow["STATUS_DATE"] = $rq->{'Значение'}->__toString();
				}
				if($rq->{'Наименование'}=='НаименованиеПрибора') $loadingRow["ITEM_NAME"] = $rq->{'Значение'}->__toString();
				if($rq->{'Наименование'}=='СтатусПрибора') $loadingRow["STATUS"] = $rq->{'Значение'}->__toString();
			}
			$loadingRow["HASH"] = md5($loadingRow["NAKLAD_NUM"]."_".$loadingRow["ITEM_NAME"]);
			//$loadingRow["HASH"] = md5($loadingRow["NAKLAD_NUM"]."_".$loadingRow["STATUS_DATE"]);
			$hashList[] = $loadingRow["HASH"];
			$loadingData[$loadingRow["HASH"]] = $loadingRow;
		}
	}
	
	//print_r($hashList); echo '<br /><br />';	
	
	$arFilter = Array("IBLOCK_ID"=>134, "PROPERTY_HASH"=>$hashList, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), array("ID", "PROPERTY_HASH"));
	while($ob = $res->GetNext())
	{
		$hash = $ob["PROPERTY_HASH_VALUE"];
		$id = $ob["ID"];

		if(in_array($hash,$hashList)){ // if exists, then update
			

			//echo $hash."(".$ob["ID"].")<br />"; continue;

			$ld = $loadingData[$hash];
			
			$el = new CIBlockElement;
			
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(),
			  "IBLOCK_SECTION_ID" => false,
			  "IBLOCK_ID"      => 134,
			  "PROPERTY_VALUES"=> array(
				"NAKLAD_NUM"=>$ld["NAKLAD_NUM"],
				"CLIENT_NAME"=>$ld["CLIENT_NAME"],
				"NAKLAD_DATE"=>$ld["NAKLAD_DATE"],
				"ITEM_NAME"=>$ld["ITEM_NAME"],
				"STATUS"=>$ld["STATUS"],
				"STATUS_DATE"=>$ld["STATUS_DATE"],
				"HASH"=>$ld["HASH"],
			  ),
			  "NAME"           => "Накладная номер ".$ld["NAKLAD_NUM"]." - ".$ld["ITEM_NAME"],
			  "ACTIVE"         => "Y"
			  );
			
			
			//print_r($arLoadProductArray);
			
			
			$PRODUCT_ID = $id;
			if($upd = $el->Update($PRODUCT_ID, $arLoadProductArray)){
				$updatedItems[] = $ld;
			} else {
				$errorItems[] = $ld;
			}
			unset($loadingData[$hash]);
		}
	}
	
	//die();
	
	
	foreach($loadingData as $ld){
		$el = new CIBlockElement;
		
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(),
		  "IBLOCK_SECTION_ID" => false,
		  "IBLOCK_ID"      => 134,
		  "PROPERTY_VALUES"=> array(
				"NAKLAD_NUM"=>$ld["NAKLAD_NUM"],
				"CLIENT_NAME"=>$ld["CLIENT_NAME"],
				"NAKLAD_DATE"=>$ld["NAKLAD_DATE"],
				"ITEM_NAME"=>$ld["ITEM_NAME"],
				"STATUS"=>$ld["STATUS"],
				"STATUS_DATE"=>$ld["STATUS_DATE"],
				"HASH"=>$ld["HASH"],
		  ),
		  "NAME"           => "Накладная номер ".$ld["NAKLAD_NUM"]." - ".$ld["ITEM_NAME"],
		  "ACTIVE"         => "Y"
		);
		
		
		if($PRODUCT_ID = $el->Add($arLoadProductArray)){
			$addedItems[] = $ld;
		} else {
			$errorItems[] = $ld;
		}
	}
	
	
	if($addedItems)
		echo 'Добавленных элементов накладных: '.count($addedItems).'<br />';
	if($updatedItems)
		echo 'Обновленных элементов накладных: '.count($updatedItems).'<br />';
	if($errorItems)
		echo 'Не получилось добавить/обновить элементов накладных: '.count($errorItems).'<br />';
	
	copy(__DIR__."/NAKLAD.xml", __DIR__."/naklad/NAKLAD_".date("d.m.Y_H.i.s",time()).".xml");
	unlink(__DIR__.'/NAKLAD.xml');
}


?>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>