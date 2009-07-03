<?php defined('SYSPATH') OR die('No direct access allowed.');
class New_entry_Controller extends Website_Controller {
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
    
    $this->template->header->title                    = 'Area Magazine CMS : Create New Entry';
    $this->template->header->page_title               = 'Create New Entry';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/entry');
    
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
    $valid->pre_filter('trim', 'title', 'excerpt');
    
    // Add rules
    $valid->add_rules('title', 'required', 'length[1,255]');
    $valid->add_rules('body_text', 'required', 'length[50,65535]');
   
    if( ! $valid->validate()):
      // Retrieve error message
      $errors = $valid->errors('form_error_messages');
      
      // Redirect to user page & display error
      $this->session->set_flash('form_error', $errors);
      url::redirect(url::base().'new_entry');
    else:
      if (isset($id) && $id > 0):
        $entry = ORM::factory('entry', $id);
      else:
        $entry = ORM::factory('entry');
      endif;
      
      $entry->created_at    = isset($id) ? $this->input->post('date').' '.$this->input->post('hour').':'.$this->input->post('minute').':00' : date('Y-m-d h:i:s');
      $entry->title         = mysql_real_escape_string($this->input->post('title'));
      $entry->excerpt       = mysql_real_escape_string($this->input->post('excerpt'));
      $entry->body_text     = mysql_real_escape_string(stripslashes($this->input->post('body_text')));
      $entry->category_id   = mysql_real_escape_string($this->input->post('category'));
      $entry->author_id     = $this->session->get('user_id');
      $entry->status        = mysql_real_escape_string($this->input->post('status'));
      $entry->url           = date('Y').'/'.date('m').'/'.date('d').'/'.$this->_make_url($entry->title);
      
      // Get the image thumbnail record from database
      $old_thumb = $entry->thumb_image;
      
      // Delete current picture
      if (isset($_POST['del_pic'])):
        // Check wether user has been upload a picture before, delete it if exists 
        if (file_exists(DOCROOT.Kohana::config('core.entry_image_folder').$old_thumb) && ! is_dir(DOCROOT.Kohana::config('core.entry_image_folder').$old_thumb)):
          unlink(DOCROOT.Kohana::config('core.entry_image_folder').$old_thumb);
        endif;
        
        $entry->thumb_image = NULL;
      endif;
      
      if (isset($_FILES)):
        $files = Validation::factory($_FILES)
          ->add_rules('thumb', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
         
        if ($files->validate())
        {          
          // Temporary file name
          $filename = upload::save('thumb');
          
          // Resize, sharpen, and save the image
          if ($entry->category_id == 10 OR $entry->category_id == 11):
            Image::factory($filename)
              ->resize(70, 91, Image::HEIGHT)
              ->crop(70, 91)
              ->save(Kohana::config('core.entry_image_folder').basename($filename));
          else:
            if (Image::factory($filename)->__get('width') <= 310 OR Image::factory($filename)->__get('height') <= 248):
              Image::factory($filename)
                ->save(Kohana::config('core.entry_image_folder').basename($filename));
            else:
              Image::factory($filename)
                ->resize(310, 248, Image::WIDTH)
                ->crop(310, 248)
                ->save(Kohana::config('core.entry_image_folder').basename($filename));
            endif;
          endif;
          
          $entry->thumb_image  = basename($filename);
          
          unlink(Kohana::config('upload.directory').'/'.basename($filename));
        }
      endif;
      
      $entry->save();
      
      $status = isset($id) ? 'updated' : 'created';
      $url    = isset($id) ? 'manage_entries/edit/'.$id : 'new_entry';
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'Entry '.$entry->title.' has been '.$status.'.');
      url::redirect(url::base().$url);
    endif;
  }
  
  private function _make_url($text)
  {
    $text_model = new Text_Model;
    
    $the_text = text::limit_words($text, 5, '');
    $new_text = $text_model->dirify($the_text);
    $undr_text= str_replace('_', '-', $new_text);
    
    return $undr_text;
  }
}
// END New_entry_Controller