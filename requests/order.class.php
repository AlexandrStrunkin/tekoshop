<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class Order {
	//актуальные значения
	private $_ordersIBlockID = 135;
	private $_offersIBlockID = 136;
	private $_reviewIBlockID = 137;
	private $_status = Array(3698, 3699, 3700, 3701); //3603 - отменен(0); 3604 - завершен(1); 3605 - в работе(2);  3606 - новая(3);
	const _showAll = true;
	private $_ignoreOwn = false;
	
	private $_userID;
	private $_groupIDs;
	
	function __construct($userID, $groupsIDs)
	{
		$this->_userID = $userID;
		$this->_groupIDs = $groupsIDs;
	}
	
	public function statusChange($orderID, $status)
	{
		//echo "statusChange($orderID , $status)";
		$res = CIBlockElement::GetList(Array(), Array('ID' => $orderID), false, false, Array('PROPERTY_ORDER_WORKER', 'CREATED_BY'));

		//$res = CIBlockElement::GetByID($orderID);
		if($res){
			$order = $res->fetch();
            
			//проверить авторство записи
			if ($this->_userID == $order['CREATED_BY'] || ($this->_userID == $order['PROPERTY_ORDER_WORKER_VALUE'] && $status == 1)){
				
				//изменить
				if ($this->_status[$status]) {

					CIBlockElement::SetPropertyValuesEx($orderID, $this->_ordersIBlockID, Array('ORDER_STATUS' => $this->_status[$status]), Array());

                    //отправить почту & отметить рейтинг
                    if($this->_status[$status] == 3699) {
	                    require($_SERVER['DOCUMENT_ROOT'].'/partner/rating.class.php');

	                    $rating = new Rating($order['PROPERTY_ORDER_WORKER_VALUE']);
	                    $rating->setORating(1);
	                    //echo $order['PROPERTY_ORDER_WORKER_VALUE'];
	                    global $USER;
                        $emails[] = $USER->getEmail();

                        //если закрывает создатель заявки
                        if($this->_userID == $order['CREATED_BY']) {
                            $secUser = $order['PROPERTY_ORDER_WORKER_VALUE'];
                        }

                        //иначе закрывает монтажник
                        else{
                            $secUser =  $order['CREATED_BY'];
                        }

                        $secUser = CUser::GetByID($secUser)->fetch();
                        $emails[] = $secUser['EMAIL'];

                        //print_r($emails);

                        $arMailParams = Array(
                            'USERS_MAIL' => $emails,
                            'ORDER_ID'   => $orderID,
                            'OFFER_URL'  => '/requests/?o=offers&a=list&id='.$orderID
                        );

                        $id = CEvent::Send('PARTNER_STATUS_DONE', 's1', $arMailParams);

                    }
                    return true;
				}
			}
		};
		return false;
	}
	
	public function ordersList($id = 0, $status = 3, $view = "") //СТАТУС 2 - ЗАЯВКИ В РАБОТЕ; 3- НОВЫЕ ЗАЯВКИ; 4 - АРХИВ ЗАЯВОК
	{
		$arFilter = Array('IBLOCK_ID' => $this->_ordersIBlockID, 'ACTIVE' => '');
		if ($id) $arFilter['ID'] = $id;

		if($view!="Y") $arFilter['PROPERTY_ORDER_STATUS'] = $this->_status[$status]; //Array(3606);
		
        // Фильтрация по городу
        global $USER;
        $udata = CUser::GetByID($USER->GetID());
        $udata = $udata->Fetch();
		$arFilter['PROPERTY_ORDER_CITY_VALUE'] = $udata['WORK_CITY'];
        
		if ($status == 2)
			$arFilter['PROPERTY_ORDER_WORKER'] = $this->_userID;
        
		$arSections = Array();
		$orders = Array();
		$res = CIBlockSection::GetList(	Array(),
										Array(	'IBLOCK_ID' => $this->_ordersIBlockID/*,
												'UF_GROUP_ID' => $this->_groupIDs*/
											 ),
										false,
										Array(	'ID', 'NAME', 'UF_GROUP_ID'), false);
		while($section = $res->fetch())
		{
			$arSections[$section['ID']] = $section['UF_GROUP_ID'];
			//$arSections[$section['ID']] = $section['UF_GROUP_ID'];
		}

		// Добавляем в фильтр вид деятельности
        $SecList = array();
        foreach($arSections as $secID=>$grpID){
        	if(in_array($grpID,$this->_groupIDs))
            	$SecList[] = $secID;
        }
        
        $arFilter["SECTION_ID"] = $SecList;
        
        $ordList = array();
        
		$res = CIBlockElement::GetList(	Array('created' => 'desc'),
										$arFilter,
										false,
										false,
										Array(	'ID',
												'NAME',
												'IBLOCK_SECTION_ID',
												'CREATED_BY',
												'PROPERTY_ORDER_CITY',
												'DETAIL_TEXT',
												'ACTIVE_FROM',
												'ACTIVE_TO',
												'PROPERTY_ORDER_ACCOUNT',
												'PROPERTY_ORDER_OBJECTS_INPUT',
												'PROPERTY_ORDER_DEVICE',
												'PROPERTY_ORDER_OFFERS_COUNT',
												'PROPERTY_ORDER_TO',
                                                'PROPERTY_ORDER_TO_MULTIPLE',
												'PROPERTY_ORDER_STATUS',
												'PROPERTY_ORDER_FILE'
											 )
									  );
		while($order = $res->fetch()) {
        	$ordList[] = $order['ID'];
        	if($order['PROPERTY_ORDER_TO_MULTIPLE_VALUE']){
                if(!stristr($order['PROPERTY_ORDER_TO_MULTIPLE_VALUE'],';'.$this->_userID.';')){
                    continue;
                }else{
                	$order['PROPERTY_ORDER_TO_VALUE'] = $this->_userID;
                }
            }
			if ($order['PROPERTY_ORDER_TO_VALUE']) {
				if ($order['PROPERTY_ORDER_TO_VALUE'] == $this->_userID) {
					$orders[$order['ID']] = $order;
					$orders[$order['ID']]['PRIVATE'] = $order['CREATED_BY'];
					$fOrders[] =  $order['ID'];
				}
			} else {
				$orders[$order['ID']] = $order;
				$sOrders[] = $order['ID'];
				if (in_array($this->_userID, explode(",", $order['PROPERTY_ORDER_OFFERS_COUNT_VALUE'])))
					$fOrders[] =  $order['ID'];
			}
		}

		$res = CIBlockElement::GetElementGroups($sOrders, false, array('IBLOCK_ELEMENT_ID', 'ID'));
		while($section = $res->fetch())
		{
			$orders[$section['IBLOCK_ELEMENT_ID']]['SECTIONS'][] = $section['ID'];
		}

		$res = CIBlockElement::GetList(Array(), Array('CREATED_BY' => $this->_userID, 'PROPERTY_OFFER_ORDER_ID' => $fOrders), false, false, Array('PROPERTY_OFFER_ORDER_ID', 'CREATED_BY', 'ID', 'PROPERTY_OFFER_DEVICE_HTML', 'PROPERTY_OFFER_COMMENT'));
		while($offer = $res->fetch())
		{
			$orders[$offer['PROPERTY_OFFER_ORDER_ID_VALUE']]['OFFERS'][] = $offer['ID'];
		}
		
        
		$res = CIBlockElement::GetList(Array(), Array('CREATED_BY' => $this->_userID, 'PROPERTY_OFFER_ORDER_ID' => $ordList), false, false, Array('PROPERTY_OFFER_ORDER_ID', 'CREATED_BY', 'ID', 'PROPERTY_OFFER_DEVICE_HTML', 'PROPERTY_OFFER_COMMENT', 'PROPERTY_OFFER_DEVICE'));
		while($offer = $res->fetch())
		{
            $devID = explode(',', $offer['PROPERTY_OFFER_DEVICE_VALUE']);
            $sum = 0;
            if($devID){
                foreach($devID as $dev){
                	$arPrice = CCatalogProduct::GetOptimalPrice($dev, 1, $USER->GetUserGroupArray());
                    $sum += floatval($arPrice["PRICE"]["PRICE"]);
                }
            }
            $offer["SUM"] = $sum;
			$orders[$offer['PROPERTY_OFFER_ORDER_ID_VALUE']]['OFFERSDATA'][] = $offer;
		}

		
        if ($status == 4){ // Архив заявок(все, где есть свои предложения)
        	foreach($orders as $ind=>$ord){
            	//print_r($ord); echo '<br /><br />';
            	//echo $ord['PROPERTY_ORDER_OFFERS_COUNT_VALUE'].'<br />';
            	if(!in_array($this->_userID,explode(',', $ord['PROPERTY_ORDER_OFFERS_COUNT_VALUE'])))
                	unset($orders[$ind]);
            }
        }



		foreach($orders as &$order)
		{
			foreach($order['SECTIONS'] as $section)
			{
				if(in_array($arSections[$section], $this->_groupIDs)){
					$order['VISIBLE'] = 'Y';
					break;
				}
			}
		}

		return $orders;
	}
	
	public function offersList($id = 0, $offer = '', $oid = 0)
	{
		//проверка принадлежит ли заявка пользователю
		//$order = CIBlockElement::GetByID($id);
		//$order = $order->fetch();
        
        $flt = $id ? array("ID"=>$id) : array("CREATED_BY"=>$this->_userID);
        $res = CIBlockElement::GetList(Array(), $flt, false, false, array('ID','CREATED_BY','PROPERTY_ORDER_WORKER'));
        $ids = array();
        $corder = "";
        while($order = $res->GetNext()){
	        $corder = $order;
        	if(!in_array($order["ID"],$ids)) $ids[] = $order["ID"];
        	$worker[$order["ID"]] = $order['PROPERTY_ORDER_WORKER_VALUE']; // Исполнитель
        }
        $order = $corder;
        
		if($order['CREATED_BY'] == $this->_userID)
		{
			$arFilter = Array('PROPERTY_OFFER_ORDER_ID' => $ids);
            if($offer=='current') $arFilter['CREATED_BY'] = $worker[$id];
            if($oid) $arFilter['ID'] = $oid;
			$res = CIBlockElement::GetList(	Array('PROPERTY_OFFER_ORDER_ID'=>'desc', 'created_date'=>'desc'),
											$arFilter, 
											false, 
											false, 
											Array(	'ID',
													'CREATED_BY',
													'NAME',
													'DETAIL_TEXT',
													'PROPERTY_OFFER_DEVICE',
													'PROPERTY_OFFER_DEVICE_HTML',
													'PROPERTY_OFFER_ORDER_ID',
													'PROPERTY_OFFER_PRICE_DEVICE',
													'PROPERTY_OFFERS_PRICE_WORK',
													'PROPERTY_OFFER_COMMENT',
													'PROPERTY_OFFERS_FILE' ));
			while($offer = $res->fetch())
			{
				$offers[] = $offer;
				$uids[] = $offer['CREATED_BY'];
			};
			
			$uids = implode('|', array_unique($uids));
			$by = '';
			$order = '';
			$res = CUser::GetList($by, $order, Array('ID' => $uids), 
				Array(	'FIELDS' => Array(	'ID', 'WORK_COMPANY'), 'SELECT' => Array(	'UF_USER_STATUS')));
			while($user = $res->fetch()) 
				$users[$user['ID']] = $user;
			foreach($offers as &$offer){
		        // Если определен исполнитель, то указываем его везде
                $offer['WORKER'] = $worker[$offer['PROPERTY_OFFER_ORDER_ID_VALUE']];
				$offer['CREATED_INFO'] = $users[$offer['CREATED_BY']];	
            }	
			return $offers;
		};
		return Array();
	}
	
	public function offersAccept($offerID, $AD)
	{
		$answer = false;
		$offer = 0;
		$order = 0;
		
		//Проверка
		
		//Существует ли ПРЕДЛОЖЕНИЕ?
		$arFilter = Array('ID' => $offerID);
		$res = CIBlockElement::GetList(	Array('id'=>'asc'), 
										$arFilter, 
										false, 
										false, 
										Array(	'ID',
												'CREATED_BY',
												'PROPERTY_OFFER_ORDER_ID',
												'PROPERTY_OFFER_DEVICE'));
		if ($res->SelectedRowsCount())
		{
				$offer = $res->fetch();
				
				//Существует ли ЗАЯВКА?
				$res = CIBlockElement::GetByID($offer['PROPERTY_OFFER_ORDER_ID_VALUE']);
				if($res->SelectedRowsCount())
				{
					$order = $res->fetch();
				}
		}
		//Установка
		if($order && $offer && ($order['CREATED_BY'] == $this->_userID))
		{
			if($AD)
			{
				$arDevice = explode(',', $offer['PROPERTY_OFFER_DEVICE_VALUE']);
				foreach($arDevice as $deviceID)
				{
					Add2BasketByProductID($deviceID, 1, array());
				}
			}
			
            // Отправка сообщения о принятии заявки
            $olink = "http://teko-shop.ru/requests/?o=orders&a=get&id=".$order['ID']."&v=1&view=Y&CODE=".$offer['ID'];
            requestAcceptMsg($order['ID'], $offer['CREATED_BY'], $olink);
            
			$orderID = $order['ID'];
			$workerID = $offer['CREATED_BY'];
			CIBlockElement::SetPropertyValuesEx($orderID, $this->_ordersIBlockID, Array('ORDER_WORKER' => $workerID), FLAGS);
			$this->statusChange($order['ID'], 2);
			$answer = true;
		}
		
		return $answer;
	}
	
	//Добавить оценку выполненой работы. Возвращает ID исполнителя в случаее успеха, иначе FALSE
	public function ratingVote($orderID, $text, $rating, $public)
	{
		$commentID = false;
		$oOrder = new CIBlockElement;
		$res = $oOrder->GetList(	Array(),
									Array(	'ID' => $orderID,
											'IBLOCK_ID' =>	$this->_ordersIBlockID,
											'PROPERTY_ORDER_STATUS' => $this->_status[1],
											'CREATED_BY' => $this->_userID,
										 ),
									false,
									Array(	'iNumPage'	=>	1,
											'nPageSize'	=>	1),
									Array(	'PROPERTY_ORDER_WORKER', 'PROPERTY_ORDER_COMMENTED', 'ID', 'NAME')
								);
									  
		if($res->SelectedRowsCount() > 0)
		{
			$order = $res->fetch();
			if (empty($order['PROPERTY_ORDER_COMMENTED_VALUE']))
			{
				$rating = abs($rating) > 5 ? 0 : $rating;
				$commentID = $oOrder->Add(	Array(	"DETAIL_TEXT"	=>	$text, 
													"NAME" => $order['ID'],
													"IBLOCK_ID" => $this->_reviewIBlockID,
													"ACTIVE" => 'Y',
													"IBLOCK_SECTION_ID" => false,
													"PROPERTY_VALUES" => Array(	"REVIEWS_USER_LINK" => $order['PROPERTY_ORDER_WORKER_VALUE'],
																				"REVIEWS_ORDER_LINK" => $orderID,
																				"REVIEWS_STARS" => $rating,
																				"REVIEWS_PUBLIC" => $public)
																			  ),
													false, 
													true,
													false
										 );
			};
		};

		if($commentID){
			CIBlockElement::SetPropertyValuesEx($orderID, $this->_ordersIBlockID, Array('ORDER_COMMENTED' => $commentID));
			return $order['PROPERTY_ORDER_WORKER_VALUE'];
		}
		else return false;
	}

	public function getStatusByCode($code)
	{
		//3603 - отменен(0);
		//3604 - завершен(1);
		//3605 - в работе(2);
		//3606 - новая(3);

		$arCode = Array("ORDER_CANCELED" => 0,
						"ORDER_DONE" => 1,
						"ORDER_INPROGRESS" => 2,
						"ORDER_NEW" => 3);
		return $this->_status[$arCode[$code]];

	}


		

}