<?php

namespace Ps14\Site\KeSearchIndexer;

use Tpwd\KeSearch\Indexer\Types\File;
use Tpwd\KeSearch\Indexer\Types\Page;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class SysFileReferenceFields {

	/**
	 * @param $fileObject
	 * @param string $content
	 * @param File $fileIndexerObject
	 * @param string $feGroups
	 * @param array $ttContent
	 * @param string $storagePid
	 * @param string $title
	 * @param string $tags
	 * @param string $abstract
	 * @param array $additionalFields
	 * @return void
	 */
	public function modifyFileIndexEntryFromContentIndexer($fileObject, string &$content, File $fileIndexerObject, ?string $feGroups, array $ttContent, string $storagePid, string &$title, string &$tags, string $abstract, array $additionalFields) {
		if($fileObject instanceof FileReference) {
			$properties = $fileObject->getProperties();

			if(empty($properties['title']) === false) {
				$title = strip_tags($properties['title']);
			}

			if(empty($properties['description']) === false && strpos($content, strip_tags($properties['description'])) === false) {
				$content .= ' ' . strip_tags($properties['description']);
			}
		}
	}
}