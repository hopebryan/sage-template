<?php 
	/*Template Name: Home*/	
?>
<?php get_template_part('templates/banner'); ?>
<section id="review">
	<div class="container text-center wow fadeIn">
		<h2 class="lastWord">Book Reviews</h2>
		<div class="row">
			<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
				<div id="myCarousel" class="carousel slide">
				<!-- Indicators -->
					<?php
					$args = array(
					'posts_per_page' => 10,
					'offset' => 0,
					'orderby' => 'date',
					'order' => 'ASC',
					'post_type' => 'bookreview',
					'post_status' => 'publish',
					'suppress_filters' => true 
					);
					$posts_array = get_posts( $args ); 
					?>

					<div class="carousel-inner" role="listbox">
						<?php
						/* DISPLAY BOOK REVIEWS */
						$count = 0;
						$status = '';
						$carouIn = '<ol class="carousel-indicators">';
						foreach ( $posts_array as $post_review ) : setup_postdata( $post );
						$bookreview_perm= esc_url( get_permalink( $post_review->ID ) ); 
						$address = get_post_meta( $post_review->ID, 'readersname', true ); 
						if($count == 0)
						{
							$status = 'active';
						}
						else{
							$status = '';
						}

						$carouIn.= '<li data-target="#myCarousel" data-slide-to="'.$count.'" class="'.$status.'"></li>';
						echo '<div class="item '.$status.'">
						<div class="review-cont">
						<p>
						'. $post_review->post_content .'
						</p>
						<p class="readers-name">&#x2014;'. $post_review->post_title;
						if(!empty($address)) {
							echo '<span>, '.$address.'</span>';
						}
						echo '</p>

						</div>
						</div>';
						$count++;
						endforeach;
						$carouIn.='</ol>';

						?> 
					</div>
					<?php
						echo $carouIn;
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="about-book">
	<div class="container wow fadeIn">
		<div class="row">
			<div class="col-md-5">
				<div class="book-availibility text-center">
					<figure class="book-img">
						<?php $page_id='28'; ?>
						<?php if(has_post_thumbnail($page_id)) : ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'single-post-thumbnail'); ?>
						<?php endif; ?>
						<?php $imageURI = $image[0]; ?>
						<img src="<?php echo $imageURI; ?>" alt="Batting Rocks: Over the Barn">
					</figure>
					<div class="retailer">
						<ul>
							<li class="amazon"><a href="<?php echo get_post_meta(32, 'amazonurl', true); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/amazon.png" alt="Amazon"></a></li>
							<li class="barnesandnoble"><a href="<?php echo get_post_meta(32, 'barnesandnobleurl', true); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/barnesandnoble.png" alt="BarnesandNoble"></a></li>
						</ul>
					</div>
					<div class="prices">
						<div class="kindle">
							<a href="<?php echo get_post_meta(32, 'kindleurl', true); ?>" target="_blank"><?php echo get_post_meta(32, 'kindleprice', true); ?></a>
						</div>
						<div class="paperback">
							<a href="<?php echo get_post_meta(32, 'paperbackurl', true); ?>" target="_blank"><?php echo get_post_meta(32, 'paperbackprice', true); ?></a>
						</div>
						<div class="hardcover">
							<a href="<?php echo get_post_meta(32, 'hardcoverurl', true); ?>" target="_blank"><?php echo get_post_meta(32, 'hardcoverprice', true); ?></a>
						</div>
					</div>
				</div>				
			</div>
			<div class="col-md-7">
				<div class="book-cont text-center">
					<div class="book-cont-wrap">
						<?php $query = new WP_Query('page_id=28'); ?>
							<?php while($query->have_posts()) : $query->the_post(); ?>
								<h2 class="lastWord"><?php echo get_the_title(); ?></h2>
								<?php get_template_part('templates/content', 'page'); ?>
							<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="about-author">
	<div class="container wow fadeIn">
		<div class="row">
			<div class="col-md-7 col-md-push-5">
				<figure class="author-img">
					<?php $page_id='30'; ?>
					<?php if(has_post_thumbnail($page_id)) : ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'single-post-thumbnail'); ?>
					<?php endif; ?>
					<?php $imageURI = $image[0]; ?>
					<img src="<?php echo $imageURI; ?>" alt="Lawn Griffiths">
				</figure>
			</div>
			<div class="col-md-5 col-md-pull-7">
				<div class="author-cont text-center">					
					<?php $query = new WP_Query('page_id=30'); ?>
						<?php while($query->have_posts()) : $query->the_post(); ?>
							<h2><?php echo get_the_title(); ?></h2>
							<?php get_template_part('templates/content', 'page'); ?>
						<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="excerpt">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="excerpt-cont text-center wow fadeIn">
					<div class="excerpt-cont-wrap">						
						<?php $query = new WP_Query('page_id=32'); ?>							
							<?php while($query->have_posts()) : $query->the_post(); ?>
								<h2><?php echo get_the_title(); ?></h2>
								<?php get_template_part('templates/content', 'page'); ?>
								<p class="availableat"><?php echo get_post_meta($post->ID, 'bookavailable', true); ?></p>
								<div class="retailer">
									<ul>
										<li class="amazon"><a href="<?php echo get_post_meta($post->ID, 'amazonurl', true); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/amazon-white.png" alt="Amazon"></a></li>
										<li class="barnesandnoble"><a href="<?php echo get_post_meta($post->ID, 'barnesandnobleurl', true); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/barnesandnoble-white.png" alt="BarnesandNoble"></a></li>
									</ul>
								</div>
								<div class="prices">
									<div class="kindle">
										<a href="<?php echo get_post_meta($post->ID, 'kindleurl', true); ?>" target="_blank"><?php echo get_post_meta(32, 'kindleprice', true); ?></a>
									</div>
									<div class="paperback">
										<a href="<?php echo get_post_meta($post->ID, 'paperbackurl', true); ?>" target="_blank"><?php echo get_post_meta(32, 'paperbackprice', true); ?></a>
									</div>
									<div class="hardcover">
										<a href="<?php echo get_post_meta($post->ID, 'hardcoverurl', true); ?>" target="_blank"><?php echo get_post_meta(32, 'hardcoverprice', true); ?></a>
									</div>
								</div>
							<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="get-in-touch">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="contact-cont wow fadeIn">					
					<?php $query = new WP_Query('page_id=36'); ?>
						<?php while($query->have_posts()) : $query->the_post(); ?>
							<h2><?php echo get_the_title(); ?></h2>
							<?php get_template_part('templates/content', 'page'); ?>
						<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<div class="social-media">
						<?php wp_nav_menu(['menu' => 'Social Menu', 'menu_class' => 'social_navigation', 'container_class' => '']); ?>
					</div>
					<div class="contact-form">
						<div class="home-contact">
							<?php echo do_shortcode('[contact-form-7 id="25" title="Contact form 1"]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>