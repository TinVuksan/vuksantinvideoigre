<?php
get_header();
?>

<section class="page-wrap">
    <div class="container recenzija-container">
        <h1><?php the_title();?></h1>

        <?php if(has_post_thumbnail()):?>
            <img class="img-fluid mb-3 img-thumbnail" src="<?php the_post_thumbnail_url('blog-large');?>" alt="image">
        <?php endif;?>
                <?php get_template_part('template-parts/content', 'recenzija');?>
                <?php wp_link_pages();?>
    </div>
</section>

<?php
get_footer();
?>