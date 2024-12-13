<?php

(function() {

	// -------------------------------------------------------------------------------------------------------------------
	// Weitere Felder in Pages
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', [
		'tx_site_disable_sticky_pdf' => [
			'exclude' => true,
			'label' => 'LLL:EXT:ps14_site/Resources/Private/Language/locallang_tca.xlf:pages.disable-sticky.pdf',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[0 => '']
				],
				'default' => 0,
			]
		],
	]);

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'foundation_sticky', 'tx_site_disable_sticky_pdf', 'after:tx_foundation_disable_sticky');

	$GLOBALS['TCA']['pages']['columns']['media']['label'] = 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.media_formlabel';
	$GLOBALS['TCA']['pages']['columns']['media']['config']['maxitems'] = 1;
	$GLOBALS['TCA']['pages']['columns']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
		[
			'desktop' => [
				'allowedAspectRatios' => ['16_9', '4_3'],
				'selectedRatio' => '16_9'
			],
			'mobile' => [
				'allowedAspectRatios' => ['16_9', '4_3'],
				'selectedRatio' => '16_9'
			]
		]
	);
})();