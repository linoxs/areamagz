<?php defined('SYSPATH') OR die('No direct access allowed.');
class Role_Model extends ORM {
  protected $has_many = array('user');
} // END Role_Model