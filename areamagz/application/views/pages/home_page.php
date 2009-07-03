    <div id="grid-1">

    	<!-- FRESH NEWS -->
      <div id="fresh-news" class="margin-bottom-big margin-top-big left">

        <div id="slideshow">
          <?php foreach ($fresh_news as $news): ?>
            <div class="slide">
              <p class="image-on-text"><a href="<?php echo $news->url; ?>"><img src="http://<?php echo Kohana::config('core.entry_image_folder').$news->thumb_image; ?>" alt="img" width="310"/></a></p>
              <p class="headline-title-15 <?php echo $news->segment; ?>"><a href="entertainment-news.php"><strong>Entertainment</strong></a></p>
              <h2 class="headline-title-18"><a href="<?php echo $news->url; ?>"><strong><?php echo $news->title; ?></strong></a></h2>
              <p id="opening-text" > <?php echo text::limit_chars($news->excerpt, 200, '', FALSE); ?> <a href="<?php echo $news->url; ?>"><span>&nbsp;<strong>read more...</strong></span></a></p>
            </div>
          <?php endforeach; ?>
        </div>
        
				<p class="segment-title" id="title-fresh-news"><strong>Fresh News</strong></p>

      </div><!-- END OF FRESH NEWS-->

      <!-- MORE NEWS -->
      <div id="more-news" class="margin-top-big margin-bottom-big left">

        <div class="list-of-news margin-top-big">
          <p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-1.jpg" alt="img" /></a></p>
          <p class="segment-news-flash news-segment"><a href="#">Eat &amp; Drink</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>Disney-Pixar's Up</strong></a></h2>
          <span class="tiny-news">An animated comedy adventure about a 78-year-old man who ties balloons to his house and flies away</span>
					<span class="little-note">Yesterday</span>
				</div>
        <div class="list-of-news">
          <p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-2.jpg" alt="img" width="80"/></a></p>
          <p class="segment-entertainment news-segment"><a href="#">Entertainment</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>Distinct memes, ideas, perspectives, and attitudes</strong></a></h2>
					 <span class="tiny-news">features Celebrity Gossip, Entertainent.</span>
          <span class="little-note">Yesterday</span>
        </div>
        <div class="list-of-news">
	        <p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-3.jpg" alt="img" width="80"/></a></p>
          <p class="segment-eat news-segment"><a href="#">Eat &amp; Drink</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>Report from FG Summit in France</strong></a></h2>
					 <span class="tiny-news">Summit FG Series lubricants are specially designed for rotary screw</span>
          <span class="little-note">Yesterday</span>
        </div>
        <div class="list-of-news">
        	<p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-4.jpg" alt="img" width="80"/></a></p>
          <p class="segment-shopping news-segment"><a href="#">Shopping</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>Vision Streetwear. Legends Never Die</strong></a></h2>
					 <span class="tiny-news">Taking Vision to the Streets will be held from June 3 – 6 at National City</span>
          <span class="little-note">Yesterday</span>
        </div>
        <div class="list-of-news">
        	<p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-5.jpg" alt="img" width="80"/></a></p>
          <p class="segment-art news-segment"><a href="#">Kids</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>Twitter: What are you doing?</strong></a></h2>
					 <span class="tiny-news">Twitter is a free service that lets you keep in touch</span>
          <span class="little-note">Yesterday</span>
        </div>
        <div class="list-of-news">
          <p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-6.jpg" alt="img" width="80"/></a></p>
          <p class="segment-kids news-segment"><a href="#">Kids</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>10 Great Printer Related Ideas for Your Kids</strong></a></h2>
					 <span class="tiny-news">If you have an aquarium at home then a good recycling idea of printer your kids</span>
          <span class="little-note">Yesterday</span>
        </div>
        <div class="list-of-news">
          <p class="image-on-text float-left"><a href="#"><img src="<?php echo Kohana::config('core.img_url'); ?>more-7.jpg" alt="img" width="80"/></a></p>
          <p class="segment-speed news-segment"><a href="#">Speed Guide</a></p>
          <h2 class="headline-title-15"><a href="#"><strong>'Speed Racer' car faces reality Innovation</strong></a></h2>
					 <span class="tiny-news">Just over a week ago, Top Speed brought you the news that Rolls Royce</span>
          <span class="little-note">Yesterday</span>
      	</div>
       	<span class="segment-title" id="title-more-news"><strong>More News</strong></span>
	  	</div><!-- END OF MORE NEWS-->

			<!-- BLOG -->
			<div id="blog" class="left margin-top-big margin-bottom">
				<div id="blognya-wimar" class="blog-show">
					<span class="blog-title">Wimar Says</span>
					<ul>
						<li><a href="#">How many galleries per page?</a></li>
						<li><a href="#">Easy text truncation for jQuery</a></li>
						<li><a href="#">Replace pieces of text with images</a></li>
						<li><a href="#">Another approach to tool tips using jQuery</a></li>
						<li><a href="#">A simple extension for jQuery to rotate images within the DOM</a></li>
						<li><a href="#">Add dialog placeholder(s) to your page</a></li>
						<li><a href="#">Massive Giveaway of Designious Goodies</a></li>
						<li><a href="#">Portraits of Iconic People of All Time</a></li>
					</ul>
					<span class="more"><a href="#">More Wimar's articles...</a></span>
				</div>
				<div id="blognya-dean" class="blog-hide">
					<span class="blog-title">Style Conundrum</span>
					<ul>
						<li><a href="#">Style Conundrum</a></li>
						<li><a href="#">How many galleries per page?</a></li>
						<li><a href="#">Easy text truncation for jQuery</a></li>
						<li><a href="#">Replace pieces of text with images</a></li>
						<li><a href="#">Another approach to tool tips using jQuery</a></li>
						<li><a href="#">A simple extension for jQuery to rotate images within the DOM</a></li>
						<li><a href="#">Add dialog placeholder(s) to your page</a></li>
						<li><a href="#">Massive Giveaway of Designious Goodies</a></li>
					</ul>
					<span class="more"><a href="#">More Dean's articles...</a></span>
				</div>
				<div id="blognya-tejo" class="blog-hide">
					<span class="blog-title">Frankly Speaking</span>
					<ul>
						<li><a href="#">Frankly Speaking</a></li>
						<li><a href="#">Easy text truncation for jQuery</a></li>
						<li><a href="#">Replace pieces of text with images</a></li>
						<li><a href="#">Another approach to tool tips using jQuery</a></li>
						<li><a href="#">A simple extension for jQuery to rotate images within the DOM</a></li>
						<li><a href="#">Add dialog placeholder(s) to your page</a></li>
						<li><a href="#">Massive Giveaway of Designious Goodies</a></li>
						<li><a href="#">Portraits of Iconic People of All Time</a></li>
					</ul>
					<span class="more"><a href="#">More Tejo's articles...</a></span>
				</div>
				<div id="blognya-bara" class="blog-hide">
					<span class="blog-title">Bara's Pots &amp; Pans</span>
					<ul>
						<li><a href="#">Bara's Pots &amp; Pans</a></li>
						<li><a href="#">Easy text truncation for jQuery</a></li>
						<li><a href="#">Replace pieces of text with images</a></li>
						<li><a href="#">Another approach to tool tips using jQuery</a></li>
						<li><a href="#">A simple extension for jQuery to rotate images within the DOM</a></li>
						<li><a href="#">Add dialog placeholder(s) to your page</a></li>
						<li><a href="#">Massive Giveaway of Designious Goodies</a></li>
						<li><a href="#">Portraits of Iconic People of All Time</a></li>
					</ul>
					<span class="more"><a href="#">More Bara's articles...</a></span>
				</div>
				<ul id="blog-right">
					<li id="blog-wimar"><a href="#" id="a-wimar"><strong>Wimar Says</strong><span class="bg-blog-arrow">&nbsp;</span></a></li>
					<li id="blog-dean"><a href="#" id="a-dean"><strong>Style Conundrum</strong><span class="bg-blog-arrow">&nbsp;</span></a></li>
					<li id="blog-tejo"><a href="#" id="a-tejo"><strong>Frankly Speaking</strong><span class="bg-blog-arrow">&nbsp;</span></a></li>
					<li id="blog-bara"><a href="#" id="a-bara"><strong>Bara's Pots &amp; Pans</strong><span class="bg-blog-arrow">&nbsp;</span></a></li>
				</ul>
        <p class="segment-title" id="title-blog"><strong>Area Blog</strong></p>
			</div>

    </div><!-- END OF GRID-1 -->

    <div id="grid-2">

      <!-- EDITORIAL CHOICE-->
      <div id="editorial" class="middle">
        <div>
          <p class="segment-title" id="title-editorial-choice"><strong>Editorial Choice</strong></p>
          <p class="image-on-text float-left"><a href="#"><img src="http://<?php echo Kohana::config('core.entry_image_folder').$latest_feature->thumb_image; ?>" height="90" alt="img" /></a></p>
          <p class="headline-title-15" id="segment-feature"><a href="#"><strong>Feature</strong></a></p>
          <h2 class="headline-title-18"><a href="#"><strong><?php echo $latest_feature->title; ?></strong></a></h2>
          <p> <?php echo text::limit_chars(stripslashes($latest_feature->excerpt), 180, '', FALSE); ?> <a href="#"><span>&nbsp;<strong>read more...</strong></span></a> </p>
        </div>
        <div class="margin-top"> <p class="image-on-text float-left"><a href="#"><img src="http://<?php echo Kohana::config('core.entry_image_folder').$last_hot_seat->thumb_image; ?>" height="90" alt="img" /></a></p>
          <p class="headline-title-15" id="segment-hotseat"><a href="#"><strong>Hot Seat</strong></a></p>
          <h2 class="headline-title-18"><a href="#"><strong><?php echo $last_hot_seat->title; ?></strong></a></h2>
          <p> <?php echo text::limit_chars(stripslashes($last_hot_seat->excerpt), 180, '', FALSE); ?> <a href="#"><span>&nbsp;<strong>read more...</strong></span></a> </p>
        </div>
      </div>

      <!-- AREA SOCIETY RED-BALD IMAGE -->
			<div id="area-society" class="middle margin-top-big margin-bottom">
				<span><a href="area-society.php"><img src="<?php echo Kohana::config('core.img_url'); ?>area-society.png" alt="img" /></a></span>
			</div>

      <!-- OTHER NEWS -->
      <div class="margin-top margin-bottom-big middle" id="other-news">
				<span class="segment-title" id="title-other-news"><strong>Other News</strong></span>
        <ul class="m-top-10">
        	<!--  !important 1 space character at end <a>(anchor) for IE6 -->
          <?php foreach ($other_news as $other): ?>
            <li><a href="<?php echo $other->url; ?>"><?php echo $other->title; ?> </a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- CALENDAR EVENTS -->
      <div id="calendar-events" class="middle margin-top-big margin-bottom">
        <p class="segment-title" id="title-calendar-events"><strong>Calendar Events</strong></p>
        <?php foreach($latest_events as $event): ?>
        <?php
        // Fetch the date
        $year   = substr($event->date, 0, 4);
        $month  = substr($event->date, 5, 2);
        $date   = substr($event->date, 8, 2);
        $day    = date('D', mktime(0, 0, 0, $month, $date, $year));
        $hmonth = date('M', mktime(0, 0, 0, $month, $date, $year));
        ?>
          <div class="list-of-calendar"> <span class="little-date"><?php echo $date; ?><em class="little-day"><?php echo $day; ?></em><em class="little-month"><?php echo $hmonth; ?></em></span>
            <p class="little-event"><a href="event-detail.php"><strong><?php echo $event->title; ?></strong></a></p>
            <p class="little-info"><em><?php echo text::limit_chars($event->description, 100, '', FALSE); ?></em></p>
          </div>
        <?php endforeach; ?>

      </div><!-- END CALENDAR EVENTS-->

      <!-- TWITTER HINTS -->
			<div id="twitter-hint" class="margin-top middle">
        <p class="segment-title" id="title-twitter-hints"><strong>Twitter Hints</strong></p>
        <?php foreach ($tweet as $twit): ?>
        <div class="list-of-twitter-hint">
          <p><span><?php echo $this->makeURL($twit->text); ?></span></p>
          <p><span>By <a href="<?php echo 'http://twitter.com/'.$twit->user->screen_name; ?>" class="blue"><?php echo $twit->user->name; ?></a></span> on <?php echo substr($twit->created_at, 0, 20); ?></p>
        </div>
        <?php endforeach; ?>
      </div>

			<!-- TWITTER FOLLOW ME. FAT BIRD IMAGE -->
			<div id="twitter-followme" class="middle margin-bottom-big">
				<a href="http://twitter.com/<?php echo Kohana::config('twitter.username'); ?>"><img src="<?php echo Kohana::config('core.img_url'); ?>twitter-bird-followme.jpg" alt="Follow me" /></a>
			</div>

      <!-- RECENT COMMENTS -->
      <div id="recent-comments" class="margin-top-big middle">
        <p class="segment-title" id="title-recent-comments"><strong>Recent Comments</strong></p>
        <div class="list-of-recent-comments">
          <p><span>Ini website apa apaan yak? kok saya mo cari tau tentang testiomial para politisi yang sudah pernah </span></p>
          <p><span>By <a href="#">Herry Sosiawan</a> on <a href="#">Living lingerine to wear</a></span></p>
        </div>
        <div class="list-of-recent-comments">
          <p><span>Ini website apa apaan yak? kok saya mo cari tau tentang testiomial para politisi yang sudah pernah berpengalaman dalam memasarkan produk MLM(Multilevel Marketing) ga ketemu-ketemu</span></p>
          <p><span>By <a href="#">Shinta Novithany</a> on <a href="#">Childer of heaven, went war</a></span></p>
        </div>
        <div class="list-of-recent-comments">
          <p><span>Ga ketemu-ketemu sampe sampe saya putus asa eh malah ketemunya rekomendasai tempat makan, piye toh iki? kowe wedus gembel opo ora gitu looh?</span></p>
          <p><span>By <a href="#">Dicky Arthanto</a> on <a href="#">Big Burger King killa</a></span></p>
        </div>
      </div>

    </div> <!-- END OF GRID-2 -->

    <div id="grid-3">

			<?php echo $showcase;?>
      
			<?php echo $signin_form;?>
      
      <?php echo $side_ads;?>
		
		 <!-- READER'S REVIEW -->
      <div id="readers-review" class="right margin-bottom-big">
        <p class="segment-title margin-top" id="title-readers-review"><strong>Reader's Review</strong></p>
        <div class="list-of-readers-review">
          <h2 class="headline-title-15"><a href="#"><span>Chocolate Cheesecake</span></a>&nbsp;<span class="rate">recommended!</span> </h2>
          <p><span>Jalan Arief Rahman Hakim no.23 Depok I</span></p>
          <p><span>By <a href="#">Zoel</a></span> on 8 June</p>
        </div>
        <div class="list-of-readers-review">
          <h2 class="headline-title-15"><a href="#"><span>Nasi Goreng &amp; Kwe Tiaw Tegal 'Bejo'</span></a></h2>
          <p><span>Jalan Nusantara Raya samping Meubel Depok I</span></p>
          <p><span>By <a href="#">Inoe Grahadi</a></span> on 15 June</p>
        </div>
        <div class="list-of-readers-review">
          <h2 class="headline-title-15"><a href="#"><span>Bubur Ayam Cirebon Barito</span></a></h2>
          <p><span>Jalan Barito Raya Samping AA Gym Jak-sel</span></p>
          <p><span>By <a href="#">Haidar Ghazy</a></span> on 24 June</p>
        </div>
        <div class="list-of-readers-review">
          <h2 class="headline-title-15"> <a href="#"><span>Roti Bakar &amp; Pancong Keju Akang</span></a>&nbsp;<span class="rate">recommended!</span> </h2>
          <p><span>Jalan Leli Raya Depok I</span></p>
          <p><span>By <a href="#">Tri Laksono</a></span> on 28 June</p>
        </div>
					<p class="little-note"><a href="readers-review.php">Read More Reviews...</a></p>
      </div>
			
      <!-- PAPARAZZI -->
      <div id="paparazzi" class="right margin-top-big">
        <p class="segment-title" id="title-paparazzi"><strong>Paparazzi</strong></p>
				<div id="mygalone">
          <img alt="Corner of the street, Sao Paulo City Fest"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-2.jpg" />
          <img alt="Black n White with bunch on people"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-3.jpg" />
          <img alt="Light Please! Photograph workshop"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-4.jpg" />
          <img alt="Kuta Beach, Coca Cola Sunset Party"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-1.jpg" />
          <img alt="Light Please! Photograph workshop"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-5.jpg" />
          <img alt="Light Please! Photograph workshop"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-6.jpg" />
          <img alt="Light Please! Photograph workshop"  src="<?php echo Kohana::config('core.img_url'); ?>photo-slide-7.jpg" />
				</div>
			</div>