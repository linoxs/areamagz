<?php defined('SYSPATH') OR die('No direct access allowed.');
class Website_Controller extends Template_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->db	= Database::instance();
		
		$this->template->header = new View('includes/header');
    $this->template->footer = new View('includes/footer');
	}
}
// END Website_Controller