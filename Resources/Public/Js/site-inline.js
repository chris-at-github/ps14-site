var site = window.site || {};

// ---------------------------------------------------------------------------------------------------------------------
// Datenstruktur fuer eventuelle Skripte
site.data = site.data || {};
site.l10n = site.l10n || {};
site.settings = site.settings || {};

// Fehler in TinySlider beheben
var exports = exports || {};

// ---------------------------------------------------------------------------------------------------------------------
// eigene On-Event Methode um Asynchrone Skripte besser steuern zu koennen -> damit koennen Callbacks auf Events bereits
// im Voraus gesammelt werden bzw. auf bereits gefeuerte Events kann immer noch eine Callback-Methode angewandt werden
//
// Callbacks registrieren
// site.on('event', function() {
//	 // Callback
// });
//
// Callbacks aufrufen
// site.fire('event');

site.onEventFired = site.onEventFired || {};
site.onEventCallbacks = site.onEventCallbacks || {};

if(typeof site.on !== 'function') {
	site.on = function(event, callback) {
		if(typeof(this.onEventFired[event]) !== 'undefined' && this.onEventFired[event] === true) {
			callback();
			return;
		}

		if(typeof(this.onEventCallbacks[event]) === 'undefined') {
			this.onEventCallbacks[event] = [];
		}

		this.onEventCallbacks[event].push(callback);
	};
}

if(typeof site.fire !== 'function') {
	site.fire = function(event) {
		if(typeof(this.onEventFired[event]) !== 'undefined') {
			return;
		}

		if(typeof(this.onEventCallbacks[event]) !== 'undefined') {
			this.onEventCallbacks[event].forEach(function(callback, i) {
				callback();
			});

			this.onEventCallbacks[event] = [];
		}

		this.onEventFired[event] = true;
	};
}

// ---------------------------------------------------------------------------------------------------------------------
// asynchrones DOMContentLoaded nutzen
document.addEventListener('DOMContentLoaded', function(event) {
	site.fire('documentLoaded');
});

// ---------------------------------------------------------------------------------------------------------------------
// Klassen auf Body-Tag setzen
document.addEventListener('DOMContentLoaded', function(event) {

	// JS-Klassen setzen
	document.body.classList.remove('no-js');
	document.body.classList.add('js');
});