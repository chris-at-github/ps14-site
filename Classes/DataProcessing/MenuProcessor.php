<?php

namespace Ps14\Site\DataProcessing;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectFactory;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class MenuProcessor extends \TYPO3\CMS\Frontend\DataProcessing\MenuProcessor {

	/**
	 * @param array $pageIds Array mit Eltern-IDs
	 * @param string $sorting random|manual
	 * @param int $limit
	 * @return array IDs von Unterseiten
	 */
	protected function getSubpages($pageIds, $sorting = null, $limit = null) {

		$subpageIds = [];

		/** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder  $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages')->createQueryBuilder();

		$statement = $queryBuilder
			->select('uid')
			->from('pages')
			->where(
				$queryBuilder->expr()->in('pid', $pageIds)
			);

		if($sorting !== null) {
			$statement->orderBy($sorting);
		}

		if($limit !== null) {
			$statement->setMaxResults($limit);
		}

		$statement = $queryBuilder->executeQuery();

		while($row = $statement->fetchAssociative()) {
			$subpageIds[] = $row['uid'];
		}

		return $subpageIds;
	}

	/**
	 * Parst die Inhalte aller verknupeften Inhaltselemente
	 *
	 * @param ContentObjectRenderer $cObject The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObject, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) {

		if(isset($processedData['flexform']['settings']['sorting']) === true && $processedData['flexform']['settings']['sorting'] !== 'default') {
			$pages = GeneralUtility::intExplode(',', $processedData['data']['pages']);
			$subpages = $this->getSubpages($pages, $processedData['flexform']['settings']['sorting']);

			// Konfiguration wird falsch zwischengecacht
			// Reset auf Ursprungswert
			$this->menuConfig = [
				'wrap' => '[|]',
			];

			// bisherige Settings aus TypoScript zuruecksetzen
			unset($processorConfiguration['special.']['value.']);
			$processorConfiguration['special'] = 'list';
			$processorConfiguration['special.']['value'] = implode(', ', $subpages);
		}

		return parent::process($cObject, $contentObjectConfiguration, $processorConfiguration, $processedData);
	}
}