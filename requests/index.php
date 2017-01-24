<?define("NEED_AUTH", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

if($USER->IsAuthorized()):?> 
<div class="row"> 	 
  <div class="col-main col-xs-12 col-sm-9"> 	 
    <div class="bx_breadcrumbs"> 		 
      <ul> 			 
        <li><a href="/" title="Главная" >Главная</a></li>
       			 
        <li><a href="/personal/" title="Личный кабинет" >Личный кабинет</a></li>
       			 
        <li><span>Заявки на монтаж</span></li>
       		 </ul>
     	 </div>
	 <div class="page-title">
        <h1>Заявки на монтаж</h1>
    </div>
   	<?require('controller.php');?> </div>
 	 
  <div class="col-left sidebar col-xs-12 col-sm-3"> 		

<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH."/include_areas/r_left_menu.php",
			"EDIT_TEMPLATE" => ""
		)
	);?>
  
 
</div>
 </div>

 
 <?endif;?>
 
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>