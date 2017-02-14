var i = 1;
var fields;
var conds;
var actions;

function initFDMap(fields1, conds1, actions1){
    fields = fields1;
    conds = conds1;
    actions = actions1;
}

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
    for (var i = 0; i< actions.length; i++){
        var opt = document.createElement('option');
        opt.value = actions[i];
        opt.innerHTML = actions[i];
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