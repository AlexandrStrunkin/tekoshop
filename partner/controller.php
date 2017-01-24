<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?require('partner.class.php');

define('DEFAULT_CITY', 3693);
define('DEFAULT_CITY_NAME', "Казань");

$partner = new Partner();

$action = $_GET['a'] ? $_GET['a'] : 'list';
$id = $_GET['id'] ? (int) $_GET['id'] : 0;
$page = $_GET['page'] ? (int) $_GET['page'] :0;

//$sort['nTopCount'] = 2;

//$sort['nTopCount'] = 20;
//$order = 'asc';

switch ($action){
	case 'list':
		$arCityList = $partner->getPartnersLocList();

		//фильтрация
		$filter = array();

		$filter[] = (isset($_GET['city']) && (int)($_GET['city']))
			? 'WORK_CITY = "'.$arCityList[(int)$_GET['city']].'"'
			: 'WORK_CITY = "Казань"';

		$work = isset($_GET['work']) ? $_GET['work'] : Array();

		if(!empty($work)){
			foreach ($work as $key => $wg) {
				if (!$partner->isPartnerGroup($wg)) unset($work[$key]);
			}
		}

		if (empty($work))
			$filter[] = 'GROUP_ID IN('.implode(',', array_keys($partner->getGroupsNames())).')';
		else
			$filter[] = 'GROUP_ID IN('.implode(',', $work).')';

		$page = (int) $_GET['page'] ? (int) $_GET['page'] : 0;

		//сортировка
		$order = 'ORDER BY ';
		if(isset($_GET['sort_n'])){
			//$sort = array('admin_notes' => (bool)$_GET['sort_r'] ? 'desc' : 'asc');
			//EX:
			$order .= ' `WORK_COMPANY` ';
			$order .= ((bool)$_GET['sort_n'])? 'DESC' : 'ASC';
		}
		else//(isset($_GET['sort_n']))
		{
			//$sort = array('work_company' => (bool)$_GET['sort_n'] ? 'desc' : 'asc');
			//EX:
			$order .= ' `ADMIN_NOTES` ';
			$order .= ((bool)$_GET['sort_r'])? 'ASC' : 'DESC';

		}

		require('templates/filter.php');
		require('templates/sortbar.php');

		$users = $partner->getExList($filter, $order, $page);
		//$users = $partner->getList($filter, $sort, $order);
		if (is_array($users))

			require('templates/partnerli.php');

		if($partner->getCount() > $partner->getPaginator()) {
			require('templates/paginator.php');
		}
		break;

	case 'detail':
		if ($id)
		{
			$cache = new CPHPCache();
			$cache_time = 86400;
			$cache_id = 'partner'.$id;
			$cache_path = '/partnerplus/partnerlist/';

			if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
			{
				$res = $cache->GetVars();
				if (is_array($res["partner".$id]))
					$arPartner = $res["partner".$id];
			}

			if (!is_array($arPartner))
			{
				$arPartner = $partner->getByID($id);
				if(!count($arPartner)) break;

				$arPartner['SETS'] = $partner->getPartnerSets($id, 4);
				$arPartner['REVIEWS'] = $partner->getPartnerReview($id, 5);
				$arPartner['LICENSES'] = $partner->getPartnerLicenses($id, 3);

				if ($cache_time > 0)
				{
					$cache->StartDataCache($cache_time, $cache_id, $cache_path);
					$cache->EndDataCache(array("partner".$id =>$arPartner));
				}
			}
			$arPartner['PICTURE'] = $partner->getPartnerGallery($id, 3);

			require('templates/detailpartner.php');

		}
		else
		{
			echo 'Партнер с данным ID не найден';
		}

		break;

	case 'sets':
		if ($id) {
			$arSetItems = $partner->getPartnerSetByID($id);
			require('templates/setitems.php');
		}
		break;
	case 'renew':
		require('rating.class.php');
		$arGroups = array_keys($partner->getGroupsNames());
		$by = '';
		$order = '';

		$res = CUser::GetList($by, $order, array('GROUPS_ID'=>$arGroups), array('SELECT' => array('UF_O_RATING', 'UF_F_RATING'), 'FIELDS' => array('ID', 'WORK_COMPANY')));
		while($arUser = $res->fetch()) {
			if($arUser['UF_O_RATING'] > 0 || $arUser['UF_F_RATING'] > 0){
				$rating = new Rating($arUser['ID']);
				$rating->renewOldRating();
				unset($rating);
			}
		}
		echo 'Done';
		break;
}?>
