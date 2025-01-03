import { format, parse } from 'date-fns';

(function () {
	'use strict';

	site.on('documentLoaded', function() {
		document.querySelectorAll('.form__item--date').forEach(function(item, index) {
			const textfield = item.querySelector('.form__field--date');

			const datefieldContainer = document.createElement('div');
				datefieldContainer.classList.add('form__datepicker');

			const datefield = document.createElement('input');
				datefield.type = 'date';
				datefield.classList.add('form__datepicker-field');

			datefieldContainer.appendChild(datefield);
			item.appendChild(datefieldContainer);

			datefield.addEventListener('change', function() {
				if(datefield.value) {
					const parsed = parse(datefield.value, 'yyyy-MM-dd', new Date());
					const formatted = format(parsed, 'dd.MM.yyyy');

					textfield.value = formatted;
				}
			});

			textfield.addEventListener('change', function() {
				const parsed = parse(textfield.value, 'dd.MM.yyyy', new Date());
				const formatted = format(parsed, 'yyyy-MM-dd');

				datefield.value = formatted;
			});
		});
	});
})();