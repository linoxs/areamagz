<?php defined('SYSPATH') or die('No direct access allowed.');
 
$lang = array
(
'username' => Array
    (
      'required' => 'The username cannot be blank.',
      'length' => 'The username must be between 3 and 30 characters.',
      'default' => 'Invalid username Input.',
    ),
'password' => Array
    (
      'required' => 'You must supply a password.',
      'length'  => 'The password must be between 6 and 30 characters.',
      'default' => 'Invalid password Input.',
    ),
'confirm_pass' => Array
    (
      'required' => 'You must supply a confirmation password.',
      'pwd_check' => 'Please confirm exactly the same password',
      'default' => 'Invalid password Input.',
    ),
'title' => Array
    (
      'required' => 'You must supply a title.',
      'length' => 'The title must be between 13 and 255 characters.',
      'default' => 'Invalid title Input.',
    ),
'body_text' => Array
    (
      'required' => 'You must supply body text.',
      'length' => 'The body text must be between 10 and 65535 characters.',
      'default' => 'Invalid body text Input.',
    ),
);