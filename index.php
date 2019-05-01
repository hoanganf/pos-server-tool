<?php
	include_once 'config.php';

	include_once constant("LIB_DIR").'/php/dao/Data.php';
	include_once constant("LIB_DIR").'/php/dao/BaseDAO.php';
	include_once constant("LIB_DIR").'/php/util/PageBuilder.php';
	include_once constant("LIB_DIR").'/php/util/PageGetter.php';

	include_once constant("MODEL_DIR").'dao/CategoryDAO.php';
	include_once constant("MODEL_DIR").'dao/ProductDAO.php';
	include_once constant("MODEL_DIR").'dao/UnitDAO.php';
	include_once constant("MODEL_DIR").'dao/IngredientDAO.php';
	include_once constant("MODEL_DIR").'dao/RestaurantDAO.php';
	include_once constant("MODEL_DIR").'dao/UserDAO.php';

	include_once constant("MODEL_DIR").'ProductPageBuilder.php';
	include_once constant("MODEL_DIR").'CategoryPageBuilder.php';
	include_once constant("MODEL_DIR").'UnitPageBuilder.php';
	include_once constant("MODEL_DIR").'IngredientPageBuilder.php';
	include_once constant("MODEL_DIR").'RestaurantPageBuilder.php';
	include_once constant("MODEL_DIR").'UserPageBuilder.php';

	include_once constant("CONTROLLER_DIR").'ToolPageGetter.php';

	set_error_handler("errorRedirect");

	$pageId='product';
	if(isset($_GET['pageId'])){
		$pageId=$_GET['pageId'];
	}
	$pageBuilder=new ToolPageGetter();
	$pageBuilder->get($pageId);
?>
