<?php defined('SYSPATH') OR die('No direct access allowed.');
class Home_Controller extends Website_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
  
  public function index()
  {
    $this->template->content  = new View('pages/home_page');
    
    // Load the news model
    $news = new News_Model;
    // Get fresh news (5 latest news)
    $fresh_news = $news->get_fresh_news();
    // Fill the fresh news variables
    $this->template->content->fresh_news    = $fresh_news;
    
    // Get other news
    $other_news = $news->get_other_news();
    // Fill the other news variables
    $this->template->content->other_news = $other_news;
    
    // Get latest feature
    $latest_feature = $news->get_last_feature();
    // Fill the latest feature variables
    foreach($latest_feature as $feature):
      $last_feature = $feature;
    endforeach;
    // Pass it to the view
    $this->template->content->latest_feature = $last_feature;
    
    // Get latest hot seat
    $hot_seat = $news->get_last_hotseat();
    // Fill the latest hot seat variables
    foreach($hot_seat as $seat):
      $last_hot_seat = $seat;
    endforeach;
    // Pass it to the view
    $this->template->content->last_hot_seat = $last_hot_seat; 
    
    // Load the event model
    $events = new Event_Model;
    // Get latest events (6 latest events)
    $latest_events = $events->get_latest_events();
    // Fill the latest events variables
    $this->template->content->latest_events = $latest_events;
    
    // Load the twitter model
    $twitter  = new Twitter_Model();
    // Get user timeline
    $tweet = $twitter->get_timeline();
    // Pass it to the view
    $this->template->content->tweet         = $tweet;
    
    $this->template->content->showcase      = new View('includes/showcase');
    $this->template->content->signin_form   = new View('includes/signin-form');
    $this->template->content->side_ads      = new View('includes/side-ads');
  }
  
  public function makeURL($URL) {
    $URL = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:\+.~#?&//=]+)','<a href=\\1>\\1</a>', $URL);
    $URL = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:\+.~#?&//=]+)','<a href=\\1>\\1</a>', $URL);
    $URL = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})','<a href=\\1>\\1</a>', $URL);
    
    return $URL;
  }
}
// END Website_Controller