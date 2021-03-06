<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************/
require_once("include/utils/CommonUtils.php");
require_once 'include/Webservices/Utils.php';
require_once 'include/Webservices/DescribeObject.php';

require 'include.inc';
function vtJsonFields($adb, $request){
	$moduleName = $request['modulename'];
	$mem = new VTModuleExpressionsManager($adb);
	$expressionFields = $mem->expressionFields($moduleName);
	$fields = $mem->fields($moduleName);
	echo json_encode(array('exprFields'=>$expressionFields, 'moduleFields'=>$fields));
}
vtJsonFields($adb, $_REQUEST);
?>