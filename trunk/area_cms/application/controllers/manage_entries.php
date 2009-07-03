<?php defined('SYSPATH') OR die('No direct access allowed.');
class Manage_entries_Controller extends Website_Controller {
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
    
    $total  = $this->db->count_records('entries');

    //Setup pagination
    $pagination = new Pagination(array(
                        'base_url'    => 'manage_entries/index/',
                        'uri_segment' => 'index',
                        'total_items'=> $total,
                        'style' => "digg",
                        'items_per_page' => $num_per_page,
                        'auto_hide' => true
                      ));
   
    $offset = $this->uri->segment(3) == 1 ? 0 : $this->uri->segment(3);
    
    $entries    = $this->db
                    ->select(
                              'entries.id',
                              'entries.created_at',
                              'entries.title',
                              'entries.excerpt',
                              'categories.label AS category',
                              'users.display_name AS author',
                              '(CASE WHEN entries.status=1 THEN "published" ELSE "draft" END) AS status'
                             )
                    ->from('entries')
                    ->join('categories', 'categories.id', 'entries.category_id')
                    ->join('users', 'users.id', 'entries.author_id')
                    ->orderby('entries.id', 'DESC')
                    ->limit($num_per_page, $offset)
                    ->get();
                    
    $this->template->header->title      = 'Area Magazine CMS : Manage Entries';
    $this->template->header->page_title = 'Manage Entries';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/show_entry');
    
    $this->template->content->entries     = $entries;
    $this->template->content->pagination  = $pagination;
    
    $this->template->content->menu        = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function edit($id)
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title                    = 'Area Magazine CMS : Edit Entry';
    $this->template->header->page_title               = 'Edit Entry';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/entry');
    
    // Get Categories from database
    $categories = ORM::factory('category')->find_all();
    $this->template->content->categories = $categories;
    
    // Get entry data from database
    $entry  = ORM::factory('entry')->find($id);
    $this->template->content->entry   = $entry;
    
    if ($entry->status == 0):
      $published_check  = '';
      $draft_check      = 'checked';
    else:
      $published_check  = 'checked';
      $draft_check      = '';
    endif;
    
    $this->template->content->published_check = $published_check;
    $this->template->content->draft_check     = $draft_check;
    
    $this->template->content->menu    = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function delete($id)
  {
    // Check session availibility
    $this->_check_session();
    
    // Get entry data from database
    $entry = ORM::factory('entry', $id);
    
    // set success message session
    $this->session->set_flash('form_success', 'Entry <em>'.$entry->title.'</em> has been deleted.');
    
    // Delete the mentioned entry from database
    $entry->delete();
    
    // Redirect to manage entries page
    url::redirect(url::base().'manage_entries');
  }
  
  public function search()
  {
    // Check session availibility
    $this->_check_session();
    
    // Define variables
    $filter   = $this->uri->argument(1);
    $keyword  = $this->uri->argument(2);

    $access = $this->_get_menu();
    
    //Pagination configuration
    $num_per_page = 10;
    
    $offset = $this->uri->argument(3) == 1 ? 0 : $this->uri->argument(3);
    
    if ($filter == 'category'):
      $category = ORM::factory('category')->like('label', $keyword)->find();
      $entries    = $this->db
                    ->select(
                              'entries.id',
                              'entries.created_at',
                              'entries.title',
                              'entries.excerpt',
                              'categories.label AS category',
                              'users.display_name AS author',
                              '(CASE WHEN entries.status=1 THEN "published" ELSE "draft" END) AS status'
                             )
                    ->from('entries')
                    ->join('categories', 'categories.id', 'entries.category_id')
                    ->join('users', 'users.id', 'entries.author_id')
                    ->where('category_id', $category->id)
                    ->orderby('entries.id', 'DESC')
                    ->limit($num_per_page, $offset)
                    ->get();
                    
      $total  = $this->db->where('category_id', $category->id)->count_records('entries');
    elseif ($filter == 'author'):
      $author   = ORM::factory('user')->like('display_name', $keyword)->find();
      $entries    = $this->db
                    ->select(
                              'entries.id',
                              'entries.created_at',
                              'entries.title',
                              'entries.excerpt',
                              'categories.label AS category',
                              'users.display_name AS author',
                              '(CASE WHEN entries.status=1 THEN "published" ELSE "draft" END) AS status'
                             )
                    ->from('entries')
                    ->join('categories', 'categories.id', 'entries.category_id')
                    ->join('users', 'users.id', 'entries.author_id')
                    ->where('author_id', $author->id)
                    ->orderby('entries.id', 'DESC')
                    ->limit($num_per_page, $offset)
                    ->get();
                    
      $total  = $this->db->where('author_id', $author->id)->count_records('entries');
    elseif ($filter == 'status'):
      $status   = $keyword == 'published' ? 1 : 0;
      $entries    = $this->db
                    ->select(
                              'entries.id',
                              'entries.created_at',
                              'entries.title',
                              'entries.excerpt',
                              'categories.label AS category',
                              'users.display_name AS author',
                              '(CASE WHEN entries.status=1 THEN "published" ELSE "draft" END) AS status'
                             )
                    ->from('entries')
                    ->join('categories', 'categories.id', 'entries.category_id')
                    ->join('users', 'users.id', 'entries.author_id')
                    ->where($filter, $status)
                    ->orderby('entries.id', 'DESC')
                    ->limit($num_per_page, $offset)
                    ->get();
                    
      $total  = $this->db->where($filter, $status)->count_records('entries');
    else:      
      $entries    = $this->db
                    ->select(
                              'entries.id',
                              'entries.created_at',
                              'entries.title',
                              'entries.excerpt',
                              'categories.label AS category',
                              'users.display_name AS author',
                              '(CASE WHEN entries.status=1 THEN "published" ELSE "draft" END) AS status'
                             )
                    ->from('entries')
                    ->join('categories', 'categories.id', 'entries.category_id')
                    ->join('users', 'users.id', 'entries.author_id')
                    ->like($filter, $keyword)
                    ->orderby('entries.id', 'DESC')
                    ->limit($num_per_page, $offset)
                    ->get();
                    
      $total  = $this->db->like($filter, $keyword)->count_records('entries');
    endif;

    //Setup pagination
    $pagination = new Pagination(array(
                        'base_url'        => 'manage_entries/search/'.$filter.'/'.$keyword,
                        'uri_segment'     => $keyword,
                        'total_items'     => $total,
                        'style'           => "digg",
                        'items_per_page'  => $num_per_page,
                        'auto_hide'       => true
                      ));
    
    $this->template->header->title                    = 'Area Magazine CMS : Manage Entries';
    $this->template->header->page_title               = 'Manage Entries';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/show_entry');
    
    $this->template->content->entries         = $entries;
    $this->template->content->pagination      = $pagination;
    
    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
}
// END Manage_entries_Controller