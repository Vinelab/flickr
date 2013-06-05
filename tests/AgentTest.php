<?php namespace Vinelab\Social\Flickr\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use Mockery as M;
use Vinelab\Social\Flickr\Agent;

Class AgentTest extends TestCase {

	public function setUp()
	{
		$this->configMock       = M::mock('Illuminate\Config\Repository');
		$this->configMock->shouldReceive('get');

		$this->httpClientMock   = M::mock('Vinelab\Http\Client');
		$this->httpResponseMock = M::mock('Vinelab\Http\Response');
	}

	public function testFetchFeed()
	{
		$this->httpResponseMock->shouldReceive('content')->once()->andReturn(Helpers::mockResult('feed'));
		$this->httpClientMock->shouldReceive('get')->once()->andReturn($this->httpResponseMock);

		$flickr = new Agent($this->configMock, $this->httpClientMock);
		// IMPORTANT: in case of changing this url, the @param nsid is necessary for the Agent
		// 		to differentiate b/w a feed and a photoset

		$url = 'http://some.valid.url/with/some/path?nsid=123';

		$feed = $flickr->fetch($url);
		$this->assertNotNull($feed);
		$this->assertInstanceOf('\Vinelab\Social\Flickr\Feed', $feed, 'Should return a Feed instance');
	}

	public function testFetchPhotoset()
	{
		$this->httpResponseMock->shouldReceive('content')->once()->andReturn(Helpers::mockResult('photoset'));
		$this->httpClientMock->shouldReceive('get')->once()->andReturn($this->httpResponseMock);

		$flickr = new Agent($this->configMock, $this->httpClientMock);
		// IMPORTANT: in case of changing this url, the @param nsid is necessary for the Agent
		// 		to differentiate b/w a feed and a photoset

		$url = 'http://some.valid.url/with/some/path?nsid=123';

		$feed = $flickr->fetch($url);
		$this->assertNotNull($feed);
		$this->assertInstanceOf('\Vinelab\Social\Flickr\Photoset', $feed, 'Should return a photoset instance');
	}
}