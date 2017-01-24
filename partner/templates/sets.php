<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="setslist">
<?foreach($arSets as $id => $set):?>
	<li class="set">
		<a class="set-cover element-<?=$id;?>" href="javascript:void(0)" data-id="<?=$id;?>">
			<?=$set["NAME"];?>
		</a>
	</li>
<?endforeach;?>
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

		jQuery("#modcat_main_inner").load("/partner/?a=sets&id="+load_id+" #setitems", function(response, status, xhr){
			jQuery('#modcat_main').css('background-image', 'none');
			if(status == 'success') curLoaded = load_id;
		});
	}

	jQuery('body').on('click', '.set-cover', function(){
		var this_id =jQuery(this).data('id');
		if (curLoaded == this_id)
			showCatalogBlock();
		else loadCatalogList(this_id);
	});

	jQuery('#modcat_main_close, #modcat_main_close_btn').on('click', hideCatalogBlock);
</script>*/?>
