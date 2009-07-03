<?php defined('SYSPATH') OR die('No direct access allowed.');
class Manage_comments_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    $access = $this->_get_menu();
    
    $this->template->header->title      = 'Area Magazine CMS : Manage Comments';
    $this->template->header->page_title = 'Manage Comments';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/show_comment');
    
    //Pagination configuration
    $num_per_page = 10;
    
    $total  = $this->db->count_records('entries');

    //Setup pagination
    $pagination = new Pagination(array(
                        'base_url'    => 'manage_comments/index/',
                        'uri_segment' => 'index',
                        'total_items' => $total,
                        'style'       => "digg",
                        'items_per_page' => $num_per_page,
                        'auto_hide'   => true
                      ));
   
    $offset = $this->uri->segment(3) == 1 ? 0 : $this->uri->segment(3);
    $comments = $this->db->select(
                                  'comments.id',
                                  'comments.time',
                                  'comments.name',
                                  'comments.email',
                                  'comments.comment',
                                  'comments.status',
                                  'entries.title'
                                  )
                        ->from('comments')
                        ->join('entries', 'comments.entry_id', 'entries.id')
                        ->orderby('comments.id','DESC')
                        ->limit($num_per_page, $offset)
                        ->get();

    $this->template->content->comments  = $comments;
    $this->template->content->pagination  = $pagination;

    $this->template->content->menu      = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function approve($id)
  {
    // Check session availibility
    $this->_check_session();
    
    // Get comment data from database
    $comment = ORM::factory('comment', $id);
    
    // set success message session
    $this->session->set_flash('form_success', 'Comment has been approved.');
    
    // set comment status as approved
    $comment->status = 1;
    
    // Delete the mentioned comment from database
    $comment->save();
    
    // Redirect to manage comments page
    url::redirect(url::base().'manage_comments');
  }
  
  public function delete($id)
  {
    // Check session availibility
    $this->_check_session();
    
    // Get comment data from database
    $comment = ORM::factory('comment', $id);
    
    // set success message session
    $this->session->set_flash('form_success', 'Comment has been deleted.');
    
    // Delete the mentioned comment from database
    $comment->delete();
    
    // Redirect to manage comments page
    url::redirect(url::base().'manage_comments');
  }
}
// END Manage_comments_Controller