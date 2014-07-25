$(function(){
	$('#projects #gallery img').click(function(){
		var id = $(this).attr('id');
		$('#projects #gallery img').removeClass('active');
		$('#display .project').removeClass('active');
		$('#display .project#display-'+id).addClass('active');
		$(this).addClass('active');
		var stateObj = { target: "project="+id };
		history.pushState(stateObj, "project="+id, "?page=projects&project="+id);	
	});	
});