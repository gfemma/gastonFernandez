$.fn.msgerr = function(msg){
    $(this).popover({
        animation: true,
        container: 'body',
        html: true,
        content: msg,
        template: '<div class="errorMsg"><span>'+msg+'</span></div>',
        placement: 'top',
        trigger: 'focus click',
        tabindex: 0
    });
    $(this).popover('enable');
    $(this).popover('show');
    $(this).on('click', function(){
        $(this).popover('hide');
        $(this).popover('disable');
    });
    var popovers = document.querySelectorAll("div[x-placement]",".errorMsg", ".bs-popover");
    for(d of popovers){
        d.addEventListener("click", function(){
            $(this).popover('hide');
            $(this).popover('disable');
        });
    }
    setTimeout(()=>{
        for(d of popovers){
            $(d).popover('hide');
            $(d).popover('disable');
        }
    }, 9000);
    return false;
};
