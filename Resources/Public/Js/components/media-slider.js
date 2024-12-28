(function () {
	'use strict';

	site.on('documentLoaded', function() {
		if(typeof(tns) === 'function') {
			document.querySelectorAll('.container--variant-media-left, .container--variant-media-right').forEach(function(node, index) {

				// 	// Event CeGallery_BeforeSliderInitialize ausfuehren
				// 	xna.fireEvent('CeGallery_BeforeSliderInitialize', {node: node});
				//
				// 	// Controls | Navigation anzeigen
				// 	let controls = node.querySelector('.slider--controls .slider--controls-inner');
				let navigation = node.querySelector('.slider--navigation .slider--navigation-inner ul');
				let controls = null;
				// navigation = null;

				let slider = tns({
					container: node.querySelector('.container__media'),
					// 		center: false,
					// 		loop: false,
					autoWidth: false,
					items: 1,
					gutter: 0,
					autoplay: true,
					controls: false,
					nav: (navigation !== null),
					navContainer: node.querySelector('.slider--navigation .slider--navigation-inner ul'),
					animateIn: 'tns-fadeIn',
					animateOut: 'tns-fadeOut',
					speed: 1000,
					mode: 'gallery',
					onInit: function() {

						// CSS Lazyload durch setzen der Klasse slider--initialized
						// node.querySelector('.container__media--slider').classList.add('slider--initialized');

						// Autoplay Button entfernen
						// node.querySelector('button[data-action="stop"]').remove();

						// node.querySelectorAll('.tns-item').forEach(function(item, index) {
						//
						// 	// Focus auf geklonte Eintraege verhindern
						// 	if(item.classList.contains('tns-slide-cloned') === true) {
						// 		item.querySelectorAll('a, button').forEach(function(element) {
						// 			element.setAttribute('tabindex', '-1');
						// 		});
						// 	} else {
						// 		item.removeAttribute('aria-hidden');
						// 	}
						//
						// 	// Beim Fokusieren eines Links / Buttons innerhalb eines Eintrags immer zu diesem Eintrag springen
						// 	item.querySelectorAll('a, button').forEach(function(element) {
						// 		element.addEventListener('focus', function() {
						// 			slider.goTo(item.getAttribute('data-index'));
						// 		});
						// 	});
						// });
						//
						// 			// Slider Controls wieder fixen
						// 			if(controls !== null) {
						// 				controls.removeAttribute('tabindex');
						// 				controls.removeAttribute('aria-label');
						// 			}
						//
						// 			// Slider Navigation wieder fixen
						// 			if(navigation !== null) {
						// 				navigation.querySelector('ul').removeAttribute('aria-label');
						//
						// 				navigation.querySelectorAll('li').forEach(function(item) {
						// 					item.removeAttribute('aria-label');
						// 				});
						// 			}
					}
				});
				//
				// 	// Event CeGallery_AfterSliderInitialize ausfuehren
				// 	xna.fireEvent('CeGallery_AfterSliderInitialize', {node: node, slider: slider});
			});
		}
	});
})();