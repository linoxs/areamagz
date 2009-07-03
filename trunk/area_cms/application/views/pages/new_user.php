<?php echo html::stylesheet(array
(
  'media/libs/lightbox/css/jquery.lightbox.packed',
),
array
(
'screen',
));
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
  
  <form method="post" action="<?php echo url::base(); ?>new_user/save" id="newuser_form" enctype="multipart/form-data">
  <table class="inputForm">
    <tr>
      <td>Username</td>
      <td><input type="text" name="username" class="input-text-long" /></td>
    </tr>
    <tr>
      <td>Display Name</td>
      <td><input type="text" name="display_name" class="input-text-verylong" /></td>
    </tr>
    <tr>
      <td>Role</td>
      <td>
        <select name="role" class="input-select">
          <option value="1">Administrator</option>
          <option value="2">Author</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="password" id="password" class="input-text-long" /></td>
    </tr>
    <tr>
      <td>Confirm password</td>
      <td><input type="password" name="confirm_pass" id="confirm_pass" class="input-text-long" /></td>
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
<?php
echo html::script(array
(
  'media/js/jquery.validate.pack.js',
), FALSE);
?>
<script type="text/javascript">
$(document).ready(function(){
  $("#newuser_form").validate({
		rules: {
			username: {
				required: true,
				minlength: 3
			},
			password: {
				required: true,
				minlength: 6
			},
			confirm_pass: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 3 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 6 characters long"
			},
			confirm_pass: {
				required: "Please provide a confirmation password",
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Please enter the same password as above"
			}
		}
	});

  $('#reset').click(function(){
    tinyMCE.activeEditor.dom.remove(tinyMCE.activeEditor.dom);
  });
  
  $('#thumb').blur(function(){
    if ($(this).val() !== '')
    {
      xval = '<p>'+ $(this).val() +'</p>';
      $('#thumb-cap').html(xval);
    }
  });
});
</script>