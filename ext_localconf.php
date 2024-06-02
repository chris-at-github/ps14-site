<?php

if(defined('TYPO3') === false) {
	die('Access denied.');
}

// ---------------------------------------------------------------------------------------------------------------------
// CKEditor
// Konfiguration fuer den (CKE) Editor im Backend
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['ps14Default'] = 'EXT:ps14_site/Configuration/RTE/Default.yaml';
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['ps14Minimal'] = 'EXT:ps14_site/Configuration/RTE/Minimal.yaml';

// ---
// KeSearch Indexer
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyFileIndexEntryFromContentIndexer'][] = \Ps14\Site\KeSearchIndexer\SysFileReferenceFields::class;

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyPageContentFields'][] = \Ps14\Site\KeSearchIndexer\ContentElementRecords::class;
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyContentFromContentElement'][] = \Ps14\Site\KeSearchIndexer\ContentElementRecords::class;
//
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyPageContentFields'][] = \Ps14\Site\KeSearchIndexer\RemoveContentFromHiddenParent::class;
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['contentElementShouldBeIndexed'][] = \Ps14\Site\KeSearchIndexer\RemoveContentFromHiddenParent::class;