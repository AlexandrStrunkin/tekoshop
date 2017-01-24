<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$object = $_GET['o'];
$action = $_GET['a'];
$value = (int) $_GET['v'];
$of = $_GET['offer'];
$id = (int) $_GET['id'];
$oid = (int) $_GET['oid'];
$code = (int) $_GET['CODE'];
$view = $_GET['view'];


require('order.class.php');


if(isset($USER) && ($USER->IsAuthorized())){
	$uid = $USER->GetID();
	$order = new Order($uid, $USER->GetUserGroupArray());
}
else die('NO_AUTH');

//printf("<pre>Object: %s, action: %s, value: %d, id: %d </pre>", $object, $action, $value, $id);

if(isset($_GET['strIMessage'])):?>
	<div>
		<?=htmlspecialcharsbx($_GET['strIMessage']);?>
	</div>
<?endif;
switch($object)
{
	case 'status':
		if ( $action == 'change' && $id )
			$answer = $order->statusChange($id, $value);
		include('templates/.default/statuschange.php');
		break;

	case 'orders':
		//list
		if ( ($action == 'list') || ($action == 'get' && $id))
		{
			$orders = $order->ordersList($id ? $id : 0, $_GET['s'] > 1 ? $_GET['s'] : 3,$view);
			include('templates/.default/orderslist.php');
		}

		//get
		if ($action == 'get' && $id && $value){
			require('templates/.default/offersadd.php');
        	require('templates/.default/messages.php');
		} elseif($action == 'get' && $view=="Y") {
        	require('templates/.default/messages.php');
        }

		break;

	case 'offers':
		if ($action == 'list' && $id) {
			$offers = $order->offersList($id, $of);
			include('templates/.default/offerslist.php');
		} elseif($action == 'list' && !$id){
			$offers = $order->offersList(0,'',$oid);
			include('templates/.default/offerslist.php');        	
        } elseif($action == 'accept' && $id) {
			$AD = isset($_POST['accept_devices']) ? true : false;
			$answer = $order->offersAccept($id, $AD);
			if($answer)
				require('templates/.default/offersaccept.php');
		}
		break;

	case 'rating':
		if ($action == 'vote' && $_SERVER['REQUEST_METHOD'] == 'POST') {
			$votetext = strip_tags($_POST['votetext']);
			$vote = (int)$_POST['vote'];
			$public = $_POST['public'] == 'Y'? 1 : 0;

			if ($votetext != '' && $vote){
				
				//Добавить отзыв
				$workerID = $order->ratingVote($id, $votetext, $vote, $public);
				if($workerID){
					require($_SERVER['DOCUMENT_ROOT'].'/partner/rating.class.php');
					
					//Пересчитать рейтинг
					$rating = new Rating($workerID);
					$rating->addReviewRating($vote);

					require('templates/.default/ratingdone.php');
				}else{
					require('templates/.default/ratingfault.php');
				}
			}
			else require('templates/.default/ratingempty.php');
		}
		break;
};
?>