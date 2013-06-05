<?php namespace Vinelab\Social\Flickr\Tests;

Class Helpers {

	public static function mockResult($of)
	{
		return implode('', file("./tests/resources/{$of}.php"));
	}
}