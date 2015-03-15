<?php

//Archive Template 
//this is set up to handle categories, tags, author archives

get_header(); ?>

<section class="content-archive">
	<div class="inner">
		
		<div class="content-archive_title">
		<?php 
		if (is_category()) {
			echo 'Viewing Posts in Category: ';
			single_cat_title();
		} else if (is_tag()) {
			echo 'Viewing Posts Tagged: '; 
			single_tag_title();
		} else if (is_author()) {
			global $post;
			echo 'Viewing Posts by: '; 
			the_author_meta('display_name', $post->post_author);
		} ?>
		</div>
		
		<div class="content-archive_body">
			<?php if (have_posts()) : while (have_posts()) : the_post(); 
			?>

			<article <?php post_class(); ?> role="article">
				<h2 class="entry-title">
					<a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="entry-meta">
					
				</div>
				<?php the_excerpt(); ?>
			</article>
			
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
		
	</div>
</section>

<?php get_footer();