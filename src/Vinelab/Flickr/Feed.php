<?php namespace Vinelab\Flickr;

Class Feed {

	protected $title;
	protected $url;
	protected $description;
	protected $image;
	protected $guid;
	protected $items;

	function __construct($feedData)
	{
		$this->title = $feedData->title;
		$this->url = $feedData->url;
		$this->description = $feedData->description;
		$this->image = $feedData->image;
		$this->guid = $feedData->guid;

		$this->items = array_map(function($item) {
			return new FeedItem($item);
		}, $feedData->items);
	}

	public static function collection($feed)
	{
		if ($feed !== false)
		{
			$feedReflection = new \ReflectionObject( (object) $feed);

			if ($feedReflection->hasProperty('photoset'))
			{
				// we're dealing with a photoset

			} else {
				// dealing with a regular rss feed but serialized to PHP array
			}
		}

		return $feed;

	}
}