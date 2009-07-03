<?php defined('SYSPATH') OR die('No direct access allowed.');
class Blog_Controller extends Website_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    // Get blog author information from database
    $author_id  = $this->input->get('auth_id');
    $author = ORM::factory('blog_author')->find($author_id);
    
    // Get the blog entry list from database
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
                    ->select('*, (CASE WHEN status=1 THEN "Published" ELSE "Draft" END) AS status')
                    ->from('blogs')
                    ->where('blog_author_id', $author_id)
                    ->orderby('created_at', 'DESC')
                    ->limit($num_per_page, $offset)
                    ->get();

    $this->template->header->title                    = 'Area Magazine CMS : Manage Blog - '.$author->blog_name;
    $this->template->header->page_title               = 'Manage Blog - '.$author->blog_name;
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                          = new View('pages/blog_show_entry');
    $this->template->content->author                  = $author;
    $this->template->content->entries                 = $entries;
    $this->template->content->pagination              = $pagination;
    
    $this->template->content->menu                    = new View('pages/menu');
    $this->template->content->menu->access            = $access;
  }
  
  public function write_new()
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    // Get blog author information from database
    $author_id  = $this->input->get('auth_id');
    $author = ORM::factory('blog_author')->find($author_id);
    
    $this->template->header->title                    = 'Area Magazine CMS : Write New Entry for '.$author->blog_name;
    $this->template->header->page_title               = 'Write New Entry for '.$author->blog_name;
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                          = new View('pages/blog_new_entry');
    $this->template->content->author                  = $author;
    $this->template->content->menu                    = new View('pages/menu');
    $this->template->content->menu->access            = $access;
  }
  
  public function save()
  {
    $author_id  = $this->input->get('auth_id');
    
    // Check session availibility
    $this->_check_session();
    
    // Call the validation class
    $valid  = new Validation($_POST);
    // Add pre filter
    $valid->pre_filter('trim', 'title', 'excerpt');
    
    // Add rules
    $valid->add_rules('title', 'required', 'length[1,255]');
    $valid->add_rules('body_text', 'required', 'length[50,65535]');
   
    if( ! $valid->validate()):
      // Retrieve error message
      $errors = $valid->errors('form_error_messages');
      
      // Redirect to user page & display error
      $this->session->set_flash('form_error', $errors);
      url::redirect(url::site('blog/write_new?auth_id='.$author_id));
    else:
      $entry = ORM::factory('blog');
      
      $entry->created_at    = date('Y-m-d h:i:s');
      $entry->title         = mysql_real_escape_string($this->input->post('title'));
      $entry->excerpt       = mysql_real_escape_string($this->input->post('excerpt'));
      $entry->body_text     = mysql_real_escape_string(stripslashes($this->input->post('body_text')));
      $entry->blog_author_id= $author_id;
      $entry->status        = mysql_real_escape_string($this->input->post('status'));
      $entry->url           = date('Y').'/'.date('m').'/'.date('d').'/'.$this->_make_url($entry->title);
      
      if (isset($_FILES)):
        $files = Validation::factory($_FILES)
          ->add_rules('thumb', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
         
        if ($files->validate())
        {          
          // Temporary file name
          $filename = upload::save('thumb');
          
          // Resize, sharpen, and save the image
          Image::factory($filename)
            ->resize(140, 140, Image::WIDTH)
            ->save(Kohana::config('core.blog_image_folder').basename($filename));
          
          $entry->thumb_image  = basename($filename);
          
          unlink(Kohana::config('upload.directory').'/'.basename($filename));
        }
      endif;
      
      $entry->save();
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'Entry '.$entry->title.' has been saved.');
      url::redirect(url::site('blog/write_new?auth_id='.$author_id));
    endif;
  }
  
  public function edit($id)
  {
    // Check session availibility
    $this->_check_session();
    
    $access = $this->_get_menu();
    
    // Get blog author information from database
    $author_id  = $this->input->get('auth_id');
    $author = ORM::factory('blog_author')->find($author_id);
    
    // Get blog entry data from database
    $entry  = ORM::factory('blog')->find($id);
    
    if ($entry->status == 0):
      $published_check  = '';
      $draft_check      = 'checked';
    else:
      $published_check  = 'checked';
      $draft_check      = '';
    endif;
    
    $this->template->header->title                    = 'Area Magazine CMS : Write New Entry for '.$author->blog_name;
    $this->template->header->page_title               = 'Write New Entry for '.$author->blog_name;
    $this->template->header->greeting_box             = new View('pages/includes/mod-greeting');
    $this->template->header->greeting_box->search_box = new View('pages/includes/mod-search-entries');
    
    $this->template->content                          = new View('pages/blog_new_entry');
    $this->template->content->author                  = $author;
    $this->template->content->entry                   = $entry;
    $this->template->content->published_check         = $published_check;
    $this->template->content->draft_check             = $draft_check;
    
    $this->template->content->menu                    = new View('pages/menu');
    $this->template->content->menu->access            = $access;
  }
  
  public function update($id)
  {
    $author_id  = $this->input->get('auth_id');
    
    // Check session availibility
    $this->_check_session();
    
    // Call the validation class
    $valid  = new Validation($_POST);
    
    // Add pre filter
    $valid->pre_filter('trim', 'title', 'excerpt');
    
    // Add rules
    $valid->add_rules('title', 'required', 'length[1,255]');
    $valid->add_rules('body_text', 'required', 'length[50,65535]');
   
    if( ! $valid->validate()):
      // Retrieve error message
      $errors = $valid->errors('form_error_messages');
      
      // Redirect to user page & display error
      $this->session->set_flash('form_error', $errors);
      url::redirect(url::base().'new_entry');
    else:
      $entry = ORM::factory('blog', $id);
      
      $entry->created_at    = $this->input->post('date').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
      $entry->title         = mysql_real_escape_string($this->input->post('title'));
      $entry->excerpt       = mysql_real_escape_string($this->input->post('excerpt'));
      $entry->body_text     = mysql_real_escape_string(stripslashes($this->input->post('body_text')));
      $entry->status        = mysql_real_escape_string($this->input->post('status'));
      $entry->url           = date('Y').'/'.date('m').'/'.date('d').'/'.$this->_make_url($entry->title);
      
      // Get the image thumbnail record from database
      $old_thumb = $entry->thumb_image;
      
      // Delete current picture
      if (isset($_POST['del_pic'])):
        // Check wether user has been upload a picture before, delete it if exists 
        if (file_exists(DOCROOT.Kohana::config('core.blog_image_folder').$old_thumb) && ! is_dir(DOCROOT.Kohana::config('core.blog_image_folder').$old_thumb)):
          unlink(DOCROOT.Kohana::config('core.blog_image_folder').$old_thumb);
        endif;
        
        $entry->thumb_image = NULL;
      endif;
      
      if (isset($_FILES)):
        $files = Validation::factory($_FILES)
          ->add_rules('thumb', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
         
        if ($files->validate())
        {          
          // Temporary file name
          $filename = upload::save('thumb');
          
          // Resize, sharpen, and save the image
          Image::factory($filename)
            ->resize(140, 140, Image::WIDTH)
            ->save(Kohana::config('core.blog_image_folder').basename($filename));
          
          // Check wether user has been upload a picture before, delete it if exists 
          if (file_exists(DOCROOT.Kohana::config('core.blog_image_folder').$old_thumb) && ! is_dir(DOCROOT.Kohana::config('core.blog_image_folder').$old_thumb)):
            unlink(DOCROOT.Kohana::config('core.blog_image_folder').$old_thumb);
          endif;
        
          $entry->thumb_image  = basename($filename);
          
          unlink(Kohana::config('upload.directory').'/'.basename($filename));
        }
      endif;
      
      $entry->save();
      
      // Redirect to user page & display success message
      $this->session->set_flash('form_success', 'Entry '.$entry->title.' has been updated.');
      url::redirect(url::site('blog/index?auth_id='.$author_id));
    endif;
  }
  
  public function delete($id)
  {
    $author_id  = $this->input->get('auth_id');
    
    // Check session availibility
    $this->_check_session();
    
    // Get entry data from database
    $entry = ORM::factory('blog', $id);
    
    // set success message session
    $this->session->set_flash('form_success', 'Entry <em>'.$entry->title.'</em> has been deleted.');
    
    // Delete the mentioned entry from database
    $entry->delete();
    
    // Redirect to manage entries page
    url::redirect(url::site('blog/index?auth_id='.$author_id));
  }
  
  private function _make_url($text)
  {
    $text_model = new Text_Model;
    
    $the_text = text::limit_words($text, 5, '');
    $new_text = $text_model->dirify($the_text);
    $undr_text= str_replace('_', '-', $new_text);
    
    return $undr_text;
  }
}
// END Blog_Controller