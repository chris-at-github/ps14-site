<?php

namespace Ps14\Site\KeSearchIndexer;

use Tpwd\KeSearch\Indexer\Types\Page;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class RemoveContentFromHiddenParent {

	/**
	 * @param string $fields
	 * @param $pageIndexer
	 * @return void
	 */
	public function modifyPageContentFields(&$fields, $pageIndexer)	{
		$fields .= ',colPos, tx_foundation_parent';
	}

	/**
	 * @param array $ttContent
	 * @param bool $isIndexed
	 * @param Page $pageIndexer
	 * @return boolean
	 */
	public function contentElementShouldBeIndexed(array $ttContent, bool $isIndexed, Page $pageIndexer) {

		// keine verschachtelten Inhaltselemente von tx_foundation_domain_model_elements -> darf indexiert werden
		if(empty($ttContent['tx_foundation_parent']) === true || (int) $ttContent['colPos'] !== 5628) {
			return $isIndexed;
		}

		// ---
		// 1. Pruefung ob der Elterndatensatz (tx_xo_domain_model_elements) aktiv ist

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_foundation_domain_model_elements')->createQueryBuilder();
		$statement = $queryBuilder
			->select('foreign_uid')
			->from('tx_foundation_domain_model_elements')
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter((int) $ttContent['tx_foundation_parent'], Connection::PARAM_INT)),
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter((int) $ttContent['sys_language_uid'], Connection::PARAM_INT))
			)
			->execute();
		$element = $statement->fetch();

		// Element ist hidden | deleted
		if($element === false) {
			return false;
		}

		// ---
		// 2. Pruefung ob das Elternelement von tx_foundation_domain_model_elements aktiv ist

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content')->createQueryBuilder();
		$statement = $queryBuilder
			->select('*')
			->from('tt_content')
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter((int) $element['foreign_uid'], Connection::PARAM_INT)),
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter((int) $ttContent['sys_language_uid'], Connection::PARAM_INT))
			)
			->execute();
		$content = $statement->fetch();

		// Content Element ist hidden | deleted
		if($content === false) {
			return false;
		}

		return $isIndexed;
	}
}