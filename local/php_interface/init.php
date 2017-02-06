<?
CModule::IncludeModule('catalog');

function GetRegionData(){
    // Если есть город в куках, то танцуем от него
    global $currentLocation;
    if($_COOKIE["currentCity"]){
        if(!$_SESSION["ccity"][$_COOKIE["currentCity"]]){
            // Если город для данного кука не сохранен, сделаем это
            // Получаем имя города по ID
            $res = CIBlockElement::GetList(Array(), array("ID"=>$_COOKIE["currentCity"]), false, false, array("NAME", "PROPERTY_PHONE", "PROPERTY_EMAIL"));
            $row = $res->fetch();
            $phone = $row["PROPERTY_PHONE_VALUE"];
            $email = $row["PROPERTY_EMAIL_VALUE"];

            // Получаем текущий регион
            $cities = CCity::GetList(array(),array("CITY_NAME"=>$row["NAME"]));
            $row = $cities->fetch();
            $currentLocation = array("REGION_NAME"=>$row["REGION_NAME"],"CITY_NAME"=>$row["CITY_NAME"],"PHONE"=>$phone,"EMAIL"=>$email);
            $_SESSION["ccity"][$_COOKIE["currentCity"]] = $currentLocation;
        }
        else {
            $currentLocation = $_SESSION["ccity"][$_COOKIE["currentCity"]];
        }
    }
    else {
        // В противном случае ловим регион по текущему IP
        if(!$_SESSION["ccity_byip"]){
            // Если город для данного IP не установлен в сессии
            $obCity = new CCity();
            $curCity = $obCity->GetFullInfo();
            $regionName = $curCity["REGION_NAME"]["VALUE"];
            $currentLocation = array("REGION_NAME"=>$curCity["REGION_NAME"]["VALUE"],"CITY_NAME"=>$curCity["CITY_NAME"]["VALUE"]);
            $_SESSION["ccity_byip"] = $currentLocation;
        }
        else {
            $currentLocation = $_SESSION["ccity_byip"];
        }
    }

    // Получаем цену текущего региона
    global $regionPriceID;
    global $regionPriceCODE;
    $_SESSION["regionPriceID"] = 0;
    if(!$_SESSION["regionPriceIDArr"][$currentLocation["REGION_NAME"]]){
        $dbPriceType = CCatalogGroup::GetList(array("SORT" => "ASC"),array());
        while($arPriceType = $dbPriceType->Fetch()){
            $pTypeName = strtolower($arPriceType["NAME_LANG"]);
            $curRegion = strtolower($currentLocation["REGION_NAME"]);
            if(strstr($pTypeName,$curRegion)){
                $_SESSION["regionPriceIDArr"][$currentLocation["REGION_NAME"]] = $arPriceType;
            }

        }
    }

    if($rpArr = $_SESSION["regionPriceIDArr"][$currentLocation["REGION_NAME"]]){
        $regionPriceID = $rpArr["ID"];
        // Добавляем цену текущего региона в фильтр
        $regionPriceCODE = $rpArr["NAME"];
        $_SESSION["regionPriceID"] = $regionPriceID;
    }
}
 function arshow($arr){
     global $USER;
     if($USER->IsAdmin()){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
     }
    }
function GetItemPrices(&$arItemPrices, $IBLOCK_ID, $manufacturerID){
    static $mfPrices, $arGroups;

    global $regionPriceID, $allPrices, $USER;
    $region_price = $min_price = $old_price = array();
    $PRICE_ROZN = PRICE_ROZN; // Цена по умолачнию - из настроек модуля tireos.prices
    $bManufacturerPrice = false;

    if(!isset($arGroups)){
        $arGroups = explode(',', $USER->GetGroups());
    }

    $arGroups = explode(',', $USER->GetGroups());
    if(!in_array(14, $arGroups)){
        $bUserAuthorized = $USER->IsAuthorized();
        if(!isset($mfPrices)){
            $mfPrices = unserialize(COption::GetOptionString('tireos.prices', 'NA_PRICES', array()));
        }

        if($bUserAuthorized && $mfPrices[$IBLOCK_ID]['A_MF_SHOWED_PRICES'][$manufacturerID]){
            $PRICE_ROZN = $mfPrices[$IBLOCK_ID]['A_MF_SHOWED_PRICES'][$manufacturerID];
            $bManufacturerPrice = true;
        }
        elseif(!$bUserAuthorized && $mfPrices[$IBLOCK_ID]['NA_MF_SHOWED_PRICES'][$manufacturerID]){
            $PRICE_ROZN = $mfPrices[$IBLOCK_ID]['NA_MF_SHOWED_PRICES'][$manufacturerID];
            $bManufacturerPrice = true;
        }

        if($arItemPrices){
            foreach($arItemPrices as $i => $price){
                if($PRICE_ROZN && $PRICE_ROZN == $allPrices[$price['PRICE_ID']]['NAME']){
                    continue;
                }

                // Ищем соответствующие параметры
                if(
                    (
                        $bUserAuthorized &&
                        $mfPrices[$IBLOCK_ID]['A_MF_PRICES'] &&
                        $mfPrices[$IBLOCK_ID]['A_MF_PRICES'][$manufacturerID] &&
                        !in_array($price['PRICE_ID'], $mfPrices[$IBLOCK_ID]['A_MF_PRICES'][$manufacturerID])
                    )
                    ||
                    (
                        !$bUserAuthorized &&
                        $mfPrices[$IBLOCK_ID]['NA_MF_PRICES'] &&
                        $mfPrices[$IBLOCK_ID]['NA_MF_PRICES'][$manufacturerID] &&
                        !in_array($price['PRICE_ID'], $mfPrices[$IBLOCK_ID]['NA_MF_PRICES'][$manufacturerID])
                    )
                ){
                    unset($arItemPrices[$i]);
                }
            }
        }
    }

    if($arItemPrices){
        foreach($arItemPrices as $code => $arPrice){
            if($arPrice['CAN_ACCESS']){
                if(!$min_price){
                    $min_price = $arPrice;
                }
                elseif($arPrice['VALUE'] < $min_price['VALUE']){
                    $min_price = $arPrice;
                }

                if($code == $PRICE_ROZN){
                    $old_price = $arPrice;
                }
                else{
                    // Если установлена цена для этого региона, то однозначно устанавливаем её
                    if($regionPriceID && $regionPriceID == $arPrice['PRICE_ID']){
                        $region_price = $min_price = $arPrice;
                        break;
                    }
                }
            }
        }
    }

    return array($min_price, $old_price, $region_price, $bManufacturerPrice);
}

/*
You can place here your functions and event handlers

AddEventHandler("module", "EventName", "FunctionName");
function FunctionName(params)
{
    //code
}
*/
?><?
//Отправка заявки на парнерство
//AddEventHandler("form", "onBeforeResultAdd", "resultPrepare");
function resultPrepare($formID, &$arFields, &$arrVALUES)
{

}
global $catalogIDS;
global $catalogIDS2;
$catalogIDS = array(123, 114, 115, 116, 117, 118, 119, 120, 171, 142);
$catalog2IDS = array(162, 144);

function GetParamValueUniteller($key, $defaultValue = null)
{
    if (
        isset($_REQUEST["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_REQUEST)
        || isset($_POST["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_POST)
        || isset($_GET["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_GET)
        || isset($_SESSION["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_SESSION)
        || isset($_COOKIE["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_COOKIE)
        || isset($_SERVER["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_SERVER)
        || isset($_ENV["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_ENV)
        || isset($_FILES["SALE_CORRESPONDENCE"]) || array_key_exists("SALE_CORRESPONDENCE", $_FILES)
        || isset($_REQUEST["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_REQUEST)
        || isset($_POST["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_POST)
        || isset($_GET["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_GET)
        || isset($_SESSION["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_SESSION)
        || isset($_COOKIE["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_COOKIE)
        || isset($_SERVER["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_SERVER)
        || isset($_ENV["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_ENV)
        || isset($_FILES["SALE_INPUT_PARAMS"]) || array_key_exists("SALE_INPUT_PARAMS", $_FILES)
        )
    {
        throw new \Bitrix\Main\SystemException('SALE_CORRESPONDENCE or SALE_INPUT_PARAMS were defined in superglobal variable!');
    }

    if($key === "BASKET_ITEMS" && isset($GLOBALS["SALE_INPUT_PARAMS"]["BASKET_ITEMS"]))
    {
        return $GLOBALS["SALE_INPUT_PARAMS"]["BASKET_ITEMS"];
    }
    elseif($key === "TAX_LIST" && isset($GLOBALS["SALE_INPUT_PARAMS"]["TAX_LIST"]))
    {
        return $GLOBALS["SALE_INPUT_PARAMS"]["TAX_LIST"];
    }

    if(!isset($GLOBALS["SALE_CORRESPONDENCE"]) || !is_array($GLOBALS["SALE_CORRESPONDENCE"]))
        return false;

    if(!isset($GLOBALS["SALE_INPUT_PARAMS"]) || !is_array($GLOBALS["SALE_INPUT_PARAMS"]))
        return false;


    if (!isset($GLOBALS["SALE_CORRESPONDENCE"]) || !is_array($GLOBALS["SALE_CORRESPONDENCE"]))
        return False;

    if (!array_key_exists($key, $GLOBALS["SALE_CORRESPONDENCE"]))
        return False;
    /*
    if(!array_key_exists($key, $GLOBALS["SALE_CORRESPONDENCE"]))
    {
        if($defaultValue !== null)
            return $defaultValue;

        $message = GetMessage("SKGPSA_ERROR_NO_KEY", array(
            "#KEY#" => $key,
            "#ORDER_ID#" => $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"],
            "#PS_ID#" => $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["PAY_SYSTEM_ID"]
        ))." (".__METHOD__.")";

        self::alarm( $key, $message );
        throw new \Bitrix\Main\SystemException($message, self::GET_PARAM_VALUE);
    }
    */
    $type = $GLOBALS["SALE_CORRESPONDENCE"][$key]["TYPE"];
    $value = $GLOBALS["SALE_CORRESPONDENCE"][$key]["VALUE"];

    if (strlen($type) > 0)
    {
        if (array_key_exists($type, $GLOBALS["SALE_INPUT_PARAMS"])
            && is_array($GLOBALS["SALE_INPUT_PARAMS"][$type])
            && array_key_exists($value, $GLOBALS["SALE_INPUT_PARAMS"][$type]))
        {
            $res = $GLOBALS["SALE_INPUT_PARAMS"][$type][$value];
        }
        elseif ($type == "SELECT" || $type == "RADIO" || $type == "FILE")
        {
            $res = $GLOBALS["SALE_CORRESPONDENCE"][$key]["VALUE"];
        }
        else
        {
            $res = False;
        }
    }
    else
    {
        $res = $value;
    }

    return $res;
}

//Получение статуса партнер
AddEventHandler("form", "onAfterResultStatusChange", "changeStatus");
function changeStatus($WEB_FORM_ID, $RESULT_ID, $NEW_STATUS_ID, $CHECK_RIGHTS)
{

    if ($WEB_FORM_ID == 6){

        //задаем переменные
        $acceptStatusID = 6; //ИД статуса принятия
        $rejectStatusID = 7; //ИД статуса отказа

        $arField = array();
        $arAnwer = array();
        $by = Array();
        $order = Array();
        $userGroups = Array();

        //информация о заявке
        $res = CFormResult::GetByID($RESULT_ID);
        $data = $res->Fetch();

        $userID = $data['USER_ID']; //ID пользователя
        $currentStatusID = $data['STATUS_ID'];

        if ($currentStatusID == $acceptStatusID)
        {
            //информация о полях заявки
            $usrAnw = CFormResult::GetDataByID($RESULT_ID, array(), $arField, $arAnwer);
            $groupIDs = $usrAnw['GID'][0]['USER_TEXT']; //получить ID групп в заявке

            //получить список разрешенных групп (признак partners_*)
            $filter = Array('ID'=>$groupIDs, 'ACTIVE' => 'Y', 'ADMIN' => 'N', 'STRING_ID' => 'partners_%');
            $res = CGroup::GetList($by, $order, $filter, 'N');
            while($data = $res->Fetch())
            {
                $userGroups[] = $data['ID'];
            }

            //добавить пользователя к группам
            if (count($userGroups)){
                global $USER;

                $arUser["WORK_COMPANY"] = $usrAnw['ORG_NAME'][0]['USER_TEXT'];
                $arUser["WORK_CITY"] = $usrAnw['CITY'][0]['USER_TEXT'];
                $arUser["WORK_PHONE"] = $usrAnw['PHONE'][0]['USER_TEXT'];
                $arUser["GROUP_ID"] = array_merge($userGroups, $USER->GetUserGroup($userID));

                //print_r($arUser);
                $USER->Update($userID, $arUser);

                $arUser = $USER->GetByID($userID)->fetch();
                if(!empty($arUser['EMAIL'])){
                    $arMailParams = Array(
                        'USERS_MAIL' => $arUser['EMAIL']
                    );
                    $id = CEvent::Send('PARTNER_ACCEPTED', 's1', $arMailParams);
                }
            }
        }elseif($currentStatusID == $rejectStatusID){
            global $USER;
            $arUser = $USER->GetByID($userID)->fetch();
            if(!empty($arUser['EMAIL'])){
                $arMailParams = Array(
                    'USERS_MAIL' => $arUser['EMAIL']
                );

                $id = CEvent::Send('PARTNER_REJECTED', 's1', $arMailParams);
            }
        }
    }
}

//добавление заявки на монтаж
//добавление предложения на заявку
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("OrderManager", "prepare"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("OrderManager", "uprepare"));

AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("OrderManager", "OnSuccessElementAdd"));
AddEventHandler("iblock", "OnAfterIBlockElementDelete", Array("OrderManager", "OnSuccessElementDelete"));

class OrderManager
{
    //ИБ ИД
    const IB_OFFERS_ID = 136;
    const IB_ORDERS_ID = 135;
    const UF_TABLE_NAME = 'b_uts_iblock_135_section';
    const IB_LIC_ID = 139;
    const IB_GAL_ID = 138;

    //Свойства
    const ORDER_OFFERS_COUNT = 3657; //Предложения(счетчик) заявки
    const ORDER_OFFERS_LINK    = 3662; //ID свойства связки
    const ORDER_STATUS = 3655; //Статус заявки
    const ORDER_TO = 3656; //Адресат заявки
    const ORDER_CITY = 3650; //Город

    const OFFERS_DEVICE_LIST = 3661; //Список ID товаров через запятую
    const OFFERS_DEVICE_HTML = 3668; //Форматированный ХТМЛ-код товаров


    //Статусы
    const NEW_STATUS = 3701;

    //protected static $_uid = false;
    //protected static $_uGroups = false;

    function uprepare(&$arParams){
        if($arParams['IBLOCK_ID'] == self::IB_OFFERS_ID )
            self::_prepareDevice($arParams);
    }

    function prepare(&$arParams){
        global $USER;

        $_uid = $USER->IsAuthorized() ? $USER->GetID() : false;
        $_uGroups = $_uid ? $USER->GetUserGroupArray() : false;

        //Если запись в ПРЕДЛОЖЕНИЯ
        if($arParams['IBLOCK_ID'] == self::IB_OFFERS_ID )
        {
            $orderID = (int) $arParams['PROPERTY_VALUES'][self::ORDER_OFFERS_LINK];
            //echo $orderID, ' - ', $_uid, ' - ', print_r($_uGroups);
            echo $orderID;
            //Проверить может ли пользователь делать предложение на заявку
            if ($orderID &&    $_uid && is_array($_uGroups) &&    self::_accessToOrder($orderID, $_uGroups, $_uid))
            {
                //принять ID товаров предложения и привести их HTML вид, заодно провалидировать
                self::_prepareDevice($arParams);

                //добавить текущую заявку в поле предложений заявки
                self::_addToOffersCounter($orderID, $_uid);

                $arParams['NAME'] = $orderID;
            }
            //генерировать исключение или просто die
            else die('Ошибка доступа к заявке');
        }
        //Если в ЗАЯВКИ
        elseif($arParams['IBLOCK_ID'] == self::IB_ORDERS_ID ){
            $arParams['PROPERTY_VALUES'][self::ORDER_STATUS] = self::NEW_STATUS;
        }
    }

    /** Может ли пользователь оставлять ПРЕДЛОЖЕНИЯ на заявку: true / false **/
    protected static function _accessToOrder($orderID, $_uGroups, $uid)
    {
        global $DB;
        $access = false;

        //найдем разделы заявки с указанным ID
        $sql = 'SELECT    `se`.`IBLOCK_ELEMENT_ID`,
                        `s`.`NAME`,
                        `u`.`UF_GROUP_ID`
                FROM `b_iblock_section_element` as `se`
                JOIN  `b_iblock_section` as `s` ON `s`.`ID` = `se`.`IBLOCK_SECTION_ID`
                JOIN  `'.self::UF_TABLE_NAME.'` AS `u` ON  `s`.`ID` = `u`.`VALUE_ID`
                WHERE `se`.`IBLOCK_ELEMENT_ID` = '.$orderID;

        $res = $DB->Query($sql);
        echo 1;
        //нашли?
        if ($res->SelectedRowsCount())
        {
            echo 2;
            $sres = CIBlockElement::GetProperty(self::IB_ORDERS_ID, $orderID, Array(),Array('ID' => self::ORDER_TO));
            $props = $sres->fetch();
            if(!empty($props['VALUE']))
                if($uid == $props['VALUE']) $access = true;
                else $access = false;
            else {
                //сравнить группы раздела элемента с пользовательскими группами
                while ($row = $res->fetch()) {
                    if ($row['VALUE'] == $uid) {
                        $access = true;
                        break;
                    }
                    if (in_array($row[UF_GROUP_ID], $_uGroups)) {
                        $access = true;
                        break;
                    }
                }
            }
        }
        return $access;
    }

    protected static function _prepareDevice(&$arParams)
    {

        $str = trim($arParams['PROPERTY_VALUES'][self::OFFERS_DEVICE_LIST]);
        $arDevList = empty($str) ? false : explode(',', $str);

        if($arDevList && is_array($arDevList))
        {
            $acArDevSect = Array();
            $res = CIBlockElement::GetList(    Array(),
                Array('ID' => $arDevList),
                false,
                false,
                Array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'IBLOCK_CODE', 'CODE', 'DETAIL_PAGE_URL'));

            while($device = $res->fetch())
            {
                $acArDevList[$device['ID']] = Array(    'NAME'             => $device['NAME'],
                    'URL'             => "/catalog/{$device['IBLOCK_CODE']}/#SECTION_CODE_PATH#/{$device['CODE']}/",
                    'SECTION_ID'    => $device['IBLOCK_SECTION_ID'],
                    'DD'    => $device['DETAIL_PAGE_URL']  );

                $acArDevSect[] = $device['IBLOCK_SECTION_ID'];
            }

            $res = CIBlockSection::GetList(    Array(),
                Array('ID' => $acArDevSect),
                false,
                Array('ID', 'CODE'),
                false );
            while($section = $res->fetch()){
                $arSections[$section['ID']] = $section['CODE'];
            }

            $html = Array();
            $ids = Array();

            foreach($acArDevList as $deviceID => $arDevice){

                $arDevice['URL'] = str_replace('#SECTION_CODE_PATH#', $arSections[$arDevice['SECTION_ID']], $arDevice['URL']);

                $html[] = '<a href="'.$arDevice['URL'].'">'.$arDevice['NAME'].'</a>';
                $ids[] = $deviceID;

            }

            $arParams['PROPERTY_VALUES'][self::OFFERS_DEVICE_LIST] = implode(',', $ids);
            $arParams['PROPERTY_VALUES'][self::OFFERS_DEVICE_HTML] = implode(', ', $html);
        }
    }

    protected static function _addToOffersCounter($orderID, $_uid)
    {
        //получить значение лиц предложений заявки
        $prop = CIBlockElement::GetProperty(self::IB_ORDERS_ID,  $orderID, Array(), Array('ID' => self::ORDER_OFFERS_COUNT));
        $prop = $prop->fetch();

        //получаем список лиц подавших предложения на заявку
        $users = empty($prop['VALUE']) ? Array() : explode(',', $prop['VALUE']);

        //если нет в списке добавляем и сохраняем
        if(!in_array($_uid, $users)){
            $users[] = $_uid;
            $value = implode(',', $users);
            CIBlockElement::SetPropertyValuesEx($orderID, self::IB_ORDERS_ID, Array(self::ORDER_OFFERS_COUNT => $value));
        }
    }

    function OnSuccessElementAdd(&$arFields)
    {
        //если записались в ПРЕДЛОЖЕНИЯ
        if($arFields['IBLOCK_ID'] == self::IB_OFFERS_ID)
        {
            global $USER;
            require($_SERVER['DOCUMENT_ROOT'].'/partner/rating.class.php');
            $rating = new Rating($arFields['CREATED_BY']);
            $_uid = $arFields['CREATED_BY'];

            //обновить рейтинг по ПРЕДЛОЖЕНИЯМ
            $rating->addOffersRating();
            resetUserCache($_uid);

            $orderID = $arFields['PROPERTY_VALUES'][3662];

            $order = CIBlockElement::GetByID($orderID)->fetch();
            $orderUser = CUser::GetByID($order['CREATED_BY'])->fetch();
            //$emails[] = $USER->GetEmail();
            $emails[] = $orderUser['EMAIL'];

            $arMailParams = Array(
                'USERS_MAIL' => $emails,
                'ORDER_ID'   => $orderID,
                'OFFER_TEXT' => $arFields['DETAIL_TEXT'],
                'OFFER_URL'  => '/requests/?o=offers&a=list&id='.$orderID
            );

            $id = CEvent::Send('PARTNER_NEW_OFFER', 's1', $arMailParams);
        }

        //если записались в ЛИЦЕНЗИИ
        elseif($arFields['IBLOCK_ID'] == self::IB_OFFERS_ID)
        {
            global $USER;
            require($_SERVER['DOCUMENT_ROOT'].'/partner/rating.class.php');
            $rating = new Rating($arFields['CREATED_BY']);

            //пересчитать рейтинг по ПРОФИЛЮ
            $rating->calcPRating(true, true);
            resetUserCache($arFields['CREATED_BY']);
        }

        //Если добавлена в галлерею - сбросить кеш
        elseif($arFields['IBLOCK_ID'] == self::IB_GAL_ID){
            global $USER;
            require($_SERVER['DOCUMENT_ROOT'].'/partner/rating.class.php');
            $rating = new Rating($arFields['CREATED_BY']);

            $rating->setGRating(1);
            resetUserCache($arFields['CREATED_BY']);
        }

        //Новая заявка
        elseif($arFields['IBLOCK_ID'] == self::IB_ORDERS_ID){

            global $USER;
            require($_SERVER['DOCUMENT_ROOT'].'/partner/rating.class.php');

            $rating = new Rating($arFields['CREATED_BY']);

            /*MAIL*/
            //выбрать пользователей подходящих групп и городов
            //print_r($arFields);
            //получить список групп по разделам
            $res = CIBlockSection::GetList(Array(), Array('ID' => $arFields['IBLOCK_SECTION'], 'IBLOCK_ID' => self::IB_ORDERS_ID), false, Array('UF_GROUP_ID'), false);
            while($section = $res->fetch()){
                $groupsIDs[] = $section['UF_GROUP_ID'];
            }
            //AddMessage2Log($groupsIDs);

            //получить список пользователей по городу и группам
            $res = CIBlockPropertyEnum::GetList(Array(), Array('IBLOCK_ID' => self::IB_ORDERS_ID, 'PROPERTY_ID' => self::ORDER_CITY));
            while($city= $res->fetch()){
                $cities[$city['ID']] = $city['VALUE'];
            }

            //print_r($cities);
            $by = '';
            $order ='';

            $userFilter = Array('WORK_CITY' => $cities[$arFields['PROPERTY_VALUES'][self::ORDER_CITY]], 'GROUPS_ID' => $groupsIDs);

            if($arFields['PROPERTY_VALUES'][3755]){ // Если задан конкретный список компаний, то добавляем его для сортировки
                $companyIds = array();
                foreach(explode(';',$arFields['PROPERTY_VALUES'][3755]) as $cid){
                    if($cid)
                        $companyIds[] = $cid;
                }
                $userFilter = array('ID'=>implode(' | ',$companyIds));
            }

            if($arFields["PROPERTY_VALUES"]["3656"])
                $userFilter = array('ID'=>$arFields["PROPERTY_VALUES"]["3656"]);

            $res = CUser::GetList($by,$order, $userFilter, Array('FIELDS'=>Array('EMAIL')));

            while($user = $res->fetch()){
                if (!empty($user['EMAIL']))
                    $emails[] = $user['EMAIL'];
            }

            //AddMessage2Log($emails);

            //сформировать почтовое событие на указанные адреса пользователей
            $arMailParams = Array(
                'USERS_MAIL' => $emails,
                'ORDER_ID'   => $arFields['XML_ID'],
                'ORDER_TEXT' => $arFields['DETAIL_TEXT'],
                'ORDER_URL'  => '/requests/?o=orders&a=get&id='.$arFields['XML_ID'].'&v=1'
            );
            $id = CEvent::Send('PARTNER_NEW_ORDER', 's1', $arMailParams);
        }
        unset($rating);
    }

    function OnSuccessElementDelete($arFields)
    {

    }
} //end class

AddEventHandler("main", "OnAfterUserLogin", Array("UserManager", "OnAfterUserLoginHandler"));
class UserManager{
    public function OnAfterUserLoginHandler(&$fields)
    {

    }
}

function resetUserCache($userID)
{
    $cache = new CPHPCache();
    $cache_id = 'partner'.$userID;
    $cache_path = '/partnerplus/partnerlist/';
    $cache->Clean($cache_id, $cache_path);
}

//Обновление Рейтинга профиля пользователя
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{
        CModule::IncludeModule("iblock");
        $IB_LIC_ID = 139;
        //Если изменяются поля относящиеся к рейтингу - пересмотреть и пересчитать
        $res = CIBlockElement::GetList(Array("created" => "desc"),
            Array("IBLOCK_ID" => $IB_LIC_ID,
                "CREATED_BY" => $arFields['ID'],
            ),
            false,
            Array("nPageSize" => 1),
            Array("ID"));

        $cert = $res->SelectedRowsCount() ? true : false;

        global $USER;
        $arUser = $USER->GetByID($arFields['ID'])->fetch();

        $logo = false;
        if (!isset($arFields['WORK_LOGO']))
            if (!empty($arUser['WORK_LOGO'])) $logo = true;
            elseif ($arFields['WORK_LOGO']['del'] != 'Y' && $arFields['WORK_LOGO']['old_id'])
                $logo = true;

        $phone = $arUser['WORK_PHONE'] ? true : false;
        $profile = $arUser['WORK_PROFILE'] ? true : false;


        //echo '<br>cert: ', $cert ? 'ok':'fail', '<br>logo: ', $logo ? 'ok':'fail', '<br>phone: ', $phone ? 'ok':'fail', '<br>work_profile: ', $profile ? 'ok':'fail';

        $arFields['UF_P_RATING'] = ($cert && $logo && $phone && $profile) ? 1 : 0;

        $arFields['UF_R_RATING'] = isset($arFields['UF_R_RATING']) ? $arFields['UF_R_RATING'] : $arUser['UF_R_RATING'];
        $arFields['UF_P_RATING'] = isset($arFields['UF_P_RATING']) ? $arFields['UF_P_RATING'] : $arUser['UF_P_RATING'];
        $arFields['UF_F_RATING'] = isset($arFields['UF_F_RATING']) ? $arFields['UF_F_RATING'] : $arUser['UF_F_RATING'];
        $arFields['UF_O_RATING'] = isset($arFields['UF_O_RATING']) ? $arFields['UF_O_RATING'] : $arUser['UF_O_RATING'];
        $arFields['UF_G_PROFILE'] = isset($arFields['UF_G_PROFILE']) ? $arFields['UF_G_PROFILE'] : $arUser['UF_G_PROFILE'];

        $rRating = explode('/', $arFields['UF_R_RATING']);

        $totalRating = 0;
        $totalRating += $arFields['UF_P_RATING'] > 0 ? 1 : 0;
        $totalRating += $arFields['UF_F_RATING'] > 0 ? 1 : 0;
        $totalRating += $arFields['UF_O_RATING'] > 0 ? 1 : 0;
        $totalRating += $arFields['UF_G_PROFILE'] > 0 ? 1 : 0;
        $totalRating += $rRating[0] / $rRating[1] > 3.5 ? 1 : 0;

        $arFields['UF_RATING'] = $totalRating;
        $arFields['ADMIN_NOTES'] = $totalRating;

        //echo '<pre>', print_r($arFields), '</pre>';
        //die('INIT DIE: OnBeforeUserUpdateHandler');
}

//удалить закешированные данные пользователя
AddEventHandler("main", "OnAfterUserUpdate", "OnAfterUserUpdateHandler");
function OnAfterUserUpdateHandler(&$arFields)
{
    $cache = new CPHPCache();
    $cache_id = 'partner'.$arFields['ID'];
    $cache_path = '/partnerplus/partnerlist/';
    $cache->Clean($cache_id, $cache_path);
}


?>
<?
function my_crop($text, $length, $clearTags = true)
{
$text = trim($text);
if ($clearTags === true)
$text = strip_tags($text);
if ($length <= 0 || strlen($text) <= $length)
return $text;
$out = mb_substr($text, 0, $length);
$pos = mb_strrpos($out, ' ');
if ($pos)
$out = mb_substr($out, 0, $pos);
return $out.'...';
}
?>
<?
AddEventHandler("subscribe", "BeforePostingSendMail", array("SubscribeHandlers", "BeforePostingSendMailHandler"));

class SubscribeHandlers
{
    function BeforePostingSendMailHandler($arFields)
    {
        $rsSub = CSubscription::GetByEmail($arFields["EMAIL"]);
        $arSub = $rsSub->Fetch();

        $arFields["BODY"] = str_replace("#MAIL_ID#", $arSub["ID"], $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#MAIL_MD5#", SubscribeHandlers::GetMailHash($arFields["EMAIL"]), $arFields["BODY"]);

        return $arFields;
    }

    function GetMailHash($email)
    {
        return md5(md5($email) . MALSEC_TEKOS);
    }
}
?><?
                AddEventHandler("main", "OnPageStart", "ShowResizer2Head", 50);
                function ShowResizer2Head()
                {
                    global $APPLICATION;
                    if(substr_count($APPLICATION->GetCurDir(), "/bitrix/") == 0)
                    {
                        if( CModule::IncludeModule("yenisite.resizer2") )
                            CResizer2::ShowResizer2Head();
                        else
                            return;
                    }
                }
                    ?><?
            AddEventHandler("main", "OnEndBufferContent", "replaceResizer2Content");
            function replaceResizer2Content($content){
                if( CModule::IncludeModule("yenisite.resizer2") && !CSite::InDir("/bitrix/")){
                    $resize_class = COption::GetOptionString("yenisite.resizer2", "resize_class", "");
                    $resize_class_classname = COption::GetOptionString("yenisite.resizer2", "resize_class_classname", "");
                    $resize_class_set_small = COption::GetOptionString("yenisite.resizer2", "resize_class_set_small", "");
                    $resize_class_set_big = COption::GetOptionString("yenisite.resizer2", "resize_class_set_big", "");
                    $resize_wm = COption::GetOptionString("yenisite.resizer2", "resize_wm", "");
                    $resize_wm_set = COption::GetOptionString("yenisite.resizer2", "resize_wm_set", "");

                    if($resize_class == "Y" && $resize_class_classname && $resize_class_set_small){
                        $content = CResizer2Resize::imgTagClassResize($resize_class_classname, $content, $resize_class_set_small, $resize_class_set_big);
                    }

                    if($resize_wm == "Y" && $resize_wm_set ){
                        $content =  CResizer2Resize::imgTagWH($content, $resize_wm_set);
                    }

                }
            }
            ?><?
/*
For component informunity:feedback
*/
include_once('/home/bitrix/www/bitrix/components/informunity/feedback/attach/add_event_handler.php');

function show_slider($media_id, $slide_width, $slide_height, $slide_zoom_height = "", $slide_zoom_width = "") {
    CModule::IncludeModule("fileman");
    CMedialib::Init();
    $arElements = CMedialibItem::GetList(array("arCollections"=>array($media_id)));
    $max_h = 0;
    $max_w = 0;
    $max_z_w = 0;
    $max_z_h = 0;
    foreach($arElements as $arElement)
    {
            $pic = CFile::ResizeImageGet($arElement,array("width"=>$slide_width,"height"=>$slide_height),BX_RESIZE_IMAGE_PROPORTIONAL,true);
            $pic1 = CFile::ResizeImageGet($arElement,array("width"=>$slide_zoom_width,"height"=>$slide_zoom_height),BX_RESIZE_IMAGE_PROPORTIONAL,true);
            $arResult["ELEMENTS"][] = array(
                    "PREVIEW_PICTURE"=>array(
                            "SRC"=>$pic["src"] ? $pic["src"] : $arElement["PATH"],
                            "WIDTH"=>$pic["width"],
                            "HEIGHT"=>$pic["height"]
                    ),
                    "DETAIL_PICTURE"=>array(
                            "SRC"=>$pic1["src"] ? $pic1["src"] : $arElement["PATH"],
                            "WIDTH"=>$pic1["width"],
                            "HEIGHT"=>$pic1["height"]
                    ),
                    "DESCRIPTION" => $arElement["DESCRIPTION"]
            );
            if($max_h<$pic["height"])
                    $max_h = $pic["height"];
            if($max_w<$pic["width"])
                    $max_w = $pic["width"];
            if($max_z_h<$pic1["height"])
                    $max_z_h = $pic1["height"];
            if($max_z_w<$pic1["width"])
                    $max_z_w = $pic1["width"];

            $left_offcet = 0;
            if (count($arElements) > 3) $left_offcet = -($slide_width + 11)."px";

    }
    echo '<div class="mc_slider_wrap" style="width: '.(($slide_width+ 11) * 3 ) .'px;height: '.($slide_height + 11).'px;position: relative;">';
    echo '<div style="width: '.(($slide_width+ 11) * 3 ) .'px;height: '.($slide_height + 11).'px;overflow: hidden;position: relative;">';
    echo '<div class="mc_slider" style="position: absolute;top: 0;left: '.$left_offcet.';width: '.($slide_width + 11)*  count($arResult["ELEMENTS"]).'px;">';
    foreach ($arResult["ELEMENTS"] as $one_pic){
        echo '<a class="gallery" rel="group" title="'.$one_pic["DESCRIPTION"].'" href="'.$one_pic["DETAIL_PICTURE"]["SRC"].'"><img src="'.$one_pic["PREVIEW_PICTURE"]["SRC"].'" /></a>';
    }
    echo '</div></div>';
    echo '<a href="javascript:void(0);" class="mc_prev" style="background: url(/bitrix/components/aprof/lenta_zoom/templates/.default/images/arrows.png) no-repeat scroll 0 0 transparent;
height: 42px;
left: -23px;
margin-top: -30px;
position: absolute;
top: 50%;
width: 20px;
z-index: 60;"></a>';
    echo '<a href="javascript:void(0);" class="mc_next" style="background: url(/bitrix/components/aprof/lenta_zoom/templates/.default/images/arrows.png) no-repeat scroll -20px 0 transparent;
height: 42px;
margin-top: -30px;
position: absolute;
right: -18px;
top: 50%;
width: 20px;
z-index: 60;"></a>';
    echo '</div>';
}



AddEventHandler("catalog", "OnBeforeProductAdd", "OnBeforeIBlockElement");
AddEventHandler("catalog", "OnBeforeProductUpdate", "OnBeforeIBlockElement");
function OnBeforeIBlockElement($ID, $arFields = false)
{
if(is_array($ID))
{
$arFields = $ID;
$IS_AVAILABLE = $arFields["QUANTITY"] > 0? 1: 0;
$ELEMENT_ID = $arFields["ID"];
CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array("IS_AVAILABLE" => $IS_AVAILABLE));
}
elseif(is_int($ID) && is_array($arFields) && isset($arFields["QUANTITY"]))
{
$IS_AVAILABLE = $arFields["QUANTITY"] > 0? 1: 0;
$ELEMENT_ID = $ID;
CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array("IS_AVAILABLE" => $IS_AVAILABLE));
}
}


if(!function_exists("getImgById")){
function getImgById($id){
    return CFile::GetFileArray( $id );
}
}

if(!function_exists("getResizedImgById")){
function getResizedImgById($id, $w, $h, $mode = 'RESIZE'){
    $img = getImgById($id);

    $arFilter = '';
    $arFileTmp = CFile::ResizeImageGet(
    $img,
    array("width" => $w, "height" => $h),
    ($mode=='CROP')?BX_RESIZE_IMAGE_EXACT:BX_RESIZE_IMAGE_PROPORTIONAL,
    true, $arFilter
    );

    return $arFileTmp;
}
}

if(!function_exists("getResizedImgWatermark")){
function getResizedImgWatermark($id, $w, $h, $wm=''){
    $img = getImgById($id);

    $arFileTmp = CFile::ResizeImageGet(
    $img,
    array("width" => $w, "height" => $h),
    BX_RESIZE_IMAGE_PROPORTIONAL,
    true,
    $wm
    );

    return $arFileTmp;
}
}


function cropStr($str, $size){
  if(strlen($str)<$size) return $str;
  $ret = mb_substr($str,0,mb_strrpos(mb_substr($str,0,$size,'utf-8'),' ','utf-8'),'utf-8');
  if(strlen($ret)!=strlen($str)) $ret .= "...";
  return $ret;
}





// Уведомление о длительном отсутствии предложений
function noOfferMsg($requestID, $user){

    $rsUser = CUser::GetByID($user);
    $arUser = $rsUser->Fetch();
    //echo 'Сообщение о простаивании завяки номер '.$requestID;
    $messArr = array(
        "EMAIL" => $arUser["EMAIL"],
        "rnum" => $requestID
    );

    CEvent::Send("NO_REQUEST_OFFER", "s1", $messArr);
    // Выставляем метку что пользователь уведомлен
    CIBlockElement::SetPropertyValueCode($requestID, "NO_REQUEST", "1");

}




// Проверка заявок на отсутствие предложений за последние 3 дня
function checkRequestOld(){ // Вызываем функцию когда это требуется


    $requests = array();
    // Выбираем открытые заявки клиента давностью более 3 дней
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>135/*, "PROPERTY_ORDER_TO"=>$USER->GetID()*/, "<PROPERTY_REQUEST_DATE"=>date("Y-m-d", time()-86400*3), ">PROPERTY_REQUEST_DATE"=>date("Y-m-d", time()-86400*10), "PROPERTY_NO_REQUEST"=>false, "ACTIVE"=>"Y"), false, false, array("ID", "PROPERTY_ORDER_TO", "CREATED_BY"));
    while($row = $res->fetch())
    {
        $requests[$row["ID"]] = $row;
    }

    // Определяем, есть ли у нас предложения к этим заявкам
    $offerlist = array();
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>136, "PROPERTY_OFFER_ORDER_ID"=>$requests, "ACTIVE"=>"Y"), false, false, array("PROPERTY_OFFER_ORDER_ID"));
    while($row = $res->fetch())
    {
        if($requests[$row["PROPERTY_OFFER_ORDER_ID_VALUE"]])
            unset($requests[$row["PROPERTY_OFFER_ORDER_ID_VALUE"]]);
    }


    foreach($requests as $req)
        noOfferMsg($req["ID"], $req["CREATED_BY"]);

    return "checkRequestOld();";
}

function rateRequestMessage($requestID, $user){

    $rsUser = CUser::GetByID($user);
    $arUser = $rsUser->Fetch();
    //echo 'Сообщение о простаивании завяки номер '.$requestID;
    $messArr = array(
        "EMAIL" => $arUser["EMAIL"],
        "rnum" => $requestID
    );

    //mail('pashchok@yandex.ru', 'Попытка отправить уведомление об оценке', json_encode($messArr));
    //return;

    CEvent::Send("NO_REQUEST_RATE", "s1", $messArr);
    // Выставляем метку что пользователь уведомлен
    CIBlockElement::SetPropertyValueCode($requestID, "NO_RATE", "1");

}


// Проверка оценки завершенных заявок
function assessFinishedRequest(){

    checkRequestOld();

    // Выбираем завершенные заявки клиента давностью более 3 дней, на которые нет оценки
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>135, "PROPERTY_ORDER_STATUS"=>"3699", "PROPERTY_rating"=>false, "<PROPERTY_REQUEST_DATE"=>date("Y-m-d", time()-86400*3), ">PROPERTY_REQUEST_DATE"=>date("Y-m-d", time()-86400*10), "PROPERTY_NO_RATE"=>false, "ACTIVE"=>"Y"), false, false, array("ID", "PROPERTY_ORDER_TO", "CREATED_BY"));
    while($row = $res->fetch())
    {
        $requests[$row["ID"]] = $row;
    }

    // Заставляем пользователя всё это дело оценить по почте
    if($requests)
        foreach($requests as $req)
            rateRequestMessage($req["ID"], $req["CREATED_BY"]);

    return "assessFinishedRequest();";
}


// Отправка сообщения о принятии предложения
function requestAcceptMsg($requestID, $userID, $olink){

    CModule::IncludeModule("iblock");
    if($_SESSION["accept_rq_".$requestID]) return;

    $rsUser = CUser::GetByID($userID);
    $arUser = $rsUser->Fetch();
    $messArr = array(
        "EMAIL" => $arUser["EMAIL"],
        "rnum" => $requestID,
        "olink" => $olink
    );

    $_SESSION["accept_rq_".$requestID] = true;
    CEvent::SendImmediate("ACCEPT_REQUEST", "s1", $messArr);

    // Получим список всех предложений к заявке, чтобы потом отправить остальным отказ
    $ofList = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>136, "PROPERTY_OFFER_ORDER_ID"=>$requestID), false, false, array("ID", "CREATED_BY"));
    $declineList = array();
    while($ofItem = $ofList->fetch()){
        $rsUser = CUser::GetByID($ofItem["CREATED_BY"]);
        $arUser = $rsUser->Fetch();
        if($arUser["ID"]!=$userID) $declineList[] = $arUser["EMAIL"];
    }

    //AddMessage2Log($declineList);

    if($declineList){
        $messArr = array(
            "EMAIL" => $declineList,
            "rnum" => $requestID,
            "olink" => $olink
        );
        AddMessage2Log($messArr);
        CEvent::SendImmediate("DECLINE_REQUEST", "s1", $messArr);
    }
}


AddEventHandler("forum", "onAfterMessageAdd", "onAfterMessageAddHandler");
function onAfterMessageAddHandler($ID){
    $arMessage = CForumMessage::GetByID($ID);

    if($arMessage["FORUM_ID"]==10):

        $oid = $arMessage["PARAM2"];

        CModule::IncludeModule("iblock");

        // Получаем предложение и исполнителя вместе с ней
        $res = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>136, "ID"=>$oid), false, false, array("CREATED_BY", "PROPERTY_OFFER_ORDER_ID"));
        if($row = $res->fetch())
        {
            $worker = $row["CREATED_BY"];
            $order = $row["PROPERTY_OFFER_ORDER_ID_VALUE"];
        }

        // Получаем предложение и заказчика
        $res = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>135, "ID"=>$order), false, false, array("ID", "CREATED_BY"));
        if($row = $res->fetch())
        {
            $creator = $row["CREATED_BY"];
        }

        $sendUrl = "";
        if($arMessage["AUTHOR_ID"]==$creator){
            $sendUsr = $worker;
            $sendUrl = "http://teko-shop.ru/requests/?o=orders&a=get&id=".$row["ID"]."&v=1&view=Y&CODE=".$oid."&MID=".$ID."#message".$ID;
        }
        elseif($arMessage["AUTHOR_ID"]==$worker){
            $sendUsr = $creator;;
            $sendUrl = "http://teko-shop.ru/requests/?o=offers&a=list&oid=".$oid."&MID=".$ID."#message".$ID;
        }

        if(!$sendUsr) return;

        global $USER;
        $arUser = $USER->GetByID($sendUsr)->fetch();

        CEvent::SendImmediate("NEW_TASK_COMMENT", "s1", array("message"=>$arMessage["POST_MESSAGE"], "EMAIL"=>$arUser["EMAIL"], "url"=>$sendUrl));

    endif;
}


AddEventHandler("catalog", "OnGetOptimalPrice", "MyGetOptimalPrice");

function MyGetOptimalPrice(
    $intProductID,
    $quantity = 1,
    $arUserGroups = array(),
    $renewal = "N",
    $arPrices = array(),
    $siteID = false,
    $arDiscountCoupons = false
 ) {




     // Если работаем с акционным товаром, то ему ставим текущую цену
     global $recalcAucPrice; // Пересчет для аукционного товара(либо при добавлении, либо внутри корзины, если там реально аукционный)
     global $tAucData;
     if($tAucData["CURRENT_PRODUCT"]["ID"] && $intProductID==$tAucData["CURRENT_PRODUCT"]["ID"] && $recalcAucPrice){
          return array(
              'PRICE' => array(
                  'CATALOG_GROUP_ID' => 1,
                  'PRICE' => $tAucData["CURRENT_PRODUCT"]["PRICE"],
                  'CURRENCY' => "RUB",
              )
          );
     }


    // Определение цены при добавлении в корзину
    $bAdd2BasketAspro = isset($_REQUEST['add_item']) && $_REQUEST['add_item'] === 'Y' && isset($_REQUEST['item']) && $intProductID == $_REQUEST['item'];
    $bSaleOrderAjax = $_REQUEST && isset($_REQUEST['action']) && $_REQUEST['action'] == 'refreshOrderAjax';
    $bBasketAjax = $_REQUEST && isset($_REQUEST['action']) && $_REQUEST['action'] == 'recalculate';
    $action = $_REQUEST["action"] ? htmlspecialcharsbx($_REQUEST["action"]) : "";
    $id = $_REQUEST["id"] ? intval($_REQUEST["id"]) : 0;
    global $GROUP_POLICY; // В корзине, увы, тоже пересчет
    if( $bAdd2BasketAspro || $bSaleOrderAjax || $bBasketAjax || ( ($action=="ADD2BASKET" || $action=="mc_add_element" ||  $action == 'refreshOrderAjax') && $id && $intProductID==$id) || $GROUP_POLICY){ // Если товар, добавляемый в корзину, то делаем расчет цены для него


            $priceTypes = array(); // Конечный набор типов цен для расчета

            // Получаем все цены для этого товара
            $allPrices = array();
            $res = CPrice::GetList(array(),array("PRODUCT_ID" => $intProductID));
            while($row=$res->fetch()){
                $allPrices[] = $row;
            }

            $pricesOptions = unserialize(COption::GetOptionString("tireos.prices", "NA_PRICES", array()));

            // Определим производителя
            $res = CIBlockElement::GetList(array(),array("ID"=>$intProductID),false,false,array("IBLOCK_ID","PROPERTY_PROIZVODITEL"));
            if($row=$res->fetch()){
                $mf = $row["PROPERTY_PROIZVODITEL_ENUM_ID"];
                $ib = $row["IBLOCK_ID"];
            }

            // Если пользователь неавторизованный, то выдернем настройки модуля и определим, из каких цен брать
            global $USER;
            if($USER->IsAuthorized()){

                if($pricesOptions[$ib]["A_MF_PRICES"][$mf]){
                    $priceTypes = $pricesOptions[$ib]["A_MF_PRICES"][$mf];
                }

            }else{

                // Если есть настройки для этого производителя, то устанавливаем эти типы цен
                if($pricesOptions[$ib]["NA_MF_PRICES"][$mf]){
                    $priceTypes = $pricesOptions[$ib]["NA_MF_PRICES"][$mf];
                }

            }

            // Ищем минимальную из заданных цен
            if($priceTypes){

                global $pricesHasAccess; // Список типов цен, на которые у юзера есть доступ

                // Просто объединяем типы цен, доступные пользователю и определенные из настроек
                $resultPriceTypes = array_intersect($pricesHasAccess,$priceTypes);

                // Ну и ищем среди цен минимальную
                $resultPrice = 0;
                $resultGroup = 0;
                foreach($allPrices as $itemPrice){
                    if( in_array($itemPrice["CATALOG_GROUP_ID"],$resultPriceTypes) && (!$resultPrice || $itemPrice["PRICE"]<$resultPrice) ){
                        $resultPrice = $itemPrice["PRICE"];
                        $resultGroup = $itemPrice["CATALOG_GROUP_ID"];
                    }

                }


                if($resultPrice){

                    return array(
                        'PRICE' => array(
                            'CATALOG_GROUP_ID' => $resultGroup,
                            'PRICE' => $resultPrice,
                            'CURRENCY' => "RUB",
                        )
                    );
                }
            }

            // Если цены не были установлены, то вобщем то ничего не делаем - система посчитает сама


    }

     // Если региональная цена указана - крутим цену в сторону региональной
     $regionPriceID = $_SESSION["regionPriceID"];
     if($regionPriceID){
        $priceList = CPrice::GetList( array(),array("PRODUCT_ID" => $intProductID, "CATALOG_GROUP_ID" => $regionPriceID) );
        if ($priceRow = $priceList->Fetch())
        {
            if(!$priceRow['PRICE'])
                return true;
            return array(
                'PRICE' => array(
                    'CATALOG_GROUP_ID' => $priceRow['CATALOG_GROUP_ID'],
                    'PRICE' => $priceRow['PRICE'],
                    'CURRENCY' => "RUB",
                )
            );

        }
     }


    return true;
 }

// Обрабатываем элементы наборов и уведомляем об отсутствующих
function checkRemovedFromSets(){
    CModule::IncludeModule('iblock');
    // Вытаскиваем все наборы и собираем их элементы
    $setItems = array();
    $setItemsByComplect = array();
    $itemsResult = array("ACTIVE"=>array(),"INACTIVE"=>array(),"REMOVED"=>array());
    $res = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>140,"ACTIVE"=>"Y"),false,false,array("ID","NAME","PROPERTY_SETS_CONTENT","CREATED_BY"));
    while($row=$res->fetch()){
        if($row["PROPERTY_SETS_CONTENT_VALUE"]){
            $setItems[] = $row["PROPERTY_SETS_CONTENT_VALUE"];
            $setItemsByComplect[$row["ID"]][] = $row;
        }
    }

    $res = CIBlockElement::GetList(array(),array("ID"=>$setItems),false,false,array("*","PROPERTY_ARKHIVNAYA_MODEL"));
    while($row=$res->fetch()){
        if($row["ACTIVE"]=="N"){
            $itemsResult["INACTIVE"][] = $row["ID"];
            $itemsResult["INACTIVE_DATA"][$row["ID"]] = $row;
        }else{
            $itemsResult["ACTIVE"][] = $row["ID"];
            $itemsResult["ACTIVE_DATA"][$row["ID"]] = $row;
        }
    }

    // Выводим для теста
    /*if(count($itemsResult["ACTIVE"]))
        echo '<b>Активные позиции:</b><br />';
    foreach($itemsResult["ACTIVE"] as $item){
        echo $item["NAME"].'['.$item["ID"].']<br />';
    }

    if(count($itemsResult["INACTIVE"]))
        echo '<br /><b>Неактивные позиции:</b><br />';
    foreach($itemsResult["INACTIVE"] as $item){
        echo $item["NAME"].'['.$item["ID"].']<br />';
    }*/

    /*?><pre><?print_r($setItemsByComplect);?></pre><?*/

    // Совмещаем полученное в итог
    $userComplects = array();
    foreach($setItemsByComplect as $complectID=>$complect){
        $activeI = array(); $inactiveI = array(); $removedI = array(); $archivedI = array();
        // Перебираем элементы комплекта
        foreach($complect as $complectItem){
            // Ищем в неактивных
            if(in_array($complectItem["PROPERTY_SETS_CONTENT_VALUE"],$itemsResult["INACTIVE"])){
                $inactiveI[] = $itemsResult["INACTIVE_DATA"][$complectItem["PROPERTY_SETS_CONTENT_VALUE"]]; // Неактивные
            } elseif($itemsResult["ACTIVE_DATA"][$complectItem["PROPERTY_SETS_CONTENT_VALUE"]]["PROPERTY_ARKHIVNAYA_MODEL_VALUE"]=="Да") {
                $archivedI[] = $itemsResult["ACTIVE_DATA"][$complectItem["PROPERTY_SETS_CONTENT_VALUE"]]; // Архивные
            } elseif(in_array($complectItem["PROPERTY_SETS_CONTENT_VALUE"],$itemsResult["ACTIVE"])){
                $activeI[] = $itemsResult["ACTIVE_DATA"][$complectItem["PROPERTY_SETS_CONTENT_VALUE"]]; // Активные
            } else {
                $removedI[] = $complectItem["PROPERTY_SETS_CONTENT_VALUE"]; // Несуществующие
            }
        }

        //echo 'Для набора '.$complect[0]["NAME"].'['.$complect[0]["ID"].'] найдены: '.count($activeI).' активных элементов, '.count($inactiveI).' неактивных элементов и '.count($removedI).' удаленных<br /><br />';

        $userComplects[$complect[0]["CREATED_BY"]][] = array("DATA"=>$complect[0],"ACTIVE"=>$activeI,"INACTIVE"=>$inactiveI,"REMOVED"=>$removedI,"ARCHIVED"=>$archivedI);
    }

    /*?><pre><?print_r($userComplects);?></pre><?*/

    // Выводим всё
    $adminMsgText = "";
    foreach($userComplects as $UID=>$uItem){
        $usrSel = CUser::GetByID($uItem[0]["DATA"]["CREATED_BY"]);
        $userInfo = $usrSel->fetch();
        $userMsgText = "";
        //echo '<b>Пользователь '.$UID.' содержит следующие комплекты:</b><br /><br />';
        $find = false;
        foreach($uItem as $uComplect){
            if(count($uComplect["INACTIVE"]) || count($uComplect["REMOVED"]) || count($uComplect["ARCHIVED"]))
                $userMsgText .= "Набор '<b>".$uComplect["DATA"]["NAME"]."</b>', элементы:<br />";
            if(count($uComplect["INACTIVE"]) || count($uComplect["REMOVED"]) || count($uComplect["ARCHIVED"])){
                $adminMsgText .= "[".$userInfo["EMAIL"]."] Набор '<b>".$uComplect["DATA"]["NAME"]."</b>'[".$uComplect["DATA"]["ID"]."], элементы:<br />";
                $find = true;
            }
            //echo '*** '.$uComplect["DATA"]["NAME"].'['.$uComplect["DATA"]["ID"].']<br />';
            if(count($uComplect["INACTIVE"])){
                //echo '****** Элементы, которые были деактивированы: ';
                $adminMsgText .= "Деактивированные => ";
                foreach($uComplect["INACTIVE"] as $ind=>$ucItem){
                    if($ind){
                        $userMsgText .= ", ";
                        $adminMsgText .= ", ";
                    }
                    $userMsgText .= "<b>".$ucItem["NAME"]." (<a href=\"https://teko-shop.ru/personal/sets/?id=".$uComplect["DATA"]["ID"]."\">ссылка</a>)[Неактивен]</b>";
                    $adminMsgText .= "<b>".$ucItem["NAME"]."[".$ucItem["ID"]."]</b>";
                    //echo $ucItem["NAME"].'['.$ucItem["ID"].'], ';
                }
                $userMsgText .= "<br /><br />";
                $adminMsgText .= "<br />";
                //echo '<br />';
            }
            if(count($uComplect["REMOVED"])){
                $adminMsgText .= "Удаленные => ID <b>".implode(',',$uComplect["REMOVED"])."</b>[Удален]<br /><br />";
                /*echo '****** Элементы, которые были удалены: ID '.implode(',',$uComplect["REMOVED"]);
                echo '<br />';*/
            }
            if(count($uComplect["ARCHIVED"])){
                $adminMsgText .= "Архивные => ";
                foreach($uComplect["ARCHIVED"] as $ind=>$ucItem){
                    if($ind){
                        $userMsgText .= ", ";
                        $adminMsgText .= ", ";
                    }
                    $userMsgText .= "<b>".$ucItem["NAME"]." (<a href=\"https://teko-shop.ru/personal/sets/?id=".$uComplect["DATA"]["ID"]."\">ссылка</a>)[В архиве]</b>";
                    $adminMsgText .= "<b>".$ucItem["NAME"]."[".$ucItem["ID"]."]</b>";
                    //echo $ucItem["NAME"].'['.$ucItem["ID"].'], ';
                }
                $userMsgText .= "<br /><br />";
                $adminMsgText .= "<br />";
                /*echo '****** Элементы, которые были удалены: ID '.implode(',',$uComplect["REMOVED"]);
                echo '<br />';*/
            }
            //echo '<br />';
        }

        if($find)
            $adminMsgText .= "<br /><br />";

        //echo '<br />';
        if($userMsgText){
            CEvent::SendImmediate("COMPLECT_USER_SEND",SITE_ID,array("MESSAGE"=>$userMsgText,"EMAIL"=>$userInfo["EMAIL"]));
            $userMsgText = "У Вас обнаружены наборы, требующие корректировки в связи с наличием в них неактивных на сайте товаров:<br /><br />".$userMsgText;
            //echo $userMsgText."<br /><br />";
        }

    }

    if($adminMsgText){
        CEvent::SendImmediate("COMPLECT_ADMIN_SEND",SITE_ID,array("MESSAGE"=>$adminMsgText));
        $adminMsgText = "Были обнаружены наборы, требующие корректировки в связи с наличием в них неактивных/удаленных на сайте товаров:<br /><br />".$adminMsgText;
        //echo $adminMsgText."<br /><br />";
    }

    return "checkRemovedFromSets();";
}

// MODs for SDEK
    // закладка в настройки
AddEventHandler("ipol.sdek", "onTabsBuild", "addTab");
function addTab(&$arTabs){
    $arTabs = array('Дополнительные настройки'=>'/bitrix/modules/ipol.sdek/optionsInclude/special.php');
}
    // настройки бесплатной доставки и величина страховки
AddEventHandler('ipol.sdek', 'onCalculate', 'changeSDEKTerms');
function changeSDEKTerms(&$arResult, $profile, $arConfig, $arOrder){
    //$cities = COption::GetOptionString('ipol.sdek','custom_freeCities',false);
    //if(strpos($cities,",".$arOrder['LOCATION_TO'].",") === false)
        //return;

    // страховка
    $incPrice = COption::GetOptionString('ipol.sdek',"custom_ensurance",false);
    if($arOrder['PRICE'] && $incPrice)
        $arResult['VALUE'] += ($incPrice * $arOrder['PRICE'])/100;

    $pFD = COption::GetOptionString('ipol.sdek',"custom_priceFreeDeliv_$profile",false);

    if($pFD && $pFD <= $arOrder['PRICE'])
        $arResult['VALUE'] = 0;
}
    // смена габаритов
AddEventHandler("ipol.sdek", "onBeforeDimensionsCount", "handleGoods");
function handleGoods(&$arOrderGoods){
    if(!cmodule::includeModule('iblock')) return;
    $prop = COption::GetOptionString('ipol.sdek',"custom_gabProp",false);
    if(!$prop) return;
    // sdekhelper::toLog($arOrderGoods,'$arOrderGoods PRE');
    foreach($arOrderGoods as $key => $arGood){
        $elt = CIBlockElement::GetList(array(),array('ID'=>$arGood['PRODUCT_ID']),false,false,array('ID','PROPERTY_'.$prop))->Fetch();
        if(!$elt['PROPERTY_'.$prop.'_VALUE']){
            $TP = CCatalogSku::GetProductInfo($arGood['PRODUCT_ID']);
            $elt = CIBlockElement::GetList(array(),array('ID'=>$TP['ID']),false,false,array('ID','PROPERTY_'.$prop))->Fetch();
        }
        if($elt['PROPERTY_'.$prop.'_VALUE'] && preg_match('/(\d+)x(\d+)x(\d+)/',$elt['PROPERTY_'.$prop.'_VALUE'],$matches)){
            $arOrderGoods[$key]['DIMENSIONS'] = array(
                "WIDTH"  => $matches[1],
                "HEIGHT" => $matches[2],
                "LENGTH" => $matches[3],
            );
        }
    }
}

AddEventHandler("main", "OnBeforeProlog", "OnBeforePrologHandler");
function OnBeforePrologHandler(){
    // Ищем и устанавливаем пользователей по настройке комплектов ТЕКО
    global $complectUsers;
    $complectUsers = array();
    $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), array("GROUPS_ID"=>array(21)));
    while($usr=$rsUsers->fetch()){
        $complectUsers[] = $usr["ID"];
    }
    // Устанавливаем розничную цену и интернет-магазина(коды)
    //define("PRICE_ROZN","Розн.");
    //define("PRICE_MAGAZ","Д 10%");
    define("PRICE_ROZN",COption::GetOptionString("tireos.prices", "BASE_PRICE", "Розн.")); // COption::GetOptionString("tireos.prices", "BASE_PRICE", 0)
    define("PRICE_MAGAZ","СпЦ 2");

    // Рассчитываем доступные пользователю цены(кэшируем на час)
    global $pricesHasAccess;
    global $USER;

    $obCache = new CPHPCache();
    $cacheLifetime = 3600; $cacheID = 'userPrices/up'.$USER->GetID(); $cachePath = '/'.$cacheID;
    if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
    {
       $vars = $obCache->GetVars();
       $pricesHasAccess = $vars['pricesHasAccess'];
    }
    elseif( $obCache->StartDataCache()  )
    {

        $pricesHasAccess = array();
        $userGroups = CUser::GetUserGroup($USER->GetID());
        foreach($userGroups as $uGroup){
            $priceList = CCatalogGroup::GetGroupsList(array("GROUP_ID"=>$uGroup, "BUY"=>"Y"));
            while($pItem=$priceList->fetch()){
                if(!in_array($pItem["CATALOG_GROUP_ID"],$pricesHasAccess))
                    $pricesHasAccess[] = $pItem["CATALOG_GROUP_ID"];
            }
        }

        $obCache->EndDataCache(array('pricesHasAccess' => $pricesHasAccess));

    }

    // Типы цен сохраняем и кэшируем(кэш 1ч)
    global $allPrices;
    $obCache = new CPHPCache();
    $cacheLifetime = 3600; $cacheID = 'allPrices'; $cachePath = '/'.$cacheID;
    if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
    {
       $vars = $obCache->GetVars();
       $allPrices = $vars['allPrices'];
    }
    elseif( $obCache->StartDataCache()  )
    {

        $allPrices = array();
        $res = CCatalogGroup::GetList(array(),array("ACTIVE"=>"Y"));
        while($row=$res->fetch()){
            $allPrices[$row["ID"]] = $row;
        }

        $obCache->EndDataCache(array('allPrices' => $allPrices));

    }

    // Получим IP
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    define("CURRENT_IP",$ip);



}







// Если при добавлении заказа встречаем аукционный товар, то самому товару надо будет установить время нахождения на аукционе равное текущему
AddEventHandler("sale", "OnBeforeOrderAdd", "OnBeforeOrderAddHandler");
function OnBeforeOrderAddHandler(&$arFields){
    // После добавления устанавливаем время добавления
     global $tAucData; // Аукционный товар
     if($tAucData["CURRENT_PRODUCT"] && $tAucData["AUC_IN_BASKET"]){
        $dbBasketItems = CSaleBasket::GetList(
            array(
                    "NAME" => "ASC",
                    "ID" => "ASC"
                ),
            array(
                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                    "LID" => SITE_ID,
                    "ORDER_ID" => "NULL",
                    "PRODUCT_ID" => $tAucData["CURRENT_PRODUCT"]["ID"]
                ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE",
                  "PRODUCT_ID", "QUANTITY", "DELAY",
                  "CAN_BUY", "PRICE", "WEIGHT")
        );
        if($bask = $dbBasketItems->fetch()){
            // Деактивируем купленный лот
            $el = new CIBlockElement;
            $el->Update($tAucData["AUC_PRODUCT"]["ID"], Array("ACTIVE" => "N"));
            //CIBlockElement::SetPropertyValuesEx($tAucData["AUC_PRODUCT"]["ID"], "", array("INTERVAL_LENGTH"=>$tAucData["CURRENT_PRODUCT"]["TIMEFROMSTART"]));

            $bs = new CIBlockSection;
            $res = $bs->Update($tAucData["AUC_ITEM"]["ID"], array("UF_LAST_BUY"=>date("d.m.Y H:i:s", time())));
        }

    }

    return $arFields;
}

// При добавлении в корзину - если есть аукционный товар, то удаляем его
AddEventHandler("sale", "OnBeforeBasketAdd", "OnBeforeBasketAddHandler");
function OnBeforeBasketAddHandler(&$arFields){
    global $tAucData; // Аукционный товар
    if($tAucData["CURRENT_PRODUCT"] && $tAucData["AUC_IN_BASKET"]){
        $dbBasketItems = CSaleBasket::GetList(
            array(),
            array(
                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                    "LID" => SITE_ID,
                    "ORDER_ID" => "NULL",
                    "PRODUCT_ID" => $tAucData["CURRENT_PRODUCT"]["ID"]
                ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE",
                  "PRODUCT_ID", "QUANTITY", "DELAY",
                  "CAN_BUY", "PRICE", "WEIGHT")
        );
        if($basketResult=$dbBasketItems->fetch())
            CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
    }
}

// При обновлении записей в корзине - количество аукцоннного товара не больше одного
AddEventHandler("sale", "OnBeforeBasketUpdate", "OnBeforeBasketUpdateHandler");
function OnBeforeBasketUpdateHandler($ID,&$arFields){
    global $tAucData; // Аукционный товар
    if($ID==$tAucData["BASKET_ID"] && $tAucData["AUC_IN_BASKET"]){
        //AddMessage2Log("");
        $arFields["QUANTITY"] = 1;
    }
}


// Получить файлы медиабиблиотеки по ключам
function getFromMediaByKeys($arKeys){
    if(!$arKeys)
        return;

    global $DB;

    CModule::IncludeModule("fileman");
    CMedialib::Init();

    $kw = 'newstest';

    $err_mess = CMedialibCollection::GetErrorMess()."<br>Function: CMedialibItem::GetList<br>Line: ";
    $strSql = "SELECT
                        MI.*,MCI.COLLECTION_ID, F.HEIGHT, F.WIDTH, F.FILE_SIZE, F.CONTENT_TYPE, F.SUBDIR, F.FILE_NAME, F.HANDLER_ID,
                        ".$DB->DateToCharFunction("MI.DATE_UPDATE")." as DATE_UPDATE2
                    FROM b_medialib_collection_item MCI
                    INNER JOIN b_medialib_item MI ON (MI.ID=MCI.ITEM_ID)
                    INNER JOIN b_file F ON (F.ID=MI.SOURCE_ID)
            WHERE MI.KEYWORDS IN ('".implode("','",$arKeys)."')";

    $res = $DB->Query($strSql, false, $err_mess);

    $result = array();

    while($row=$res->fetch()){
        CMedialibItem::GenerateThumbnail($row, array('rootPath' => $rootPath));
        $row['PATH'] = CFile::GetFileSRC($row);
        $result[] = $row;
    }

    return $result;

}

// Editing string items values from admin
AddEventHandler("main", "OnAdminListDisplay", "MyOnAdminListDisplay");
function MyOnAdminListDisplay(&$list)
{
    foreach($list->aRows as &$row){
        foreach($row->aFields as $k=>&$field){
            if(strstr($k,"PROPERTY_") && $field["view"]["type"]=="html"){
                $propID = str_replace("PROPERTY_","",$k);
                $field["view"]["value"] = '<div class="admlist-editfield" data-prod="'.$row->arRes["ID"].'" data-id="'.$propID.'">'.$field["view"]["value"].'</div>';
            }
        }
    }
}
// подписка пользователя при оформлении заказа
AddEventHandler('sale', 'OnSaleComponentOrderOneStepFinal', 'Subscrible');

function Subscrible($ID, &$arFields) {
    $dbOrderProps = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array(
            "ORDER_ID" => $arFields["ID"],
            "CODE" => array("NEWSCHECKED")
        )
    );
    $arOrderProps = $dbOrderProps->Fetch();

    // если галка на подписку стоит
    if($arOrderProps['VALUE'] == 'Y') {
        // получим все активные рубрики
        CModule::IncludeModule("subscribe");
        $RUB_ID = array();
        $rsRubric = CRubric::GetList(array(), array("ACTIVE" => "Y"));
        while($arRubric = $rsRubric->GetNext()) {
            $RUB_ID[] = $arRubric['ID'];
        }
        $userId = $arFields['USER_ID'];
        $userEmail = $arFields["USER_EMAIL"];
        $subscr = new CSubscription;
        $fields = Array(
            "USER_ID" => $userId,
            "FORMAT" => "text",
            "EMAIL" => $userEmail,
            "ACTIVE" => "Y",
            "RUB_ID" => $RUB_ID,
            "SEND_CONFIRM" => "N",
            "CONFIRMED" => "Y"
        );
        $idsubrscr = $subscr->Add($fields, SITE_ID);
    }
}

function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function generatePrice(){

    //$to = 'pashawm@mail.ru'; $subject = 'Test email using PHP'; $message = "CRON"; mail($to, $subject, $message);

    get_data('https://teko-shop.ru/cataloge/new_gen.php?gen=Y');

    return "generatePrice();";
}

// Автоматическая очистка кэша Битрикс
function clean_expire_cache($path = "") {
    if (!class_exists("CFileCacheCleaner")) {
        require_once ($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/cache_files_cleaner.php");
    }
    $curentTime = mktime();
    if (defined("BX_CRONTAB") && BX_CRONTAB === true) $endTime = time() + 5; //Если на кроне, то работаем 5 секунд
    else $endTime = time() + 1; //Если на хитах, то не более секунды
    //Работаем со всем кешем
    $obCacheCleaner = new CFileCacheCleaner("all");
    if (!$obCacheCleaner->InitPath($path)) {
        //Произошла ошибка
        return "clean_expire_cache();";
    }
    $obCacheCleaner->Start();
    while ($file = $obCacheCleaner->GetNextFile()) {
        if (is_string($file)) {
            $date_expire = $obCacheCleaner->GetFileExpiration($file);
            if ($date_expire) {
                if ($date_expire < $curentTime) {
                    unlink($file);
                }
            }
            if (time() >= $endTime) break;
        }
    }
    if (is_string($file)) {
        return "clean_expire_cache(\"" . $file . "\");";
    }
    else {
        return "clean_expire_cache();";
    }
}

