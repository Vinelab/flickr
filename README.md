![build status](https://travis-ci.org/Vinelab/flickr.png?branch=master "build status")

## Vinelab  - Flickr Agent

## Installation
Refer to [vinelab/flickr on packagist.org](https://packagist.org/packages/vinelab/flickr) for composer installation instructions.

Edit **app.php** and add ```'Vinelab\Services\Flickr\FlickrServiceProvider',``` to the ```'providers'``` array.

It will automatically alias itself as **Flickr** so no need to alias it in your **app.php** unless you would like to customize it. In that case edit your **'aliases'** in **app.php** adding ``` 'MyFlickr'	  => 'Vinelab\Services\Flickr\Facades\Flickr',```

## Usage

### Fetch Feed

```php

$feed = Flickr::fetch('feed://api.flickr.com/services/feeds/photos_public.gne?nsid=54738376@N04&lang=en-us&format=rss_200');

// Result
object(Vinelab\Flickr\Feed)[144]
  public 'title' => string 'Uploads from Dan Chippendale' (length=28)
  public 'url' => string 'http://www.flickr.com/photos/danchippendale/' (length=44)
  public 'description' => string '' (length=0)
  public 'image' => string 'http://farm8.staticflickr.com/7442/buddyicons/54738376@N04.jpg?1369125163#54738376@N04' (length=86)
  public 'id' => string '/photos/public/54706237' (length=23)
  public 'photos' =>
    array (size=20)
      0 =>
        object(Vinelab\Flickr\Photo)[146]
          public 'id' => string '/photo/8922527151' (length=17)
          public 'title' => string 'A touch of the Alps in Bromley' (length=30)
          public 'url' => string 'http://www.flickr.com/photos/danchippendale/8922527151/' (length=55)
          public 'width' => string '1024' (length=4)
          public 'height' => string '526' (length=3)
      1 =>
        object(Vinelab\Flickr\Photo)[147]
          public 'id' => string '/photo/8915741362' (length=17)
          public 'title' => string 'Boys toys' (length=9)
          public 'url' => string 'http://www.flickr.com/photos/danchippendale/8915741362/' (length=55)
          public 'width' => string '681' (length=3)
          public 'height' => string '1024' (length=4)
    	  ....
```

### Fetch Photoset

```php
$photoset = Flickr::fetch('http://www.flickr.com/photos/danchippendale/sets/72157633636679556/');

// Result
object(Vinelab\Flickr\Photoset)[144]
  public 'id' => string '72157633636679556' (length=17)
  public 'title' => string 'Dan Chippendale' (length=15)
  public 'photos' =>
    array (size=100)
      0 =>
        object(Vinelab\Flickr\Photo)[146]
          public 'id' => string '8757610350' (length=10)
          public 'title' => string 'To the sea!' (length=11)
          public 'url' => string 'http://farm4.staticflickr.com/3778/8757610350_737f9738d6.jpg' (length=60)
          public 'width' => string '5212' (length=4)
          public 'height' => string '3468' (length=4)
      1 =>
        object(Vinelab\Flickr\Photo)[147]
          public 'id' => string '8756483393' (length=10)
          public 'title' => string 'L1037144' (length=8)
          public 'url' => string 'http://farm3.staticflickr.com/2831/8756483393_7d83a4a564.jpg' (length=60)
          public 'width' => string '5212' (length=4)
          public 'height' => string '3468' (length=4)
          ....
```

## TODO
- **Photoset and Feed classes must iterate through all the result pages to include all the photos. i.e. The flickr result limit is around 100 and there's 500 photos in the set.**
- Improve tests by adding **failure** tests, currently only includes succeeding scenarios where the results are received as expected.
- Photo Class must do more like returning specified sizes of photos based on photo url i.e. ```$photo->small();``` and ```$photo->medium();``` etc.
