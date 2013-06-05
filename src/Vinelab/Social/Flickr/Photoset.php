<?php namespace Vinelab\Social\Flickr;

Class Photoset {

	public $id;
	public $title;
	public $photos;

	function __construct($photoset)
	{
		if (! $photoset instanceof stdClass)
		{
			$photoset = (object) $photoset;
		}

		$this->id     = $photoset->id;
		$this->title  = $photoset->ownername;
		$this->photos = array_map(array($this,'transformPhotos'), $photoset->photo);
	}

	protected function transformPhotos($photo)
	{
		return new Photo((object) $photo);
	}

	public function toArray()
	{
		$photosetArray = (array) $this;
		$photosetArray['photos'] = array_map(function($photo){ return $photo->toArray(); }, $photosetArray['photos']);
		return $photosetArray;
	}

}