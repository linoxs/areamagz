<?php defined('SYSPATH') or die('No direct script access.');
 
class Twitter_Model extends Model {
 
	public function __construct()
	{
		parent::__construct();
	}
  
  public function get_timeline()
  {
    $login = 'linoxs:linoxssayasendiri';
    $login = Kohana::config('twitter.username').':'.Kohana::config('twitter.password');
    $tweets = "http://twitter.com/statuses/friends_timeline.xml?count=5";
    
    $tw = curl_init();
    
    curl_setopt($tw, CURLOPT_URL, $tweets);
    
    curl_setopt($tw, CURLOPT_USERPWD, $login);
    
    curl_setopt($tw, CURLOPT_RETURNTRANSFER, TRUE);
    
    $twi = curl_exec($tw);
    
    return new SimpleXMLElement($twi);    
  }
 
}
// END OF Twitter_Model