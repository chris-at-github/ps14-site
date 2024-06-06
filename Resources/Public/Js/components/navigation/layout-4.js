(function () {
	'use strict';

	xna.on('documentLoaded', function() {

		let navigation = {
			isMobileEnabled: function() {
				return document.body.classList.contains('is--off-canvas-active');
			},

			itemExpand: function(item, listItem) {

				// nur wenn es Kind Elemente gibt
				if(listItem.hasAttribute('aria-expanded') === true && listItem.getAttribute('aria-expanded') === 'false') {

					// Backlink und Direktlink einbinden
					navigation.itemBeforeExpand(item, listItem);

					listItem.setAttribute('aria-expanded', 'true');
					listItem.classList.add('navigation-item--in');

					setTimeout(function() {
						listItem.classList.add('navigation-item--active');
						listItem.classList.remove('navigation-item--in');
					}, 10);
				}
			},

			itemReduce: function(item, listItem) {

				// nur wenn es Kind Elemente gibt
				if(listItem.hasAttribute('aria-expanded') === true) {
					listItem.classList.add('navigation-item--out');
					listItem.classList.remove('navigation-item--active');
					listItem.setAttribute('aria-expanded', 'false');

					setTimeout(function() {
						listItem.classList.remove('navigation-item--out');
					}, 350);
				}
			},

			itemBeforeExpand: function(item, parent) {

				// Erstellung Parent Link
				// als erstes -> Zurueck-Link wird ebenfalls an erster Stelle eingefuegt und verdraengt den Link
				if(parent.querySelector('.navigation-item--parentlink') === null) {
					parent.querySelector('ul').insertAdjacentElement('afterbegin', navigation.createParentLink(item, parent));
				}

				// Erstellung Zurueck Link
				if(parent.querySelector('.navigation-item--backlink') === null) {
					parent.querySelector('ul').insertAdjacentElement('afterbegin', navigation.createBackLink(item, parent));
				}
			},

			createBackLink: function(item, parent) {
				let backlink = document.createElement('li'),
					text = document.createElement('button'),
					svg = xna.createSvgUseElement('#sprite-arrow-left', {'viewBox': '0 0 14 11'});

				backlink.classList.add('navigation-item--backlink');
				backlink.addEventListener('click', function() {
					navigation.itemReduce(backlink, parent);
				});

				text.innerText = xna.l10n.navigation.prev;
				text.appendChild(svg);

				backlink.appendChild(text);

				return backlink;
			},

			createParentLink: function(item, parent) {
				let parentlink = document.createElement('li'),
					link = item.cloneNode(true),
					svg = xna.createSvgUseElement('#sprite-overview', {'viewBox': '0 0 11 12'});

				parentlink.classList.add('navigation-item--parentlink');

				link.removeChild(link.querySelector('svg'));

				// nur wenn das Elternelemet ein Link ist
				if(link.tagName.toLocaleLowerCase() === 'a') {
					link.appendChild(svg);
				}

				parentlink.appendChild(link);

				return parentlink;
			}
		};

		document.querySelectorAll('.main-navigation').forEach(function(node) {

			// alle Navigationspunkte nach Typ kennzeichen (Direktlink / Unternavigation)
			node.querySelectorAll('li').forEach(function(item) {

				// hat mindestens Unterelement
				if(item.querySelector('ul') !== null) {
					item.classList.add('navigation-item--expandable');
					item.setAttribute('aria-expanded', false);

				} else {
					item.classList.add('navigation-item--link');
				}
			});

			node.querySelectorAll('li > a, li > span').forEach(function(item) {
				let listItem = item.parentElement;
				let active = false;
				let timeout = false;

				if(listItem.hasAttribute('aria-expanded') === true) {
					let svg = xna.createSvgUseElement('#sprite-chevron-right', {'viewBox': '0 0 6 12'});
					item.appendChild(svg);
				}

				item.addEventListener('click', function(event) {
					navigation.itemExpand(item, listItem);

					if(listItem.hasAttribute('aria-expanded') === true && navigation.isMobileEnabled() === true) {
						event.preventDefault();
					}
				});

				listItem.addEventListener('mousemove', function(event) {
					if(active === false && navigation.isMobileEnabled() === false) {
						active = true;
						navigation.itemExpand(item, listItem);
					}
				});

				listItem.addEventListener('mouseleave', function(event) {
					if(navigation.isMobileEnabled() === false) {
						active = false;
						navigation.itemReduce(item, listItem);
					}
				});

				listItem.addEventListener('focusin', function(event) {
					if(navigation.isMobileEnabled() === false) {
						timeout = false;
						navigation.itemExpand(item, listItem);
					}
				});

				listItem.addEventListener('focusout', function(event) {
					timeout = true;

					setTimeout(function() {
						if(timeout === true) {
							// navigation.itemReduce(item, listItem);
						}
					}, 10);
				});
			});
		});
	});
})();