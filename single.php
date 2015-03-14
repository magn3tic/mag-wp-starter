<?php

// single.php - default view for single posts


get_header(); 

if (have_posts()) : while (have_posts()) : the_post();
?>

<section class="">
	<div class="inner">
		<article>
			
		</article>
	</div>
</section>

<section>
	<div class="inner">
		
	</div>
</section>

<?php
endwhile; endif; wp_reset_postdata();

get_footer();