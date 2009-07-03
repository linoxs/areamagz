<?php defined('SYSPATH') OR die('No direct access allowed.');
class Blog_Model extends ORM {
  protected $belongs_to = array('blog_author');
} // END Blog_Model
