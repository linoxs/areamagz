<?php defined('SYSPATH') or die('No direct script access.');
 
class Event_Model extends Model {
 
	public function __construct()
	{
		parent::__construct();
	}
  
  public function get_latest_events()
  {
    $events = $this->db->select('
                              id,
                              date,
                              title,
                              description
                              ')
                    ->from('events')
                    ->orderby('date', 'DESC')
                    ->limit(6)
                    ->get();
                    
    return $events;
  }
 
}
// END OF Event_Model