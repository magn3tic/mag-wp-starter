<?php

/*
*	Index File - since we are using a home.php and other archive templates,
* this is really here as a fallback and a reference 
*/

get_header(); ?>

<section class="content-index">
	<div class="inner">
	<?php 

	if (have_posts()) : while (have_posts()) : the_post();

	//list of category links with a separator
	$cats_linked = get_the_category_list(', '); 
	
	//get the date in your own format
	$post_date = get_the_date('F j, Y', $post);

	//get the date in the format chosen in wordpress settings
	$date_by_settings = get_the_time(get_option('date_format'));

	//authors name linked to archive
	$author_linked = get_the_author_link(get_the_author_meta('ID'))
	?>

	<article <?php post_class(); ?> role="article">
		<h2 class="entry-title">
			<a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="entry-meta">
			<span><?php echo $date_by_settings; ?></span>
			<span><?php echo $cats_linked; ?></span>
			<span><?php echo $author_linked; ?></span>
		</div>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>	
	</article>
	
	<?php 
	endwhile; ?>
	
	<div class="paginated-links">
		<?php mag_pagination(); ?>
	</div>

	<?php endif; 
	wp_reset_postdata(); ?>
	</div>
</section>


<?php
get_footer();