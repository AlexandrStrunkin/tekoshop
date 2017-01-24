<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sortbar">
	<b>Сортировать по:</b>
	<span>рейтингу
		<i style="background: url('images/dir.png') no-repeat">
			<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam("sort_r=0", array("sort_n", "sort_r"));?>" class="sort_asc"></a>
			<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam("sort_r=1", array("sort_n", "sort_r"));?>" class="sort_desc"></a>
		</i>
	</span>
	<span>названию
		<i style="background: url('images/dir.png') no-repeat">
			<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam("sort_n=0", array("sort_n", "sort_r"));?>" class="sort"></a>
			<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam("sort_n=1", array("sort_n", "sort_r"));?>" class="sort"></a>
		</i>
	</span>
</div>
