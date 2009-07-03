<?php echo $menu; ?>
<div id="wrapper">  
  <fieldset class="data-grid">
    <legend>Entries</legend>
      <table class="data-table">
        <tr>
          <th width="5%">ID</th>
          <th width="15%">User Name</th>
          <th width="30%">Display Name</th>
          <th width="15%">Role</th>
          <th width="20%">Status</th>
          <th width="15%">Action</th>
        </tr>
      </table>
    <div class="data-wrapper">
      <table class="data-table">
        <?php $i = 1; ?>
        <?php foreach ($users as $user): ?>
        <?php $class = $i % 2 == 0 ? 'row-1' : 'row-2'; ?>
        <tr>
          <td class="<?php echo $class; ?>" width="5%"><?php echo $user->id; ?></td>
          <td class="<?php echo $class; ?>" width="15%"><?php echo $user->username; ?></td>
          <td class="<?php echo $class; ?>" width="30%"><?php echo $user->display_name; ?></td>
          <td class="<?php echo $class; ?>" width="15%"><?php echo $user->role; ?></td>
          <td class="<?php echo $class; ?>" width="20%"><?php echo $user->status; ?></td>
          <td class="<?php echo $class; ?>" width="15%">
            <a href="<?php echo url::base().'author_profile/index/'.$user->id; ?>"><img src="<?php echo url::base().'/'.Kohana::config('core.image_url'); ?>icons/database_edit.gif" rel="Edit this record" title="Edit this record" class="icon"/></a> |
            <a href="#" rel="<?php echo $user->id; ?>" class="del-confirm"><img src="<?php echo url::base().'/'.Kohana::config('core.image_url'); ?>icons/database_remove.gif" alt="Delete this record" title="Delete this record" class="icon"/></a></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
      </table>
    </div>
    <?php echo $pagination; ?>
    
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.del-confirm').click(function(){
    var rel = $(this).attr('rel');
    
    jConfirm('Are you sure delete this item?', 'Delete item', function(val){
      if (val == true)
      {
        window.location.href = '<?php echo url::base(); ?>manage_users/delete/'+ rel;
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
</script>