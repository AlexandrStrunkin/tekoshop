/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/

function getCookie(name) {
	var matches = document.cookie.match(
		new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)")
	);

	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
	options = options || {};
	var expires = options.expires;

	if (typeof expires == "number" && expires) {
		var d = new Date();
		d.setTime(d.getTime() + expires * 1000);
		expires = options.expires = d;
	}

	if (expires && expires.toUTCString) {
		options.expires = expires.toUTCString();
	}

	value = encodeURIComponent(value);
	var updatedCookie = name + "=" + value;

	for (var propName in options) {
		updatedCookie += "; " + propName;
		var propValue = options[propName];
		if (propValue !== true) {
			updatedCookie += "=" + propValue;
		}
	}

	document.cookie = updatedCookie;
}

//basket_wrapp

function deleteCookie(name) {
	setCookie(name, "", {
		expires: -1
	})
}

function loadCitiesBase(){
	if(!$('.city-popup-list-container ul').length){
		$.ajax({
			beforeSend: function(){
				$('.city-select a').addClass('loading')
			},
			'url': '/ajax/city_filter.php?view=full',
			'success': function (data){
				$('.city-popup-list-container').html(data)
				$('.city-popup-list-wrapper').toggle(100)
				$('.city-select .cpl-top input').focus()
			},
			complete: function(){
				$('.city-select a').removeClass('loading')
			}
		})
	}
	else{
		$('.city-popup-list-wrapper').toggle(100)
		$('.city-select .cpl-top input').focus()
	}
}

function loadCitiesList(searchWord){
	$('.cpl-clist').html('<ul></ul>')
	for(var i = 0; i < citiesFull.length; ++i){
		if(citiesFull[i]['NAME'].toLowerCase().indexOf(searchWord.toLowerCase()) != -1){
			$('.cpl-clist ul').append('<li data-id="' + citiesFull[i]['ID']+ '">' + citiesFull[i]['NAME'] + '</li>');
		}
	}
}

(function(jQuery){
	jQuery.fn.extend({
		donetyping: function(callback,timeout){
			timeout = timeout || 1e3; // 1 second default timeout
			var timeoutReference,
				doneTyping = function(el){
					if (!timeoutReference) return;
					timeoutReference = null;
					callback.call(el);
				};
			return this.each(function(i,el){
				var $el = jQuery(el);
				// Chrome Fix (Use keyup over keypress to detect backspace)
				// thank you @palerdot
				$el.is(':input') && $el.on('keyup keypress',function(e){
					// This catches the backspace button in chrome, but also prevents
					// the event from triggering too premptively. Without this line,
					// using tab/shift+tab will make the focused element fire the callback.
					if (e.type=='keyup' && e.keyCode!=8) return;

					// Check if timeout has been set. If it has, "reset" the clock and
					// start over again.
					if (timeoutReference) clearTimeout(timeoutReference);
					timeoutReference = setTimeout(function(){
						// if we made it here, our timeout has elapsed. Fire the
						// callback
						doneTyping(el);
					}, timeout);
				}).on('blur',function(){
					// If we can, fire the event since we're leaving the field
					doneTyping(el);
				});
			});
		}
	});
})(jQuery);

$(document).ready(function(){
	var cityname = $('.js_city_title').data('cityname');
	
	jqmEd('load_cities', 'city_change', '.load_cities', 'cityname=' + encodeURIComponent(cityname));
	/*$('.city-verifier').fadeIn(500)

	$('.cv-btn-yes').on('click', function(){
		$('.city-verifier').fadeOut(500)
		setCookie('city_verified', 'Y', {path:'/', expires: 604800}) // 86400 * 7
	}) */
	
	$(document).on('click', '.js_my_city', function(e){
		var cityID = $(e.target).data('id');
		setCookie('city_verified', 'Y', {path:'/', expires: 604800}) // 86400 * 7
		setCookie('currentCity', cityID, {path:'/', expires: 604800}) // 86400 * 7
		$('.jqmClose').trigger('click');
	});

	$(document).on('click', '.city-select a', function(e){
		//loadCitiesBase()
		$('.load_cities').trigger('click');
		
		return false
	})

	$(document).on('click', '.cv-btn-change', function(e){
		$('.city-verifier').fadeOut(500)
		//loadCitiesBase()
		$('.load_cities').trigger('click');
		//setCookie('city_verified', 'Y', {path:'/', expires: 604800}) // 86400 * 7
		return false
	})

	$(document).on('click', '.cpl-clist li', function(){
		var cityID = $(this).data('id')
		var cityName = $(this).html()
		setCookie('currentCity', cityID, {path:'/', expires: 604800}) // 86400 * 7
		setCookie('city_verified', 'Y', {path:'/', expires: 604800}) // 86400 * 7
		window.location = window.location.href
	})

	$(document).on('click', '.cpl-close', function(){
		$('.city-popup-list-wrapper').hide(100)
	})

	$(document).on('click', function(){
		$('.city-popup-list-wrapper').hide(100)
	})

	$(document).on('click', '.city-popup-list-container', function(e){
		e.stopPropagation()
	})

	$(document).keyup(function(e) {
		if(e.keyCode == 27){
			$('.city-popup-list-wrapper').hide(100)
		}
	});
	
	if (!(getCookie('city_verified') == 'Y')){
		$('.load_cities').trigger('click');
	}
})