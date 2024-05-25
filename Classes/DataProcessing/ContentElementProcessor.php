<?php

namespace Ps14\Site\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class ContentElementProcessor extends \Ps14\Foundation\DataProcessing\ContentElementProcessor {

	/**
	 * Liefert eine Klasse falls das Element sich auf Root-Ebene befindet. Bei verschachtelten Elementen entfaellt diese
	 * Klasse
	 *
	 * @param array $processedData Daten des Contentelements aus der Datenbank
	 * @param array $processorConfiguration Konfiguration aus Typoscript
	 * @param ContentObjectRenderer $cObject
	 * @return string
	 */
	protected function getFrameOuterClass($processedData, $processorConfiguration, $cObject) {
		return str_replace('container--outer', 'ce-frame--outer', parent::getFrameOuterClass($processedData, $processorConfiguration, $cObject));
	}
}