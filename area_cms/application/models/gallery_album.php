<?php defined('SYSPATH') OR die('No direct access allowed.');
class Gallery_album_Model extends ORM {
  protected $has_many = array('gallery_image');
} // END Gallery_album_Model
