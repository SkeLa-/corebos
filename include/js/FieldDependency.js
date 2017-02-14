var role;
function initFD(res, role1){
    role = role1;
    res = JSON.parse(res);
    var targets = getTargetFields(res);
    if(checkRoles(res)){
        changeFields(targets);
        hideFields(targets);
        readOnlyFields(targets);
    }

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