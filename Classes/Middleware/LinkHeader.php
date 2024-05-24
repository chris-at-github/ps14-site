<?php

namespace Ps14\Site\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class LinkHeader implements MiddlewareInterface {

	/**
	 * @param \Psr\Http\Message\ServerRequestInterface $request
	 * @param \Psr\Http\Server\RequestHandlerInterface $handler
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler):ResponseInterface {

		/** @var Response $response */
		$response = $handler->handle($request);
		$pageType = (int) GeneralUtility::_GP('type');

		if($pageType === 8080) {
			$link = $request->getUri()->getScheme() . '://' . $request->getUri()->getHost() . $request->getUri()->getPath();
			$response = $response->withAddedHeader('Link', '<' . $link . '>; rel="canonical"');
		}

		return $response;
	}
}