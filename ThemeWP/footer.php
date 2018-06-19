<script src="/wp-content/themes/ThemeWP/js/jquery-3.1.0.min.js"></script>
<script src="/wp-content/themes/ThemeWP/js/jquery.easing.min.js"></script>
<script src="/wp-content/themes/ThemeWP/js/jquery.mousewheel.min.js"></script>
<script src="/wp-content/themes/ThemeWP/js/viewScroller.js"></script>
<script src="/wp-content/themes/ThemeWP/js/slider.js"></script>
<script>

$(document).ready(function() {

if($(window).width()>= '898' && $(window).height()<= '700'){

$(".wpcf7-form").attr("action", "#view-5");
$(".wpcf7-form invalid").attr("action", "#view-5");

    $('.mainbag').viewScroller({
                
                changeWhenAnim: false
			})	

}else{

$('.mainbag').viewScroller({
                useScrollbar: true,
                changeWhenAnim: false
			})	
};
});
var wrapper = $( ".file_upload" ),
	inp = wrapper.find( "input" ),
	btn = wrapper.find( "button" ),
	lbl = wrapper.find( "div" );
    
btn.focus(function(){
	inp.focus();
});
    // Crutches for the :focus style:
inp.focus(function(){
		wrapper.addClass( "focus" );
	}).blur(function(){
		wrapper.removeClass( "focus" );
});
	
btn.add( lbl ).click(function(){
	inp.click();
});

btn.focus(function(){
		wrapper.addClass( "focus" );
	}).blur(function(){
		wrapper.removeClass( "focus" );
});

var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

inp.change(function(){
	var file_name;
	if( file_api && inp[ 0 ].files[ 0 ] ){
		file_name = inp[ 0 ].files[ 0 ].name;
	}
	else{
		file_name = inp.val().replace( "C:\\fakepath\\", '' );
	}
    
	if( ! file_name.length ){
		return;
	}
	
	if( lbl.is( ":visible" ) ){
		lbl.text( file_name );
		btn.text( "Додати фото" );
    }
	else{
		btn.text( file_name );
	}
}).change();

$(window).resize(function(){
	$( ".file_upload input" ).triggerHandler( "change" );
});
window.onload=function (){if(window.location=="http://hermes-tm.com.ua/#view-5")setTimeout(function(){window.location.replace("http://hermes-tm.com.ua/#v5");},1000);};
$( "#menu-button" ).click(function() {

if($(".menu-center").css("display")=="none"){$(".menu-center").css("display","block");}
else{$(".menu-center").css("display","none");}
});
if($(window).width()<= '898'){
$( ".f-b" ).click(function() {
$(".menu-center").css("display","none");
})
};

	</script>
</body>
</html>