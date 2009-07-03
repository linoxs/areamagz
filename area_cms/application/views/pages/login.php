<?php if ($this->session->get('login_error')): ?>
  <div id="error-caption"><?php echo $this->session->get('login_error'); ?></div>
<?php endif; ?>

<form method="POST" action="<?php echo url::site('login/do_login'); ?>">
  <table class="linoForm">
    <tr>
      <td>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="input-text-long" />
      </td>
    </tr>
    <tr>
      <td>
        <label for="password">Password</label>
        <input type="password" name="password" id="username" class="input-text-long" />
      </td>
    </tr>
    <td>
        <input type="submit" name="enter" value="Login" class="input-button"/>
      </td>
    </tr>
  </table>
</form>