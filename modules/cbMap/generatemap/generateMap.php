<?php
/*************************************************************************************************
 * Copyright 2016 JPL TSolucio, S.L. -- This file is a part of TSOLUCIO coreBOS Customizations.
 * Licensed under the vtiger CRM Public License Version 1.1 (the "License"); you may not use this
 * file except in compliance with the License. You can redistribute it and/or modify it
 * under the terms of the License. JPL TSolucio, S.L. reserves all rights not expressly
 * granted by the License. coreBOS distributed by JPL TSolucio S.L. is distributed in
 * the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Unless required by
 * applicable law or agreed to in writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT ANY WARRANTIES OR CONDITIONS OF ANY KIND,
 * either express or implied. See the License for the specific language governing
 * permissions and limitations under the License. You may obtain a copy of the License
 * at <http://corebos.org/documentation/doku.php?id=en:devel:vpl11>
 *************************************************************************************************
 *  Module       : Business Mappings
 *  Version      : 1.0
 *  Author       : JPL TSolucio, S. L.
 *************************************************************************************************/

require_once('modules/cbMap/cbMapcore.php');

class generatecbMap extends cbMapcore {

	function generateMap() {
		// you have to override this one with the specific functionality of your mapping
		$Map = $this->getMap();
        $mapType = $Map->column_fields['maptype'];
        $targetModule = $Map->column_fields['targetname'];
		echo '<br><h3>Create here your process to generate mappings for '.$Map->column_fields['maptype'].'</h3>';


        if($mapType == "FieldDependency"){
            $mapInstance = CRMEntity::getInstance($targetModule);
            $fields = $mapInstance->column_fields;
            $fields = json_encode(array_keys($fields));
            $conditions = json_encode(array("equals", "empty", "contains", "greater", "smaller"));
            $actions = json_encode(array("change", "disable", "hide"));


            echo $targetModule;
            echo "<input type=\"button\" value=\"New Dependency\" onclick=\"newDependency();\" class=\"crmButton small save\" name=\"newDependency\">";
            echo "<input type=\"button\" value=\"Reset\" onclick=\"reset();\" class=\"crmButton small save\" name=\"Reset\">";

            echo "<div id=\"dependencies\"></div>";


            echo "<script>
                    var i = 1;
                   
                    function newDependency(){
                        var div = document.createElement('div');
                        div.className = 'dependency-'+i;
                        div.id = 'dependency-'+i;
                        div.innerHTML = '<input type=\"button\" value=\"New Condition\" onclick=\"newCondition('+i+');\" class=\"crmButton small save\" name=\"newCondition\">\
                        <input type=\"button\" value=\"New Target\" onclick=\"newTarget('+i+');\" class=\"crmButton small save\" name=\"newTarget\">\
                        <div id=\"conditions-'+i+'\"></div><div id=\"targets-'+i+'\"></div>';
                        document.getElementById('dependencies').appendChild(div);
                        i++;
                    }
                    function newCondition(id){
                   
                    var fields = $fields;
                    var conds = $conditions;
                     var linebreak = document.createElement('br');
                    id = 'dependency-'+id;
                    document.getElementById(id).appendChild(linebreak);
                         var select = document.createElement('select');
                         select.className = 'Select Field';
                         var condition = document.createElement('select');
                         condition.className = 'Select Condition';
                         
                         for (var i = 0; i< fields.length; i++){
                            var opt = document.createElement('option');
                            opt.value = fields[i];
                            opt.innerHTML = fields[i];
                            select.appendChild(opt);
                        }
                        for (var i = 0; i< conds.length; i++){
                            var opt = document.createElement('option');
                            opt.value = conds[i];
                            opt.innerHTML = conds[i];
                            condition.appendChild(opt);
                        }
                    var input = document.createElement('input');
                     input.setAttribute('type', 'text');
                     document.getElementById(id).appendChild(select);
                     document.getElementById(id).appendChild(condition);
                     document.getElementById(id).appendChild(input);
                     document.getElementById('conditions-'+id).appendChild(document.getElementById(id));
                    }
                    function newTarget(id){
                     var fields = $fields;
                    var conds = $actions;
                     var linebreak = document.createElement('br');
                    id = 'dependency-'+id;
                    document.getElementById(id).appendChild(linebreak);
                         var select = document.createElement('select');
                         select.className = 'Select Field';
                         var condition = document.createElement('select');
                         condition.className = 'Select Condition';
                         
                         for (var i = 0; i< fields.length; i++){
                            var opt = document.createElement('option');
                            opt.value = fields[i];
                            opt.innerHTML = fields[i];
                            select.appendChild(opt);
                        }
                        for (var i = 0; i< conds.length; i++){
                            var opt = document.createElement('option');
                            opt.value = conds[i];
                            opt.innerHTML = conds[i];
                            condition.appendChild(opt);
                        }
                    var input = document.createElement('input');
                     input.setAttribute('type', 'text');
                     document.getElementById(id).appendChild(select);
                     document.getElementById(id).appendChild(condition);
                     document.getElementById(id).appendChild(input);
                     document.getElementById('conditions-'+id).appendChild(document.getElementById(id));
                    }
                    function reset(){
                    document.getElementById('dependencies').innerHTML = '';
                    i=1;
                    }
                </script>";
        }


		return "A";
	}

}
?>