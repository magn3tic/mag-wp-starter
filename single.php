<?php

// single.php - default view for single posts


get_header(); 

if (have_posts()) : while (have_posts()) : the_post();
?>

<section class="content-singlepost">
	<div class="inner">
		
		<article class="singlepost-article" role="article">
			<h1><?php the_title(); ?></h1>
			<div class="singlepost-article_content">
				<?php the_content(); ?>
			</div>
		</article>
	
	</div>
</section>

<?php
endwhile; endif; wp_reset_postdata();

get_footer();