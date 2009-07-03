<?php defined('SYSPATH') OR die('No direct access allowed.');
class Ajax_Controller extends Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function approve_comment()
  {
    if ($this->input->post('from-ajax') == 'yes'):
      $id = $this->input->post('id');
      
      // Get comment data from database
      $comment = ORM::factory('comment', $id);
      
      // Update status of the mentioned comment from database
      $comment->status  = 1;
      
      // Save the data
      $comment->save();
      
      echo 'success';
    else:
      echo 'You are not allowed to view this page directly !';
    endif;
  }
  
  public function delete_comment()
  {
    if ($this->input->post('from-ajax') == 'yes'):
      $id = $this->input->post('id');
      
      // Get comment data from database
      $comment = ORM::factory('comment', $id);
      
      // Delete the data
      $comment->delete();
      
      echo 'success';
    else:
      echo 'You are not allowed to view this page directly !';
    endif;
  }
  
  public function delete_image()
  {
    if ($this->input->post('from-ajax') == 'yes'):
      $id = $this->input->post('id');
      
      // Get comment data from database
      $image = ORM::factory('gallery_image', $id);
      
      // Delete the file
      if (file_exists(Kohana::config('core.gallery_folder').$image->image)):
        unlink(Kohana::config('core.gallery_folder').$image->image);
      endif;
      
      // Delete the data
      $image->delete();
      
      echo 'success';
    else:
      echo 'You are not allowed to view this page directly !';
    endif;
  }
}
// END Ajax_Controller 