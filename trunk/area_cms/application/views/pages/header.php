<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo html::specialchars($title) ?></title>
<?php echo html::stylesheet(array
(
'media/css/reset',
'media/css/site',
'media/css/droppy',
'media/css/jquery.alerts',
),
array
(
'screen',
));

echo html::script(array
(
    'media/js/jquery-1.3.2.min.js',
    'media/js/jquery.droppy.js',
    'media/js/jquery.alerts.js',
    'media/libs/tinymce/jscripts/tiny_mce/tiny_mce.js',
), FALSE);
?>
<script type="text/javascript">
$(document).ready(function(){
  $(function() {
    $('#nav').droppy();
  });
});
</script>
<?php if (substr($this->uri->segment(1), 0, 5) !== 'photo'): ?>
<script type="text/javascript">
tinyMCE.init({
  mode : "textareas",
	theme : "advanced",
	plugins : "advimage",
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,help",
  theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,code,|,forecolor,backcolor,|,sub,sup",
  theme_advanced_buttons3 : "",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true,
	
	relative_urls : false,
	remove_script_host : false,

});
</script>
<?php endif; ?>
</head>
<body>
  <div id="header">
    <h1 id="page-title">Area Magazine CMS : <?php echo $page_title; ?></h1>
		<?php echo $greeting_box; ?>
  </div>