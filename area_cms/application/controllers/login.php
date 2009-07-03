<?php defined('SYSPATH') OR die('No direct access allowed.');
class Login_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index($err = NULL)
  {
    $this->template->header->title          = 'Area Magazine CMS : Login';
    $this->template->header->page_title     = 'Login';
    $this->template->header->greeting_box   = NULL;
    $this->template->content                = new View('pages/login');
  }
  
  public function do_login()
  {
    // Proceed only if the data is submited through form submit
    if ($this->input->post('enter') === 'Login'):
      $user = ORM::factory('user')->where(array('username' => $this->input->post('username'), 'password' => md5($this->input->post('password'))))->find();
      
      if ($user->status == 0):
        // redirect to login page with error message
        $this->session->set_flash('login_error', 'Your account has not been activated, please contact webmaster.');
        url::redirect(url::base().'login');
        exit;
      endif;
      
      // If username * password correct
      if ($user->username):
        // Set userdata into session cookies
        $this->session->set(
                          array(
                            'user_id'       => $user->id,
                            'username'      => $user->username,
                            'display_name'  => $user->display_name,
                            'role'          => $user->role,
                          )
                        );
        
        // redirect to cms dasboard
        url::redirect(url::base().'home');
      else: // Else
        // redirect to login page with error message
        $this->session->set_flash('login_error', 'Unknown user or wrong password');
        url::redirect(url::base().'login');
      endif;
    // Display error message if not
    else:
      echo 'No direct acces is allowed';
    endif;
  }
  
  function do_logout()
  {
    // Destroy session cookies
    $this->session->destroy();
    
    // redirect to cms dasboard
    url::redirect(url::base().'login');
  }
}
// END Login_Controller