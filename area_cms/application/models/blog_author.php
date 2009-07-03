<?php defined('SYSPATH') OR die('No direct access allowed.');
class Blog_author_Model extends ORM {
  protected $has_many = array('blog');
} // END Blog_author_Model
