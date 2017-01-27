<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *********************************************************************************/
require_once 'include/utils/utils.php';
require_once 'modules/PickList/PickListUtils.php';

class Vtiger_DependencyPicklist {

	static function getDependentPicklistFields($module='') {
		global $adb;

		if(empty($module)) {
			$result = $adb->pquery('SELECT DISTINCT sourcefield, targetfield, tabid FROM vtiger_picklist_dependency', array());
		} else {
			$tabId = getTabid($module);
			$result = $adb->pquery('SELECT DISTINCT sourcefield, targetfield, tabid FROM vtiger_picklist_dependency WHERE tabid=?', array($tabId));
		}
		$noofrows = $adb->num_rows($result);

		$dependentPicklists = array();
		if($noofrows > 0) {
			$fieldlist = array();
			for($i=0; $i<$noofrows; ++$i) {
				$fieldTabId = $adb->query_result($result,$i,'tabid');
				$sourceField = $adb->query_result($result,$i,'sourcefield');
				$targetField = $adb->query_result($result,$i,'targetfield');

				if(getFieldid($fieldTabId, $sourceField) == false || getFieldid($fieldTabId, $targetField) == false) {
					continue;
				}

				$fieldResult = $adb->pquery('SELECT fieldlabel FROM vtiger_field WHERE fieldname = ?', array($sourceField));
				$sourceFieldLabel = $adb->query_result($fieldResult,0,'fieldlabel');

				$fieldResult = $adb->pquery('SELECT fieldlabel FROM vtiger_field WHERE fieldname = ?', array($targetField));
				$targetFieldLabel = $adb->query_result($fieldResult,0,'fieldlabel');

				$dependentPicklists[] = array('sourcefield'=>$sourceField, 'sourcefieldlabel'=>$sourceFieldLabel,
						'targetfield'=>$targetField, 'targetfieldlabel'=>$targetFieldLabel,
						'module'=>getTabModuleName($fieldTabId));
			}
		}
		return $dependentPicklists;
	}

	static function getAvailablePicklists($module) {
		global $adb, $log;
		$tabId = getTabid($module);

		$query="select vtiger_field.fieldlabel,vtiger_field.fieldname" .
				" FROM vtiger_field inner join vtiger_picklist on vtiger_field.fieldname = vtiger_picklist.name" .
				" where displaytype=1 and vtiger_field.tabid=? and vtiger_field.uitype in ('15','16') " .
				" and vtiger_field.presence in (0,2) ORDER BY vtiger_picklist.picklistid ASC";

		$result = $adb->pquery($query, array($tabId));
		$noofrows = $adb->num_rows($result);

		$fieldlist = array();
		if($noofrows > 0) {
			for($i=0; $i<$noofrows; ++$i) {
				$fieldlist[$adb->query_result($result,$i,"fieldname")] = $adb->query_result($result,$i,"fieldlabel");
			}
		}
		return $fieldlist;
	}

	static function savePickListDependencies($module, $dependencyMap) {
		global $adb;
		$tabId = getTabid($module);
		$sourceField = $dependencyMap['sourcefield'];
		$targetField = $dependencyMap['targetfield'];

		$valueMapping = $dependencyMap['valuemapping'];
		for($i=0; $i<count($valueMapping); ++$i) {
			$mapping = $valueMapping[$i];
			$sourceValue = $mapping['sourcevalue'];
			$targetValues = $mapping['targetvalues'];
			$serializedTargetValues = json_encode($targetValues);

			$optionalsourcefield = $mapping['optionalsourcefield'];
			$optionalsourcevalues = $mapping['optionalsourcevalues'];

			if(!empty($optionalsourcefield)) {
				$criteria = array();
				$criteria["fieldname"] = $optionalsourcefield;
				$criteria["fieldvalues"] = $optionalsourcevalues;
				$serializedCriteria = json_encode($criteria);
			} else {
				$serializedCriteria = null;
			}

			$checkForExistenceResult = $adb->pquery("SELECT id FROM vtiger_picklist_dependency WHERE tabid=? AND sourcefield=? AND targetfield=? AND sourcevalue=?",
					array($tabId, $sourceField, $targetField, $sourceValue));
			if($adb->num_rows($checkForExistenceResult) > 0) {
				$dependencyId = $adb->query_result($checkForExistenceResult, 0, 'id');
				$adb->pquery("UPDATE vtiger_picklist_dependency SET targetvalues=?, criteria=? WHERE id=?",
						array($serializedTargetValues, $serializedCriteria, $dependencyId));
			} else {
				$adb->pquery("INSERT INTO vtiger_picklist_dependency (id, tabid, sourcefield, targetfield, sourcevalue, targetvalues, criteria)
								VALUES (?,?,?,?,?,?,?)",
						array($adb->getUniqueID('vtiger_picklist_dependency'), $tabId, $sourceField, $targetField, $sourceValue,
						$serializedTargetValues, $serializedCriteria));
			}
		}
	}

	static function deletePickListDependencies($module, $sourceField, $targetField) {
		global $adb;

		$tabId = getTabid($module);

		$adb->pquery("DELETE FROM vtiger_picklist_dependency WHERE tabid=? AND sourcefield=? AND targetfield=?",
				array($tabId, $sourceField, $targetField));
	}

	static function getPickListDependency($module, $sourceField, $targetField) {
		global $adb;

		$tabId = getTabid($module);
		$dependencyMap = array();
		$dependencyMap['sourcefield'] = $sourceField;
		$dependencyMap['targetfield'] = $targetField;

		$result = $adb->pquery('SELECT * FROM vtiger_picklist_dependency WHERE tabid=? AND sourcefield=? AND targetfield=?',
				array($tabId,$sourceField,$targetField));
		$noOfMapping = $adb->num_rows($result);

		$valueMapping = array();
		$mappedSourceValues = array();
		for($i=0; $i<$noOfMapping; ++$i) {
			$sourceValue = $adb->query_result($result, $i, 'sourcevalue');
			$targetValues = $adb->query_result($result, $i, 'targetvalues');
			$unserializedTargetValues = json_decode(html_entity_decode($targetValues),true);

			$mapping = array();
			$mapping['sourcevalue'] = $sourceValue;
			$mapping['targetvalues'] = $unserializedTargetValues;

			$valueMapping[$i] = $mapping ;
		}
		$dependencyMap['valuemapping'] = $valueMapping;

		return $dependencyMap;
	}

	static function getPicklistDependencyDatasource($module) {
		global $adb;


        $xml2 = "<?xml version=\"1.0\"?> 
     <map>
    <origin>
        <name>Campaigns</name>
    </origin>
    <roles>
    <role>CEO</role>
    </roles>
    <dependencies>
        <dependency>
           <name>startdate</name>
            <conditions>
                <condition>
                    <operator>haschanged</operator>
                    <values></values>
                </condition>
            </conditions>
            <targets>
                <change>
                    <field>enddate</field>
                    <corebos_expression>add_days('startdate',60)</corebos_expression>
                </change>
            </targets>
        </dependency>
        <dependency>
            <conditions>
                <condition>
                    <module>Campaigns</module>
                    <fields>
                        <field>campaignname</field>
                    </fields>
                    <action>contains</action>
                    <values>
                        <value>ad</value>
                        <value>ia</value>
                    </values>
                </condition>  
                   <condition>
                    <module>Campaigns</module>
                    <fields>
                        <field>campaign_no</field>
                    </fields>
                    <action>contains</action>
                    <values>
                        <value>ad</value>
                        <value>ia</value>
                        <value>ia2</value>
                        <value>CA</value>
                    </values>
                </condition> 
                <condition>
                    <module>Campaigns</module>
                    <fields>
                        <field>product_name</field>
                    </fields>
                    <action>empty</action>
                </condition> 
                
                <condition>
                    <module>Campaigns</module>
                    <fields>
                        <field>expectedroi</field>
                    </fields>
                    <action>greater</action>
                    <values>
                        <value>2</value>
                    </values>
                </condition> 
                <condition>
                    <module>Campaigns</module>
                    <fields>
                        <field>numsent</field>
                    </fields>
                    <action>lesser</action>
                    <values>
                        <value>5</value>
                    </values>
                </condition> 
                <condition>
                    <module>Campaigns</module>
                    <fields>
                        <field>targetsize</field>
                    </fields>
                    <action>equals</action>
                    <values>
                        <value>15926</value>
                    </values>
                </condition> 
            </conditions>
            <targets>
                <change>
                <field>sponsor</field>
                <value>Sponzori</value>  
                <field>campaignname</field>
                <value>2323232</value>
                </change>
                <hide>
                <field>targetaudience</field>
                </hide>
                <readonly>
                <field>campaignname</field>
                </readonly>
                <collapse>
                </collapse>
            </targets>
        </dependency>
        
        
        
        
        
    </dependencies>
</map>";



        $ob = simplexml_load_string($xml2);
        $json = json_encode($ob);


        return $json;
	}

	static function getJSPicklistDependencyDatasource($module) {
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($module);
		return json_encode($picklistDependencyDatasource);
	}

	static function checkCyclicDependency($module, $sourceField, $targetField) {
		$adb = PearDatabase::getInstance();

		// If another parent field exists for the same target field - 2 parent fields should not be allowed for a target field
		$result = $adb->pquery('SELECT 1 FROM vtiger_picklist_dependency
									WHERE tabid = ? AND targetfield = ? AND sourcefield != ?',
				array(getTabid($module), $targetField, $sourceField));
		if($adb->num_rows($result) > 0) {
			return true;
		}

		//TODO - Add required check for cyclic dependency

		return false;
	}

	static function getDependentPickListModules() {
		$adb = PearDatabase::getInstance();

		$query = 'SELECT distinct vtiger_field.tabid, vtiger_tab.tablabel, vtiger_tab.name as tabname FROM vtiger_field
						INNER JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_field.tabid
						INNER JOIN vtiger_picklist ON vtiger_picklist.name = vtiger_field.fieldname
					WHERE uitype IN (15,16)
						AND vtiger_field.tabid != 29
						AND vtiger_field.displaytype = 1
						AND vtiger_field.presence in (0,2)
					GROUP BY vtiger_field.tabid HAVING count(*) > 1';
		// END
		$result = $adb->pquery($query, array());
		while($row = $adb->fetch_array($result)) {
			$modules[$row['tablabel']] = $row['tabname'];
		}
		uksort($modules, function($a,$b) {
			return (strtolower(getTranslatedString($a,$a)) < strtolower(getTranslatedString($b,$b))) ? -1 : 1;
		});
		return $modules;
	}

}
?>