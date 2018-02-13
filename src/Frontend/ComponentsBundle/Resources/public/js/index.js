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
   	showModal();
	});
	closeBtn.on('click', function(){
		hideModal();
	});
	$(window).on('click', function(event) {
			if ($(event.target).hasClass('modal')) {
				hideModal();
			}
	});

	//open modal window on hash
	var hash = window.location.hash;
	if (hash === '#contacts') {
		 showModal();
	}

	//remove hash
	function removeHash () {
    var scrollV, loc = window.location;
    if ("pushState" in history)
        history.pushState("", document.title, loc.pathname + loc.search);
    else {
        // Prevent scrolling by storing the page's current scroll offset
        scrollV = document.documentElement.scrollTop || document.body.scrollTop;
        loc.hash = "";
        // Restore the scroll offset, should be flicker free
				document.documentElement.scrollTop = scrollV;
        document.body.scrollTop = scrollV;
			}
	}

	function showModal() {
		modal.show();
		$("body").css("overflow", "hidden");
		window.location.hash = "contacts"
	}

	function hideModal() {
		modal.hide();
		removeHash();
		$("body").css("overflow", "auto");
	}
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
	$('.show-components .show-components__text, .download-versions__item-icon').on('click', function() {
		var $showComponents = $(this).closest('.show-components');
		var $showComponentsText = $showComponents.find('.show-components__text');
		var $showComponentsList = $showComponents.find('.components');

		if(parseInt($showComponentsText.css('marginBottom')) > 0) {
			$showComponentsText.css('marginBottom', 0);
		} else {
			$showComponentsText.css('marginBottom', $showComponentsList.css('height'));
		}
		if($showComponentsList.css('display') == 'block') {
			$showComponentsText.removeClass('active');
		}else {
			$showComponentsText.addClass('active');
		}
		$showComponentsList.toggle();
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
