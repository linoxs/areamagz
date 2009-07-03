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
  
  <fieldset class="data-grid">
    <legend>Comments</legend>
      <table class="data-table">
        <tr>
          <th width="5%">ID</th>
          <th width="10%">Time</th>
          <th width="10%">Name</th>
          <th width="10%">Email</th>
          <th width="28%">Comment Text</th>
          <th width="10%">Entry</th>
          <th width="17%">Action</th>
        </tr>
      </table>
    <div class="data-wrapper">
      <table class="data-table">
        <?php if (count($comments) <= 0): ?>
          <h3 style="margin:10px 5px; color:#ebebeb;">There are no comments at this momment</h3>
        <?php else: ?>
          <?php $i = 1; ?>
          <?php foreach ($comments as $comment): ?>
          <?php $class = $i % 2 == 0 ? 'row1' : 'row2'; ?>
          <tr>
            <td class="<?php echo $class; ?>" width="5%"><?php echo $comment->id; ?></td>
            <td class="<?php echo $class; ?>" width="10%"><?php echo $comment->time; ?></td>
            <td class="<?php echo $class; ?>" width="10%"><?php echo $comment->name; ?></td>
            <td class="<?php echo $class; ?>" width="10%"><?php echo $comment->email; ?></td>
            <td class="<?php echo $class; ?>" width="30%"><?php echo text::limit_chars($comment->comment, 100, '...', FALSE); ?></td>
            <td class="<?php echo $class; ?>" width="15%"><a href="#"><?php echo text::limit_chars($comment->title, 100, '...', FALSE); ?></a></td>
            <td class="<?php echo $class; ?>" width="20%">
              <?php if ($comment->status == 0): ?>
                <input type="button" class="input-button approve-comment" rel="<?php echo $comment->id; ?>" value="Approve" />
              <?php endif; ?>
              <input type="button" class="input-button del-confirm" rel="<?php echo $comment->id; ?>" value="Delete" />
            </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </table>
    </div>
    <?php echo $pagination; ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.approve-comment').click(function(){
    var id = $(this).attr('rel');
    
    jConfirm('Approve this comment?', 'Approve Comment', function(val){
      if (val == false)
      {
        return false;
      }
      else
      {
        window.location.href = '<?php echo url::base(); ?>manage_comments/approve/'+ id;
      }
    });
  });
  
  $('.del-confirm').click(function(){
    var id = $(this).attr('rel');
    
    jConfirm('Are you sure delete this comment?', 'Delete Comment', function(val){
      if (val == false)
      {
        return false;
      }
      else
      {
        window.location.href = '<?php echo url::base(); ?>manage_comments/delete/'+ id;
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