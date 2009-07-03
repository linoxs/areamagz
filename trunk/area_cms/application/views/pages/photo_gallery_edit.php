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
    <legend>Albums</legend>
      <table class="data-table">
        <tr>
          <th width="10%">Thumb</th>
          <th width="84%">Edit This Album</th>
          <th width="6%">Action</th>
        </tr>
      </table>
    <div class="data-wrapper">
      <?php if (count($albums) <=0): ?>
        <h3 style="margin:10px 5px; color:#ebebeb;">No data</h3>
      <?php endif; ?>
      <table class="data-table">
        <?php $i = 1; ?>
        <?php foreach ($albums as $album): ?>
        <?php $class = $i % 2 == 0 ? 'row-1' : 'row-2'; ?>
        <tr>
          <td class="<?php echo $class; ?>" width="10%"><img src="<?php echo url::base().Kohana::config('core.gallery_folder').$album->image; ?>" style="width:60px; border:1px solid #ccc; padding:5px;" /></td>
          <td class="<?php echo $class; ?>" width="83%" style="vertical-align:middle;"><a href="<?php echo url::site('photo_gallery/edit_album/').'/'.$album->id; ?>"><?php echo $album->title; ?></a></td>
          <td class="<?php echo $class; ?>" width="7%">
            <input type="button" class="input-button del-album" rel="<?php echo $album->id; ?>" value="Delete This Album" />
          </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
      </table>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.del-album').click(function(){
    var id = $(this).attr('rel');
    
    jConfirm('Are you sure delete this album?', 'Delete album', function(val){
      if (val == true)
      {
        window.location.href = '<?php echo url::base(); ?>photo_gallery/delete_album/'+ id;
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