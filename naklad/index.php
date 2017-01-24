<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
$notFound = false;

echo $id;

//$APPLICATION->SetTitle("Накладная номер ".$id);
$result = array();
if(!$id) $notFound = true;
else{
	$arFilter = Array("IBLOCK_ID"=>134, "PROPERTY_NAKLAD_NUM"=>$id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("PROPERTY_ITEM_NAME"=>"desc", "PROPERTY_STATUS_DATE"=>"desc"), $arFilter, false, false, Array("PROPERTY_NAKLAD_NUM","PROPERTY_CLIENT_NAME","PROPERTY_NAKLAD_DATE","PROPERTY_ITEM_NAME","PROPERTY_STATUS","PROPERTY_STATUS_DATE"));
	$iname = "";
	while($row = $res->Fetch()):
		if($row["PROPERTY_ITEM_NAME_VALUE"]!=$iname):
			$result[] = $row;
		endif;
		$iname = $row["PROPERTY_ITEM_NAME_VALUE"];
	endwhile;
}
?> 

<?if(count($result)):?>

    <div>Накладная номер "<?=$id?>"</div>
    <div>Наименование клиента: "<?=$result[0]["PROPERTY_CLIENT_NAME_VALUE"]?>"</div>
    <div>Дата накладной" <?=$DB->FormatDate($result[0]["PROPERTY_NAKLAD_DATE_VALUE"], 'DD.MM.YYYY HH:MI:SS', 'DD.MM.YY')?></div>
	
    <br /><br />
	<div>Список приборов:</div>
    <br />
    
	<?foreach($result as $row):?>
    	<div style="border:#000 solid 1px; padding:15px; background:#FFF;">
        	<div>Наименование: <?=$row["PROPERTY_ITEM_NAME_VALUE"]?></div>
        	<div>Статус: <?=$row["PROPERTY_STATUS_VALUE"]?></div>
        	<div>Дата изменения статуса: <?=$DB->FormatDate($row["PROPERTY_STATUS_DATE_VALUE"], 'DD.MM.YYYY HH:MI:SS', 'DD.MM.YY')?></div>
        </div>
        <br /><br />
    <?endforeach;?>


<?else:?>
	Накладные не найдены!
<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>