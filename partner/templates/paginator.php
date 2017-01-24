<div class="bx_pagination_bottom"><div class="bx_pagination_page">
<span class="bx_pg_text">Страницы:</span>
<ul>
<?if ($page > 0):?>
    <li><a href="<?=$APPLICATION->GetCurPageParam("page=".($page-1), array("page"));?>">&#8592;</a></li>
<?endif;?>
<?for ($i=1;$i* $partner->getPaginator() < $partner->getCount();$i++){?>
	<?if (($i == $page) || ((0 == $page) && ($i==1))) {?>
	<li class="bx_active" title="Текущая страница"><?=$i?></li>
	<?} else {?>
	<li><a href="<?=$APPLICATION->GetCurPageParam("page=".($i), array("page"));?>"><?=$i?></a></li>
	<?}?>
<?} ?>
<?if((($page+1) * $partner->getPaginator()) < $partner->getCount()):?>
    <li><a href="<?=$APPLICATION->GetCurPageParam("page=".($page+1), array("page"));?>">&#8594;</a></li>
<?endif?>
</ul>
</div></div>
<?$APPLICATION->AddHeadString('<link href="/bitrix/templates/teko_mc/components//bitrix/system.pagenavigation/mc_visual/style.css";  type="text/css" rel="stylesheet" />',true)?>