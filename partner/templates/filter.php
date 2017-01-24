<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="" method="get" class="filterbar">
	<input type="hidden" value="Y" name="filter">
	<div class="col-xs-6">
		<div class="form-group">
			<label for="city_select">Город<?echo $filter['WORK_CITY'];?></label>
			<select name="city" id="city_select" class="form-control">
				<?
                $curCity = $_GET['city'] ?  $_GET['city'] : DEFAULT_CITY;
				foreach($arCityList as $cityId => $cityName):?>
					<option <?=intval($curCity) == $cityId? 'selected' : '';?> value="<?=$cityId;?>">
						<?=$cityName;?>
					</option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	<div class="col-xs-6">
		<?
		$arGroupNames = $partner->getGroupsNames();
		foreach($arGroupNames as $groupId => $groupName):?>
			<?$checked = in_array($groupId, $_GET['work'])? 'checked="checked"':'';?>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="work[]" value="<?=$groupId;?>" <?=$checked;?>><?=$groupName;?>
				</label>
			</div>
		<?endforeach;?>
		<button type="submit" class="button btn-cart">
			<span>
				<span>Применить</span>
			</span>
		</button>
	</div>

</form>
<div class="clearfix"></div>
<hr>
