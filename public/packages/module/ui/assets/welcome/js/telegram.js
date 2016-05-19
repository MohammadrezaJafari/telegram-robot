var order = 0;
var flag = false;
var data = [];
var commands = [];
function addText(){
    var element = "<div class=\"form-group\"><label class=\"col-sm-2 control-label\">Text</label> <div class=\"col-sm-10\"> <textarea rows=\"5\" name=\"command["+order+ "][text]\" placeholder=\"Text...\" class=\"form-control\"></textarea> </div><i class='del-arrayset  glyphicon glyphicon-remove-circle'></i> </div>";
    $('.form-horizontal > .form-group').last().before(element);
    $('.glyphicon-remove-circle').click(function(event){
        $(this).parent().remove();
        order--;
    });
    order++;
}

function addMedia(type){
    var element = '<div class="form-group"> ' +
        '<label class="col-sm-2 control-label">'+type+'</label>' +
        '<div class="col-sm-10"> ' +
        '<input id="id" name="command['+order+ ']['+type+'][data]" type="file"> ' +
        '<input name="command['+order+ ']['+type+'][description]" value="" type="text" class="form-control" id="column" placeholder="">' +
        '</div>' +
        '<i class="del-arrayset  glyphicon glyphicon-remove-circle"></i>' +
        '</div>';
    $('.form-horizontal > .form-group').last().before(element);
    $('.glyphicon-remove-circle').click(function(event){
        $(this).parent().remove();
        order--;
    });
    order++;
}

function getSelect(btnSize,row,col, value){
    var btnClass = "col-sm-" + btnSize;
    var options;
    for(var i=0;i<commands.length;i++){
        if(value == commands[i].name){
            options += '<option selected value="'+commands[i].name+'">'+commands[i].name+'</option>' ;
        }else{
            options += '<option value="'+commands[i].name+'">'+commands[i].name+'</option>' ;

        }
    }
    var select1 =
        '<div  style="margin-top: 10px" class="'+btnClass+'">' +
        '<select  name="keyboard[' + row + '][' + col + ']" class="form-control">' +
            options+
        '</select>' +
        '</div>';
    return select1;
}

function createKeyboard(){
    if(flag){
        $('.form-horizontal .form-group:last').prev().remove();
    }
    flag = true;
    $('.form-horizontal .form-group:last').prev().after('<div class="form-group" id="keyboard"></div>');
    var row = $('#row').val();
    var column = $('#column').val();
    var btnSize = parseInt(12/column);
    var element = getSelect(btnSize);
    var value;
    for(var i=0; i<row;i++){
        for(var j=0; j<column;j++){
            value = "";
            if(data[i] != undefined){
                if(data[i][j] != undefined){
                    value = data[i][j];
                }
            }
            $("#keyboard").append(getSelect(btnSize,i,j,value));
        }
    }
}
$(document).ready(function(){

    $('.glyphicon-remove-circle').click(function(event){
        $(this).closest('.form-group').remove();
        order--;
    });
    if($('input[name=order]').val() != undefined){
        order = parseInt($('input[name=order]').val());
    }
    if($('input[name=commands]').val() != undefined){
        commands = JSON.parse($('input[name=commands]').val());
    }
    //for edit page, check keyboard data is available
    if($('input[name=data]').val() != ""){
        // data = JSON.parse($('input[name=data]').val());
        flag = true;
        $('.form-horizontal .form-group:last').prev().after('<div class="form-group" id="keyboard"></div>');
        createKeyboard();
    }
});


