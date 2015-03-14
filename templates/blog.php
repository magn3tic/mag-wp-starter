<?php

/* Template Name: Blog */

get_header(); ?>

<section class="default-leadin">
	<div class="inner">
		<h1 class="default-leadin_title"><?php the_title(); ?></h1>
	</div>
</section>

<section>
	<div class="inner">
	<?php
	if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article class="single-article" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
		<h2 class="single-article_headline" itemprop="headline">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<div class="single-article_content" itemprop="text">
			<?php the_content(); ?>
		</div>
	</article>

	<?php 
	endwhile; endif; wp_reset_postdata();
	?>
	</div>
</section>

<?php
get_footer();