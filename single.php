<?php get_header(); /* Tells WordPress to include header.php */ ?>
<div class="container-fluid maincontainer">
    <div class="container">
        <div class="row">
            <section class="col-sm-7 maintext">
<h2>LATEST ARTICLES</h2>	


<article class="excerpts"> <!--we can reuse the css on the old article to restyle the new dynamic posts-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
	<div <?php post_class(); ?>>
		<h3 class="posttitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

		<div class="postcontent">
			<?php /*?><?php the_post_thumbnail(array(150,150), array ('class' => 'alignright')); ?><?php */?>
			<?php the_content(); ?>
		</div><!--postcomtet-->
						
		<div class="content-band">
			<span class="postmeta-category"><?php the_category(', '); ?></span>
			<span class="postmeta-comments"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span>
			
		</div><!--content-band-->
	</div><!--post class-->
    <div class="related-template">
	<h3>RELATED POSTS</h3>
	<ul class="rel-list">
		<?php
		$backup = $post; //Backup current post object
		$current = $post->ID;  //get current post id 
								
		global $post;

		//Fetch categories of current post
		$counter = 0;
		$allcats = '';
		foreach ((get_the_category()) as $cat) {
			if ($counter > 0) $allcats .= ',';
			$allcats .= $cat->cat_ID;
			$counter++;
		}
		
	$myposts = get_posts('numberposts=3&order=DESC&category=');
        foreach ($myposts as $post) :
			setup_postdata($post);
			?>
		<li>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			<span class="related-posts-date"><?php the_time('F jS, Y'); ?></span>
		</li>
		<?php endforeach;
								
		$post = $backup; //restore current post object
		wp_reset_query();
		?>
	</ul>
</div>

	
    <div class="comments-template">
			<?php comments_template(); ?>
		</div>
		
	<?php endwhile; ?>
	<?php else: ?>
	<div class="post">
		<p>Sorry, no posts found.</p>
	</div><!--post-->
	<?php endif; ?>
</article>
</section>

            
     </div>
    </div>
  </div>
<?php get_footer(); ?>