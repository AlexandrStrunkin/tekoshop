<?               
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_SESSION["CATALOG_PARAMS"]["CATALOG_AVAILABLE_PRODUCT"] == 'Y'){
    $_SESSION["CATALOG_PARAMS"]["CATALOG_AVAILABLE_PRODUCT"] = 'N';
} else {
    $_SESSION["CATALOG_PARAMS"]["CATALOG_AVAILABLE_PRODUCT"] = 'Y';
}
?>