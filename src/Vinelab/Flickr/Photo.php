<?php namespace Vinelab\Flickr;

Class Photo {

	public $id;
	public $title;
	public $url;
	public $width;
	public $height;

	function __construct($photo)
	{
		if (! $photo instanceof stdClass)
		{
			$photo = (object) $photo;
		}

		$this->id    = isset($photo->guid) ? $photo->guid : $photo->id;
		$this->title = $photo->title;
		$this->url   = isset($photo->url) ? $photo->url : $photo->url_m;
		$this->width = isset($photo->width) ? $photo->width : $photo->width_o;
		$this->height= isset($photo->height) ? $photo->height : $photo->height_o;
	}

	public function toArray()
	{
		return (array) $this;
	}
}