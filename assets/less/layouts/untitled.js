$("pre").each(function (){
    $(this).animate({
        scrollTop:  $(this).scrollTop() - $(this).offset().top + $(this).find(".highlighted").offset().top - 50 
    }, 1000); 
    return this; 
});