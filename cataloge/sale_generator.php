<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

global $USER;

// array("114","115","116","117","123","118","119","120","142")

function copyElemBwIblock($srcElementID,$destIblockID){
	
	// Выдираем описание свойств для инфоблока назначения
	$destIBProps = array();
	$res = CIBlockProperty::GetList(Array(), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$destIblockID));
	while($row=$res->fetch()){
		if($row["PROPERTY_TYPE"]=="L"){ // Если список - получим значения
			$row["VALS"] = array();
			$enumRes = CIBlockProperty::GetPropertyEnum($row["ID"]);
			while($enumRow=$enumRes->fetch())
				$row["VALS"][] = $enumRow;
		}

		$destIBProps[$row["CODE"]] = $row;
	}

	// Сразу же выдергиваем все элементы в инфоблоке назначения, уже привязанные к исходным(для обновления данных)
	$existItems = array();
	$res = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>$destIblockID,"PROPERTY_CATALOG_ITEM_ID"=>$srcElementID),false,false,array("ID","PROPERTY_CATALOG_ITEM_ID"));
	while($row=$res->fetch()){
		$existItems[$row["PROPERTY_CATALOG_ITEM_ID_VALUE"]] = $row["ID"];
	}

	$res = CIBlockElement::GetList(array(),array("ID"=>$srcElementID));
	while($row=$res->GetNextElement()){
		$arFields = $row->GetFields(); // Поля
		$arProps = $row->GetProperties(); // Свойства

		// Вытаскиваем только нужные свойства
		/*?><pre><?print_r($arFields);?></pre><?*/
		$addVals = array();
		
		$addVals["IBLOCK_ID"] = $destIblockID;
		$addVals["NAME"] = $arFields["NAME"];
		$addVals["CODE"] = $arFields["CODE"];
		$addVals["ACTIVE"] = "N";
		$addVals["ACTIVE_FROM"] = $arFields["ACTIVE_FROM"];
		$addVals["ACTIVE_TO"] = $arFields["ACTIVE_TO"];
		$addVals["DATE_ACTIVE_FROM"] = $arFields["DATE_ACTIVE_FROM"];
		$addVals["DATE_ACTIVE_TO"] = $arFields["DATE_ACTIVE_TO"];
		$addVals["PREVIEW_TEXT"] = $arFields["PREVIEW_TEXT"];
		$addVals["PREVIEW_TEXT_TYPE"] = $arFields["PREVIEW_TEXT_TYPE"];
		$addVals["DETAIL_TEXT"] = $arFields["DETAIL_TEXT"];
		$addVals["DETAIL_TEXT_TYPE"] = $arFields["DETAIL_TEXT_TYPE"];

		$pp = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
		$dp = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);

		$addVals["PREVIEW_PICTURE"] = CFile::MakeFileArray($pp["SRC"]);
		$addVals["DETAIL_PICTURE"] = CFile::MakeFileArray($dp["SRC"]);
		$addVals["XML_ID"] = $arFields["XML_ID"];

		$addVals["PROPERTY_VALUES"] = array();

		$addVals["PROPERTY_VALUES"]["4395"] = $arFields["ID"];

		// Соотносим свойства с существующими в инфоблоке назначения
		foreach($arProps as $prop){
			if( ($destProp = $destIBProps[$prop["CODE"]]) && $prop["VALUE"]){ // Если есть свойство с таким кодом, то добавляем

				if($prop['PROPERTY_TYPE']=='L'){ // Список

					//$addVals['PROPERTY_VALUES'][$destProp['ID']]['VALUE_ENUM_ID'] = $prop['VALUE_ENUM_ID'];

					$find = false;
					foreach($destProp["VALS"] as $p){
						if($p["VALUE"]==$prop["VALUE_ENUM"]){ // Если свойство с таким значение найдено - используем его
							$addVals['PROPERTY_VALUES'][$destProp['ID']]['VALUE_ENUM_ID'] = $p["ID"];
							$find = true;
						}
					}
					
					// Если нет такого свойства, то можно бы и создать
					if(!$find){
						$ibpenum = new CIBlockPropertyEnum;
						if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>$destProp['ID'], 'VALUE'=>$prop['VALUE_ENUM_ID']))){
							$addVals['PROPERTY_VALUES'][$destProp['ID']]['VALUE_ENUM_ID'] = $PropID;
						}
					}

				} elseif($prop['PROPERTY_TYPE']=='F'){

					if ($prop['MULTIPLE']=='Y') {

						if (is_array($prop['VALUE']))
						{
							foreach ($prop['VALUE'] as $key => $arElEnum){
								$addVals['PROPERTY_VALUES'][$destProp["ID"]][$key] = CFile::CopyFile($arElEnum);                             
							}
						}
	                }else
						$addVals['PROPERTY_VALUES'][$destProp["ID"]] = CFile::CopyFile($prop['VALUE']);

				} else {
					/*?><pre><?print_r($prop);?></pre><?*/

					$pdescArr = array();

					foreach($prop["VALUE"] as $key=>$pVal)
						$pdescArr[] = array("VALUE"=>$pVal,"DESCRIPTION"=>$prop["DESCRIPTION"][$key]);

					$addVals["PROPERTY_VALUES"][$destProp["ID"]] = $pdescArr;

				}
			}
		}

		// Если связка уже создана, то обновляем, иначе - создаем
		if($PRODUCT_ID = $existItems[$arFields["ID"]]){

			$el = new CIBlockElement;

			if($el->Update($PRODUCT_ID, $addVals))
				echo 'Обновлено!';
			else
				echo 'Не удалось обновить элемент! '.$el->LAST_ERROR."<br />";

		} else {

			$el = new CIBlockElement;
			if($PRODUCT_ID = $el->Add($addVals))
				echo "Элемент создан [ID=".$PRODUCT_ID."]<br />";
			else
				echo "Ошибка создания: ".$el->LAST_ERROR."<br />";

		}

		// Надо создать товар
		// Получаем старый товар
		$srcProduct = CCatalogProduct::GetByID($arFields["ID"]);

		// Делаем добавление(проверяя, есть ли уже такой)
		$cProdRes = CCatalogProduct::GetList(array(),array("ID"=>$PRODUCT_ID));		
		if(!($cProdRow=$cProdRes->fetch()))
			CCatalogProduct::Add(array("ID" => $PRODUCT_ID,"VAT_INCLUDED" => $srcProduct["VAT_INCLUDED"],"VAT_ID" => $srcProduct["VAT_ID"]));

		// С каталогом посложнее будет - надо сперва хапнуть все цены, а затем создать/обновить их для нового товара
		$price_res = CPrice::GetList(
    	    array(),
	        array(
                "PRODUCT_ID" => $arFields["ID"]
            )
	    );
		while($price_row=$price_res->fetch()){

			$p_fields = array(
				"PRODUCT_ID" => $PRODUCT_ID,
				"CATALOG_GROUP_ID" => $price_row["CATALOG_GROUP_ID"],
				"PRICE" => $price_row["PRICE"],
				"CURRENCY" => $price_row["CURRENCY"],
				"QUANTITY_FROM" => $price_row["QUANTITY_FROM"],
				"QUANTITY_TO" => $price_row["QUANTITY_TO"],
				//"BASE" => $price_row["BASE"]
			);

			// Для каждой цены ищем ценовое предложение
			$p_res = CPrice::GetList(array(),array("PRODUCT_ID" => $PRODUCT_ID,"CATALOG_GROUP_ID" => $price_row["CATALOG_GROUP_ID"]));
			if($p_row = $p_res->Fetch())
			    CPrice::Update($p_row["ID"], $p_fields);
			else
			    CPrice::Add($p_fields);

		}
		
		

	}

}

CModule::IncludeModule('iblock');

// Дергаем подобные элементы
$res = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => array("114","115","116","117","123","118","119","120","142"),
		"PROPERTY_ZNACHOK_NA_TOVARE_VALUE" => "Распродажа"
	)
);
while($row=$res->fetch())
	copyElemBwIblock($row["ID"],"142");
?>