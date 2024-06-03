<?php

namespace Ps14\Site\Filter\DataProvider;

abstract class AbstractDataProvider {

	/**
	 * Instanz des Filter Service
	 *
	 * @var \Ps14\Site\Service\FilterService $filter
	 */
	protected $filter;

	/**
	 * @param array $data
	 * @param array $properties
	 * @return array $data
	 */
	abstract public function provide($data, $properties);

	/**
	 * @return \Ps14\Site\Service\FilterService
	 */
	public function getFilter() {
		return $this->filter;
	}

	/**
	 * @param \Ps14\Site\Service\FilterService $filter
	 */
	public function setFilter(\Ps14\Site\Service\FilterService $filter) {
		$this->filter = $filter;
	}
}