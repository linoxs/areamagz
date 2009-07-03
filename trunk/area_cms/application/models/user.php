<?php defined('SYSPATH') OR die('No direct access allowed.');
class User_Model extends ORM {
  protected $has_many = array('entry');
  protected $belongs_to = array('role');
} // END User_Model