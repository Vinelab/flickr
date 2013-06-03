<?php namespace Vinelab\Flickr;

Class Feed {

	public $title;
	public $url;
	public $description;
	public $image;
	public $id;
	public $photos;

	function __construct($feed)
	{
		if (! $feed instanceof stdClass)
		{
			$feed = (object) $feed;
		}

		$this->title       = $feed->title;
		$this->url         = $feed->url;
		$this->description = $feed->description;
		$this->image       = $feed->image;
		$this->id          = $feed->guid;
		$this->photos      = array_map(array($this, 'transformPhotos'), $feed->items);
	}

	protected function transformPhotos($photo)
	{
		return new Photo((object) $photo);
	}

	public function toArray()
	{
		$feedArray = (array) $this;
		$feedArray['photos'] = array_map(function($photo){ return $photo->toArray(); }, $feedArray['photos']);
		return $feedArray;
	}
}