<?php namespace Vinelab\Social\Flickr\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use Vinelab\Social\Flickr\Feed;

Class FeedTest extends TestCase {

	public function testFeed()
	{
		$result = unserialize(Helpers::mockResult('feed'));
		$feed = new Feed($result);

		$this->assertNotNull($feed->title, 'Must have a title');
		$this->assertNotNull($feed->url, 'Must have a url');
		$this->assertNotNull($feed->description, 'Must have a description');
		$this->assertNotNull($feed->image, 'Must have an image');
		$this->assertNotNull($feed->id, 'Must have an id');
		$this->assertNotNull($feed->photos, 'Must have an id');

		$this->assertInstanceOf('\Vinelab\Social\Flickr\Photo', $feed->photos[0]);

		$feedArray = $feed->toArray();
		$this->assertArrayHasKey('title', $feed->toArray());
		$this->assertEquals($feed->title, $feedArray['title']);

		$this->assertArrayHasKey('id', $feedArray['photos'][0]);
		$this->assertCount(count($feed->photos), $feedArray['photos']);
	}
}