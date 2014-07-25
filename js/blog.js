var tempScrollTop, currentScrollTop = 0;
function getParameter(paramName, searchString) {
  var search = window.location.search;
  if( searchString !== undefined ){
  	search = searchString;
  } 
  console.log("arg len: "+arguments.length);
  var searchString = search.substring(1);
  var i, val, params = searchString.split("&");

  for (i=0;i<params.length;i++) {
    val = params[i].split("=");
    if (val[0] == paramName) {
      return val[1];
    }
  }
  return null;
}
$(function(){
	sweepin();
	$('#bloglist li').click(function(){
		var id = $(this).attr('id');
		sweepout(function(){
			location.href = '/?page=blog&entry='+id;
		});
	});
	$('#comment-button').click(function(){
		console.log('comment button clicked');
		var readyToSubmit = false;
		if( $('#username-input').val() == '' ){
			$('.error-messages .username').show();
			readyToSubmit = false;
		} else {
			$('.error-messages .username').hide();
			readyToSubmit = true;
		}
		if( $('#comment-input').val() == '' ){
			$('.error-messages .message').show();
			readyToSubmit = false;
		} else {
			$('.error-messages .message').hide();
			readyToSubmit = true;
		}
		if( readyToSubmit ){
			$('#comment-button img').show();
			$('#comment-button span').hide();
				
			$.post('ajax/submitcomment.php', {
				id:getParameter('entry'),
				name:$('#username-input').val(),
				comment:$('#comment-input').val()
			}, function(value){
				console.log(value);
				$('#comment-button span').show();
				$('#comment-button img').hide();
				if( value == 'invalid' ){
					$('.error-messages .incorrect').show();
				} else if( value == 'incomplete' ){
					$('.error-messages .incomplete').show();
				} else {
					$('.error-messages div').hide();
					$('#username-input').val('');
					$('#comment-input').val('');
					$('.error-messages .successful').show();
					$('#comments-body').append('<p id="loading-comments" style="text-align:center"><img src="images/ajax-loader.gif"/><br/>loading comment...</p>');
					$('#comments-body').load('ajax/updatecomments.php', {id:getParameter('entry')}, function(){
							$('#loading-comments').remove();
							$('.error-messages .successful').hide();
					});
				}
			});
			
		}
	});
});
function sweepin(callback){
	var i  = 0;
	$('#bloglist li').each(function(){
		var that = $(this);
		setTimeout( function(){
			that.animate({left:'0%'});
		}, i*100+300);
		i++;
	});
	if( callback !== undefined ){
		setTimeout( function(){
			callback();
		}, i*100+300);
	}
}
function sweepout(callback){
	var i  = 0;
	$('#bloglist li').each(function(){
		var that = $(this);
		setTimeout( function(){
			that.animate({left:'-100%'});
		}, i*100+300);
		i++;
	});
	if( callback !== undefined ){
		setTimeout( function(){
			callback();
		}, i*100+300);
	}
}
function loadBlog(id){
	$('#blog').load('includes/loading.php', function(){
		$('#blog').load('ajax/loadBlog.php', {id:id}, function(value){
			var containerheight = $('#container').height();
			$('img', this).each(function(){
				$(this).load(function(){
					console.log('callback');
					$('#container').height($('#blog').height());
				});
			});
		});
	});
}



