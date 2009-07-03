<div id="greeting">
  <p>Hi <a href="<?php echo url::base(); ?>author_profile"><?php echo $this->session->get('display_name'); ?></a>, <a href="<?php echo url::base(); ?>login/do_logout">Logout</a></p>
  <?php echo $search_box; ?>
</div>