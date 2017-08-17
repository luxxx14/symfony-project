$(document).ready(function(){
	
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
	scrollToTopBtn.on('click', function(){
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
});

//copy text
function copyToClipboard(element) {
		var $temp = $("<textarea>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}