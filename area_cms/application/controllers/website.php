<?php defined('SYSPATH') OR die('No direct access allowed.');
class Website_Controller extends Template_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->template->header = new View('pages/header');
    $this->template->footer = new View('pages/footer');
		
		$this->db	= Database::instance();
		$this->session	= Session::instance();
	}
	
	function _check_session()
	{
		if ($this->session->get('username') == ''):
			// redirect to logout method
			url::redirect(url::base().'login/do_logout');
    endif;
	}
	
	function _get_menu()
	{
		$modules_head =  $this->db->select('access_controls.module_id')
														->from('access_controls')
														->where('access_controls.role_id=',$this->session->get('role'))
														->get();

    $i = 0;
    $arr = array();
    
    foreach ($modules_head as $head):
      // Get The head menu
      $head_menu = ORM::factory('modules_head')->where('id =', $head->module_id)->find();
      
      $arr[$i]['id']          = $head_menu->id;
      $arr[$i]['name']        = $head_menu->name;
      $arr[$i]['controller']  = $head_menu->controller;
      
      $child_menu = ORM::factory('module')->where('head_id =', $head->module_id)->find_all();
      
      $x = 0;
      foreach($child_menu as $child)
      {
        $arr[$i]['child'][$x]['id'] = $child->id;
        $arr[$i]['child'][$x]['name'] = $child->name;
        $arr[$i]['child'][$x]['controller'] = $child->controller;
        
        $x++;
      }
      
      $i++;
    endforeach;
		
		return $arr;
	}
	
}