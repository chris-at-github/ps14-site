<?php

(function() {

	// -------------------------------------------------------------------------------------------------------------------
	// Anpassung TYPO3 Text Modul
	$GLOBALS['TCA']['tt_content']['types']['text']['columnsOverrides']['tx_foundation_background_media']['config']['maxitems'] = 99;

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
		array(
			'Sketch', // 'LLL:EXT:ps14_hero/Resources/Private/Language/locallang_tca.xlf:hero.title',
			'ps14_site_sketch',
			'ps14-module-hero'
		),
		'CType',
		'ps14_site'
	);

	// Felddefinitionen
	$GLOBALS['TCA']['tt_content']['types']['ps14_site_sketch']['showitem'] = \Ps14\Site\Service\TcaService::getShowitem(
		['general', 'appearance', 'language', 'access', 'categories', 'notes', 'extended'],
		[
			'general' => '--palette--;;general, --palette--;;headers, --palette--;;foundation_identifier, bodytext, tx_foundation_elements,'
		]
	);

// ---------------------------------------------------------------------------------------------------------------------
// Elements TCA anpassen

// Definition Record
	$GLOBALS['TCA']['tt_content']['types']['ps14_site_sketch']['columnsOverrides']['tx_foundation_elements']['config']['overrideChildTca'] = [
		'columns' => [
			'record_type' => [
				'config' => [
					'items' => [
						[
							'label' => 'Default', // LLL:EXT:ps14_icon_text/Resources/Private/Language/locallang_tca.xlf:elements.record-type.default
							'value' => 'ps14_site_sketch_floor'
						],
					],
					'default' => 'ps14_site_sketch_floor'
				]
			],
			'description' => [
				'config' => [
					'richtextConfiguration' => 'ps14Default'
				]
			]
		],
		'types' => [
			'ps14_site_sketch_floor' => [
				'showitem' => \Ps14\Site\Service\TcaService::getShowitem(
					['general', 'appearance', 'access'],
					[
						'general' => '--palette--;;general, --palette--;;header, description, media,'
					],
					'tx_foundation_domain_model_elements'
				)
			],
		]
	];
})();