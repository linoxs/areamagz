<div id="latest-comments" class="box-mid">
  <h2>Most recent comments</h2>
  <?php if (count($comments) <= 0): ?>
    <h3 style="margin:10px 5px; color:#ebebeb;">There are no comments at this momment</h3>
  <?php else: ?>
    <ul>
      <?php $i = 1; ?>
      <?php foreach ($comments as $comment): ?>
        <?php $class = $i % 2 == 0 ? 'row1' : 'row2'; ?>
        <?php
        // Set the timespan 2009-05-28 13:29:40
        
        $year   = substr($comment->time, 0, 4);
        $month  = substr($comment->time, 5, 2);
        $day    = substr($comment->time, 8, 2);
        $hour   = substr($comment->time, 11, 2);
        $minute = substr($comment->time, 14, 2);
        $second = substr($comment->time, 17, 2);
        
        $time = mktime($hour, $minute, $second, $month, $day, $year);
        $timespan = date::timespan($time);
        
        $comment_time = '';
        
        // the years
        if ($timespan['years']):
          $comment_time .= $timespan['years'].' year';
          if ($timespan['years'] > 1):
            $comment_time .= 's ';
          else:
            $comment_time .= ' ';
          endif;
        endif;
        
        // the months
        if ($timespan['months'] AND $timespan['years'] <= 1):
          $comment_time .= $timespan['months'].' month';
          if ($timespan['months'] > 1):
            $comment_time .= 's ';
          else:
            $comment_time .= ' ';
          endif;
        endif;
        
        // the weeks
        if ($timespan['weeks'] AND $timespan['months'] <= 1):
          $comment_time .= $timespan['weeks'].' week';
          if ($timespan['weeks'] > 1):
            $comment_time .= 's ';
          else:
            $comment_time .= ' ';
          endif;
        endif;
        
        // the days
        if ($timespan['days'] AND $timespan['weeks'] <= 1):
          $comment_time .= $timespan['days'].' day';
          if ($timespan['days'] > 1):
            $comment_time .= 's ';
          else:
            $comment_time .= ' ';
          endif;
        endif;
        
        // the hours
        if ($timespan['hours'] AND $timespan['days'] <= 1):
          $comment_time .= $timespan['hours'].' hour';
          if ($timespan['hours'] > 1):
            $comment_time .= 's ';
          else:
            $comment_time .= ' ';
          endif;
        endif;
        
        // the minutes
        if ($timespan['minutes'] AND $timespan['hours'] <= 1):
          $comment_time .= $timespan['minutes'].' minute';
          if ($timespan['minutes'] > 1):
            $comment_time .= 's ';
          else:
            $comment_time .= ' ';
          endif;
        endif;
        ?>
        <li class="<?php echo $class; ?>">
          <p><?php echo text::limit_chars(strip_tags($comment->comment), 100, '...', FALSE); ?></p>
          <p class="auth-status">Commented by <em><?php echo $comment->name; ?></em> <?php echo $comment_time; ?> ago in <a href="#"><?php echo $comment->title; ?></a></p>
          <p class="right-button-group">
            <?php if ($comment->status == 0): ?>
              <input type="button" class="input-button approve-comment" rel="<?php echo $comment->id; ?>" value="Approve" />
            <?php endif; ?>
            <input type="button" class="input-button del-confirm" rel="<?php echo $comment->id; ?>" value="Delete" />
          </p>
        </li>
      <?php $i++; ?>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>