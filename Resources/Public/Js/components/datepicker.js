import { format, parse } from 'date-fns';

(function () {
	'use strict';

	site.on('documentLoaded', function() {
		document.querySelectorAll('.form__item--date').forEach(function(item, index) {
			const textfield = item.querySelector('.form__field--date');
			const id = 'form__item--date-' + index;

			const datefieldContainer = document.createElement('div');
				datefieldContainer.classList.add('form__datepicker');

			const datefield = document.createElement('input');
				datefield.type = 'date';
				datefield.classList.add('form__datepicker-field');
				datefield.setAttribute('id', id);

			const datelabel = document.createElement('label');
				datelabel.classList.add('form__datepicker-label');
				datelabel.setAttribute('for', id);

			const datelabelValue = document.createElement('span');
				datelabelValue.classList.add('visually-hidden');
				datelabelValue.innerText = site.l10n.datepicker.label;

			datelabel.appendChild(datelabelValue);
			datefieldContainer.appendChild(datelabel);
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