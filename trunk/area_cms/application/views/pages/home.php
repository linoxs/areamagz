<?php echo $menu; // Load navigation menu ?>
<div id="wrapper">
  
  <?php echo $latest_comments; // Load latest comments box ?>
  
  <?php echo $latest_entries; // Load latest entries box ?>
  
</div>
<?php
// Load this page javascript
echo html::script(array
(
  'media/js/js_home.js',
), FALSE);
?>