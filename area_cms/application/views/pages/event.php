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
  
  <form method="post" action="<?php echo url::base(); ?>new_event/save/<?php echo @$event->id; ?>" id="newevent_form" enctype="multipart/form-data">
  <table class="inputForm">
    <tr>
      <td>Date</td>
      <td><input type="text" name="date" id="date" class="input-text-long" value="<?php echo substr(@$event->date, 0, 10); ?>" /></td>
    </tr>
    <tr>
      <td>Time</td>
      <td><input type="text" name="time" id="time" class="input-text-long" value="<?php echo substr(@$event->date, -8, 8); ?>" /></td>
    </tr>
    <tr>
      <td>Title</td>
      <td><input type="text" name="title" class="input-text-long" value="<?php echo stripslashes(@$event->title); ?>" /></td>
    </tr>
    <tr>
      <td>Location</td>
      <td><input type="text" name="location" class="input-text-verylong" value="<?php echo stripslashes(@$event->location); ?>" /></td>
    </tr>
    <tr>
      <td>Description</td>
      <td>
        <textarea name="description" id="description" class="input-textarea-big"><?php echo stripslashes(@$event->description); ?></textarea>
      </td>
    </tr>
    <?php if(isset($event->image) && $event->image !== ''): ?>
    <tr>
      <td>&nbsp;</td>
      <td>
        <img class="userpic" src="<?php echo url::base().Kohana::config('core.event_image_folder').$event->image; ?>" style=""/>
        <br/>
        <input type="checkbox" name="del_pic" id="del_pic" value="1" /> Delete picture
      </td>
    </tr>
    <?php endif; ?>
    <tr id="picture">
      <td>Event Image</td>
      <td><input type="file" name="image" id="image" class="input-file" /></td>
    </tr>
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
  $('#time').clock({displayFormat:'24',
                   defaultHour:now.getHours(),
                   defaultMinute:now.getMinutes()});

  $("#newevent_form").validate({
		rules: {
      date: {
				required: true,
				minlength: 10
			},
			title: {
				required: true,
				minlength: 1
			},
      location: {
				required: true,
				minlength: 1
			},
		},
		messages: {
			date: {
				required: "Please enter a date",
				minlength: "Correct date consists of 10 character with yyyy-mm-dd format "
			},
      title: {
				required: "Please enter a title",
				minlength: "Title must consist of at least 1 characters"
			},
      location: {
				required: "Please enter a location",
				minlength: "Location must consist of at least 1 characters"
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