<?php

(function() {

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