$(window).load(function(){
	
});
$(function(){
	var index = 0;
	if( $('.projectviewer-next').length > 0 ){
		$('.projectviewer-next').click(function(){
			$('.projectviewer-prev').show();
			var index = $('.projectviewer .active').index();
			$('.projectviewer .active').removeClass('active');
			$('.projectviewer li').eq(++index).addClass('active');
			$('.projectviewer ul').animate({left:'-=800'}, function(){
				
			});
			if( $('.projectviewer li').length-1 == index ){
				$(this).hide();
			}
		});
		$('.projectviewer-prev').click(function(){
			$('.projectviewer-next').show();
			var index = $('.projectviewer .active').index();
			$('.projectviewer .active').removeClass('active');
			$('.projectviewer li').eq(--index).addClass('active');
			$('.projectviewer ul').animate({left:'+=800'}, function(){
				
			});
			if( index == 0 ){
				$(this).hide();
			}
		});
	}
	$('.projectviewer li img').click(function(){
		var w = $(this).width();
		var h = $(this).height();
		var ww = $(window).width();
		var wh = $(window).height();
		var imgratio = w/h;
		var wratio = ww/wh;
		console.log(wratio, imgratio);
		var src = $(this).attr('src');
		$('#zoom img').attr('src', src);
		$('#zoom').css({width:$(window).width(), height:$(window).height()}).show();
		if( imgratio > wratio ){
			$('#zoom img').css({width:'90%', height:'auto'});
		} else {
			$('#zoom img').css({width:'auto', height:'90%'});
		}
		/*
		var cw = $(window).width();
		var ch = $(window).height();
		var w = $('#zoom img').width();
		var h = $('#zoom img').height();
		if( h < ch ){
			$('#zoom').css({'padding-top':(ch-h)/2});
		} else {
			$('#zoom').css({'padding-top':0});
		}
		$('#zoom').hide().fadeIn();
		*/
	});
	$('#zoom').click(function(){
		$(this).fadeOut();
	});
	$('#tab').click(function(){
		if( $('#container').hasClass('loading') ){
			alert('please wait for images to load');
		} else {
			var constant = 240;
			if( $(this).hasClass('active') ){
				$(this).removeClass('active').animate({right:'+='+constant});
			} else {
				$(this).addClass('active').animate({right:'-='+constant});
			}
		}
	});
	var index = 0;
	var l = $('.viewer img').length;
	var barl = 208;
	var seg = barl/l;
	console.log(l, barl, seg);
	$('#progress').animate({width:'+='+seg}, 50);
	$('.viewer img').each(function(){
		$(this).load(function(){
			index++;
			console.log($(this));
			$('#progress').animate({width:'+='+seg}, 50);
			if( index >= l ){
				$('#container').removeClass('loading');
			}
		});
	});
	$(window).resize(function(){
		$('#zoom').css({width:$(window).width(), height:$(window).height()});
	});
});