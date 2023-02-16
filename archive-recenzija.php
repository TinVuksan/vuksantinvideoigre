<?php
    get_header();
    ?>
    
    
		<article class="content px-3 py-5 p-md-5">

		<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post();
				get_template_part('template-parts/content', 'archive');
			}
		}
		?>
		<div class="paginacija">
		<?php 
		global $wp_query;
		$big = 999999999;
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages
		));
		?>
		</div>
	    </article>
    <?php
    get_footer();
    ?>
	    

