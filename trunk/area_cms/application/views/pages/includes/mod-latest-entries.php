<div id="latest-posts" class="box-mid">
  <h2>Most recent entries</h2>
  <?php if (count($entries) <= 0): ?>
    <h3 style="margin:10px 5px; color:#ebebeb;">There are no entries at this momment</h3>
  <?php else: ?>
    <ul>
      <?php $i = 1; ?>
      <?php foreach ($entries as $entry): ?>
      <?php $class = $i % 2 == 0 ? 'row1' : 'row2'; ?>
      <?php
      // Set the timespan 2009-05-28 13:29:40
      
      $year   = substr($entry->created_at, 0, 4);
      $month  = substr($entry->created_at, 5, 2);
      $day    = substr($entry->created_at, 8, 2);
      $hour   = substr($entry->created_at, 11, 2);
      $minute = substr($entry->created_at, 14, 2);
      $second = substr($entry->created_at, 17, 2);
      
      $time = mktime($hour, $minute, $second, $month, $day, $year);
      $timespan = date::timespan($time);
      
      $entry_time = '';
      
      // the years
      if ($timespan['years']):
        $entry_time .= $timespan['years'].' year';
        if ($timespan['years'] > 1):
          $entry_time .= 's ';
        else:
          $entry_time .= ' ';
        endif;
      endif;
      
      // the months
      if ($timespan['months'] AND $timespan['years'] <= 1):
        $entry_time .= $timespan['months'].' month';
        if ($timespan['months'] > 1):
          $entry_time .= 's ';
        else:
          $entry_time .= ' ';
        endif;
      endif;
      
      // the weeks
      if ($timespan['weeks'] AND $timespan['months'] <= 1):
        $entry_time .= $timespan['weeks'].' week';
        if ($timespan['weeks'] > 1):
          $entry_time .= 's ';
        else:
          $entry_time .= ' ';
        endif;
      endif;
      
      // the days
      if ($timespan['days'] AND $timespan['weeks'] <= 1):
        $entry_time .= $timespan['days'].' day';
        if ($timespan['days'] > 1):
          $entry_time .= 's ';
        else:
          $entry_time .= ' ';
        endif;
      endif;
      
      // the hours
      if ($timespan['hours'] AND $timespan['days'] <= 1):
        $entry_time .= $timespan['hours'].' hour';
        if ($timespan['hours'] > 1):
          $entry_time .= 's ';
        else:
          $entry_time .= ' ';
        endif;
      endif;
      
      // the minutes
      if ($timespan['minutes'] AND $timespan['hours'] <= 1):
        $entry_time .= $timespan['minutes'].' minute';
        if ($timespan['minutes'] > 1):
          $entry_time .= 's ';
        else:
          $entry_time .= ' ';
        endif;
      endif;
      ?>
      <li class="<?php echo $class; ?>">
        <strong><?php echo $entry->title; ?></strong>
        <p style="margin-top:5px;"><?php echo text::limit_chars(stripslashes(strip_tags($entry->body_text)), 400, '...', FALSE); ?></p>
        <p class="auth-status">Posted by <em><?php echo $entry->display_name; ?></em> <?php echo $entry_time; ?> ago in <a href="#"><?php echo $entry->label; ?></a></p>
      </li>
      <?php $i++; ?>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>
