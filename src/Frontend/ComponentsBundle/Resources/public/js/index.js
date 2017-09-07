$(document).ready(function(){
	
	var inputField =  $('#subscribe-form input');
	var errorField = $('.error');
	
	//scroller
	$('.nav').localScroll();
	$('.main').localScroll();
	
	//scroll to top	
	var scrollToTopBtn = $('.back-to-top');
	var image = $('.main');
	var size = 100;
	$(window).on('scroll', function(){		
		
		var height = $(this).height();		
		var top = $(this).scrollTop();
		size = 100 + 2*top/100+'%'
		image.css('background-size', size); 		
		var calculatedHeight = height < 600 ? height : 600;
		if(top > calculatedHeight) {			
			scrollToTopBtn.show();
		} else {
			scrollToTopBtn.hide();
		}		
	});
	scrollToTopBtn.on('click', function(e){
		e.preventDefault();
		$.scrollTo('0', 1000);
	});		
	
	//modal window
	var addressBtn = $('#address');
	var modal = $('.modal');
	var closeBtn = $('.close');
	addressBtn.on('click', function(){		
    modal.show();
	});
	closeBtn.on('click', function(){
			modal.hide();
	});	
	$(window).on('click', function(event) {		
			if ($(event.target).hasClass('modal')) {				
					modal.hide();
			}
	});
	
	//download navigation
	$('.download nav a').on('click', function(e){		
		e.preventDefault();
		var currentActiveMenu = $('.active').attr('href');
		$(currentActiveMenu).hide();
		$('.active').removeClass('active');       
    $(this).addClass('active');
		var menuToDisplayName = $(this).attr('href');
		$(menuToDisplayName).show();		
	});	
	
	//highlight text in textarea
	$('.frame').focus(function() {
    var $this = $(this);
    $this.select();    
	});
	
	//fix safari issue
	$('.frame').mouseup(function(e) {
     e.preventDefault();
	});
	
	inputField.on('keydown', function(){		
		errorField.text('');
		inputField.removeClass('input-error');
	});
	
	//form submit	
	$('#subscribe-form').on('submit', function(e){
		var email = inputField.val();
		e.preventDefault();		
		if (!validator.isEmail(email)) {
			errorField.text('Ошибка: неправильный e-mail');
			inputField.addClass('input-error');
			return;
		} else {
			$.post('/admin/subscriber/' + email + '/subscribe', {})
				.done(function(){					
					inputField.val('');
					toogleForm();
					setTimeout(toogleForm, 3000);
				})
				.fail(function(xhr, status, error) {					
					errorField.text('Ошибка: произошла ошибка');
					inputField.addClass('input-error');
				});			
		}
	});
	
	function toogleForm() {
		$('.input-block').toggle();
		$('.success-message').toggle();
	}
	
	//select locale

	$('#select-locale span').on('click', function() {		
		$('#select-locale ul').toggle();		
	});
	
	$('#select-locale li').on('click', function() {		
		$('#select-locale span').text($(this).text());
		$('#select-locale ul').toggle();		
	});
	
	//show dropdown lists
	$('.show-components').on('click', function(){
		$(this).next().toggle();
	});	
});

//copy text
function copyToClipboard(element) {
		var $temp = $("<textarea>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}