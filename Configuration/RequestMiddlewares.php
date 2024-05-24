<?php

return [
	'frontend' => [
		'ps14/site/link-header' => [
			'target' => \Ps14\Site\Middleware\LinkHeader::class,

			// keine Ahnung warum es auf after stehen muss -> eigentlich sollte diese Middleware davor ausgefuehrt werden
			// -> tut es aber nur mit after???
			'before' => [
				'typo3/cms-adminpanel/renderer'
			]
		],
	],
];