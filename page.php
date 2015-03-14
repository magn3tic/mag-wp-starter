<?php

// page.php - default view for single pages

get_header(); 

if (have_posts()) : while (have_posts()) : the_post();
?>

<section class="content-page">
	<div class="inner">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="inner">
		<?php the_content(); ?>
	</div>
</section>

<?php
endwhile; endif; wp_reset_postdata();

get_footer();