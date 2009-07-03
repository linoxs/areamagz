<?php echo html::stylesheet(array
(
  'media/css/site',
  'media/libs/jquery_file_tree/jqueryFileTree',
),
array
(
'screen',
));
?>
<?php echo $menu; ?>
  <div id="file" style="position:relative; float:left; max-width:200px; min-height:300px; max-height:300px; border:1px solid #ebebeb; background-color:#fff; padding:10px; margin-right:10px; overflow:auto;"></div>

  <div style="position:relative; float:left; margin-bottom:20px;">
    <input type="text" class="input-text-verylong" id="url"/>  
    <p style="color: #fff;">Copy this url then paste it into Insert Image Manager on the editor</p>
  </div>

  <div id="preview" style="position:relative; float:left; width:690px; min-height:200px; border:1px solid #ebebeb; background-color:#fff; padding:10px;"></div>
  
    <div style="clear:both; margin-top:20px; padding:5px;">
      <?php if ($this->session->get('success')): ?>
      <div id="success-caption"><?php echo $this->session->get('success'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->get('info')): ?>
      <div id="info-caption"><?php echo $this->session->get('info'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->get('error')): ?>
      <div id="error-caption"><?php echo $this->session->get('error'); ?></div>
    <?php endif; ?>
  
    <form method="post" action="<?php echo url::base(); ?>manage_assets/upload" enctype="multipart/form-data">
      <table class="inputForm">
        <tr id="picture">
          <td>Upload Image</td>
          <td><input type="file" name="picture" />&nbsp;<input type="submit" class="input-button" value="Upload" /> <span class="caption">*image with more than 600 x 400 px resolution will be resized</span></td>
        </tr>
      </table>
    </form>
  </div>
<?php echo html::script(array
(
  'media/libs/jquery_file_tree/jqueryFileTree.js',
), FALSE);
?>
<script type="text/javascript">
$(document).ready( function() {
  $('#file').fileTree({ root: '/area_cms/media/images/',script: '/area_cms/media/libs/jquery_file_tree/connectors/jqueryFileTree.php' }, function(file) {
    var preview = '<img src="'+ file +'" border="0" style="max-width: 685px;"/>';
    var url = file.split('/');
    
    var fileURL = '';
    
    for (i=4;i < url.length;i++)
    {
      if (i > 4)
      {
        prefix = '/';
      }
      else
      {
        prefix = '';
      }
      
      fileURL += prefix + url[i];
    }
    
    var fullURL = '<?php echo url::base(); ?>media/images/'+ fileURL;
    
    $('#url').val(fullURL);
    $('#preview').html(preview);
  });
});
</script>