<div class="container">
	<div class="content-header">
    <?php if(has_post_thumbnail()):?>
            <img class="img-fluid mb-3 img-thumbnail" src="<?php the_post_thumbnail_url('blog-large');?>" alt="image">
            <?php endif;?>
		<div class="meta mb-3">
            
            <span class="date"><?php the_date(); ?></span>
            <?php
            $tags = get_the_tags();
            if($tags):
                foreach($tags as $tag):?>
                    <a href="<?php echo get_tag_link($tag->term_id);?>" class="badge badge-success">
                        <?php echo $tag->name;?>
                    </a>
            <?php endforeach; endif;?>

            <span class="comment"><a class="badge badge-info" href="#comments"><i class='fa fa-comment'></i> <?php comments_number(); ?></a></span>
        </div>
</div>

<?php
the_content();
?>

<?php
comments_template();
?>
</div>