$(function(){
	$('.top-drawer, .drawer').hover(function(){
		var bubbleclass = $('#bubble').attr('class');
		var drawerid = $(this).attr('id');
		$('#bubble').removeClass(bubbleclass);
		drawerid = drawerid.substring(2);
		$('#bubble').addClass(drawerid);
	}, function(){
		var bubbleclass = $('#bubble').attr('class');
		$('#bubble').removeClass(bubbleclass);
		$('#bubble').addClass('open');
		/*
		var id = $('#dresser .active').attr('id');
		var c = '';
		if( id ){
			c = id.substring(2);
		} else {
			c = 'open';
		$('#bubble').addClass(c);
		*/
	});
});
function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
    });
}
preload([
    'images/bubble_2info.png',
    'images/bubble_3blog.png',
    'images/bubble_4art.png',
    'images/bubble_5projects.png',
    'images/bubble_6commissions.png',
    'images/bubble_7prints.png'
]);