<?php defined('SYSPATH') OR die('No direct access allowed.');
class Access_control_Model extends ORM {
  protected $belongs_to = array('module','role');
} // END Access_control_Model
