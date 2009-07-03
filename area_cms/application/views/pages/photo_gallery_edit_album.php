<?php echo $menu; ?>
<div id="wrapper">
  <?php if ($this->session->get('form_success')): ?>
    <div id="success-caption"><?php echo $this->session->get('form_success'); ?></div>
  <?php endif; ?>
  <!--
  <div id="error-caption">Error information here</div>
  -->
  <?php if ($this->session->get('form_error')): ?>
    <div id="info-caption">
      <h3>Please fix these error</h3>
      <ul>
      <?php foreach ($this->session->get('form_error') as $error): ?>
        <?php echo '<li>'.$error.'</li>'; ?>
      <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  
  <form method="post" action="<?php echo url::site('photo_gallery/update_album'); ?>">
    <input type="hidden" name="album_id" id="album_id" value="<?php echo $this->uri->argument(1); ?>" />
    <input type="hidden" name="thumb_id" id="thumb_id" />
    <table class="inputForm">
      <tr>
        <td>Album Title</td>
        <td><input type="text" name="title" id="title" class="input-text-verylong" value="<?php echo $album->title; ?>" /></td>
      </tr>
      <tr>
        <td>Album Description</td>
        <td><textarea name="description" id="description" rows="5" cols="45"><?php echo $album->description; ?></textarea></td>
      </tr>
      <tr>
        <td>Place</td>
        <td><input type="text" name="place" id="place" class="input-text-long" value="<?php echo $album->place; ?>"/></td>
      </tr>
      <tr>
        <td>Thumbnail</td>
        <td>
          <select name="thumbnail" id="thumbnail">
            <?php foreach ($images as $image): ?>
              <option value="<?php echo $image->id.'|'.$image->image; ?>"><?php echo $image->title; ?></option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Thumbnail Preview</td>
        <td><div id="preview"></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp</td>
        <td><input type="submit" name="save" class="input-button" value="Save" /></td>
      </tr>
    </table>
  </form>
  <br/>
  
  <form method="post" action="<?php echo url::site('photo_gallery/update_album_images'); ?>">
  <input type="hidden" name="album_id" id="album_id" value="<?php echo $this->uri->argument(1); ?>" />
  <table class="data-table">
    <?php $i = 1; ?>
    <?php foreach ($images as $image): ?>
    <?php $class = $i % 2 == 0 ? 'row-1' : 'row-2'; ?>
    <tr>
      <td class="<?php echo $class; ?>">
        <img src="<?php echo url::base().Kohana::config('core.gallery_folder').$image->image; ?>" style="max-height:120px;" />
        <br/>
        <input type="button" class="input-button del-image" value="Delete this image" rel="<?php echo $image->id; ?>" />
      </td>
      <td class="<?php echo $class; ?>" style="vertical-align:top;">
        <pre>
Title       : <input type="text" class="input-text-long" name="title[<?php echo $image->id; ?>]" value="<?php echo $image->title; ?>" /><br/>
Description : <textarea rows="5" cols="45" name="description[<?php echo $image->id; ?>]"><?php echo $image->description; ?></textarea> 
        </pre>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    
    <tr>
        <td colspan="2"><input type="submit" name="save" class="input-button" value="Save" /></td>
    </tr>
  </table>  
  </form>
  
  <form method="post" action="<?php echo url::site('photo_gallery/add_photos'); ?>" enctype="multipart/form-data">
  <input type="hidden" name="album_id" id="album_id" value="<?php echo $this->uri->argument(1); ?>" />
  <fieldset>
    <legend>Add another photo</legend>
    <input type="hidden" id="id" value="1">
    <table class="inputForm">
      <tr>
        <td>
          <div id="upload-area">
            <p style='margin-bottom:10px;' id='row" + id + "'><input type='file' name='photo[]' id='photo" + id + "' size='30'><p>
          </div>
        </td>
      </tr>
    </table>
    <table class="inputForm">
      <tr>
        <td><span class="fake-link" id="add-boxes">Add more upload boxes</span></td>
      </tr>
      <tr>
        <td><input type="submit" class="input-button" value="UPLOAD" /></td>
      </tr>
    </table>
  </fieldset>
  </form>
</div>

<?php echo html::script(array
(
  'media/js/jquery.highlightFade.js',
), FALSE);
?>
<script type="text/javascript">
$(document).ready(function(){
  $('#preview').html('<img src="<?php echo url::base().Kohana::config('core.gallery_folder').$album_thumb->image; ?>" style="max-width:120px; border:1px solid #ccc; padding:5px;" />');
  
  $('#thumbnail').change(function(){
    var value = $(this).val().split('|');
    var id  = value[0];
    var img = value[1];

    $('#preview').html('<img src="<?php echo url::base().Kohana::config('core.gallery_folder'); ?>'+ img +'" style="max-width:120px; border:1px solid #ccc; padding:5px;" />');
    $('#thumb_id').val(id);
    
  });
  
  $('#add-boxes').click(function(){
    addFormField();
  });
  
  $('.del-image').click(function(){
    var obj = $(this);
    var id = $(this).attr('rel');

    jConfirm('Are you sure delete this image?', 'Delete image', function(val){
      if (val == true)
      {
        $.ajax({
          type: "POST",
          url: "<?php echo url::site('ajax/delete_image'); ?>/",
          data: "from-ajax=yes&id="+ id,
          beforeSend: function(){
            obj.attr('value','Deleting...');
            obj.css('width','auto');
          },
          success: function(msg){
            if (msg == 'success')
            {
              obj.parents('tr').fadeOut('slow', function(){
                obj.parents('tr').remove();
              });
            }
            else
            {
               jAlert('Error : '+ msg);
            }
          }
        });
      }
      else
      {
        return false;
      }
    });
  });
  
  $('.data-table tr').hover(function(){    
    $(this).children('td').addClass('row-hover');
  },function(){
    $(this).children('td').removeClass('row-hover');
  });
});

function addFormField() {
	var id = $('#id').val();
	$("#upload-area").append("<p style='margin-bottom:10px;' id='row" + id + "'><input type='file' name='photo[]' id='photo" + id + "' size='30'>&nbsp;&nbsp<span class='fake-link' onClick='removeFormField(\"#row" + id + "\");'>Remove</span><p>");
	
	$('#row' + id).highlightFade({
		speed:1000
	});
	
	id = (id - 1) + 2;
	$('#id').val(id);
}

function removeFormField(id) {
	$(id).remove();
}  
</script>