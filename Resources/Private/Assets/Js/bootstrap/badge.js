(function () {
	'use strict';
	document.querySelectorAll('.react-component').forEach(component => {
		try {
			const data = JSON.parse(component.querySelector('.react-component__data').textContent);
			console.log(data);

		} catch (e) {
			console.error('Invalid JSON in react-component:', e);
		}
	});
})();