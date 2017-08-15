$(document).ready(()=>{
	
	//scroller
	$('.nav').localScroll();
	$('.main').localScroll();
	
	//scroll to top	
	const scrollToTopBtn = $('.back-to-top');
	const image = $('.main');
	let size = 100;
	$(window).on('scroll', ()=> {		
		
		const height = $(this).height();		
		const top = $(this).scrollTop();
		size = 100 + 2*top/100+'%'
		image.css('background-size', size); 		
		let calculatedHeight = height < 600 ? height : 600;
		if(top > calculatedHeight) {			
			scrollToTopBtn.show();
		} else {
			scrollToTopBtn.hide();
		}		
	});
	scrollToTopBtn.on('click', ()=> {
		$.scrollTo('0', 1000);
	});		
	
	//modal window
	const addressBtn = $('#address');
	const modal = $('.modal');
	const closeBtn = $('.close');
	addressBtn.on('click', () => {
		console.log("hi")
    modal.show();
	});
	closeBtn.on('click', () => {
			modal.hide();
	});	
	$(window).on('click', (event)=> {		
			if ($(event.target).hasClass('modal')) {				
					modal.hide();
			}
	});
	
	//download navigatin
	$('.download nav a').on('click', function(e){		
		e.preventDefault();
		const currentActiveMenu = '#' + $('.active').attr('href');
		$(currentActiveMenu).hide();
		$('.active').removeClass('active');       
    $(this).addClass('active');
		const menuToDisplayName = '#' + $(this).attr('href');
		$(menuToDisplayName).show();
		
	});	
});

//copy text
function copyToClipboard() {
		var $temp = $("<textarea>");
		$("body").append($temp);
		$temp.val(`<dependency>
  <groupId>ru.curs</groupId>
  <artifactId>celesta</artifactId>
  <version>6.0</version>
</dependency>`).select();
		document.execCommand("copy");
		$temp.remove();
	}