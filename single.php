<?php

// single.php - default view for single posts


get_header(); 

if (have_posts()) : while (have_posts()) : the_post();
?>

<section class="content-singlepost">
	<div class="inner">
		
		<article>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	
	</div>
</section>



<?php
endwhile; endif; wp_reset_postdata();

get_footer();