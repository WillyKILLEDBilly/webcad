var onResize = function (){
	return function(){
		var headerBg = $('.q-header-background');
		headerBg.height(600);//1920×701, %=36,51
		$('#canvas').width(headerBg.width());
		$('#canvas').height(headerBg.height());
	}
}();

var onScroll = function(){
	var switched = true;
	return function(){
		var headerBg = $('.q-header-background');
		var headerHeight = headerBg.outerHeight();
		var navbar = $('#q-navbar');
		var navbarHeight = navbar.outerHeight();
		var scrolledDistance = $(window).scrollTop();

		if(!switched){
			if ((headerHeight-scrolledDistance)<=navbarHeight){
				navbar.addClass("q-navbar-small").removeClass("q-navbar-large");
				switched=true;
			}
			var x = Number.parseInt(scrolledDistance/(headerHeight/100));
			headerBg.css("filter","grayscale("+x*1.5+"%)");
		}
		else if (switched && (headerHeight-scrolledDistance)>=navbarHeight){
			navbar.addClass("q-navbar-large").removeClass("q-navbar-small");
			switched=false;
		}
	}
}();

$(window).ready(function(){
//	onResize();
	onScroll();
	moment.locale('uk');
	$('.time-ago').each(function(){
		var time = $(this).text();
		var format = 'YYYY-MM-DD H:m:s';
		var convertedTime = moment(time, format).fromNow();
		$(this).text(convertedTime);
	});
});
//$(window).resize(onResize);
$(window).scroll(onScroll);