import { format, parse } from 'date-fns';

(function () {
	'use strict';

	site.on('documentLoaded', function() {
		document.querySelectorAll('.form__item--number').forEach(function(item, index) {
			const textfield = item.querySelector('.form__field--number');

			const buttonPlus = document.createElement('button');
				buttonPlus.type = 'button';
				buttonPlus.classList.add('form__number-steps');
				buttonPlus.classList.add('form__number-steps--plus');

			const buttonMinus = document.createElement('button');
				buttonMinus.type = 'button';
				buttonMinus.classList.add('form__number-steps');
				buttonMinus.classList.add('form__number-steps--minus');

			item.appendChild(buttonPlus);
			item.appendChild(buttonMinus);

			buttonPlus.addEventListener('click', () => {
				let textfieldValue = textfield.value;

				if(textfieldValue === '') {
					textfieldValue = 0;
				}

				textfield.value = parseInt(textfieldValue) + 1;
			});

			// Decrease value but not below 0
			buttonMinus.addEventListener('click', () => {
				let textfieldValue = textfield.value;

				if(textfieldValue === '') {
					textfieldValue = 0;
				}

				if(parseInt(textfieldValue) > parseInt(textfield.getAttribute('min'))) {
					textfield.value = parseInt(textfieldValue) - 1;
				}
			});
		});
	});
})();