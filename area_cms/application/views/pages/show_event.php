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
          <th width="30%">Title</th>
          <th width="15%">Location</th>
          <th width="33%">Description</th>
          <th width="7%">Action</th>
        </tr>
      </table>
    <div class="data-wrapper">
      <table class="data-table">
        <?php if (count($events) <= 0): ?>
          <h3 style="margin:10px 5px; color:#ebebeb;">There are no comments at this moment</h3>
        <?php else: ?>
          <?php $i = 1; ?>
          <?php foreach ($events as $event): ?>
          <?php $class = $i % 2 == 0 ? 'row1' : 'row2'; ?>
          <tr>
            <td class="<?php echo $class; ?>" width="5%"><?php echo $event->id; ?></td>
            <td class="<?php echo $class; ?>" width="10%"><?php echo $event->date; ?></td>
            <td class="<?php echo $class; ?>" width="30%"><?php echo stripslashes($event->title); ?></td>
            <td class="<?php echo $class; ?>" width="15%"><?php echo stripslashes($event->location); ?></td>
            <td class="<?php echo $class; ?>" width="33%"><?php echo text::limit_chars(stripslashes($event->description), 100, '...', FALSE); ?></td>
            <td class="<?php echo $class; ?>" width="7%">
              <a href="<?php echo url::base().'manage_events/edit/'.$event->id; ?>"><img src="<?php echo url::base().'/'.Kohana::config('core.image_url'); ?>icons/database_edit.gif" rel="Edit this record" title="Edit this record" class="icon"/></a> |
              <a href="#" rel="<?php echo $event->id; ?>" class="del-confirm"><img src="<?php echo url::base().'/'.Kohana::config('core.image_url'); ?>icons/database_remove.gif" alt="Delete this record" title="Delete this record" class="icon"/></a>
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
  $('.del-confirm').click(function(){
    var id = $(this).attr('rel');
    
    jConfirm('Are you sure delete this event?', 'Delete Event', function(val){
      if (val == false)
      {
        return false;
      }
      else
      {
        window.location.href = '<?php echo url::base(); ?>manage_events/delete/'+ id;
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