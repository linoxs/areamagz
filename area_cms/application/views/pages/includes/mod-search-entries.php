<div class="search" style="text-align: right;">
  <form method="post" action="#" id="search-form">
  <strong>Search entries : </strong>
    <select name="filter" id="filter" class="input-select">
      <option value="title">Title</option>
      <option value="body_text">Body Text</option>
      <option value="category">Category</option>
      <option value="author">Author</option>
      <option value="status">Status</option>
    </select>
    <input type="text" name="keyword" id="keyword" class="input-text-long" />
    <input type="submit" class="input-button" id="search-button" value="Search" />
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('#search-form').submit(function(){
    var filter = $('#filter').val();
    var keyword= $('#keyword').val();
    
    window.location.href = "<?php echo url::base(); ?>manage_entries/search/"+ filter +"/"+ keyword;
    
    return false;
  });
});
</script>