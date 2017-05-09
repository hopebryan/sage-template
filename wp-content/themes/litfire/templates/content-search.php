<div class="row blog-post-wrap">
<article <?php post_class(); ?>>
	<?php if(has_post_thumbnail()) : ?>
	<div class="col-md-4 col-sm-4">
		<figure class="blog-post-img">
            <?php the_post_thumbnail(); ?>
        </figure>
	</div>
	<div class="col-md-8 col-sm-8">
		<div class="blog-post-cont">						
			<h3><?php the_title(); ?></h3>
			<div class="clearfix"><?php if (get_post_type() === 'post') { get_template_part('templates/entry-meta'); } ?></div>  
			<div class="entry-summary">			
				<?php 
					$content = get_the_content();
					$content = preg_replace("/\< *[img][^\>]*[.]*\>/i","",$content,1);
					if(strlen($content) > 400)
					 //$content = '<p>'.substr($content, 0, 400).'...</p>'; 
					     $content = substr($content, 0, 400).' . . . '; 
					else
					$content =  $content;
					 echo wpautop(strip_shortcodes($content));
				?>
			</div>
			<div class="read-more pull-right">
                <a class="readmore" href="<?php the_permalink(); ?>">Read More</a>
            </div> 
		</div>
  	</div>
  	<?php else : ?>
  	<div class="col-md-12 col-sm-12">
		<div class="blog-post-cont">	
			<h3><?php the_title(); ?></h3>
			<div class="clearfix"><?php if (get_post_type() === 'post') { get_template_part('templates/entry-meta'); } ?></div>  
			<div class="entry-summary">				
				<?php 
					$content = get_the_content();
					$content = preg_replace("/\< *[img][^\>]*[.]*\>/i","",$content,1);
					if(strlen($content) > 400)
					 //$content = '<p>'.substr($content, 0, 400).'...</p>'; 
					     $content = substr($content, 0, 400).' . . . '; 
					else
					$content =  $content;
					 echo wpautop(strip_shortcodes($content));
				?>
			</div>
			<div class="read-more pull-right">
                <a class="readmore" href="<?php the_permalink(); ?>">Read More</a>
            </div> 
		</div>
  	</div>
	<?php endif; ?>
</article>
</div>
