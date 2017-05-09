<?php use Roots\Sage\Titles; ?>
<div class="blog-page">
  <div class="container">    
  <h1 class="text-center">Blog</h1>  
    <div class="row">
      <div class="col-md-8 col-sm-8">
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class(); ?>>
            <div class="blogpost-row">
              <h2 class="text-left"><?= Titles\title(); ?></h2>
              <div class="clearfix"><?php get_template_part('templates/entry-meta'); ?></div>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </div>
            <footer>
              <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
            </footer>
            <?php comments_template('/templates/comments.php'); ?>
          </article>
        <?php endwhile; ?>        
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="blog-sidebar">
          <div class="search-widgets">
            <?php dynamic_sidebar('sidebar-search'); ?>
          </div>
          <div class="sidebar-widgets">
            <?php dynamic_sidebar('sidebar-primary' ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>