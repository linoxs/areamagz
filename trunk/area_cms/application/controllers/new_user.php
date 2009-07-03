<?php defined('SYSPATH') OR die('No direct access allowed.');
class New_user_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
    
    // Set session cookie
    $this->session = Session::instance();
  }
  
  public function index()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title                    = 'Area Magazine CMS : Create New User';
    $this->template->header->page_title               = 'Create New User';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/new_user');
    $this->template->content->menu      = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function save()
  {
    // Call the validation class
    $valid  = new Validation($_POST);
    // Add pre filter
    $valid->pre_filter('trim', 'username', 'display_name');
    
    // Add rules
    $valid->add_rules('username', 'required', 'length[3,30]');
    $valid->add_rules('password', 'required', 'length[6,30]');
    $valid->add_rules('confirm_pass', 'required');
        
    // Add unique email rule
    $valid->add_callbacks('confirm_pass', array($this, '_pwd_check'));
    
    if( ! $valid->validate()):
      // Retrieve error message
      $errors = $valid->errors('form_error_messages');
      
      // Redirect to user page & display error
      $this->session->set_flash('form_error', $errors);
      url::redirect(url::base().'new_user');
    else:
      $user = ORM::factory('user');
      $user->username     = mysql_real_escape_string($this->input->post('username'));
      $user->display_name = mysql_real_escape_string($this->input->post('display_name'));
      $user->role         = mysql_real_escape_string($this->input->post('role'));
      $user->password     = md5(mysql_real_escape_string($this->input->post('password')));
      
      $user->save();
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'User '.$user->username.' has been created.');
      url::redirect(url::base().'new_user');
    endif;
  }
  
  public function _pwd_check(Validation $post)
  {
    // If add->rules validation found any errors, get me out of here!
    if (array_key_exists('confirm_pass', $post->errors()))
        return;
  
    // only valid if confirmation password match the password
    if ($post->password !== $post->confirm_pass)
    {
        // Add a validation error, this will cause $post->validate() to return FALSE
        $post->add_error( 'confirm_pass', 'pwd_check');
    }
  }
}
// END New_user_Controller