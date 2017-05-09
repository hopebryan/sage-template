<?php use Roots\Sage\Titles; ?>
<div class="blog-page">
	<div class="container wow fadeIn">	
		<h1 class="text-center"><?= Titles\title(); ?></h1>
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<?php if (!have_posts()) : ?>
					<div class="row blog-post-wrap">
					  <div class="alert alert-warning">
					    <?php _e('Sorry, no results were found.', 'sage'); ?>
					  </div>
				  </div>
				  <?php //get_search_form(); ?>
				<?php endif; ?>
				<?php while (have_posts()) : the_post(); ?>
				  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
				<?php endwhile; ?>
				<?php the_posts_navigation(); ?>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="blog-sidebar">
					<div class="search-widgets">
						<?php dynamic_sidebar('sidebar-search'); ?>
					</div>
					<div class="sidebar-widgets">
						<?php dynamic_sidebar('sidebar-primary'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>