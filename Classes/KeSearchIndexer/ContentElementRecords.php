<?php

namespace Ps14\Site\KeSearchIndexer;

use Tpwd\KeSearch\Indexer\Types\Page;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ContentElementRecords {

	/**
	 * @param string $fields
	 * @param $pageIndexer
	 * @return void
	 */
	public function modifyPageContentFields(&$fields, $pageIndexer)	{
		$fields .= ', tx_foundation_elements';
	}

	/**
	 * @param string $bodytext
	 * @param array $ttContent
	 * @param Page $pageIndexer
	 * @return void
	 */
	public function modifyContentFromContentElement(string &$bodytext, array $ttContent, Page $pageIndexer) {
		if(empty($ttContent['tx_foundation_elements']) === true) {
			return;
		}

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_foundation_domain_model_elements')->createQueryBuilder();
		$statement = $queryBuilder
			->select('uid', 'title', 'description', 'content')
			->from('tx_foundation_domain_model_elements')
			->where(
				$queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter((int) $ttContent['uid'], Connection::PARAM_INT)),
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter((int) $ttContent['sys_language_uid'], Connection::PARAM_INT))
			)
			->execute();

		while($row = $statement->fetch()) {
			if(empty($row['title']) === false) {
				$bodytext .= ' ' . strip_tags($row['title']);
			}

			if(empty($row['description']) === false) {
				$bodytext .= ' ' . strip_tags($row['description']);
			}
		}
	}
}