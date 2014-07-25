$(function(){
	resize();
	setNav();
	nav();
	selectRoster();
	submit();
	admin();
	adminSubmit();
	adminTab();
	adminNew();
	adminView();
});
/********************************************************************/
/************************* INIT  ************************************/
/********************************************************************/
function resize(){
	var positionInit = $('#content').position();
	$('#header').css({left:positionInit.left});
	$(window).resize(function() {
		var viewportWidth = $(window).width();
		var viewportHeight = $(window).height();
		var position = $('#content').position();
		$('#header, #footer').css({left:position.left});
		console.log("viewportWidth: ", viewportWidth, ", viewportHeight: ", viewportHeight, ", left: ", position.left);
	});
}
/********************************************************************/
/************************* NAV HANDLERS  ****************************/
/********************************************************************/
function nav(){
	$('#nav li').click(function(){
		$('#nav li').each(function(){
			$(this).removeClass('current');
		});
		$(this).addClass('current');
	});
}
function setNav(){
	$('#nav li').each(function(){
		$(this).removeClass('current');
	});
	var place = window.location.hash.substring(1);
	$('#nav-'+place).addClass('current');
}
function clearNav(){
	$('#nav li').each(function(){
		$(this).removeClass('current');
	});
}
/********************************************************************/
/************************* ROSTER TAB  ******************************/
/********************************************************************/
function selectRoster(){
	$("#roster-select-year").change(function () {
	  var year = $("option:selected", this).text();
	  loadRoster(year);
	})
}
function loadRoster(year){
	$("#player-cards").empty().html('<img class=ajaxLoader src="ajax-loader.gif" />');
	$('#player-cards').load('loadRoster.php', {year:year},function(){
		var width = 790;
		var count = $('.player-card').size();
		width = width/count - 20;
		$('.player-card').css({width:width});
		var imgwidth = width;
		var imgheight = imgwidth/3 * 4
		$('.player-card img').css({ width:imgwidth, height:imgheight });
		loadFlip();
	});
}
function loadFlip(){
	$('.player-card').click(function(){
		var that = $(this);
		var height = that.height();
		var name = $('.player-name', this).text();
		console.log(name);
		if( $(this).hasClass('flipped') ){
			$(this).revertFlip().removeClass('flipped');
		} else {
			var content;
			$.post('loadFlip.php', {name:name}, function(value){
				console.log(value);
				content = value;
				that.flip({
					direction:'lr',
					speed:300,
					content: content
				}).addClass('flipped').css({height:height});
			});
			console.log(content);
			
		}
	});
}
/********************************************************************/
/************************* GENERAL LOGIN  ***************************/
/********************************************************************/
function login_splash(){
	alert('must log in');
	var viewportWidth = $(window).width();
	var viewportHeight = $(window).height();
	$('#mask').css({height:viewportHeight, width:viewportWidth}).show();
	$('#login-splash').css({top:viewportHeight/2-35, left:viewportWidth/2-50}).show();
	$(window).resize(function() {
		var viewportWidth = $(window).width();
		var viewportHeight = $(window).height();
		$('#mask').css({height:viewportHeight, width:viewportWidth})
	});
}
function submit(){
	$('#submit').click(function(){
		var pwd = $('#password').val();
		$.post( 'validate.php', {password:pwd}, function(value){
			if( value == 'true' ){
				alert('logged in');
				$('#mask').hide();
				$('#login-splash').hide();
			} else {
				alert('could not log in');
			};
		});
	});
}
/********************************************************************/
/************************* ADMIN LOGIN  *****************************/
/********************************************************************/
function admin(){
	$('#adminLink').click(function(){
		clearNav();
		var width = $('#adminDiv').width() + 10;
		var height = $('#adminDiv').height() + 10;
		$('#adminInnerMask').css({height:height, width:width}).show();
		$('#adminLogin').css({top:height/2-35, left:width/2-50}).show();
	});
}
function adminSubmit(){
	$('#adminsubmit').click(function(){
		var pwd = $('#adminPassword').val();
		$.post('admin.php', {password:pwd}, function(value){
			if( value == 'true' ){
				$('#adminInnerMask').hide();
				$('#adminLogin').hide();
				alert('admin access');
			} else {
				alert('password incorrect');
			}
		});
	});
}
function adminTab(){
	$('.adminTab').click(function(){
		$('.adminTab').each(function(){
			$(this).removeClass('adminCurrentTab');
		});
		var id = $(this).attr('id');
		id += '-content';
		$('.admin-block').hide();
		$('#' + id).show();
		$(this).addClass('adminCurrentTab');
		
	});
}
/********************************************************************/
/************************* ADMIN VIEW/EDIT **************************/
/********************************************************************/
function adminView(){
	$('#admin-view-go').click(function(){
		var something = false;
		var newthing = $("#admin-view-thing option:selected").text();
		var year = $("#admin-view-select-year option:selected").text();
		switch( newthing ){
			case "stat":
				$('#view-stat-table input').each(function(){
					if( $(this).val().length > 0 ){
						something = true;
					}
				});
				if( something ){
					if( confirm('are you sure? all existing data will be lost') ){
						loadViewContent(year);
					}
				} else {
					loadViewContent(year);
				}
			break;
		}
	});
}
function loadViewContent(year){
	$('#admin-view-selector').load('loadViewOptions.php', {year:year}, function(select){
			$('#admin-view-selector #selectOpponent').change(function(){
				var opponent = $('option:selected', this).text();
				adminViewStat( year, opponent );
			});
	});
}
function adminViewStat(year, opponent){
	$("#view-content").empty().html('<img class=ajaxLoader src="ajax-loader.gif" />');
	$('#view-content').load('loadViewStat.php', {year:year, opponent:opponent}, function(){
		calculateTotal();
		editable();
	});
}
function calculateTotal(){
	$('#view-content table th[class != "name"]').each(function(){
		var theclass = $(this).attr('class');
		console.log(theclass);
		var total = 0;
		$('#view-stat-table td.'+theclass).each(function(){
			var num = $(this).text();
			num = parseInt(num);
			if( !isNaN(num) ){
				total += parseInt(num);
			}
		});
		$('.'+theclass+'-total').html(total);
	});
	/*
	var name = $('#view-content table .editable').attr('name');
	var index = name.indexOf('-');
	var theclass = name.substring(0,index);
	var total = 0;
	$('#new-stat-table .'+theclass).each(function(){
		var num = $('input', this).val();
		if(num != ''){
			num = parseInt(num);
			if( !isNaN(num) ){
				total += parseInt(num);
			}
		}
	});
	$('.'+theclass+'-total').html(total);
	*/
}
function editable(){
	$('.editable').dblclick(function(){
		var year = $('#admin-view-select-year option:selected').text();
		var opponent = $('#admin-view-selector option:selected').text();
		var classes = $(this).attr('class');
		var field = classes.substring(classes.indexOf(' ')+1);
		var name = $(this).parent('.name');
		var player = $('.namevalue', name).text();
		console.log(year, opponent, field, player);
		var that = $(this);
		var text = $(this).text();
		var input = '<input size=1 type=text value="'+text+'"/>';
		$(this).html(input);
		$(this).focusout(function(){
			var newtext = parseInt($('input', that).val());
			if( !isNaN(newtext) ){
				$(that).html(newtext);
				updateStat( year, opponent, player, field, newtext );
			} else {
				alert('value must be an integer');
				if( text == '' | newtext == '' ){
					text = 0;
				}
				$(that).html(text);
			}
		});
	});
}
function updateStat(year, opponent, player, field, value){
	$.post('updateStat.php', {year:year, opponent:opponent, player:player, field:field, value:value}, function(val){
		console.log(val);
	});
}
/********************************************************************/
/************************* ADMIN NEW  *******************************/
/********************************************************************/
function adminNew(){
	$('#admin-new-go').click(function(){
		var something = false;
		var newthing = $("#admin-new-thing option:selected").text();
		var year = $("#admin-new-select-year option:selected").text();
		switch( newthing ){
			case "stat":
				$('#new-stat-table input').each(function(){
					if( $(this).val().length > 0 ){
						something = true;
					}
				});
				if( something ){
					if( confirm('are you sure? all existing data will be lost') ){
						loadNewContent(year);
					}
				} else {
					loadNewContent(year);
				}
			break;
		}
	});
	$("#admin-new-select-year").change(function(){
		var something = false;
		$('#new-stat-table input').each(function(){
			if( $(this).val().length > 0 ){
				something = true;
			}
		});
		if( something ){
			if( confirm('are you sure? all existing data will be lost') ){
				$('#new-content').html('');
			}
		} else {
			$('#new-content').html('');
		}
	});
}
function loadNewContent(year){
	$("#new-content").empty().html('<img class=ajaxLoader src="ajax-loader.gif" />');
	$('#new-content').load('loadStat.php', {year:year}, function(){	
		dateOnChange(year);
		inputStat();
		submitNewContent();
	});
}
function dateOnChange(year){
	dateOnChangeInit(year);
}
function dateOnChangeInit(year){
	var days = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";
	var month = parseInt($('#new-content .month option:selected').attr('class'));
	var setDays;
	for( var i = 1; i <= days[month]; i++ ){
		setDays += "<option>"+i+"</option>";
	}
	$('#new-content .day').html( setDays );
	var day = parseInt($('#new-content .day option:selected').text() );
	var date = new Date(year, month, day);
	
	$('#new-content #statdow').val(weekday[date.getDay()]);
	
	$('#new-content .month').change(function(){ 
		monthChange(year); 
	});
	$('#new-content .day').change(function(){ 
		var month = parseInt($('#new-content .month option:selected').attr('class'));
		dateChange(year, month); 
	});
}
function monthChange(year){
	var days = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	var month = parseInt($('#new-content .month option:selected').attr('class'));
	var setDays;
	for( var i = 1; i <= days[month]; i++ ){
		setDays += "<option>"+i+"</option>";
	}
	$('#new-content .day').html( setDays );
	dateChange(year, month);
}
function dateChange(year, month){
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";
	var day = parseInt($('#new-content .day option:selected').text() );
	var date = new Date(year, month, day);
	$('#new-content #statdow').val(weekday[date.getDay()]);
}
function inputStat(){
	$('#new-stat-table td').focusout(function(){
		var name = $('input', this).attr('name');
		var index = name.indexOf('-');
		var theclass = name.substring(0,index);
		var total = 0;
		$('#new-stat-table .'+theclass).each(function(){
			var num = $('input', this).val();
			if(num != ''){
				num = parseInt(num);
				if( !isNaN(num) ){
					total += parseInt(num);
				}
			}
		});
		$('.'+theclass+'-total').html(total);
	});
}
function submitNewContent(){
	$('#new-stat-submit').click(function(){
		var blank = false;
		$('#new-stat-table input').each(function(){
			if( $(this).val().length == 0 ){
				blank = true;
			}
		});
		
		if( blank ){
			if( confirm('are you sure? there are empty fields. all empty fields will be inserted with 0s.') ){
				collectStats();	
			}
		} else {
			collectStats();	
		}
	});
}
function collectStats(){
	var opponent = $('#admin-new-content input[name="opponent"]').val();
	var year = $("#admin-new-select-year option:selected").text();
	var address = $('#admin-new-content input[name="gymaddress"]').val();
	var month = $('#admin-new-content .month option:selected').text();
	var day = $('#admin-new-content .day option:selected').text();
	var dow = $('#admin-new-content #statdow option:selected').text();
	var timehr = $('#admin-new-content .timehr option:selected').text();
	var timemin = $('#admin-new-content .timemin option:selected').text();
	var ampm = $('#admin-new-content .ampm option:selected').text();
	var time = timehr + ":"+ timemin + ampm;
	var name;
	$('#new-stat-table .input').each(function(){
		var stats = [];
		name = $('.name', this).text();
		$('input', this).each(function(){
			var integer;
			if( $(this).val() == '' ){
				integer = 0;
			} else {
				integer = parseInt( $(this).val() );
			}
			stats.push( integer );
		});
		$.post('enterStats.php', {'stats[]':stats, opponent:opponent, year:year, name:name}, function(value){
			$('#new-content').html('data entered successfully');
		});
	});
	$.post('enterStatsGameInfo.php', {opponent:opponent, year:year, name:name, gymaddress:address, month:month, day:day, time:time, dow:dow});
}