<pre>
<?php
/*
foreach ($access as $akses)
{
  echo 'ID          : '.$akses['id'].'<br/>';
  echo 'Name        : '.$akses['name'].'<br/>';
  echo 'Controller  : '.$akses['controller'].'<hr/>';
  
  if (isset($akses['child']))
  {
    $child = $akses['child'];
    
    echo 'Child ID          : '.$child['id'].'<br/>';
    echo 'Child Name        : '.$child['name'].'<br/>';
    echo 'Child Controller  : '.$child['controller'].'<hr/>';
  }
  
}
*/
?>
</pre>

<div id="nav-menu">
  <ul id="nav">
    <li><a href="<?php echo url::site('home'); ?>">Home</a></li>
        
    <?php foreach($access as $akses): ?>
    <?php $head_controller = $akses['controller'] !== '#' ? url::site($akses['controller']) : '#'; ?>
      <li>
        <a href="<?php echo $head_controller; ?>"><?php echo $akses['name']; ?></a>
        <?php if (isset($akses['child'])): ?>
        <ul>
          <?php foreach ($akses['child'] as $child): ?>
          <li><a href="<?php echo url::site($child['controller']); ?>"><?php echo $child['name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
    <li><a href="<?php echo url::base(); ?>login/do_logout">Logout</a></li>
  </ul>
</div>