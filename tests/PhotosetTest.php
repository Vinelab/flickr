<?php namespace Vinelab\Flickr\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use \Vinelab\Flickr\Photoset;

Class PhotosetTest extends TestCase {

	public function testPhotoset()
	{
		$result = unserialize(Helpers::mockResult('photoset'));
		$photoset = new Photoset($result['photoset']);

		$this->assertNotNull($photoset->id, 'Must have an id');
		$this->assertNotNull($photoset->title, 'Must have a title');
		$this->assertNotNull($photoset->photos, 'Must have photos');

		$this->assertNotNull('\Vinelab\Flickr\Photo', $photoset->photos[0]);

		$photosetArray = $photoset->toArray();
		$this->assertArrayHasKey('title', $photosetArray);
		$this->assertArrayHasKey('id', $photosetArray['photos'][0]);
	}
}