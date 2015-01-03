window.onload=function(){
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};

	if( isMobile.any() ){
	    $(document).ready(function(){
			$("#home").removeClass("attach");
			$("#projects").removeClass("attach");
			$("#education").removeClass("attach");
			$("#experience").removeClass("attach");
			$("#contact").removeClass("attach");
		
		    $(".desc").toggleClass("hovered");
		});
	}

	var date = new Date();
    document.getElementById('greeting').innerHTML = getGreeting(date);

    function getGreeting(date){
	    var time = date.getHours();
	    if (time >= 12 && time < 18)
	        return "Hope your day is going well!";
	    else if (time >= 18)
	        return "Hope you're enjoying your evening!";
	    else if (time >= 0 && time < 6)
	    	return "I'm a night owl too! What brings you to my site at " + date.toLocaleTimeString().replace(/:\d+ /, ' ') + "?";
	    else
	        return "Hope you have a great day today!";
	}
};