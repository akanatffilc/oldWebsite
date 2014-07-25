$(window).load(function(){
	$('.image').each(function(){
		console.log('each: ',$(this));
		$(this).load(function(){
			console.log('loaded: ',$(this));
			$(this).siblings('.loader').remove();
			$(this).show();
			var imagecontainer = $('.view-container-image').eq(0);
			var cw = imagecontainer.width();
			var ch = imagecontainer.height();
			var img = $(this);
			var w = img.width();
			var h = img.height();
			if( w > h ){
				img.width('100%');
				console.log(w, h, cw, ch, ch-(cw/(w/h)))/2;
				img.css({'margin-top':(ch-(cw/(w/h)))/2});
			} else {
				img.height('100%');
			}
		});
	});
});
$(function(){
	var index = 0;
	$('.image').each(function(){
		console.log('each: ',$(this));
		$(this).load(function(){
			console.log('index:', index);
			var preview = $('.preview').eq(index);
			index++;
			$('.preview-loading', preview).hide();
			$('.preview-loaded', preview).show();
			console.log('loaded: ',$(this), ', preview: ', $('.preview').eq(index));
			$(this).siblings('.loader').remove();
			$(this).show();
			var imagecontainer = $('.view-container-image').eq(0);
			var cw = imagecontainer.width();
			var ch = imagecontainer.height();
			var img = $(this);
			var w = img.width();
			var h = img.height();
			if( w > h ){
				img.width('100%');
				console.log(w, h, cw, ch, ch-(cw/(w/h)))/2;
				img.css({'margin-top':(ch-(cw/(w/h)))/2});
			} else {
				img.height('100%');
			}
		});
	});
	$('.preview').click(function(){
		$('.preview.active').removeClass('active');
		$(this).addClass('active');
		var index = $(this).attr('id').substring(7);
		$('.view-container-image.active').fadeOut(function(){
			$(this).removeClass('active');
			var imagecontainer = $('.view-container-image').eq(index);
			imagecontainer.show();
			imagecontainer.addClass('active');
			var cw = imagecontainer.width();
			var ch = imagecontainer.height();
			var img = $('.image', imagecontainer);
			var w = img.width();
			var h = img.height();
			if( w > h ){
				img.width('100%');
				img.height('auto');
				console.log(w, h, cw, ch, ch-(cw/(w/h)))/2;
				img.css({'margin-top':(ch-(cw/(w/h)))/2});
			} else {
				img.width('auto');
				img.height('100%');
			}
			$('.view-container-image').eq(index).hide().fadeIn();
		});
	});
	if( $('.previews-next').length > 0 ){
		$('.previews-next').click(function(){
			$('.previews-prev').show();
			var index = $('.preview-container-inner .active').index();
			$('.preview-container-inner .active').removeClass('active');
			$('.preview-container-inner ul').eq(++index).addClass('active');
			$('.preview-container-inner ul.active li').eq(0).click();
			$('.preview-container-inner').animate({left:'-=192'}, function(){
				
			});
			if( $('.preview-container-inner ul').length-1 == index ){
				$(this).hide();
			}
		});
		$('.previews-prev').click(function(){
			$('.previews-next').show();
			var index = $('.preview-container-inner .active').index();
			$('.preview-container-inner .active').removeClass('active');
			$('.preview-container-inner ul').eq(--index).addClass('active');
			$('.preview-container-inner ul.active li').eq(0).addClass('active');
			$('.preview-container-inner ul.active li').eq(0).click();
			$('.preview-container-inner').animate({left:'+=192'}, function(){
				
			});
			if( index == 0 ){
				$(this).hide();
			}
		});
	}
});