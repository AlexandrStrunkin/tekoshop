<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<dl id="partners-list">
<?foreach($users as $arPartner):?>
	<dt>
		<a href="/partner/<?=$arPartner['ID'];?>/">
			<?=$arPartner['WORK_COMPANY'];?>
		</a>
	</dt>
	<dd>
		<div class="col-xs-2">

			<?if ($arPartner['WORK_LOGO']) :?>
				<div class="partner-logo">
					<a rel="nofollow" href="/partner/<?=$arPartner['ID'];?>/">
						<img src="<?=CFile::GetPath($arPartner['WORK_LOGO']);?>" alt="<?=$arPartner['WORK_COMPANY'];?>">
					</a>
				</div>
			<?else:?>
				<div class="partner-nologo">
					<a rel="nofollow" href="/partner/<?=$arPartner['ID'];?>/">
						Нет лого
					</a>
				</div>
			<?endif;?>

			<div class="starline" style="background-position: 50% <?=intval($arPartner['ADMIN_NOTES'])*-15;?>px">

			</div>

			<div>
				<a rel="nofollow" href="/partner/<?=$arPartner['ID'];?>/#reviews">
					Отзывы
				</a>
			</div>

		</div>
		<div class="col-xs-10">
			<div class="clearfix">
				<div class="col-xs-3"><b>Статус:</b></div>
				<div class="col-xs-9"><?=intval($arPartner['WORK_NOTES']) ? '<span class="busy-status"> <b>Занят</b></span>' : '<span class="free-status"> <b>Свободен</b></span>';?></div>
			</div>

			<div class="clearfix">
				<div class="col-xs-3"><b>Город:</b></div>
				<div class="col-xs-9"><?=$arPartner['WORK_CITY'];?></div>
			</div>

			<div class="clearfix">
				<div class="col-xs-3"><b>Вид деятельности:</b></div>
				<div class="col-xs-9">
					<?$arGroups = explode(',', $arPartner['GROUPS']);
					foreach($arGroups as $group)
					{
						echo $partner->getGroupByID($group).'<br>';
					}
					?>

				</div>
			</div>

			<div class="clearfix">
				<div class="col-xs-3"><b>Адрес:</b></div>
				<div class="col-xs-9"><?=$arPartner['WORK_STREET'];?></div>
			</div>

			<div class="clearfix">
				<div class="col-xs-3"><b>Телефон:</b></div>
				<div class="col-xs-9"><?=$arPartner['WORK_PHONE'];?></div>
			</div>

			<div class="clearfix">
				<div class="col-xs-3"><b>E-mail:</b></div>
				<div class="col-xs-9"><?=$arPartner['EMAIL'];?></div>
			</div>

			<div class="clearfix">
				<div class="col-xs-3"><b>Сайт:</b></div>
				<div class="col-xs-9"><?=$arPartner['WORK_WWW'];?></div>
			</div>
			<div class="clearfix">
				<div class="col-xs-12">
					<form action="/personal/requests/?edit=Y" method="POST">
						<input type="hidden" name="order" value="<?=$arPartner['ID'];?>">
						<input type="submit" class="offer-to" value="Предложить задание">
					</form>
				</div>
			</div>

		</div>
	</dd>
<?endforeach;?>
</dl>
