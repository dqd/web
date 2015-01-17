<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace SiteModule\Api;

use Nette\Utils\Json;
use Nette\Utils\Strings;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ApiClient extends \Nette\Object
{

	/** @var string */
	private $apiUrl;

	/**
	 * @param string $apiUrl
	 */
	public function __construct($apiUrl)
	{
		$this->apiUrl = (string) $apiUrl;
	}

	/**
	 * @param string $url
	 * @return mixed
	 */
	public function callApi($url)
	{
		return Json::decode(
			$this->callRawApi($url),
			Json::FORCE_ARRAY
		);
	}

	/**
	 * @param string $url
	 * @return string
	 */
	public function callRawApi($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'PHP');
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

}
