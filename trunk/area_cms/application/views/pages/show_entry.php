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
    <legend>Entries</legend>
      <table class="data-table">
        <tr>
          <th width="5%">ID</th>
          <th width="10%">Created At</th>
          <th width="19%">Title</th>
          <th width="30%">Excerpt</th>
          <th width="10%">Category</th>
          <th width="10%">Author</th>
          <th width="10%">Status</th>
          <th width="6%">Action</th>
        </tr>
      </table>
    <div class="data-wrapper">
      <?php if (count($entries) <=0): ?>
        <h3 style="margin:10px 5px; color:#ebebeb;">No data</h3>
      <?php endif; ?>
      <table class="data-table">
        <?php $i = 1; ?>
        <?php foreach ($entries as $entry): ?>
        <?php $class = $i % 2 == 0 ? 'row-1' : 'row-2'; ?>
        <tr>
          <td class="<?php echo $class; ?>" width="5%"><?php echo $entry->id; ?></td>
          <td class="<?php echo $class; ?>" width="10%"><?php echo $entry->created_at; ?></td>
          <td class="<?php echo $class; ?>" width="18%"><?php echo text::limit_words(stripslashes($entry->title), 10, '...'); ?></td>
          <td class="<?php echo $class; ?>" width="30%"><?php echo text::limit_words(stripslashes($entry->excerpt), 10, '...'); ?></td>
          <td class="<?php echo $class; ?>" width="10%"><?php echo $entry->category; ?></td>
          <td class="<?php echo $class; ?>" width="10%"><?php echo $entry->author; ?></td>
          <td class="<?php echo $class; ?>" width="10%"><?php echo $entry->status; ?></td>
          <td class="<?php echo $class; ?>" width="7%">
            <a href="<?php echo url::base().'manage_entries/edit/'.$entry->id; ?>"><img src="<?php echo url::base().'/'.Kohana::config('core.image_url'); ?>icons/database_edit.gif" rel="Edit this record" title="Edit this record" class="icon"/></a> |
            <a href="#" rel="<?php echo $entry->id; ?>" class="del-confirm"><img src="<?php echo url::base().'/'.Kohana::config('core.image_url'); ?>icons/database_remove.gif" alt="Delete this record" title="Delete this record" class="icon"/></a>
          </td>
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
    var id = $(this).attr('rel');
    
    jConfirm('Are you sure delete this item?', 'Delete item', function(val){
      if (val == true)
      {
        window.location.href = '<?php echo url::base(); ?>manage_entries/delete/'+ id;
      }
      else
      {
        return false;
      }
      //jAlert('Confirmed: ' + val, 'Confirmation Results');
    });
  });
  
  $('.data-table tr').hover(function(){    
    $(this).children('td').addClass('row-hover');
  },function(){
    $(this).children('td').removeClass('row-hover');
  });
  
});
</script>