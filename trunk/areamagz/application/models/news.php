<?php defined('SYSPATH') or die('No direct script access.');
 
class News_Model extends Model {
 
	public function __construct()
	{
		parent::__construct();
	}
  
  public function get_fresh_news()
  {
    $query = 'SELECT
                    entries.id,
                    entries.created_at,
                    entries.title,
                    entries.excerpt,
                    entries.category_id,
                    entries.thumb_image,
                    entries.url,
                    categories.segment
              FROM  entries
              INNER JOIN categories
              ON entries.category_id = categories.id
              WHERE status=1
              AND entries.category_id NOT IN (10,11)
              ORDER BY created_at DESC
              LIMIT 0,5
            ';
            
    $news = $this->db->query($query);

    return $news;
  }
  
  public function get_other_news()
  {
    $query = 'SELECT
                    entries.id,
                    entries.created_at,
                    entries.title,
                    entries.excerpt,
                    entries.category_id,
                    entries.thumb_image,
                    entries.url,
                    categories.label
              FROM  entries
              INNER JOIN categories
              ON entries.category_id = categories.id
              WHERE status=1
              ORDER BY created_at DESC
              LIMIT 7,4
            ';
            
    $news = $this->db->query($query);

    return $news;
  }
  
  public function get_last_feature()
  {
    $feature  = $this->db->select('
                                  id,
                                  created_at,
                                  title,
                                  excerpt,
                                  category_id,
                                  thumb_image,
                                  url
                                  ')
                        ->from('entries')
                        ->where('category_id=10')
                        ->orderby('created_at', 'DESC')
                        ->limit(1)
                        ->get();
    
    return $feature;
  }
  
  public function get_last_hotseat()
  {
    $hot_seat  = $this->db->select('
                                  id,
                                  created_at,
                                  title,
                                  excerpt,
                                  category_id,
                                  thumb_image,
                                  url
                                  ')
                        ->from('entries')
                        ->where('category_id=11')
                        ->orderby('created_at', 'DESC')
                        ->limit(1)
                        ->get();
    
    return $hot_seat;
  }
 
}