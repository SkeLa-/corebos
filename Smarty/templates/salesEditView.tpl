{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/
-->*}
<script type="text/javascript" src="include/js/FieldDependencies.js"></script>
{if $PICKIST_DEPENDENCY_DATASOURCE neq ''}
<script type="text/javascript">
	jQuery(document).ready(function() {ldelim} (new FieldDependencies({$PICKIST_DEPENDENCY_DATASOURCE})).init() {rdelim});
</script>
{/if}

{include file='Buttons_List.tpl'}

{*<!-- Contents -->*}
<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
   <tr>
	<td valign=top><img src="{'showPanelTopLeft.gif'|@vtiger_imageurl:$THEME}"></td>

	<td class="showPanelBg" valign=top width=100%>
		{*<!-- PUBLIC CONTENTS STARTS-->*}
		<div class="small" style="padding:20px">
			{if $OP_MODE eq 'edit_view'}
				{assign var="USE_ID_VALUE" value=$MOD_SEQ_ID}
				{if $USE_ID_VALUE eq ''} {assign var="USE_ID_VALUE" value=$ID} {/if}
				<span class="lvtHeaderText"><font color="purple">[ {$USE_ID_VALUE} ] </font>{$NAME} - {$APP.LBL_EDITING} {$SINGLE_MOD|@getTranslatedString:$MODULE} {$APP.LBL_INFORMATION}</span> <br>
				{$UPDATEINFO}
			{/if}
			{if $OP_MODE eq 'create_view'}
				{if $DUPLICATE neq 'true'}
					<span class="lvtHeaderText">{$APP.LBL_CREATING} {$APP.LBL_NEW} {$SINGLE_MOD|@getTranslatedString:$MODULE}</span> <br>
				{else}
					<span class="lvtHeaderText">{$APP.LBL_DUPLICATING} "{$NAME}" </span> <br>
				{/if}
			{/if}

			<hr noshade size=1>
			<br>

			{include file='EditViewHidden.tpl'}

			{*<!-- Account details tabs -->*}
			<table border=0 cellspacing=0 cellpadding=0 width=95% align=center>
			   <tr>
				<td>
					<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
					   <tr>
						<td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>
						<td class="dvtSelectedCell" align=center nowrap> {$SINGLE_MOD|@getTranslatedString:$MODULE} {$APP.LBL_INFORMATION}</td>
						<td class="dvtTabCache" style="width:10px">&nbsp;</td>
						<td class="dvtTabCache" style="width:100%">&nbsp;</td>
					   </tr>
					</table>
				</td>
			   </tr>
			   <tr>
				<td valign=top align=left >
					<table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
					   <tr>

						<td align=left>
							{*<!-- content cache -->*}
					
							<table border=0 cellspacing=0 cellpadding=0 width=100%>
							   <tr>
								<td style="padding:10px">
									<!-- General details -->
									<table border=0 cellspacing=0 cellpadding=0 width="100%" class="small createview_table">
									   <tr>
										<td  colspan=4 style="padding:5px">
											<div align="center">
												{if $MODULE eq 'Webmails'}
													<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';this.form.module.value='Webmails';this.form.send_mail.value='true';this.form.record.value='{$ID}'" type="submit" name="button" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  ">
												{else}
													<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmButton small save" onclick="this.form.action.value='Save'; displaydeleted(); return formValidate();" type="submit" name="button" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  ">
												{/if}
													<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  ">
											</div>
										</td>
									   </tr>

									   <!-- included to handle the edit fields based on ui types -->
									   {foreach key=header item=data from=$BLOCKS}

							<!-- This is added to display the existing comments -->
							{if $header eq $APP.LBL_COMMENTS || (isset($MOD.LBL_COMMENT_INFORMATION) && $header eq $MOD.LBL_COMMENT_INFORMATION)}
							   <tr><td>&nbsp;</td></tr>
							   <tr>
								<td colspan=4 class="dvInnerHeader">
									<b>{if isset($MOD.LBL_COMMENT_INFORMATION)}{$MOD.LBL_COMMENT_INFORMATION}{else}{$APP.LBL_COMMENTS}{/if}</b>
								</td>
							   </tr>
							   <tr>
								<td colspan=4 class="dvtCellInfo">{$COMMENT_BLOCK}</td>
							   </tr>
							   <tr><td>&nbsp;</td></tr>
							{/if}

										<tr id="tbl{$header|replace:' ':''}Head">
										{if isset($MOD.LBL_ADDRESS_INFORMATION) && $header==$MOD.LBL_ADDRESS_INFORMATION && ($MODULE == 'Accounts' || $MODULE == 'Quotes' || $MODULE == 'PurchaseOrder' || $MODULE == 'SalesOrder'|| $MODULE == 'Invoice') && $SHOW_COPY_ADDRESS eq 'yes'}
                                                                                <td colspan=2 class="detailedViewHeader">
                                                                                <b>{$header}</b></td>
                                                                                <td class="detailedViewHeader">
                                                                                <input name="cpy" onclick="return copyAddressLeft(EditView)" type="radio"><b>{$APP.LBL_RCPY_ADDRESS}</b></td>
                                                                                <td class="detailedViewHeader">
                                                                                <input name="cpy" onclick="return copyAddressRight(EditView)" type="radio"><b>{$APP.LBL_LCPY_ADDRESS}</b></td>
										{elseif isset($MOD.LBL_ADDRESS_INFORMATION) && $header== $MOD.LBL_ADDRESS_INFORMATION && $MODULE == 'Contacts' && $SHOW_COPY_ADDRESS eq 'yes'}
										<td colspan=2 class="detailedViewHeader">
                                                                                <b>{$header}</b></td>
                                                                                <td class="detailedViewHeader">
                                                                                <input name="cpy" onclick="return copyAddressLeft(EditView)" type="radio"><b>{$APP.LBL_CPY_OTHER_ADDRESS}</b></td>
                                                                                <td class="detailedViewHeader">
                                                                                <input name="cpy" onclick="return copyAddressRight(EditView)" type="radio"><b>{$APP.LBL_CPY_MAILING_ADDRESS}</b></td>
                                                                                {else}
										<td colspan=4 class="detailedViewHeader">
											<b>{$header}</b>
										</td>
										{/if}
										</tr>

                                                                                {if $CUSTOMBLOCKS.$header.custom}
                                                                                    {include file=$CUSTOMBLOCKS.$header.tpl}
                                                                                {else}
                                                                                    <!-- Handle the ui types display -->
                                                                                    {include file="DisplayFields.tpl"}
                                                                                {/if}

									   {/foreach}


									   <!-- Added to display the Product Details in Inventory-->
									   {if $MODULE eq 'PurchaseOrder' || $MODULE eq 'SalesOrder' || $MODULE eq 'Quotes' || $MODULE eq 'Invoice'}
							   		   <tr>
										<td colspan=4>
											{include file="ProductDetailsEditView.tpl"}
										</td>
							   		   </tr>
									   {/if}

									   <tr>
										<td  colspan=4 style="padding:5px">
											<div align="center">
										{if $MODULE eq 'Emails'}
										<input title="{$APP.LBL_SELECTEMAILTEMPLATE_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECTEMAILTEMPLATE_BUTTON_KEY}" class="crmbutton small create" onclick="window.open('index.php?module=Users&action=lookupemailtemplates&entityid={$ENTITY_ID}&entity={$ENTITY_TYPE}','emailtemplate','top=100,left=200,height=400,width=300,menubar=no,addressbar=no,status=yes')" type="button" name="button" value="{$APP.LBL_SELECTEMAILTEMPLATE_BUTTON_LABEL}">
										<input title="{$MOD.LBL_SEND}" accessKey="{$MOD.LBL_SEND}" class="crmbutton small save" onclick="this.form.action.value='Save';this.form.send_mail.value='true'; return formValidate()" type="submit" name="button" value="  {$MOD.LBL_SEND}  " >
										{/if}
										{if $MODULE eq 'Webmails'}
										<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';this.form.module.value='Webmails';this.form.send_mail.value='true';this.form.record.value='{$ID}'" type="submit" name="button" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  ">
										{else}
											<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';  displaydeleted();return formValidate();" type="submit" name="button" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  ">
										{/if}
                                            <input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  ">
											</div>
										</td>
									   </tr>
									</table>
								</td>
							   </tr>
							</table>
						</td>
					   </tr>
					</table>
				</td>
			   </tr>
			</table>
		</div>
	</td>
	<td align=right valign=top><img src="{'showPanelTopRight.gif'|@vtiger_imageurl:$THEME}"></td>
   </tr>
</table>
<!--added to fix 4600-->
<input name='search_url' id="search_url" type='hidden' value='{$SEARCH}'>
</form>

{if ($MODULE eq 'Emails' || $MODULE eq 'Documents' || $MODULE eq 'Timecontrol') and ($USE_RTE eq 'true')}
	<script type="text/javascript" src="include/ckeditor/ckeditor.js"></script>
<script type="text/javascript" defer="1">
	var textAreaName = null;
	{if $MODULE eq 'Documents'}
		textAreaName = "notecontent";
	{else}
		textAreaName = 'description';
	{/if}

	<!-- Solution for ticket #6756-->
	CKEDITOR.replace( textAreaName,
	{ldelim}
		extraPlugins : 'uicolor',
		uiColor: '#dfdff1',
			on : {ldelim}
				instanceReady : function( ev ) {ldelim}
					 this.dataProcessor.writer.setRules( 'p',  {ldelim}
						indent : false,
						breakBeforeOpen : false,
						breakAfterOpen : false,
						breakBeforeClose : false,
						breakAfterClose : false
				{rdelim});
			{rdelim}
		{rdelim}
	{rdelim});
	var oCKeditor = CKEDITOR.instances[textAreaName];
</script>
{/if}

<script>
	var fieldname = new Array({$VALIDATION_DATA_FIELDNAME});
	var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL});
	var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE});

	var ProductImages=new Array();
	var count=0;
	function delRowEmt(imagename)
	{ldelim}
		ProductImages[count++]=imagename;
	{rdelim}
	function displaydeleted()
	{ldelim}
		var imagelists='';
		for(var x = 0; x < ProductImages.length; x++)
		{ldelim}
			imagelists+=ProductImages[x]+'###';
		{rdelim}

		if(imagelists != '')
			document.EditView.imagelist.value=imagelists
	{rdelim}
	var res = JSON.parse({$PICKIST_DEPENDENCY_DATASOURCE});


	var role = '{$USER_ROLE}';
	var targets = getTargetFields(res);

	if(checkRoles(res)){
		changeFields(targets);
		hideFields(targets);
		readOnlyFields(targets);
	}



	function getRoles(res){
		roles = [];
		var length = res.roles.length;
		if (length>1) {
			for (var i = 0; i < res.roles.length; i++) {
				roles.push(res.roles.role[i]);
			}
		} else {
			roles.push(res.roles.role);
		}
		return roles;
	}

	function checkRoles(res){
		var proceed = false
		if (typeof(res.roles) != 'undefined'){
			var roles = getRoles(res);
			if(roles.includes(role)) proceed = true;
		} else {
			proceed = false;
		}
		return proceed;
	}

	function changeFields(targets){
		var targetFields = targets.change;
		if(typeof (targetFields) === 'undefined') return;
		var fields = targetFields.fields;
		var values = targetFields.values;
		for (var i = 0; i<fields.length; i++){
			var field = fields[i];
			var value = values[i];
			$("input[name="+field+"]").val(value);
		}
	}

	function hideFields(targets){
		var fields = targets.hide;
		if(fields.length < 1) return;
		for (var i = 0; i<fields.length; i++){
			var field = fields[i];
			$("input[name="+field+"]").css("display", "none");
		}
	}

	function readOnlyFields(targets){
		var fields = targets.read;
		if(fields.length < 1) return;
		for (var i = 0; i<fields.length; i++){
			var field = fields[i];
			$("input[name="+field+"]").prop("readonly", true);
		}
	}

	function getTargetFields(res){
		var targetChangeFields = [];
		var targetChangeValues = [];
		var targetHideFields = [];
		var targetReadFields = [];
		var dependencies = res.dependencies;
		var dependency, targets, targetField, targetValue, 	targetFields2;
		if(dependencies.dependency.length > 1) {
			//multiple dependecies
			for (var i = 0; i < dependencies.dependency.length; i++) {
				dependency = dependencies.dependency[i];
				targets = dependency.targets;
				conditions = dependency.conditions;
				if(!validateCondtions(conditions)) continue;
				if(targets.change.field.length  > 1 && typeof(targets.change.field) == 'object'){
					for(var c = 0; c<targets.change.field.length; c++) {
						targetField = targets.change.field[c];
						targetValue = targets.change.value[c];
						targetChangeValues.push(targetValue);
						targetChangeFields.push(targetField);
					}
				} else {
					targetField = targets.change.field;
					targetValue = targets.change.value;
					targetChangeFields.push(targetField);
					targetChangeValues.push(targetValue);
				}
				targetFields2 = { 'fields':targetChangeFields, 'values':targetChangeValues};

				if(targets.hide.field.length  > 1 && typeof(targets.hide.field) == 'object'){
					for(var h = 0; h<targets.hide.field.length; h++) {
						targetField = targets.hide.field[h];
						targetHideFields.push(targetField);
					}
				} else {
					targetField = targets.hide.field;
					targetHideFields.push(targetField);
				}

				if(targets.readonly.field.length  > 1 && typeof(targets.readonly.field) == 'object') {
					for (var r = 0; r<targets.readonly.field.length; r++){
						targetField = targets.readonly.field[r];
						targetReadFields.push(targetField);
					}
				} else {
					targetField = targets.readonly.field;
					targetReadFields.push(targetField);
				}

			}
		} else {
			//single dependency
			dependency = dependencies.dependency;
			targets = dependency.targets;
			conditions = dependency.conditions;
			if(validateCondtions(conditions)) {
				if (targets.change.field.length > 1 && typeof(targets.change.field) == 'object') {
					for (var c = 0; c < targets.change.field.length; c++) {
						targetField = targets.change.field[c];
						targetValue = targets.change.value[c];
						targetChangeFields.push(targetField);
						targetChangeValues.push(targetValue);
					}
				} else {
					targetField = targets.change.field;
					targetValue = targets.change.value;
					targetChangeFields.push(targetField);
					targetChangeValues.push(targetValue);
				}
				targetFields2 = { 'fields':targetChangeFields, 'values':targetChangeValues};

				if (targets.hide.field.length > 1 && typeof(targets.hide.field) == 'object') {
					for (var h = 0; h < targets.hide.field.length; h++) {
						targetField = targets.hide.field[h];
						targetHideFields.push(targetField);
					}
				} else {
					targetField = targets.hide.field;
					targetHideFields.push(targetField);
				}

				if (targets.readonly.field.length > 1 && typeof(targets.readonly.field) == 'object') {
					for (var r = 0; r < targets.readonly.field.length; r++) {
						targetField = targets.readonly.field[r];
						targetReadFields.push(targetField);
					}
				} else {
					targetField = targets.readonly.field;
					targetReadFields.push(targetField);
				}
			}
		}
		targetFields = { 'change' : targetFields2, 'hide' : targetHideFields, 'read' : targetReadFields };
		return targetFields;
	}

	function validateCondtions(conditions){
		var Fields = []; var Values = []; var Action = [];
		var condition, action, fields, values, valid;
		if (conditions.condition.length > 1 && typeof(conditions.condition) == 'object') {
			for(var i = 0 ; i < conditions.condition.length ; i++) {
				condition = conditions.condition[i];
				action = conditions.condition[i].action;
				fields = conditions.condition[i].fields;
				values = conditions.condition[i].values;
				if (fields.length > 1 && typeof(fields) == 'object') {
					for(var j = 0 ; j < fields.length ; j++){
						Fields.push(fields.field[j]);
					}
				} else {
					Fields.push(fields.field);
				}
				if(action != 'empty'){
					if (values.length > 1 && typeof(values) == 'object') {
						for(var j = 0 ; j < values.length ; j++){
							Values.push(values.value[j]);
						}
					} else {
						Values.push(values.value);
					}
				} else {
					Values.push("");
				}
				Action.push(action);
			}
		} else {
			action = conditions.condition.action;
			fields = conditions.condition.fields;
			values = conditions.condition.values;
			if (fields.length > 1 && typeof(fields) == 'object') {
				for(var j = 0 ; j < fields.length ; j++){
					Fields.push(fields.field[j]);
				}
			} else {
				Fields.push(fields.field);
			}
			if(action != 'empty') {
				if (values.length > 1 && typeof(values) == 'object') {
					for (var j = 0; j < values.length; j++) {
						Values.push(values.value[j]);
					}
				} else {
					Values.push(values.value);
				}
			} else {
				Values.push("");
			}
			Action.push(action);
		}
		valid = validateCondition(Fields, Values, Action);
		return valid;
	}

	function validateCondition(Fields, Values, Action){
		console.log(Fields);
		console.log(Values);
		console.log(Fields);
		var valid;
		var Valids = [];
		var localValids = [];
		for(var i = 0; i<Fields.length; i++){
			var field =  $("input[name=" + Fields[i] + "]").val();
			var value = Values[i];
			var action = Action[i];
			localValids[i] = [];
			//	console.log(value);
			if(action == 'contains') {
				for(var j = 0; j<value.length; j++){
					if(field.indexOf(value[j]) > -1){
						localValids[i].push(true);
					} else {
						localValids[i].push(false);
					}
				}
			}
			if(action == 'equals'){
				if(field == value){
					localValids[i].push(true);
				} else {
					localValids[i].push(false);
				}
			}
			if(action == 'greater'){
				if(field >= value){
					localValids[i].push(true);
				} else {
					localValids[i].push(false);
				}
			}
			if(action == 'lesser'){
				if(field <= value){
					localValids[i].push(true);
				} else {
					localValids[i].push(false);
				}
			}
			if(action == 'empty'){
				if (field ==''){
					localValids[i].push(true);
				} else {
					localValids[i].push(false);
				}
			}
			if(localValids[i].includes(true)){
				Valids.push(true);
			} else {
				Valids.push(false);
			}

		}
		if(Valids.length > 1){
			valid = !(Valids.includes(false));
		} else {
			valid = Valids[0]
		}
		console.log(Valids);
		console.log(valid);
		return valid;
	}
</script>

<!-- vtlib customization: Help information assocaited with the fields -->
{if $FIELDHELPINFO}
<script type='text/javascript'>
{literal}var fieldhelpinfo = {}; {/literal}
{foreach item=FIELDHELPVAL key=FIELDHELPKEY from=$FIELDHELPINFO}
	fieldhelpinfo["{$FIELDHELPKEY}"] = "{$FIELDHELPVAL}";
{/foreach}
</script>
{/if}
<!-- END -->
