<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($AD):?>
<p>Предложенный товар был добавлен в корзину</p>
<?endif;?>
<p>Статус заявки изменен на "В Работе"</p>
<p><a href="/personal/requests/">Вернуться в заявки</a></p>

<script type="text/javascript">
jQuery(function(){
	updateBasket();
})
</script>