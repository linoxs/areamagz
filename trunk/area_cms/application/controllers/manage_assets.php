<?php defined('SYSPATH') OR die('No direct access allowed.');
class Manage_assets_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $access = $this->_get_menu();

    $this->template->header->title            = 'Area Magazine CMS : File Manager';
    $this->template->header->page_title       = 'File Manager';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/assets');
    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function upload()
  {
    if (isset($_FILES)):
      $files = Validation::factory($_FILES)
        ->add_rules('picture', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
       
      if ($files->validate())
      {                
        // Temporary file name
        $filename = upload::save('picture');
        
        if (Image::factory($filename)->__get('width') <= 600 OR Image::factory($filename)->__get('height') <= 400):
          // Sharpen, and save the image
          Image::factory($filename)
                ->sharpen(15)
                ->save('media/images/'.basename($filename));
        else:
          // Resize, sharpen, and save the image
          Image::factory($filename)
                ->resize(600, 400, Image::WIDTH)
                ->sharpen(15)
                ->save('media/images/'.basename($filename));
        endif;
        
        // Redirect to manage assets page & display success message
        $this->session->set_flash('success', 'The file has been uploaded.');
        url::redirect(url::base().'manage_assets');
      }
      else
      {
        // Redirect to manage assets page & display success message
        $this->session->set_flash('info', 'Please choose one image file to upload. File type must be gif,jpg or png.');
        url::redirect(url::base().'manage_assets');
      }
    else:
      // Redirect to manage assets page & display success message
      $this->session->set_flash('error', 'Please choose one image file to upload.');
      url::redirect(url::base().'manage_assets');
    endif;
  }
}
// END Manage_assets_Controller