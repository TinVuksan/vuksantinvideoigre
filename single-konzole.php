<?php
    get_header();
    ?>


<?php $post_slug = get_post_field( 'post_name', get_post() ); ?>
<section class="page-wrap">
    <div class="container">

        <h1 class="naslov"><?php the_title();?></h1>


        <?php if(has_post_thumbnail()):?>
            <img class="img-fluid mb-3 img-thumbnail" src="<?php the_post_thumbnail_url('blog-large');?>" alt="image">
        <?php endif;?>

        <div class="row igra-row">
            <div class="col-lg-6">
                <?php get_template_part('template-parts/content', 'konzola');?>
                <?php wp_link_pages();?>
            </div>

            <div class="col-lg-6">
            <ul class="igra_taksonomije">
                    <li>Dostupan od: <?php the_field('godina_proizvodnje');?>. godine</li>
                    <br>
                    <li>Cijena: <?php the_field('cijena');?></li>

                </ul>
            </div>
        </div>

    </div>
    




</section>
    <?php
    get_footer();
    ?>