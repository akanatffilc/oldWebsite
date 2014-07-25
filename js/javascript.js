$(function(){
	$('#nav-about').click(function(){
		var search = "?page=projects";
		var url = window.location.origin + window.location.pathname + search;
		if( !!(window.history && window.history.pushState) ){
			var stateObj = { target: "about" };
			window.history.pushState(stateObj, "about", "?page=about");
		} else {
			window.location.href = url;
		}
		$('.nav-item').removeClass('active');
		$('#nav-about').addClass('active');
		$('#inner').animate({left:'0%'});
		if( $('#about #loading').length > 0 ){
			$('#about').load('includes/about.php',function(){
				$('#container').height($('#about').height());
			});
		} else {
			$('#container').height($('#about').height());
		}
	});
	$('#nav-projects').click(function(){
		var search = "?page=projects";
		var url = window.location.origin + window.location.pathname + search;
		if( !!(window.history && window.history.pushState) ){
			var stateObj = { target: "projects" };
			history.pushState(stateObj, "projects", search);
		} else {
			window.location.href = url;
		}
		$('.nav-item').removeClass('active');
		$('#nav-projects').addClass('active');
		$('#inner').animate({left:'-100%'});
		if( $('#projects #loading').length > 0 ){
			$('#projects').load('includes/projects.php',function(){
				$('#container').height($('#projects').height());
			});
		} else {
			$('#container').height($('#projects').height());
			$('.project').removeClass('active');
			$('.project').eq(0).addClass('active');
			$('#gallery img').removeClass('active');
			$('#gallery img').eq(0).addClass('active');
		}
	});
	$('#nav-blog').click(function(){
		var search = "?page=blog";
		var url = location.origin + location.pathname + search;
		if( !!(window.history && window.history.pushState) ){
			var stateObj = { target: "blog" };
			history.pushState(stateObj, "blog", search);
		} else {
			window.location.href = url;
		}
		$('.nav-item').removeClass('active');
		$('#nav-blog').addClass('active');
		$('#inner').animate({left:'-200%'});
		if( $('#blog #loading').length > 0 ){
			$('#blog').load('includes/blog.php',function(){
				$('#container').height($('#blog').height());
			});
		} else {
			$('#container').height($('#blog').height());
		}
	});				
});