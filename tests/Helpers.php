<?php namespace Vinelab\Flickr\Tests;

Class Helpers {

	public static function mockResult($of)
	{
		switch($of)
		{
			case 'photoset':
			default:
				$file = './tests/resources/photoset.php';
			break;

			case 'feed':
				$file = './tests/resources/feed.php';
			break;
		}

		return implode('', file($file));
	}
}