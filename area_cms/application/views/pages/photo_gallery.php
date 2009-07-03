<?php echo $menu; // Load navigation menu ?>
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
  
  <?php if ($this->session->get('photo_error')): ?>
    <div id="info-caption">
      <h3>Please fix these error</h3>
      <?php echo $this->session->get('photo_error'); ?>
    </div>
  <?php endif; ?>
  
  <fieldset>
    <legend>New Album</legend>
    <form method="post" action="<?php echo url::base(); ?>photo_gallery/upload" id="newealbum_form" enctype="multipart/form-data">
      <table class="inputForm" style="border-bottom:1px solid #ccc; margin-bottom:10px;">
        <tr>
          <td>Album Title</td>
          <td><input type="text" name="title" id="title" class="input-text-verylong" /></td>
        </tr>
      </table>
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
    </form>
  </fieldset>
</div>
<?php echo html::script(array
(
    'media/js/jquery.highlightFade.js',
    'media/js/jquery.validate.pack.js',
), FALSE);
?>


<script type="text/javascript">
$(document).ready(function(){
  $("#newealbum_form").validate({
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
  
  $('#add-boxes').click(function(){
    addFormField();
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