<header>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>				
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<?php if(is_front_page()) : ?>
					<?php if(has_nav_menu('primary_navigation')) : ?>
						<?php wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if(has_nav_menu('secondary_navigation')) : ?>
						<?php wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'nav navbar-nav']); ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>