<?php defined('SYSPATH') OR die('No direct access allowed.');
class Gallery_image_Model extends ORM {
  protected $belongs_to = array('gallery_album');
} // END Gallery_image_Model
