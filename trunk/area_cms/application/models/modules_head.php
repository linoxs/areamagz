<?php defined('SYSPATH') OR die('No direct access allowed.');
class Modules_head_Model extends ORM {
  protected $has_many = array('module');
} // END Modules_head_Model