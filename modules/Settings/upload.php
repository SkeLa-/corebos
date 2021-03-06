<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/
require_once('Smarty_setup.php');
require_once('include/utils/utils.php');
require_once('modules/Settings/savewordtemplate.php');

global $app_strings, $mod_strings, $app_list_strings, $adb, $theme, $default_charset;

$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";

$smarty = new vtigerCRM_Smarty;
if(isset($_REQUEST['flag']) && $_REQUEST['flag'] != '')
{
	$flag = vtlib_purify($_REQUEST['flag']);
	switch($flag)
	{
		case 1:
			$smarty->assign("ERRORFLAG","<font color='red'>".$mod_strings['LBL_DOC_MSWORD']."</B></font>");
			break;
		case 2:
			$smarty->assign("ERRORFLAG","<font color='red'>".$mod_strings['LBL_NODOC']."</B></font>");
			break;
		default:
			$smarty->assign("ERRORFLAG","");
			break;
	}
}

$tempModule= vtlib_purify($_REQUEST['tempModule']);
$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("APP", $app_strings);
$smarty->assign("UMOD", $mod_strings);
$smarty->assign("PARENTTAB", getParentTab());
$upload_maxsize = GlobalVariable::getVariable('Application_Upload_MaxSize',3000000,$currentModule);
$smarty->assign("MAX_FILE_SIZE", $upload_maxsize);

$template = Array(
	"Leads"=>"LEADS_SELECTED",
	"Accounts"=>"ACCOUNTS_SELECTED",
	"Contacts"=>"CONTACTS_SELECTED",
	"HelpDesk"=>"HELPDESK_SELECTED"
);

$smarty->assign($template[$tempModule],"selected");

$smarty->display('CreateWordTemplate.tpl');
?>