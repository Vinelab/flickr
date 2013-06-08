<?php namespace Vinelab\Flickr;

Class Agent {

	function __construct(\Illuminate\Config\Repository $config, \Vinelab\Http\Client $httpClient)
	{
		$this->config = $config;
		$this->httpClient = $httpClient;
	}

	/**
	 * Fetches flickr feed URL (also supports Sets)
	 * @param  string (URL) $url The Feed URL from Flickr.com
	 * @return array
	 */

	public function fetch($url)
	{
		$response = $this->httpClient->get($this->request($url));

		if ($response)
		{
			return $this->feed($response->content());
		}

	}

	public function feed($content)
	{
		if ($content)
		{
			$content = unserialize($content);
			return isset($content['photoset']) ? new Photoset($content['photoset']) : new Feed($content);
		}
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
				'method'      => $this->config->get('flickr::settings.photoset_photos_method'),
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