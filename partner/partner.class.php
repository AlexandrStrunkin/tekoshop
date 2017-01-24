<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class Partner
{
	//private $groupsID = Array();
	private $curUSER;
	private $groupsNames = Array();
    protected  $count = 0;

	//private $statusIDs = Array('DONE' => Array(3604));
	const IB_ORDERS_ID = 135;
	const IB_SETS_ID = 140;
	const IB_REVIEW_ID = 137;
	const IB_GALLERY_ID = 138;
	const IB_LIC_ID = 139;
	const IBT_CATALOGUES_ID = 'catalog';
    const PAGINATION = 10;

	function __construct()
	{
		$filter = Array('ACTIVE' => 'Y', 'ADMIN' => 'N', 'STRING_ID' => 'partners_%');
		$by = '';
		$order = '';
		$res = CGroup::GetList($by, $order, $filter, 'N');
		
		while ($data = $res->Fetch()) {
			$this->groupsNames[$data['ID']] = $data['NAME'];
		}
		//echo '<!--', print_r($this->groupsNames), '-->';
		global $USER;
		$this->curUSER = $USER->getID();
	}

	public function getPartnersLocList()
	{
		$cache = new CPHPCache();
		$cache_time = 86400;
		$cache_id = 'arCityList';
		$cache_path = '/partnerplus/arcitylist/';

		if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
			$res = $cache->GetVars();
			if (is_array($res["arCityList"]) && (count($res["arCityList"]) > 0))
				$arCityList = $res["arCityList"];
		}

		if (!is_array($arCityList)) {
			$res = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC"),
				Array("IBLOCK_ID" => $this::IB_ORDERS_ID,
					"CODE" => "ORDER_CITY")
			);
			while ($ar_res = $res->Fetch()) {
				$arCityList[$ar_res['ID']] = $ar_res['VALUE'];
			}
			//////////// end cache /////////
			if ($cache_time > 0) {
				$cache->StartDataCache($cache_time, $cache_id, $cache_path);
				$cache->EndDataCache(array("arCityList" => $arCityList));
			};
		};
		return $arCityList;
	}

    public function getPaginator()
    {
        return self::PAGINATION;
    }

	public function getList($filter, $sort, $order)
	{
		$filter['GROUPS_ID'] = isset($filter['GROUPS_ID']) ? $filter['GROUPS_ID'] : array_keys($this->groupsNames);
		$res = CUser::GetList($sort,
			$order,
			$filter,
			Array("SELECT" => Array('UF_*')/*, "NAV_PARAMS"  => Array("nTopCount" => 20)*/)
		);

		while ($user = $res->fetch()) {
			$users[] = $user;
		}

		return $users;
	}

	public function getExList($filter, $order, $page = 0)
    {
		global $DB;
		if (!empty($filter))
			$filter = (implode(' AND ', $filter)) . ' AND ';
		else $filter='';
		$filter .= '`u`.`ACTIVE` = "Y"';

        $sql = 'SELECT
               COUNT(DISTINCT `USER_ID`) as `count`
               FROM `b_user_group` as `g`
               JOIN `b_user` as `u` ON `g`.`USER_ID` = `u`.`ID`
               WHERE '.$filter.$order;

        $res = $DB->Query($sql)->fetch();
        $this->count = $res['count'];

		$sql = 'SELECT
				`g`.`USER_ID` as `ID`,
			    CONVERT(GROUP_CONCAT(`g`.`GROUP_ID` SEPARATOR ",") USING UTF8) as GROUPS,
				`u`.`ACTIVE`,
				`u`.`WORK_COMPANY`,
				`u`.`WORK_WWW`,
				`u`.`WORK_PHONE`,
				`u`.`WORK_STREET`,
				`u`.`WORK_PROFILE`,
				`u`.`EMAIL`,
				`u`.`WORK_CITY`,
				`u`.`WORK_LOGO`,
				`u`.`ADMIN_NOTES`,
				`u`.`WORK_NOTES`
			    FROM `b_user_group` as `g`
			    JOIN `b_user` as `u` ON `g`.`USER_ID` = `u`.`ID`
			    WHERE ' . $filter . '
			    GROUP BY `USER_ID` ' . $order. '
                LIMIT '.$page*self::PAGINATION.', '.self::PAGINATION;

		$res = $DB->Query($sql);

		while ($user = $res->fetch()) {
			$users[] = $user;
		}
		return $users;
	}

    public function getCount()
    {
        return $this->count;
    }

	public function getByID($id)
	{
		return $this->getExList(array("`ID` = ".$id, 'GROUP_ID IN('.implode(',', array_keys($this->getGroupsNames())).')'), '');
	}

	public function getGroupsNames()
	{
		return $this->groupsNames;
	}

	public function getGroupByID($id)
	{
		return $this->groupsNames[$id];
	}

	public function isPartnerGroup($groupID)
	{
		return isset($this->groupsNames[(int)$groupID])? true : false;
	}

	public function isPartner()
	{
		global $USER;
		$arGroups = $USER->GetUserGroupArray();
		$isPartner = false;
		$arPartners = array_keys($this->groupsNames);
		foreach ($arGroups as $group) {
			if (in_array($group, $arPartners)) {
				$isPartner = true;
				break;
			}
		}
		return $isPartner;
	}

	public function getPartnerSets($id=0, $limit = 0)
	{
		if(!$id) $id = $this->curUSER;
		$sets = array();
		$res = CIBlockElement::GetList( Array(),
										Array(  "CREATED_BY" => (int)$id,
												"IBLOCK_ID" => self::IB_SETS_ID),
										false,
										Array("nPageSize"=>$limit),
                                        Array());
		while($set = $res->GetNextElement())
		{
        	$setVals = $set->getFields();
        	$setProps = $set->getProperties();
			$sets[$setVals["ID"]]["NAME"] = $setVals["NAME"];
            $setImg = '';
            if($setVals["PREVIEW_PICTURE"]){
	            $setImg = getResizedImgById($setVals["PREVIEW_PICTURE"],77,91);
            } else {
            	// Если изображение не найдено, то ищем его в товарах
                //print_r($setProps["SETS_CONTENT"]["VALUE"]);
                $setItems = CIBlockElement::GetList( Array(),
										Array(  "ID" => $setProps["SETS_CONTENT"]["VALUE"]	),
										false,
										array("nTopCount"=>10),
                                        Array("PREVIEW_PICTURE","DETAIL_PICTURE"));
                while($setItem = $setItems->fetch()){
                	if($setItem["PREVIEW_PICTURE"]){
                    	$setImg = getResizedImgById($setItem["PREVIEW_PICTURE"],77,91);
                        break;
                	}elseif($setItem["DETAIL_PICTURE"]){
                    	$setImg = getResizedImgById($setItem["DETAIL_PICTURE"],77,91);
                        break;
                    }
                }
            }
			$sets[$setVals["ID"]]["PREVIEW_PICTURE"] = ($setImg && file_exists($_SERVER["DOCUMENT_ROOT"].$setImg["src"])) ? $setImg["src"] : "";
		}
		return $sets;
	}

	public function getPartnerSetByID($id)
	{
		$res = CIBlockElement::GetProperty(self::IB_SETS_ID, (int)$id, Array(), Array("CODE" => "SETS_CONTENT"));
		$elements = Array();
		while($el = $res->fetch())
		{
			if ($el["VALUE"]) $elements[] = $el["VALUE"];
		};
        
		$res = CIBlockElement::GetProperty(self::IB_SETS_ID, (int)$id, Array(), Array("CODE" => "NUMBER_IN_SET"));
		$elemqtys = Array();
        $ind = 0;
		while($el = $res->fetch())
		{
			if ($el["VALUE"]) $elemqtys[$elements[$ind]] = $el["VALUE"];
            $ind++;
		};

		if (!empty($elements))
		{
			global $DB;
            
            $setData = CIBlockElement::GetByID($id);
            $setRow = $setData->fetch();
            $usr = CUser::GetByID($setRow["CREATED_BY"]);
            $usrData = $usr->fetch();
            
            $setSel = CIBlockElement::GetByID($id);
            $setInfo = $setSel->fetch();
            
            $elIDs = $elements;
            
			$elements = implode(',', $elements);

			$sql = 'SELECT  `E`.`ID` ,
							`E`.`NAME` ,
							`E`.`PREVIEW_TEXT`,
							`E`.`CREATED_BY`,
							CONCAT("/", `B`.`IBLOCK_TYPE_ID`, "/", `B`.`CODE`, "/", `S`.`CODE`, "/", `E`.`CODE`, "/") AS `URL`,
							CONCAT("/upload/", `F`.`SUBDIR`, "/", `F`.`FILE_NAME`) AS `SRC`
					FROM  	`b_iblock_element` AS  `E`
					JOIN  `b_iblock_section` AS  `S` ON  `E`.`IBLOCK_SECTION_ID` =  `S`.`ID`
					JOIN  `b_file` AS  `F` ON  `E`.`DETAIL_PICTURE` =  `F`.`ID`
					JOIN	`b_iblock` AS `B` ON `E`.`IBLOCK_ID` = `B`.`ID`
					WHERE  `E`.`ID` IN('.$elements.')';
			
			$elements = Array();
			$res = $DB->Query($sql);

			//$res = CIBlockElement::GetList(Array(), Array('ID'=>$elements), false, false, Array());*/
            
			if (CModule::IncludeModule("catalog")) {
				while ($el = $res->fetch()) {
                    $el["USER_INFO"] = $usrData;
                    $el["SET_INFO"] = $setInfo;
                    $el["QTY"] = $elemqtys[$el['ID']];
					$elements[$el['ID']] = $el;
				};
			}
            
            // Ресортировка по порядку
            $elNewSorting = array();
            foreach($elIDs as $el1){
                foreach($elements as $el2){
                    if($el1==$el2['ID'])
                        $elNewSorting[$el1] = $el2;
                }
            }
            $elements = $elNewSorting;
		}
		return $elements;
	}
    
   	public function getPartnerSetImg($id){
        $res = CIBlockElement::GetByID($id);
        if($ar_res = $res->GetNext())
        	return array("IMG"=>getResizedImgById($ar_res["PREVIEW_PICTURE"],200,200),"VALS"=>$ar_res);
	}
    
	public function getOwnerSetByID($id)
	{
		$set = CIBlockElement::GetByID((int)$id)->fetch();
		if ($set['IBLOCK_ID'] == self::IB_SETS_ID)
			return $set['CREATED_BY'];
		else return false;
	}

	public function isSetOwner($id)
	{
		if($this->getOwnerSetByID($id) === $this->curUSER) return true;
		else return false;
	}

	public function setPartnerSetByID($setID, $values, $desc="", $img = "", $imgdel = "")
	{
    	$setsQty = explode(",",$_POST["device_counts"]);
		if ($this->isSetOwner($setID)) {
        	$propAdd = array('SETS_CONTENT' => $values);
            if($setsQty)
            	$propAdd['NUMBER_IN_SET'] = $setsQty;
			CIBlockElement::SetPropertyValuesEx($setID, self::IB_SETS_ID, $propAdd);
            $el = new CIBlockElement;
            $el->Update($setID, array("DETAIL_TEXT"=>$desc));
            if($imgdel){
                $el = new CIBlockElement;
                $el->Update($setID, array("PREVIEW_PICTURE"=>array('del' => 'Y')));
            }
            if($img){
                $el = new CIBlockElement;
                $farray = CFile::MakeFileArray($img["tmp_name"]);
                $farray["name"] .= '.'.$img['ext'];
                $el->Update($setID, array("PREVIEW_PICTURE"=>$farray));
            }
			return true;
		}
		else return false;
	}

	public function getPartnerReview($partnerID, $limit = 0)
	{
		$res = CIBlockElement::GetList( Array(),
										Array(  "IBLOCK_ID" => self::IB_REVIEW_ID,
												"PROPERTY_REVIEWS_USER_LINK" => $partnerID,
												"PROPERTY_REVIEWS_PUBLIC" => 1
											 ),
										false,
										Array("nPageSize"=>$limit),
										Array(  "PROPERTY_REVIEWS_ORDER_LINK",
												"DATE_CREATE",
												"DETAIL_TEXT",
												"PROPERTY_REVIEWS_USER_LINK",
												"PROPERTY_REVIEWS_STARS")
										);
		while($review = $res->fetch())
		{
			$reviews[] = $review;
		}
		return $reviews;
	}

	public function getPartnerGallery($partnerID, $limit = 0)
	{
		$res = CIBlockElement::GetList( Array("created" => "desc"),
			Array(  "IBLOCK_ID" => self::IB_GALLERY_ID,
					"CREATED_BY" => $partnerID
			),
			false,
			Array("nPageSize"=>$limit),
			Array(  "PREVIEW_PICTURE",
					"PREVIEW_TEXT")
		);

		while($picture = $res->fetch())
		{
			$picture['PREVIEW_PICTURE'] = CFile::GetFileArray($picture['PREVIEW_PICTURE'], false);
			$gallery[] = $picture;
		}
		return $gallery;
	}

	public function getPartnerLicenses($partnerID, $limit = 0)
	{
		$res = CIBlockElement::GetList( Array("created" => "desc"),
				Array(  "IBLOCK_ID" => self::IB_LIC_ID,
						"CREATED_BY" => $partnerID
			),
			false,
			Array("nPageSize"=>$limit),
			Array(  "PREVIEW_PICTURE",
					"NAME")
		);

		while($license = $res->fetch())
		{
			//$license['PREVIEW_PICTURE'] = CFile::GetFileArray($license['PREVIEW_PICTURE'], false);
			$licenses[] = $license;
		}
		return $licenses;
	}

	public function getProfile()
	{
		return CUser::GetByID($this->curUSER)->fetch();

	}

	public function setProfile($profile)
	{
		global $USER;
		/*if(!empty($profile['UF_MCERT']))
		{
			foreach($profile['UF_MCERT'] as $key => $cert){
				if(!is_numeric($cert))
				{
					$profile['UF_MCERT'][$key]['MODULE_ID'] ='main';
				}
			}
			CFile::SaveForDB($profile['UF_CERT'], $key, '/uf/');
		}*/

		//echo '+++<pre>', print_r($profile), '</pre>';
		return $USER->Update($this->curUSER, $profile);

		//return
	}

	public function getUserID()
	{
		return $this->curUSER;
	}
}