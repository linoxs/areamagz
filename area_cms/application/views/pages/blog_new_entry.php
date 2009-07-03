<?php echo html::stylesheet(array
(
  'media/css/thickbox',
  'media/css/date_input.css',
),
array
(
'screen',
));

echo html::script(array
(
  'media/js/jquery.validate.pack.js',
  'media/js/thickbox.js',
  'media/js/jquery.clock.js',
  'media/js/jquery.date_input.js',
), FALSE);
?>
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
  
  <?php
    $action = $this->uri->segment(2) == 'edit' ? 'update/'.$entry->id : 'save';
  ?>
  <div style="background-color:#ebebeb; width:100%; margin-bottom:20px; padding:10px 5px; margin: 0 -5px;">
    <a href="<?php echo url::site('blog/index?auth_id='.$author->id); ?>">Show all entries</a>
  </div>
  
  
  <form method="post" action="<?php echo url::site('blog/'.$action.'?auth_id='.$author->id); ?>" id="newentry_form" enctype="multipart/form-data">
  <table class="inputForm">
    <tr>
      <td>Title</td>
      <td><input type="text" name="title" class="input-text-verylong" value="<?php echo stripslashes(@$entry->title); ?>" /></td>
    </tr>
    <tr>
      <td>Excerpt</td>
      <td><input type="text" name="excerpt" class="input-text-verylong" value='<?php echo stripslashes(@$entry->excerpt); ?>' /></td>
    </tr>
    <tr>
      <td>Body Text</td>
      <td>
        <textarea name="body_text" id="body_text" class="input-textarea-big"><?php echo stripslashes(@$entry->body_text); ?></textarea>
      </td>
    </tr>
    <?php if(isset($entry->thumb_image) && $entry->thumb_image !== ''): ?>
    <tr>
      <td>&nbsp;</td>
      <td>
        <img class="userpic" src="<?php echo url::base().Kohana::config('core.blog_image_folder').$entry->thumb_image; ?>" style=""/>
        <br/>
        <input type="checkbox" name="del_pic" id="del_pic" value="1" /> Delete picture
      </td>
    </tr>
    <?php endif; ?>
    <tr id="picture">
      <td>Image Thumbnail</td>
      <td><input type="file" name="thumb" id="thumb" class="input-file" /><span class="caption">* this image will be used at home page</span></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><input type="radio" name="status" value="1" <?php echo @$published_check; ?> /> Published <input type="radio" name="status" value="0" <?php echo @$draft_check; ?> /> Draft</td>
    </tr>
    <?php if ($this->uri->segment(2) == 'edit'): ?>
    <tr>
      <td>Change Publish Time</td>
      <td>
        <input type="text" name="date" id="date" class="input-text-long" value="<?php echo substr($entry->created_at, 0, 10); ?>" />
        <select name="hour" id="hour" class="input-select">
          <?php for ($i = 1; $i <= 24; $i++):?>
          <?php $prefix = $i < 10 ? '0' : ''; ?>
          <?php $hour_sel = $i == substr($entry->created_at, -8, 2) ? 'SELECTED' : ''; ?>
          <option value="<?php echo $prefix.$i; ?>" <?php echo $hour_sel; ?>><?php echo $prefix.$i; ?></option>
          <?php endfor; ?>
        </select> :
        <select name="minute" id="minute" class="input-select">
          <?php for ($i = 0; $i <= 59; $i++):?>
          <?php $prefix = $i < 10 ? '0' : ''; ?>
          <?php $min_sel = $i == substr($entry->created_at, -5, 2) ? 'SELECTED' : ''; ?>
          <option value="<?php echo $prefix.$i; ?>" <?php echo $min_sel; ?>><?php echo $prefix.$i; ?></option>
          <?php endfor; ?>
        </select>
      </td>
    </tr>
    <?php endif; ?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp</td>
      <td><input type="submit" name="save" class="input-button" value="Save" /> <input type="reset" id="reset" class="input-button" value="Reset" /></td>
    </tr>
  </table>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
  // Date input
  $.extend(DateInput.DEFAULT_OPTS, {
    stringToDate: function(string) {
      var matches;
      if (matches = string.match(/^(\d{4,4})-(\d{2,2})-(\d{2,2})$/)) {
        return new Date(matches[1], matches[2] - 1, matches[3]);
      } else {
        return null;
      };
    },
  
    dateToString: function(date) {
      var month = (date.getMonth() + 1).toString();
      var dom = date.getDate().toString();
      if (month.length == 1) month = "0" + month;
      if (dom.length == 1) dom = "0" + dom;
      return date.getFullYear() + "-" + month + "-" + dom;
    }
  });
  
  $("#date").date_input();
  
  // Time Input
  var now = new Date();
  $('#time').clock({displayFormat:'24'});
  
  $("#newentry_form").validate({
		rules: {
			title: {
				required: true,
				minlength: 1
			}
		},
		messages: {
			title: {
				required: "Please enter a title",
				minlength: "Your title must consist of at least 1 characters"
			}
		}
	});
  
  $('#reset').click(function(){
    tinyMCE.activeEditor.dom.remove(tinyMCE.activeEditor.dom);
  });
  
  $('#del_pic').click(function(){
    var checkStatus = $(this).attr('checked');
			
    if (checkStatus == true)
    {
      $('#picture').fadeOut('slow');
    }
    else
    {
      $('#picture').fadeIn('slow');
    }
  });
});
</script>