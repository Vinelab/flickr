<?php namespace Vinelab\Flickr;

use HttpClient;

Class Agent {

	function __construct(\Illuminate\Config\Repository $config)
	{
		$this->config = $config;
		var_dump($this->config);
	}

	/**
	 * Fetches flickr feed URL (also supports Sets)
	 * @param  string (URL) $url The Feed URL from Flickr.com
	 * @return array
	 */

	public function fetch($url)
	{
		$response = HttpClient::get($this->request($url));
		return Feed::collection(@unserialize($response->content()));
	}

	/**
	 * Parses and transforms the URL into a requestable URL
	 * @return string | array
	 */
	protected function request($url)
	{
		$parsedURL = parse_url($url);

		if (isset($parsedURL['query']) and !empty($parsedURL['query']))
		{
			parse_str($parsedURL['query'], $query);

			if (isset($query['nsid']) and !empty($query['nsid']))
			{
				return sprintf($this->config->get('flickr::settings.feed_host_pattern'), $parsedURL['path'], 'id', $query['nsid']);
			} else {
				throw new \Exception('Flickr Feed URL is missing some attributes...');
			}

		} else if (strpos($parsedURL['path'], 'sets') !== false) { // Flickr sets are treated a bit differently

			$path = explode('/', $parsedURL['path']);
			$emptyPath = array_pop($path); // usually there's an extra / at the end of the url
			$photosetId = array_pop($path);

			$params = array(
				'api_key'     => $this->config->get('flickr::settings.api_key'),
				'method'      => $this->config->get('flickr::settings.sets_method'),
				'photoset_id' => $photosetId,
				'extras'      => 'url_sq,url_t,url_s,url_m,url_o',
				'format'	  => 'php_serial'
			);

			return array('url'=>$this->config->get('flickr::settings.api_host'), 'params'=>$params);

		} else {
			throw new \Exception('Unkown Flickr feed type');
		}

	}
}