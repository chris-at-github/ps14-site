<?php

(function() {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
		'tx_site_wkhtmltopdf_enabled' => [
			'exclude' => true,
			'label' => 'LLL:EXT:ps14_site/Resources/Private/Language/locallang_tca.xlf:tt_content.wkhtmltopdf.enabled',
			'config' => [
				'type' => 'check',
				'items' => [
					'1' => [
						'0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
					]
				],
				'default' => 0,
			]
		],
		'tx_site_wkhtmltopdf_title' => [
			'exclude' => true,
			'displayCond' => 'FIELD:tx_site_wkhtmltopdf_enabled:>:0',
			'label' => 'LLL:EXT:ps14_site/Resources/Private/Language/locallang_tca.xlf:tt_content.wkhtmltopdf.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required',
			],
		],
	]);


/*

// ---------------------------------------------------------------------------------------------------------------------
// Allgemeine Ueberschreibungen
// sinnloses Label entfernen -> weitere Infos stehen in den Tabs
	$GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['label'] = ' ';
	$GLOBALS['TCA']['tt_content']['types']['list']['columnsOverrides']['pi_flexform']['l10n_mode'] = 'exclude';

// ---------------------------------------------------------------------------------------------------------------------
// Text Image (Textpic)
	$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']  = [
		'desktop' => [
			'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.desktop',
			'allowedAspectRatios' => [
				'16_9' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
				'4_3' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
					'value' => 4 / 3
				],
				'1_1' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
					'value' => 1
				],
			],
			'selectedRatio' => '4_3',
		],
		'mobile' => [
			'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.mobile',
			'allowedAspectRatios' => [
				'16_9' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
				'4_3' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
					'value' => 4 / 3
				],
				'1_1' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
					'value' => 1
				],
			],
			'selectedRatio' => '16_9',
		],
	];

// ---------------------------------------------------------------------------------------------------------------------
// Hero | Hero Slider
	$GLOBALS['TCA']['tt_content']['types']['ce_hero']['showitem'] = '
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;xoHeader,tx_xo_file, pi_flexform,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
			--palette--;;xoPrint,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
			--palette--;;hidden,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
	';


	$GLOBALS['TCA']['tt_content']['types']['ce_hero']['columnsOverrides']['tx_xo_file']['config'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
		'tx_xo_file',
		[
			'appearance' => [
				'collapseAll' => 1,
				'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference',
			],
			'overrideChildTca' => [
				'types' => [
					'0' => [
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					],
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					],
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					],
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					]
				]
			],
			'maxitems' => 1
		]
	);

	$GLOBALS['TCA']['tt_content']['types']['ce_hero']['columnsOverrides']['tx_xo_file']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = [
		'default' => [
			'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
			'allowedAspectRatios' => [
				'16_9' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
			],
			'selectedRatio' => '16_9',
		],
	];

	$GLOBALS['TCA']['tt_content']['types']['ce_hero_slider']['columnsOverrides']['tx_xo_elements']['config']['overrideChildTca']['columns']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']  = [
		'default' => [
			'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
			'allowedAspectRatios' => [
				'16_9' => [
					'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
			],
			'selectedRatio' => '16_9',
		],
	];

// ---------------------------------------------------------------------------------------------------------------------
// Download
	$GLOBALS['TCA']['tt_content']['types']['ce_downloads'] = [
		'showitem' => '
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;xoHeader, tx_xo_file, tx_xna_wkhtmltopdf_enabled, tx_xna_wkhtmltopdf_title,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
			--palette--;;hidden,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
	',
	];
	$GLOBALS['TCA']['tt_content']['types']['ce_downloads']['columnsOverrides']['tx_xna_wkhtmltopdf_enabled']['onChange'] = 'reload';

// ---------------------------------------------------------------------------------------------------------------------
// Marker
	$GLOBALS['TCA']['tt_content']['types']['ce_marker']['columnsOverrides']['tx_xo_elements']['config']['overrideChildTca']['columns']['description']['config']['richtextConfiguration'] = 'xoDefault';
*/

})();