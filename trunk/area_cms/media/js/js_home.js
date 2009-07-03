$(document).ready(function(){
  $('.approve-comment').click(function(){
    var obj = $(this);
    var id = $(this).attr('rel');
    
    jConfirm('Approve this comment?', 'Approve Comment', function(val){
      if (val == false)
      {
        return false;
      }
      else
      {
        $.ajax({
          type: "POST",
          url: "ajax/approve_comment/",
          data: "from-ajax=yes&id="+ id,
          beforeSend: function(){
            obj.attr('value','Approving...');
            obj.css('width','auto');
          },
          success: function(msg){
            if (msg == 'success')
            {
              window.location.href = "home"; 
            }
            else
            {
               jAlert('Error : '+ msg);
            }
          }
        });
      }
    });
  });
  
  $('.del-confirm').click(function(){
    var obj = $(this);
    var id = $(this).attr('rel');
    
    jConfirm('Are you sure delete this comment?', 'Delete Comment', function(val){
      if (val == false)
      {
        return false;
      }
      else
      {
        $.ajax({
          type: "POST",
          url: "ajax/delete_comment/",
          data: "from-ajax=yes&id="+ id,
          beforeSend: function(){
            obj.attr('value','Deleting...');
            obj.css('width','auto');
          },
          success: function(msg){
            if (msg == 'success')
            {
              window.location.href = "home"; 
            }
            else
            {
               jAlert('Error : '+ msg);
            }
          }
        });
      }
    });
  });
});