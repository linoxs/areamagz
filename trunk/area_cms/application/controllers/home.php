<?php defined('SYSPATH') OR die('No direct access allowed.');
class Home_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    $this->template->header->title            = 'Area Magazine CMS : Dashboard';
    $this->template->header->page_title       = 'Dashboard';
    $this->template->header->greeting_box     = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                  = new View('pages/home');
    $this->template->content->menu            = new View('pages/menu');
    $this->template->content->menu->access    = $access;
    
    $this->template->content->latest_comments = new View('pages/includes/mod-latest-comments');
    $this->template->content->latest_comments->comments  = $this->db->select(
                                          'comments.id',
                                          'comments.time',
                                          'comments.name',
                                          'comments.comment',
                                          'comments.status',
                                          'entries.title'
                                          )
                                ->from('comments')
                                ->join('entries', 'comments.entry_id', 'entries.id')
                                ->orderby('comments.id','DESC')
                                ->LIMIT(5,0)
                                ->get();
    
    $this->template->content->latest_entries  = new View('pages/includes/mod-latest-entries');
    $this->template->content->latest_entries->entries  = $this->db->select(
                                          'entries.id',
                                          'entries.created_at',
                                          'entries.title',
                                          'entries.body_text',
                                          'entries.category_id',
                                          'entries.author_id',
                                          'categories.label',
                                          'users.display_name'
                                          )
                                ->from('entries')
                                ->join('categories', 'categories.id', 'entries.category_id')
                                ->join('users', 'users.id', 'entries.author_id')
                                ->orderby('entries.id','DESC')
                                ->LIMIT(5,0)
                                ->get();
  }
  
  public function date()
  {
    $date_ago = mktime(13, 30, 0, 5, 4, 2009);
    
    $date = (date::timespan($date_ago));
    echo $this->format_date($date);
  }

  private function format_date($date)
  {
    if ($date['years'] > 0):
      if ($date['years'] > 1):
        $year = $date['years'].'years ';
      else:
        $year = $date['years'].'year ';
      endif;
    else:
      $year = '';
    endif;
    
    if ($date['months'] > 0):
      if ($date['months'] > 1):
        $month = $date['months'].'months ';
      else:
        $month = $date['months'].'month ';
      endif;
    else:
      $month = '';
    endif;
    
    if ($date['weeks'] > 0):
      if ($date['weeks'] > 1):
        $week = $date['weeks'].'weeks ';
      else:
        $week = $date['weeks'].'week ';
      endif;
    else:
      $week = '';
    endif;
    
    if ($date['days'] > 0):
      if ($date['days'] > 1):
        $day = $date['days'].'days ';
      else:
        $day = $date['days'].'day ';
      endif;
    else:
      $day = '';
    endif;
    
    if ($date['hours'] > 0):
      if ($date['hours'] > 1):
        $hour = $date['hours'].'hours ';
      else:
        $hour = $date['hours'].'hour ';
      endif;
    else:
      $hour = '';
    endif;
    
    if ($date['minutes'] > 0):
      if ($date['minutes'] > 1):
        $minute = $date['minutes'].'minutes ';
      else:
        $minute = $date['minutes'].'minute ';
      endif;
    else:
      $minute = '';
    endif;
    
    $time_span = $year.$month.$week.$day.$minute;
    
    return $time_span;
  }
}
// END Home_Controller
