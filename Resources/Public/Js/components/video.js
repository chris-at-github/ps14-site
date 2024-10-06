// No Scroll Kompontente fuer das Ausblenden der Scrollbars auf dem Body Element
// Feuert die Events scrolllock.activate und scrolllock.deactivate mit der entsprechenden Scrollbar-Breite und hoert auf das
// Event noScrollToggle um das Verhalten von ausserhalb zu steuern
(function () {
	'use strict';

	xna.on('documentLoaded', function() {
		document.querySelectorAll('.video').forEach(function(container) {
			const player = container.querySelector('.video__source');
			const playButton = container.querySelector('.video__play-button');

			player.addEventListener('click', (event) => {
				if(player.hasAttribute('controls') === false) {
					if(player.paused === true) {
						player.play();
					} else {
						player.pause();
					}
				}
			});

			if(playButton !== null) {
				playButton.addEventListener('click', (event) => {
					if(player.paused === true) {
						player.play();
					} else {
						player.pause();
					}
				});
			}

			player.addEventListener('play', (event) => {
				container.classList.add('video--played');
				container.classList.remove('video--paused');

				if(container.classList.contains('video--preview-image')) {
					container.classList.remove('video--preview-image');
				}
			});

			player.addEventListener('pause', (event) => {
				container.classList.add('video--paused');
				container.classList.remove('video--played');
			});
		});
	});
})();
