function set_Loop_Hidden(){
    setTimeout(function(){
        $(".btn-close-alert").click();
    }, 10000);
}

function show_Alert_Success(){
    $("#alert-success").css('left', '5px');
    get_List();
}

function show_Alert_Warning($msg){
    $("#warning-msg").text($msg);
    $("#alert-warning").css('left', '5px');
}