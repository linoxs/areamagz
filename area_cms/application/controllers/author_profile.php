<?php defined('SYSPATH') OR die('No direct access allowed.');
class Author_profile_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
    
    // Set session cookie
    $this->session = Session::instance();
  }
  
  public function index($user_id = NULL)
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    if ($user_id !== NULL):
      $allowed  = $this->_is_allowed_edit_other_profile($this->session->get('user_id'), $user_id);
      
      if ($allowed === FALSE):
        $this->session->set_flash('error', 'You are not allowed to edit this user profile.');
        url::redirect(url::base().'manage_users/');
        exit;
      endif;
    endif;
    
    $this->template->header->title                    = 'Area Magazine CMS : Author Profile';
    $this->template->header->page_title               = 'Update Author Profile';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/author_profile');
    
    // Query the user data
    $id_author  = ! $user_id == NULL ? $user_id : $this->session->get('user_id');
    
    $user = ORM::factory('user', $id_author);
    $this->template->content->user      = $user;
    
    // Show status option
    $this->template->content->show_status = $this->_show_status_option($user_id);
    
    // Get Menu
    $this->template->content->menu      = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }

  public function save_profile()
  {
    // Check session availibility
    $this->_check_session();
    
    $user = ORM::factory('user', $this->input->post('id'));
    $user->username     = mysql_real_escape_string($this->input->post('username'));
    $user->display_name = mysql_real_escape_string($this->input->post('display_name'));
    $user->email        = mysql_real_escape_string($this->input->post('email'));
    $user->biography    = mysql_real_escape_string(stripslashes($this->input->post('bio')));
    $user->website      = mysql_real_escape_string($this->input->post('website'));
    
    // Get the user picture info from database
    $old_pic = $user->userpic;
    
    // Delete current picture
    if (isset($_POST['del_pic'])):
      // Check wether user has been upload a picture before, delete it if exists 
      if (file_exists(DOCROOT.'media/data/'.$old_pic) && ! is_dir(DOCROOT.'media/data/'.$old_pic)):
        unlink(DOCROOT.'media/data/'.$old_pic);
      endif;
      
      $user->userpic = NULL;
    endif;
    
    if (isset($_FILES)):
      $files = Validation::factory($_FILES)
        ->add_rules('picture', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
       
      if ($files->validate())
      {        
        // Check wether user has been upload a picture before, delete it if exists 
        if (file_exists('media/data/'.$old_pic) && ! is_dir(DOCROOT.'media/data/'.$old_pic)):
          unlink('media/data/'.$old_pic);
        endif;
        
        // Temporary file name
        $filename = upload::save('picture');
       
        // Resize, sharpen, and save the image
        Image::factory($filename)
          ->resize(120, 120, Image::WIDTH)
          ->save('media/data/'.basename($filename));
        
        $user->userpic  = basename($filename);
      }
    endif;
    
    // Change user status
    if ($this->input->post('status')):
      $user->status = mysql_real_escape_string($this->input->post('status'));
    endif;

    $user->save();
    
    $this->session->set_flash('success', 'Profile has been updated');
    url::redirect(url::base().'author_profile/index/'.$this->input->post('id'));
  }
  
  public function change_password()
  {
     // Check session availibility
    $this->_check_session();
    
    $user = ORM::factory('user', $this->session->get('user_id'));
    
    // Check if current password is correct
    if ($user->password === md5($this->input->post('current'))):
      // Check if new password is the same with confirmation
      if ($this->input->post('new_pass') === $this->input->post('confirm')):
        $user->password = md5($this->input->post('new_pass'));
        $user->save();
        
        // Set flash session & redirect to index page
        $this->session->set_flash('hidpas', 'no');
        $this->session->set_flash('pass_success', 'Password has been changed.');
        url::redirect(url::base().'author_profile');
      else:
        // Set flash session & redirect to index page
        $this->session->set_flash('hidpas', 'no');
        $this->session->set_flash('pass_error', 'Passwords do not match !!');
        url::redirect(url::base().'author_profile');
      endif;
    else:
      // Set flash session & redirect to index page
      $this->session->set_flash('hidpas', 'no');
      $this->session->set_flash('pass_info', 'You have provide wrong current password, watch for caps lock !!');
      url::redirect(url::base().'author_profile');
    endif;
  }
  
  private function _is_allowed_edit_other_profile($my_id, $author_id)
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
  
  private function _show_status_option($id)
  {
    if (! $id)
    {
      return false;
    }
    else
    {
      if ($this->session->get('role') > 1)
      {
        return false;
      }
      else
      {
        if ($this->session->get('user_id') == $id)
        {
          return false;
        }
        else
        {
          return true;
        }
      }
    }
    
  }
}
// END Author_profile_Controller