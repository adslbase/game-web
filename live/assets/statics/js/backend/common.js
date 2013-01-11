function switchStylestyle(stylePath)
{
    $("#colstyle").attr("href",stylePath);
    $.cookie('style', stylePath, {
        expires: 7
    });
}

$(document).ready(function(){
    var c = $.cookie('style');
    if (c) switchStylestyle(c);

    $('.styleswitch').click(function()
    {
        switchStylestyle($(this).attr("rel"));
        return false;
    });

    $(window).bind("hashchange", function(e) {    
        
        hash = $.param.fragment();
        
        if(hash == '')
            hash = 'live';

        getMenu(hash);
    });
    $(window).trigger('hashchange');

    setRmainheight()
    
    
    if($.browser.msie && $.browser.version == 6.0)
    {
        $(window).resize(function bodySize(){
            var bWidth = ($(window).width() <= 980 ) ? 980 : '100%';
            $('#main').width(bWidth);
        });
        bodySize();
    }
});

function setRmainheight(){
    
    minheight = $(window).height()-120;
    
    if($("#cols").height()< minheight )
    {
        $("#cols").height(minheight);
        $("#rightMain").height(minheight);
    }

    $("#rightMain").load(function(){
        var mainheight = $(this).contents().find("#main").height()+4; //兼容ie8避免出现垂直滚动条。。待解决ie7。ie6
        if(mainheight  < minheight )
        {
            mainheight =  minheight;
        }
        $("#cols").height(mainheight);
        $(this).height(mainheight);  
    });
}



$("#leftMain .switchs").live('click',
    function () {
        $(this).toggleClass("on");
        $(this).parent().next("ul").slideToggle("slow");
    });   

$("#leftMain a").live('click', function(){
    $("#rightMain").attr("src",$(this).attr("href"));

    setRmainheight();
        
    $("#leftMain .submenu-active").removeClass("submenu-active");
    $(this).parent().addClass("submenu-active");

    return false;
})      

