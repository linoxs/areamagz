		</div><!-- END OF GRID-3 -->
		
  </div><!--END OF MAIN -->
  
	
  <!-- FOOTER PART-->
  <div id="footer">
  	<ul id="miscellaneous">
    	<li><a href="about-area.php">About</a></li>
      <li><a href="contact-area.php">Contact</a></li>
    </ul>
    <p>Copyright &copy;&nbsp;<a href="index.html">areamagz.com</a>&nbsp;2009</p>
    <div id="search-form" class="m-top-10">
      <form action="#" method="post">
				<div>
					<input name="input_search" type="text" class="text"/>
				</div>
				<div>
					<input name="submit_search" type="submit" value="Search" class="submit"/>
				</div>
			</form>
  	</div>
  </div>
</div>
<?php
echo html::script(array
(
    'media/js/jquery-1.3.2.min.js',
    'media/js/jquery.easing.1.3.js',
    'media/js/jquery.tooltip.pack.js',
    'media/js/jquery.slideviewer.1.1.js',
    'media/js/jquery.galleria.pack.js',
    'media/js/galerria.main.js',
    'media/js/jquery.cycle.js',
    'media/js/jquery.droppy.js',
    'media/libs/tinymce/jscripts/tiny_mce/tiny_mce.js',
), FALSE);
?>
<script type="text/javascript">
$(function() {
  $('#nav').droppy({speed: 100});
});

$(document).ready(function(){
	// Make slide show at Fresh News segment
	$('#slideshow').after('<div id="news-selector" class="m-top-10">').cycle({
		fx:     'fade',
		speed:  'slow',
		timeout: 3000,
		pager:  '#news-selector',
		before: function() { if (window.console) console.log(this.src); }
	});
	
	$('#mygalone').after('<div id="gal-nav">').cycle({ 
		fx:     'scrollRight', 
		speed:  'slow', 
		timeout: 0, 
		pager:  '#gal-nav',
		before: function() { if (window.console) console.log(this.src); }
	});
	
	$('#a-wimar').hover(function(){
    $('.blog-show').addClass('blog-hide');
    $('.blog-show').removeClass('blog-show');
    $('#blognya-wimar').addClass('blog-show');
	});
  
	$('#a-dean').hover(function(){
		$('.blog-show').addClass('blog-hide');
		$('.blog-show').removeClass('blog-show');
		$('#blognya-dean').addClass('blog-show');
	});
  
	$('#a-tejo').hover(function(){
		$('.blog-show').addClass('blog-hide');
		$('.blog-show').removeClass('blog-show');
		$('#blognya-tejo').addClass('blog-show');
	});
  
	$('#a-bara').hover(function(){
		$('.blog-show').addClass('blog-hide');
		$('.blog-show').removeClass('blog-show');
		$('#blognya-bara').addClass('blog-show');
	});
	
	$(window).bind("load", function() {
		$("div#mygalone").slideView()
	});
	
	$(window).bind("load", function() {
		$("div#mygalone").slideView({toolTip: true})
	});
	
	$(window).bind("load", function() {
		$("div#myInstantGallery").slideView({
			easeFunc: "easeInOutBack",
			easeTime: 1200
		});
	});
});
</script>
</body>
</html>