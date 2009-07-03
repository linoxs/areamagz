<?php defined('SYSPATH') OR die('No direct access allowed.');
class Category_Model extends ORM {
  protected $has_many = array('entry');
} // END Category_Model
