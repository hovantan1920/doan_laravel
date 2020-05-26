function messageSuccess(){
    $("#alert-success").css('left', '5px');
    refresh();
    setTimeout(function(){
        $(".btn-close-alert").click();
    }, 10000);
}

function messageWarning($msg){
    $("#warning-msg").text($msg);
    $("#alert-warning").css('left', '5px');
    setTimeout(function(){
        $(".btn-close-alert").click();
    }, 10000);
}