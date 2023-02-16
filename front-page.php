    <?php get_header();?>
    
    

<section class="page-wrap">

		<div class="container">
			<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post();
				the_content();
			}
		}
		?>
	    
	</div>
</section>

    <?php get_footer();?>
	    

