<section id="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="banner-cont wow fadeIn">
					<h1 style="display: none;">Batting Rocks Over the Barn</h1>
					<figure class="banner-title">
						<img src="<?php echo get_template_directory_uri(); ?>/dist/images/banner-title.png" alt="Batting Rocks: Over the Barn">
					</figure>
					<figure class="banner-bat">
						<img src="<?php echo get_template_directory_uri(); ?>/dist/images/baseball-bat.png" alt="Batting Rocks: Over the Barn">
					</figure>
					<div class="buy-book">
						<a href="<?php echo get_post_meta(2, 'buybookurl', true); ?>" target="_blank"><?php echo get_post_meta(2, 'buybook', true); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>