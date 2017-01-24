<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class Rating{
	const MAX_RATE = 5;

	const IB_ORDERS_ID = 135;
	const IB_OFFERS_ID = 136;
	const IB_REVIEW_ID = 137;
	const IB_GALLERY_ID = 138;
	const IB_LIC_ID = 139;

	const ORDER_DONE = 3699;
	
	private $arUser;
	private $userID;

	public function __construct($userID)
	{
		if ((int) $userID){
			global $USER;
			$res = $USER->GetByID($userID);
			$this->arUser = $res->fetch();
			unset($this->arUser['PASSWORD']);
			$this->userID = $userID;
		}
	}

	public function __destruct()
	{
		//global $USER;
		//echo '<pre>', print_r($this->arUser);

		//$USER->Update($this->userID, $this->arUser);
		//die();
	}

	protected function saveUser($saveArray, $needCalc = true)
	{
		global $USER;

		$this->renewTotalRating();

		//так как выборка пользователей не сортирует
		//по пользовательскому полю, используем admin_notes
		//как запись об общем рейтинге пользовател§
		$saveArray['admin_notes'] = $this->arUser['UF_RATING'];

		$USER->Update($this->userID, $saveArray);
	}

	//добавить оценку об исполнителе за§вки
	public function addReviewRating($rate)
	{

		if ($this->arUser)
		{
			$rRating = empty($this->arUser['UF_R_RATING']) ? Array(0,0) : explode('/', $this->arUser['UF_R_RATING']);
			$rRating = count($rRating) === 2 ? $rRating : Array(0,0);

			$rate = abs((int) $rate) > self::MAX_RATE ? 0 : abs((int) $rate);

			if ($rate){
				$rRating[0] += $rate;
				$rRating[1]++;
				
				$this->arUser['UF_R_RATING'] = implode('/', $rRating);

				//пересчитать рейтинг профил§ и сохранить оценку
				$this->saveUser(Array('UF_R_RATING' => $this->arUser['UF_R_RATING']), false);
			}
		}
		return false;
	}


	// 1 - Ц?ЕУїН? ЊЭОєЂЭђЉУ?О¤ ЂЉ ЂЉЊЭОН?ННЯЕ ЊЦЭСїОє
	public function calcPRating($willSave = false, $cert=false)
	{
		if(!$cert)
		{
			$res = CIBlockElement::GetList( Array("created" => "desc"),
				Array(  "IBLOCK_ID" => self::IB_LIC_ID,
					"CREATED_BY" => $this->arUser['ID'],
				),
				false,
				Array("nPageSize"=>1),
				Array("ID")
			);

			$cert = $res->SelectedRowsCount()? true : false;

		}

		$this->arUser['UF_P_RATING'] = ( $cert && $this->arUser['WORK_LOGO'] && $this->arUser['WORK_PHONE'] && $this->arUser['WORK_PROFILE']) ? 1 : 0;

		if ($willSave)
			$this->saveUser(Array('UF_P_RATING' => $this->arUser['UF_P_RATING']));
		return $this->arUser['UF_P_RATING'];
	}

	// 2 - Ц?ЕУїН? ?ЉО?Ц?ї ЊЭОєЂЭђЉУ?О¤
	public function calcGRating($willSave = false)
	{
		$res = CIBlockElement::GetList( Array(),
			Array(	'IBLOCK_ID' => self::IB_GALLERY_ID,
				'CREATED_BY' => $this->arUser['ID']),
			false,
			Array('nPageSize' =>1),
			Array('ID')
		);

		$this->arUser['UF_G_PROFILE'] = ($res->SelectedRowsCount() > 0) ? 1 : 0;

		if ($willSave)
			$this->saveUser(Array('UF_G_PROFILE' => $this->arUser['UF_G_PROFILE']));

		return $this->arUser['UF_G_PROFILE'];
	}

	public function setGRating($rate){
		$this->arUser['UF_G_PROFILE'] = $rate;
		$this->saveUser(Array('UF_G_PROFILE' => $this->arUser['UF_G_PROFILE']));
	}

	// 3 - Ц?ЕУїН? ЊЦ??ОЭ??НїЕ ЊЭОєЂЭђЉУ?О¤
	public function calcFRating($willSave = false)
	{
		$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
		$res = CIBlockElement::GetList( Array(),
			Array(	'IBLOCK_ID' => self::IB_OFFERS_ID,
				'CREATED_BY' => $this->arUser['ID'],
				'>=DATE_CREATE' => array(false, ConvertTimeStamp($lastmonth, "FULL"))
			),
			false,
			false, //Array('nPageSize' =>1),
			Array('ID')
		);
		$this->arUser['UF_F_RATING'] = ($res->SelectedRowsCount() > 0) ? 1 : 0;

		if ($willSave)
			$this->saveUser(Array(	'UF_F_RATING' => $this->arUser['UF_F_RATING']));

		return $this->arUser['UF_F_RATING'];
	}

	// Фстановить рейтинг предложений
	public function addOffersRating()
	{
		$this->arUser['UF_F_RATING'] = 1;
		$this->saveUser(Array(	'UF_F_RATING' => $this->arUser['UF_F_RATING']));
	}

	// 4 - Рейтинг выполненных заявок в мес
	public function calcORating($willSave = false)
	{
		$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
		$res = CIBlockElement::GetList( Array(),
			Array(	'IBLOCK_ID' => self::IB_ORDERS_ID,
				'PROPERTY_ORDER_STATUS' => self::ORDER_DONE,
				'PROPERTY_ORDER_WORKER' => $this->arUser['ID'],
				'>=DATE_CREATE' => array(false, ConvertTimeStamp($lastmonth, "FULL"))
			),
			false,
			false, //Array('nPageSize' =>1),
			Array('ID')
		);

		$this->arUser['UF_O_RATING'] = ($res->SelectedRowsCount() > 0) ? 1 : 0;

		if ($willSave)
			$this->saveUser(Array('UF_O_RATING' =>  $this->arUser['UF_O_RATING']));

		return $this->arUser['UF_O_RATING'];
	}

	public function setORating($rate){
		$this->arUser['UF_O_RATING'] = $rate;
		$this->saveUser(Array('UF_O_RATING' => $this->arUser['UF_O_RATING']));
	}

	//пересчитать общий рейтинг
	public function renewTotalRating()
	{

		$rRating = explode('/', $this->arUser['UF_R_RATING']);
		$totalRating = 0;
		$totalRating += $this->arUser['UF_P_RATING'] > 0 ? 1 : 0;
		$totalRating += $this->arUser['UF_F_RATING'] > 0 ? 1 : 0;
		$totalRating += $this->arUser['UF_O_RATING'] > 0 ? 1 : 0;
		$totalRating += $this->arUser['UF_G_PROFILE'] > 0 ? 1 : 0;
		$totalRating += $rRating[0]/$rRating[1] > 3.5 ? 1 : 0;

		$this->arUser['UF_RATING'] = $totalRating;

		return $this->arUser['UF_RATING'];
	}

	public function renewOldRating(){
		$rating = Array();
		$rating['UF_O_RATING'] = $this->calcORating(false);
		$rating['UF_F_RATING'] = $this->calcFRating(false);
		$this->saveUser($rating);
	}
}