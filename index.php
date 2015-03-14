<?php

/*
*	Index File - used as fallback
*
*
*/

get_header(); ?>

<section class="content-index">
	<div class="inner">
	<?php 

	if (have_posts()) : while (have_posts()) : the_post();

	$cats = get_the_category_list(', '); 
	?>

	<article <?php post_class(); ?>>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="entry-meta">
			<span></span>
			<span></span>
		</div>
		<?php the_excerpt(); ?>
	</article>
	

	<?php 
	endwhile; endif; 
	wp_reset_postdata(); ?>
	</div>
</section>





<?php
get_footer();