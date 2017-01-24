<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//Генерация мета-тегов

$descr = 'Монтажная организация ' . $arPartner[0]['WORK_COMPANY'] . ' в городе ' . $arPartner[0]['WORK_CITY'] . ' предоставляет услуги: ';
$arGroups = explode(',', $arPartner[0]['GROUPS']);
foreach($arGroups as $group)
{
	$groupName = $partner->getGroupByID($group);
	$descr .=  $groupName? $groupName.', ':'';
}
$descr = substr($descr,0,-2);  
$descr .= '.';  
$descr = str_replace('"',"'",$descr);
$descr = htmlspecialchars_decode($descr);
$APPLICATION->SetPageProperty('description',$descr);

$title_partner = 'Монтажная организация ' . $arPartner[0]['WORK_COMPANY'];
$title_partner = str_replace('"',"'",$title_partner);
$APPLICATION->SetPageProperty('title',$title_partner);
?>
<div id="partner-detail">
<div class="backlink" style="margin: 10px 0">
	<a href="javascript:history.back()" onMouseOver="window.status='Назад';return true">Назад к списку партнеров</a>
</div>
	<div class="clearfix">
		<div class="col-xs-6">
			<h1><?=$arPartner[0]['WORK_COMPANY'];?></h1>
		</div>
		<?global $USER;?>

		<?if ($arPartner[0]['ID'] != $USER->getID()):?>
			<form action="/personal/requests/?edit=Y" method="POST">
				<input type="hidden" name="order" value="<?=$arPartner[0]['ID'];?>">
				<input type="submit" class="offer-to" value="Предложить задание">
			</form>
		<?endif;?>
	</div>

	<div class="clearfix">
		<div class="col-xs-2">
			<?if ($arPartner[0]['WORK_LOGO']) :?>
				<div class="partner-logo">
					<a href="/partner/?a=detail&id=<?=$arPartner[0]['ID'];?>">
						<img src="<?=CFile::GetPath($arPartner[0]['WORK_LOGO']);?>" alt="<?=$arPartner[0]['WORK_COMPANY'];?>">
					</a>
				</div>
			<?else:?>
				<div class="partner-nologo">
					<a href=/partner/?a=detail&id=<?=$arPartner[0]['ID'];?>">
						Нет лого
					</a>
				</div>
			<?endif;?>

			<div class="starline" style="background-position: 50% <?=intval($arPartner[0]['ADMIN_NOTES'])*-15;?>px">

			</div>
		</div>

		<div class="col-xs-10">
			<?=$arPartner[0]['WORK_PROFILE']? $arPartner[0]['WORK_PROFILE'] : 'Нет описания';?>
		</div>
	</div>

	<div class="clearfix" style="margin-top: 20px">
		<div class="col-xs-3"><b>Статус</b></div>
		<div class="col-xs-9">
			<?=intval($arPartner[0]['WORK_NOTES']) ? '<span class="busy-status"> <b>Занят</b></span>' : '<span class="free-status"> <b>Свободен</b></span>';?>
		</div>
	</div>
	<div class="clearfix">
		<div class="col-xs-3"><b>Город:</b></div>
		<div class="col-xs-9"><?=$arPartner[0]['WORK_CITY'];?></div>
	</div>

	<div class="clearfix">
		<div class="col-xs-3"><b>Вид деятельности:</b></div>
		<div class="col-xs-9">
			<?$arGroups = explode(',', $arPartner[0]['GROUPS']);
			foreach($arGroups as $group)
			{
				$groupName = $partner->getGroupByID($group);
				echo $groupName? $groupName.'<br>':'';
			}
			?>

		</div>
	</div>

	<div class="clearfix">
		<div class="col-xs-3"><b>Адрес:</b></div>
		<div class="col-xs-9"><?=$arPartner[0]['WORK_STREET'];?></div>
	</div>

	<div class="clearfix">
		<div class="col-xs-3"><b>Телефон:</b></div>
		<div class="col-xs-9"><?=$arPartner[0]['WORK_PHONE'];?></div>
	</div>

	<div class="clearfix">
		<div class="col-xs-3"><b>E-mail:</b></div>
		<div class="col-xs-9"><?=$arPartner[0]['EMAIL'];?></div>
	</div>

	<div class="clearfix">
		<div class="col-xs-3"><b>Сайт:</b></div>
		<div class="col-xs-9"><?=$arPartner[0]['WORK_WWW'];?></div>
	</div>


	<?if(!empty($arPartner['LICENSES'])):?>
		<div class="clearfix">
			<div class="col-xs-3">
				<b>Лицензия:</b>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<?foreach($arPartner['LICENSES'] as $cert):?>
					<div class="col-xs-2">
						<?=CFile::Show2Images($cert['PREVIEW_PICTURE'], $cert['PREVIEW_PICTURE'], 0, 0, "style='width: 100%; height: auto'");?>

					</div>
				<?endforeach;?>
			</div>
		</div>
	<?endif;?>

	<div class="clearfix" id="gallery">
		<div class="col-xs-12"><h3>Галлерея</h3></div>
		<? if(count($arPartner['PICTURE'])):?>
			<?foreach($arPartner['PICTURE'] as $picture):?>
				<div class="gallery-element">
					<img src="<?=$picture['PREVIEW_PICTURE']['SRC'];?>" alt="" height="150">
					<?if ($picture['PREVIEW_TEXT']):?>
						<span class="col-xs-8 well" style="display: none">
							<?=$picture['PREVIEW_TEXT'];?>
						</span>
					<?endif;?>
				</div>
			<?endforeach;?>
		<?else:?>
			<p class="col-xs-12">Фотографии отсутствуют</p>
		<?endif;?>
	</div>

	<div id="setslist" class="clearfix">
		<div class="col-xs-12"><h3>Рекомендуемые комплекты оборудования</h3></div>
		<?if ($arPartner['SETS']):?>
			<?foreach($arPartner['SETS'] as $id => $set):?>
				<li class="set">
					<a class="set-cover element-<?=$id;?>" href="javascript:void(0)" data-id="<?=$id;?>">
                    	<div class="set-image-cont"><img src="<?=$set["PREVIEW_PICTURE"]?$set["PREVIEW_PICTURE"]:SITE_TEMPLATE_PATH."/images/sets.png"?>"></div>
						<?=$set["NAME"];?>
					</a>
				</li>
			<?endforeach;?>
		<?else:?>
			<p class="col-xs-12">Нет рекомендаций</p>
		<?endif;?>
	</div>

	<? require_once($_SERVER["DOCUMENT_ROOT"]."/include/sets_inc.php"); ?>

	<? /*
	<div id="modcat" style="display: none">
		<div id="modcat_main">
			<div id="modcat_main_close" style="text-align: right">
				<b><a href="javascript:void(0)">X</a></b>
			</div>

			<div id="modcat_main_inner" style="width: 460px; height: 440px; margin: 0 auto; overflow-y: auto">
				<b style="margin-top: 280px; display: block; text-align: center">Загрузка каталога</b>
			</div>

			<div style="text-align: right">
				<button id="modcat_main_close_btn" type="button" class="button btn-cart"><span><span>OK</span></span><button>
			</div>
		</div>
	</div>

	<script>
		var curLoaded = [];
		var selected = [];
		var html = [];

		function hideCatalogBlock(){
			jQuery('#modcat_main').hide();
			jQuery('#modcat').fadeOut();
		}

		function showCatalogBlock(){
			jQuery('#modcat').fadeIn(500, function(){
				jQuery('#modcat_main').fadeIn();
			});
		}

		function loadCatalogList(load_id){
			jQuery("#modcat_main_inner").html('');
			jQuery('#modcat_main').css({
				'border-radius': '20px',
				width: '500px',
				height: '530px',
				position: 'absolute',
				top: '50%',
				left: '50%',
				background: 'url("/requests/images/pre.gif") white 50% 50% no-repeat',
				padding: '20px',
				'margin-left': '-270px',
				'margin-top' : '-270px'
			});

			jQuery('#modcat').css({
				position: 'fixed',
				width: '100%',
				height: '100%',
				background: 'rgba(0, 0, 0, 0.5)',
				top: 0,
				left: 0,
				'z-index': 1000
			}).fadeIn(500, function(){
				jQuery('#modcat_main').fadeIn();
			});

			jQuery("#modcat_main_inner").load("/partner/?a=sets&id="+load_id+" #setItemsCont", function(response, status, xhr){
				jQuery('#modcat_main').css('background-image', 'none');
				if(status == 'success') curLoaded = load_id;
                
		        jQuery('body').on('focusout', '#setitems input.qty', function(){
                	var curSumObj = jQuery("#"+jQuery(this).attr('data-for'));
                    var curSum = parseFloat(jQuery(this).val())*parseFloat(jQuery(this).attr('data-price'));
                    curSumObj.html(curSum);
                	var naborSum = 0;
                    jQuery('#setitems input.qty').each(function(){
                    	var itemPrice = parseFloat(jQuery(this).attr("data-price"));
                        var itemCnt = parseFloat(jQuery(this).val());
                        naborSum += itemPrice*itemCnt;
                    });
 					naborSum = naborSum.toFixed(2);
                   jQuery('.naborsum span').html(naborSum);
                });
				
			});
		}

		jQuery('body').on('click', '.set-cover', function(){
			var this_id =jQuery(this).data('id');
			if (curLoaded == this_id)
				showCatalogBlock();
			else loadCatalogList(this_id);
		});
	
    	jQuery('body').on('click', '#buy_complect', function(){
        	jQuery('#setitems form').each(function(){
                var url = jQuery(this).attr('action');
                jQuery.ajax({
                       type: "POST",
                       url: url,
                       data: jQuery(this).serialize(), // serializes the form's elements.
                       success: function(data)
                       {
				document.location = "/personal/cart/";
                          //console.log("form data succeed!");
                       }
                });
            })
            return false;
        })
    	
        
		jQuery('#modcat_main_close, #modcat_main_close_btn').on('click', hideCatalogBlock);
	</script>*/?>

	<div class="col-xs-12" id="reviews">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Отзывы</div>
			<!-- List group -->
			<ul class="list-group">
				<?if (count($arPartner['REVIEWS'])):?>
					<?foreach($arPartner['REVIEWS'] as $review):?>
						<li class="list-group-item">
							<div class="starline" style="width: 75px; background-position: 50% <?=intval($review['PROPERTY_REVIEWS_STARS_VALUE'])*-15;?>px"></div>
							<p class="text-right">
								<b>Заявка №<?=$review['PROPERTY_REVIEWS_ORDER_LINK_VALUE'];?></b>
								<?=$review['DATE_CREATE'];?>
							</p>
							<?=$review['DETAIL_TEXT'];?>
						</li>
					<?endforeach;?>
				<?else:?>
					<li class="list-group-item">
						Отзывы отсутствуют
					</li>
				<?endif;?>
			</ul>
		</div>
	</div>
</div>
