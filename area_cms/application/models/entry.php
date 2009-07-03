<?php defined('SYSPATH') OR die('No direct access allowed.');
class Entry_Model extends ORM {
  protected $belongs_to = array('user', 'category');
} // END Entry_Model