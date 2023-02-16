<div class="container">
<div class="card mb-5">
	<div class="media card-body d-flex justify-content-center align-items-center">
		<img class="mr-3 img-fluid post-thumb img-thumbnail d-none d-md-flex" src="<?php the_post_thumbnail_url('blog-small');?>" alt="image">
		<div class="media-body">
			<h3 class="title mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="meta mb-1"><span style="font-weight:500;" class="date"><?php echo get_the_date('j. F, Y.');?></span></div>
			<div class="intro">
                <?php
                the_excerpt();
                ?>
            </div>
			<a class="btn btn-info" href="<?php the_permalink(); ?>">Read more &rarr;</a>
		</div><!--//media-body-->
	</div><!--//media-->
</div>
</div>