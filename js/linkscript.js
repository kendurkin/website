$(document).ready(function(){
    $(".icon_description").hide();
    $("#resume").hide();
    $(".link").mouseenter(function(){
        if($(window).width()>=978){
            if($(this).find("span").is(':hidden')){
                $(this).find("span").show("500");
            }
        }   
    });

    $(window).resize(function(){
        if ($(window).width() < 978) {
            var spans = $('.icon_description');
            spans.hide();
        }
    });

    $("#download").mouseenter(function(){
    	if($("#resume").is(':hidden')){
  			$("#resume").show("500");  	
    	}
    });

	$("#download").mouseleave(function(){
		if($("#resume").is(':visible')){
			$("#resume").hide("800");
		}
	});
});