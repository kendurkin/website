$(document).ready(function () {
    $(document).on("scroll", onScroll);

    $('a[href*=#]:not(.carousel-control):not(.captcha)').click(function(e) {
        e.preventDefault();
        $(document).off("scroll");
        
        //Accounts for '#' special case which indicates '#home'
        $("ul.nav > li[class|='active']").removeClass("active");
        if(!(($(this).attr("href"))==="#"))
            $(this).parent().addClass("active");
        else
            $('a[href=#home]').parent().addClass("active");

        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
            || location.hostname == this.hostname) {
            
            //'#' should be manipulated so that the window scrolls to '#home'
            var target;
            if(($(this).attr("href"))==="#")
                target = $("#home");
            else
                target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            
            $('html,body').stop().animate({
                 scrollTop: (target.offset().top) - 50
            }, 1000, 'swing', function () {
                $(document).on("scroll", onScroll);
            });
        }
    });
});

//Determines which navigation button is active based on distance from top of viewing window
function onScroll(event) {
        var scrollPos = $(document).scrollTop();
        $('#my-navbar-collapse a').each(function(){
            var currLink = $(this);
            var refElement = $(currLink.attr("href"));
            /*
                console.log("refelement.position().top is " + refElement.position().top + 
                        " and refelement height is " + refElement.height() +
                        " while scrollpos is " + scrollPos);
            */
            if(refElement.position().top - 50 <= scrollPos && refElement.position().top + refElement.outerHeight(true) + refElement.next().outerHeight(true) > scrollPos){
                $("#my-navbar-collapse ul > li").removeClass("active");
                currLink.parent().addClass("active");
            }
            else{
                currLink.parent().removeClass("active");
            }
        });
    }