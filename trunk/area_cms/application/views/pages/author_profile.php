<?php echo $menu; // Load navigation menu ?>
<div id="wrapper">
  <?php if ($this->session->get('success')): ?>
    <div id="success-caption"><?php echo $this->session->get('success'); ?></div>
  <?php endif; ?>
  
  <?php if ($this->session->get('info')): ?>
    <div id="info-caption"><?php echo $this->session->get('info'); ?></div>
  <?php endif; ?>
  
  <?php if ($this->session->get('error')): ?>
    <div id="error-caption"><?php echo $this->session->get('error'); ?></div>
  <?php endif; ?>
  
  <form method="post" action="<?php echo url::base(); ?>author_profile/save_profile" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $user->id; ?>" />
  <table class="inputForm">
    <tr>
      <td>Username</td>
      <td><input type="text" name="username" class="input-text-long" value="<?php echo $user->username; ?>" /></td>
    </tr>
    <tr>
      <td>Display Name</td>
      <td><input type="text" name="display_name" class="input-text-verylong" value="<?php echo $user->display_name; ?>" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="text" name="email" class="input-text-verylong" value="<?php echo $user->email; ?>" /></td>
    </tr>
    <tr>
      <td>Biography / profile text</td>
      <td><textarea name="bio" class="input-textarea-mid"><?php echo stripslashes($user->biography); ?></textarea></td>
    </tr>
    <tr>
      <td>Website</td>
      <td><input type="text" name="website" class="input-text-long" value="<?php echo $user->website; ?>" /></td>
    </tr>
    <?php if ( ! $user->userpic == NULL): ?>
    <tr>
      <td></td>
      <td>
        <img src="<?php echo url::base().Kohana::config('core.data_url').$user->userpic; ?>" class="userpic" />
        <br/>
        <input type="checkbox" name="del_pic" id="del_pic" value="1" /> Delete picture
      </td>
    </tr>
    <?php endif; ?>
    <tr id="picture">
      <td>Picture</td>
      <td><input type="file" name="picture" /></td>
    </tr>
    <?php if ($show_status == TRUE): ?>
    <?php
      if ($user->status == 0):
        $active   = '';
        $inactive = 'CHECKED';
      else:
        $active   = 'CHECKED';
        $inactive = '';
      endif;
    ?>
    <tr>
      <td>Status <?php echo $user->status; ?></td>
      <td><input type="radio" name="status" value="0" <?php echo $inactive; ?> /> Inactive &nbsp; <input type="radio" name="status" value="1" <?php echo $active; ?> /> Active</td>
    </tr>
    <?php endif; ?>
    <tr>
      <td>Password</td>
      <td><span class="fake-link" id="show-pass">Change password</span></td>
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
  
  <fieldset id="ch-pass">
    <legend>Change password</legend>
    
    <?php if ($this->session->get('pass_success')): ?>
      <div id="success-caption"><?php echo $this->session->get('pass_success'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->get('pass_info')): ?>
      <div id="info-caption"><?php echo $this->session->get('pass_info'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->get('pass_error')): ?>
      <div id="error-caption"><?php echo $this->session->get('pass_error'); ?></div>
    <?php endif; ?>
  
    <form method="post" action="<?php echo url::base(); ?>author_profile/change_password" enctype="multipart/form-data">
    <table class="inputForm">
      <tr class="ch-pass">
        <td>Current password</td>
        <td><input type="password" name="current" class="input-text-long" /></td>
      </tr>
      <tr class="ch-pass">
        <td>New password</td>
        <td><input type="password" name="new_pass" class="input-text-long" /></td>
      </tr>
      <tr class="ch-pass">
        <td>Confirm password</td>
        <td><input type="password" name="confirm" class="input-text-long" /></td>
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
  </fieldset>
</div>

<script type="text/javascript">
$(document).ready(function(){
  <?php
  if ($this->session->get('hidpas') !== 'no'):
    echo '$("#ch-pass").hide();';
  endif;
  ?>
  
  $('#show-pass').click(function(){
    $('#ch-pass').slideToggle('slow');
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