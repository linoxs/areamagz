<?php defined('SYSPATH') OR die('No direct access allowed.');
class Module_Model extends ORM {
  protected $has_many = array('access_control');
} // END Module_Model