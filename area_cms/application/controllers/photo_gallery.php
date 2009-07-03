<?php defined('SYSPATH') OR die('No direct access allowed.');
class Photo_gallery_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title            = 'Area Magazine CMS : Photo Gallery';
    $this->template->header->page_title       = 'Photo Gallery';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/photo_gallery');
    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function create_album()
  {    
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title            = 'Area Magazine CMS : Photo Gallery';
    $this->template->header->page_title       = 'Photo Gallery';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/photo_gallery');
    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function edit()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title            = 'Area Magazine CMS : Photo Gallery';
    $this->template->header->page_title       = 'Photo Gallery';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/photo_gallery_edit');
    
    // Get the albums data from database
    $query    = 'SELECT gallery_albums.id,
                      gallery_albums.title,
                      gallery_images.image
                FROM  gallery_albums
                LEFT JOIN gallery_images
                ON  gallery_albums.thumb_id = gallery_images.id
                ORDER BY gallery_albums.created_at DESC';
    
    $albums = $this->db->query($query);
    
    $this->template->content->albums          = $albums;
    
    
    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function edit_album($id)
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title            = 'Area Magazine CMS : Photo Gallery';
    $this->template->header->page_title       = 'Photo Gallery';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/photo_gallery_edit_album');
    
    // Get the album data from database
    $album  = ORM::factory('gallery_album')->find($id);
    
    // Get the images of the album from database
    $images = ORM::factory('gallery_image')->where('album_id', $id)->find_all();
    
    // Get this album image thumbnail
    $album_thumbnail  = ORM::factory('gallery_image')->where('id', $album->thumb_id)->find();
    
    $this->template->content->album       = $album;
    $this->template->content->album_thumb = $album_thumbnail;
    $this->template->content->images      = $images;
    
    $this->template->content->menu      = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function upload()
  {    
    // Check session availibility
    $this->_check_session();
    
    if ($_FILES['photo']['name'][0] == '' OR count($_FILES['photo']['name']) <= 0):
      // Retrieve error message
      $error = 'Please provide at least one photo';
      
      // Redirect to user page & display error
      $this->session->set_flash('photo_error', $error);
      url::redirect(url::site('photo_gallery/create_album'));
      exit;
    endif;
    
    // Call the validation class
    $valid  = new Validation($_POST);
    // Add pre filter
    $valid->pre_filter('trim', 'title');
    
    // Add rules
    $valid->add_rules('title', 'required', 'length[1,255]');
   
    if( ! $valid->validate()):
      // Retrieve error message
      $errors = $valid->errors('form_error_messages');
      
      // Redirect to user page & display error
      $this->session->set_flash('form_error', $errors);
      url::redirect(url::site('photo_gallery/create_album'));
    else:
      $album_folder_name  = date('Ymd').'_'.inflector::underscore(strtolower(trim($this->input->post('title'))));
    
      // Insert title record into gallery_albums table
      $album  = $this->db->insert(
                                  'gallery_albums',
                                  array(
                                    'created_at'  => date('Y-m-d h:i:s'),
                                    'title'       => trim($this->input->post('title')),
                                    'folder_name' => $album_folder_name,
                                  )
                          );
      
      // Get the ID of inserted album
      $album_id = $album->insert_id();
      
      // Create the album folder
      if ( ! file_exists(Kohana::config('core.gallery_folder').$album_folder_name)):
        mkdir(Kohana::config('core.gallery_folder').$album_folder_name);
      endif;
      
      // Transfer the $_FILES variable into new variable
      $files = $_FILES['photo'];
      
      // Unset the $_FILES variable
      unset($_FILES);
      
      // Count how many the files are
      $ilosc = count($files['name'])-1;
      
      // Loop each files and set new name into $_FILES['photo].$sequence variables
      for($i=0; $i<=$ilosc; $i++):
        $_FILES['photo'.$i]['name']     = $files['name'][$i];
        $_FILES['photo'.$i]['type']     = $files['type'][$i];
        $_FILES['photo'.$i]['tmp_name'] = $files['tmp_name'][$i];
        $_FILES['photo'.$i]['error']    = $files['error'][$i];
        $_FILES['photo'.$i]['size']     = $files['size'][$i];
      endfor;
      
      for($i=0; $i<=$ilosc; $i++):
        $valid->add_rules('photo'.$i, 'upload::valid', 'upload::type[gif,jpg,png]', 'upload::size[8M]');
        
        if($valid->validate()):
          for($i=0; $i<=$ilosc; $i++):
            $filename = upload::save('photo'.$i);
            
            // Check if the image file resolution is bigger than 800x800
            if (Image::factory($filename)->__get('width') <= 800 OR Image::factory($filename)->__get('height') <= 800):
              // Dont do resize, just save the image
              Image::factory($filename)
                ->save(Kohana::config('core.gallery_folder').$album_folder_name.'/'.basename($filename));
            else:
              // Resize and save the image
              Image::factory($filename)
                ->resize(800, 800, Image::WIDTH)
                ->save(Kohana::config('core.gallery_folder').$album_folder_name.'/'.basename($filename));
            endif;
            
            $insert_image = $this->db->insert(
                              'gallery_images',
                                array(
                                  'album_id'  => $album_id,
                                  'title'     => inflector::humanize($_FILES['photo'.$i]['name']),
                                  'image'     => $album_folder_name.'/'.basename($filename),
                                )
                              );
            
            // Insert the album thumbnail image
            if ($i == 0):
              $this->db->update('gallery_albums', array('thumb_id' => $insert_image->insert_id()), array('id' => $album_id));
            endif;
            
          endfor;
        else:
          // Retrieve error message
          $errors = $valid->errors('form_error_messages');
          
          // Redirect to user page & display error
          $this->session->set_flash('form_error', $errors);
          url::redirect(url::site('photo_gallery/create_album'));
        endif;
      endfor;
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'Album '.$this->input->post('title').' has been created.');
      url::redirect(url::site('photo_gallery/create_album'));
    endif;
  }
  
  public function update_album()
  {
    // Check session availibility
    $this->_check_session();
    
    $id = $this->input->post('album_id');
    
    $album  = ORM::factory('gallery_album', $id);
    
    $album->title       = mysql_real_escape_string(trim($this->input->post('title')));
    $album->description = mysql_real_escape_string(trim($this->input->post('description')));
    $album->place       = mysql_real_escape_string(trim($this->input->post('place')));
    $album->thumb_id    = mysql_real_escape_string(trim($this->input->post('thumb_id')));
    
    $album->save();
    
    // Redirect to user page & display success message
    $this->session->set_flash('form_success', 'This album has been updated.');
    url::redirect(url::site('photo_gallery/edit_album/'.$id));
  }
  
  public function update_album_images()
  {
    // Check session availibility
    $this->_check_session();
    
    $id = $this->input->post('album_id');
    
    foreach($_POST['title'] as $key => $title)
    {
      $image  = ORM::factory('gallery_image', $key);
      
      $image->title       = mysql_real_escape_string(trim($_POST['title'][$key]));
      $image->description = mysql_real_escape_string(trim($_POST['description'][$key]));
      
      $image->save();
    }
    
    // Redirect to user page & display success message
    $this->session->set_flash('form_success', 'This album has been updated.');
    url::redirect(url::site('photo_gallery/edit_album/'.$id));
  }
  
  public function delete_album($id)
  {
    // Check session availibility
    $this->_check_session();
    
    // Get album data from database
    $album  = ORM::factory('gallery_album', $id);
    
    // Get all images in this album
    $images = ORM::factory('gallery_image')->where('album_id', $id)->find_all();
    
    // Delete all images of this album
    foreach ($images as $image):
      if (file_exists(Kohana::config('core.gallery_folder').$image->image))
        unlink(Kohana::config('core.gallery_folder').$image->image);
    endforeach;
    
    // Delete all images record from database
    $this->db->delete('gallery_images', array('album_id' => $id));
    
    // Delete album folder
    rmdir(Kohana::config('core.gallery_folder').$album->folder_name);
    
    // Redirect to edit album page & display success message
    $this->session->set_flash('form_success', 'Album '.$this->input->post('title').' has been created.');
    
    // Delete the mentioned entry from database
    $album->delete();
    
    url::redirect(url::site('photo_gallery/edit'));
  }
  
  public function add_photos()
  {
    // Check session availibility
    $this->_check_session();
    
    // User have to fill at least one photo before pressing the upload button
    if ($_FILES['photo']['name'][0] == '' OR count($_FILES['photo']['name']) <= 0):
      // Retrieve error message
      $error = 'Please provide at least one photo';
      
      // Redirect to user page & display error
      $this->session->set_flash('photo_error', $error);
      url::redirect(url::site('photo_gallery/create_album'));
      exit;
    endif;
    
    // Get the ID of inserted album
    $album_id = $this->input->post('album_id');
    
    $album  = ORM::factory('gallery_album', $album_id);
    
    // Transfer the $_FILES variable into new variable
    $files = $_FILES['photo'];
    
    // Unset the $_FILES variable
    unset($_FILES);
    
    // Count how many the files are
    $ilosc = count($files['name'])-1;
    
    // Loop each files and set new name into $_FILES['photo].$sequence variables
    for($i=0; $i<=$ilosc; $i++):
      $_FILES['photo'.$i]['name']     = $files['name'][$i];
      $_FILES['photo'.$i]['type']     = $files['type'][$i];
      $_FILES['photo'.$i]['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['photo'.$i]['error']    = $files['error'][$i];
      $_FILES['photo'.$i]['size']     = $files['size'][$i];
    endfor;
    
    // Call the validation class
    $valid  = new Validation($_FILES);
    
    for($i=0; $i<=$ilosc; $i++):
      $valid->add_rules('photo'.$i, 'upload::valid', 'upload::type[gif,jpg,png]', 'upload::size[8M]');
      
      if($valid->validate()):
        for($i=0; $i<=$ilosc; $i++):
          $filename = upload::save('photo'.$i);
          
          // Check if the image file resolution is bigger than 800x800
          if (Image::factory($filename)->__get('width') <= 800 OR Image::factory($filename)->__get('height') <= 800):
            // Dont do resize, just save the image
            Image::factory($filename)
              ->save(Kohana::config('core.gallery_folder').$album->folder_name.'/'.basename($filename));
          else:
            // Resize and save the image
            Image::factory($filename)
              ->resize(800, 800, Image::WIDTH)
              ->save(Kohana::config('core.gallery_folder').$album->folder_name.'/'.basename($filename));
          endif;
          
          $insert_image = $this->db->insert(
                            'gallery_images',
                              array(
                                'album_id'  => $album_id,
                                'title'     => inflector::humanize($_FILES['photo'.$i]['name']),
                                'image'     => $album->folder_name.'/'.basename($filename),
                              )
                            );          
        endfor;
      else:
        // Retrieve error message
        $errors = $valid->errors('form_error_messages');
        
        // Redirect to user page & display error
        $this->session->set_flash('form_error', $errors);
        url::redirect(url::site('photo_gallery/edit_album/'.$album_id));
      endif;
    endfor;
    
    // Redirect to user page & display success message
    $this->session->set_flash('form_success', 'This album has been updated.');
    url::redirect(url::site('photo_gallery/edit_album/'.$album_id));
  }
}
// END Photo_gallery_Controller