<?php defined('SYSPATH') OR die('No direct access allowed.');
class Manage_users_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    //Pagination configuration
    $num_per_page = 10;
    
    $total  = $this->db->count_records('users');

    //Setup pagination
    $pagination = new Pagination(array(
                        'base_url'    => 'manage_users/index/',
                        'uri_segment' => 'index',
                        'total_items'=> $total,
                        'style' => "digg",
                        'items_per_page' => $num_per_page,
                        'auto_hide' => true
                      ));
   
    $offset = $this->uri->segment(3) == 1 ? 0 : $this->uri->segment(3);
    
    $users    = $this->db
                    ->select(
                             'users.id',
                             'users.username',
                             'users.display_name',
                             'users.status',
                             'roles.name AS role',
                             '(CASE WHEN users.status=1 THEN "active" ELSE "inactive" END) AS status'
                             )
                    ->from('users')
                    ->join('roles', 'roles.id', 'users.role')
                    ->where(array('users.role >=' => 1))
                    ->limit($num_per_page, $offset)
                    ->get();
    
    $this->template->header->title            = 'Area Magazine CMS : Manage Users';
    $this->template->header->page_title       = 'Manage Users';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/show_user');
    $this->template->content->users     = $users;
    $this->template->content->pagination= $pagination;
    
    $this->template->content->menu      = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function delete($id)
  {
    if ($id !== NULL):
      $allowed  = $this->_is_allowed_delete_other_profile($this->session->get('user_id'), $id);
      
      if ($allowed === FALSE):
        $this->session->set_flash('error', 'You are not allowed to delete this user.');
        url::redirect(url::base().'manage_users/');
        exit;
      endif;
    endif;
    
    $user = ORM::factory('user', $id);
    
    if ($user->id == ''):
      // Redirect to user page & display error message
      $this->session->set_flash('form_error', 'User with id : '.$id.' does not exists.');
      url::redirect(url::base().'manage_users');
    else:
      $user->delete();
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'User with id'.$id.' has been removed.');
      url::redirect(url::base().'manage_users');
    endif;
  }
  
  private function _is_allowed_delete_other_profile($my_id, $author_id)
	{
    // Get login user information
		$user   = ORM::factory('user', $my_id);
    
    // Get author information
		$author = ORM::factory('user', $author_id);
    
    // Return true if login user role is greater than administrator AND login user role is greater that author role
		if ($this->session->get('role') <= 1 && $user->role < $author->role):
			return true;
		else:
      // Return true if is editing own profile
			if ($author_id == $my_id):
				return true;
			else:
        // Else than condition above return false
				return false;
			endif;
    endif;
	}
}
// END Manage_users_Controller