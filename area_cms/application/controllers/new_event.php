<?php defined('SYSPATH') OR die('No direct access allowed.');
class New_event_Controller extends Website_Controller {
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
    
    $this->template->header->title                    = 'Area Magazine CMS : Create New Event';
    $this->template->header->page_title               = 'Create New Event';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/event');
    
    // Get Categories from database
    $categories = ORM::factory('category')->find_all();
    $this->template->content->categories = $categories;
    
    $this->template->content->menu      = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function save($id = NULL)
  {
    // Check session availibility
    $this->_check_session();
    
    // Call the validation class
    $valid  = new Validation($_POST);
    // Add pre filter
    $valid->pre_filter('trim', 'title', 'location', 'description');
    
    // Add rules
    $valid->add_rules('title', 'required', 'length[1,255]');
    $valid->add_rules('location', 'required', 'length[1,255]');
    $valid->add_rules('description', 'required', 'length[5,65535]');
   
    if( ! $valid->validate()):
      // Retrieve error message
      $errors = $valid->errors('form_error_messages');
      
      // Redirect to user page & display error
      $this->session->set_flash('form_error', $errors);
      url::redirect(url::base().'new_event');
    else:
      if (isset($id) && $id > 0):
        $event = ORM::factory('event', $id);
      else:
        $event = ORM::factory('event');
      endif;
      
      $event->date          = $this->input->post('date').' '.$this->input->post('time');
      $event->title         = mysql_real_escape_string($this->input->post('title'));
      $event->location      = mysql_real_escape_string($this->input->post('location'));
      $event->description   = mysql_real_escape_string(stripslashes($this->input->post('description')));
      
      // Get the image record from database
      $old_image = $event->image;
      
      // Delete current picture
      if (isset($_POST['del_pic'])):
        // Check wether user has been upload a picture before, delete it if exists 
        if (file_exists(DOCROOT.Kohana::config('core.event_image_folder').$old_image) && ! is_dir(DOCROOT.Kohana::config('core.event_image_folder').$old_image)):
          unlink(DOCROOT.Kohana::config('core.event_image_folder').$old_image);
        endif;
        
        $event->image = NULL;
      endif;
      
      if (isset($_FILES) && $_FILES['image']['name'] !== ''):
        $files = Validation::factory($_FILES)
          ->add_rules('image', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
         
        if ($files->validate())
        {          
          // Temporary file name
          $filename = upload::save('image');
          
          // Resize, sharpen, and save the image
          Image::factory($filename)
            ->resize(400, 600, Image::WIDTH)
            ->save(Kohana::config('core.event_image_folder').basename($filename));
          
          $event->image  = basename($filename);
          
          unlink(Kohana::config('upload.directory').'/'.basename($filename));
        }
        else
        {
          // Redirect to user page & display error
          $this->session->set_flash('form_error', $files->errors());
          url::redirect(url::base().'new_event');
        }
      endif;
      
      $event->save();
      
      $status = isset($id) ? 'updated' : 'created';
      $url    = isset($id) ? 'manage_events/edit/'.$id : 'new_event';
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'Event '.$event->title.' has been '.$status.'.');
      url::redirect(url::base().$url);
    endif;
  }
}
// END New_event_Controller