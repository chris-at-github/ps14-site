(function () {
	'use strict';

	site.on('documentLoaded', function() {
		document.querySelectorAll('.gallery').forEach(function(gallery) {
			gallery.querySelectorAll('.gallery-readmore').forEach(function(readmore) {
				const labelElement = readmore.querySelector('.gallery-readmore__label-value');
				let labelValue = 1; // wir starten bei 1 -> das erste Element ist noch vom Button ueberdeckt

				gallery.querySelectorAll('.gallery__item').forEach(function(item) {
					if(window.getComputedStyle(item).display === 'none') {
						labelValue++;
					}
				});

				labelElement.innerText = labelValue;
			});
		});
	});
})();