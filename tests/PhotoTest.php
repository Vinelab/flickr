<?php namespace Vinelab\Social\Flickr\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use Vinelab\Social\Flickr\Photo;

Class PhotoTest extends TestCase {

	public function testFeedPhoto()
	{
		$this->runInstantiationTestOn('feed_photo');
	}

	public function testPhotosetPhoto()
	{
		$this->runInstantiationTestOn('photoset_photo');
	}

	protected function runInstantiationTestOn($photoType)
	{
		$photo = new Photo(unserialize(Helpers::mockResult($photoType)));

		$this->assertInstanceOf('\Vinelab\Social\Flickr\Photo', $photo);
		$this->assertNotNull($photo->id, 'Must have an id');
		$this->assertNotNull($photo->title, 'Must have a title');
		$this->assertNotNull($photo->url, 'Must have a url');
		$this->assertNotNull($photo->width, 'Must have a width');
		$this->assertNotNull($photo->height, 'Must have a height');

		$photoArray = $photo->toArray();

		$this->assertArrayHasKey('id', $photoArray);
		$this->assertEquals($photo->id, $photoArray['id']);

		$this->assertArrayHasKey('title', $photoArray);
		$this->assertEquals($photo->title, $photoArray['title']);

		$this->assertArrayHasKey('url', $photoArray);
		$this->assertEquals($photo->url, $photoArray['url']);

		$this->assertArrayHasKey('width', $photoArray);
		$this->assertEquals($photo->width, $photoArray['width']);

		$this->assertArrayHasKey('height', $photoArray);
		$this->assertEquals($photo->height, $photoArray['height']);
	}
}