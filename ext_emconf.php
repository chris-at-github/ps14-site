<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "sitepackage".
 *
 * Auto generated on 20-08-2020 12:55.
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
	'title' => 'Ps14 Site',
	'description' => 'TYPO3 extension for customizing a TYPO3 installation to meet the specific requirements of a customer\'s website.',
	'category' => 'distribution',
	'author' => 'Christian Pschorr',
	'author_email' => 'pschorr.christian@gmail.com',
	'author_company' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'clearCacheOnLoad' => 0,
	'version' => '2.0.1',
	'constraints' => [
		'depends' => [
			'typo3' => '12.0.0-12.4.99',
			'ps14_foundation' => '2.0.0-2.9.99',
		],
		'conflicts' => [],
		'suggests' => [
			'ps14_modulor' => '2.0.0-2.9.99',
			'ps14_accordion' => '2.0.0-2.9.99',
			'ps14_downloads' => '2.0.0-2.9.99',
			'ps14_hero' => '2.0.0-2.9.99',
			'ps14_timeline' => '2.0.0-2.9.99',
			'ps14_kist_values' => '1.0.0-1.9.99',
			'ps14_marker' => '2.0.0-2.9.99',
			'ps14_container' => '2.0.0-2.9.99',
		],
	],
];
