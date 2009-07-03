<?php defined('SYSPATH') OR die('No direct access allowed.');
class Manage_events_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    $access = $this->_get_menu();
    
    $this->template->header->title                    = 'Area Magazine CMS : Manage Events';
    $this->template->header->page_title               = 'Manage Events';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    $this->template->content                          = new View('pages/show_event');
    
    //Pagination configuration
    $num_per_page = 10;
    
    $total  = $this->db->count_records('events');

    //Setup pagination
    $pagination = new Pagination(array(
                        'base_url'    => 'manage_events/index/',
                        'uri_segment' => 'index',
                        'total_items' => $total,
                        'style'       => "digg",
                        'items_per_page' => $num_per_page,
                        'auto_hide'   => true
                      ));
   
    $offset = $this->uri->segment(3) == 1 ? 0 : $this->uri->segment(3);
    $events = ORM::factory('event')->find_all();

    $this->template->content->events          = $events;
    $this->template->content->pagination      = $pagination;

    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function edit($id)
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title                    = 'Area Magazine CMS : Edit Event';
    $this->template->header->page_title               = 'Edit Event';
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content            = new View('pages/event');
    
    // Get event data from database
    $event  = ORM::factory('event')->find($id);
    
    $this->template->content->event = $event;
    
    $this->template->content->menu    = new View('pages/menu');
    $this->template->content->menu->access    = $access;
  }
  
  public function delete($id)
  {
    // Check session availibility
    $this->_check_session();
    
    // Get entry data from database
    $event = ORM::factory('event', $id);
    
    // Delete event image
    if (file_exists(DOCROOT.Kohana::config('core.event_image_folder').$event->image) && ! is_dir(DOCROOT.Kohana::config('core.event_image_folder').$event->image)):
      unlink(DOCROOT.Kohana::config('core.event_image_folder').$event->image);
    endif;
    
    // set success message session
    $this->session->set_flash('form_success', 'Event <em>'.$event->title.'</em> has been deleted.');
    
    // Delete the mentioned entry from database
    $event->delete();
    
    // Redirect to manage entries page
    url::redirect(url::base().'manage_events');
  }
}
// END Manage_events_Controller