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
                <?php get_template_part('template-parts/content', 'igra');?>
                <?php wp_link_pages();?>
            </div>

            <div class="col-lg-6">
                <ul class="igra_taksonomije">
                    <li>PEGI - <?php the_field('pegi');?></li>
                    <br>
                    <li>Žanr/ovi: 
                        <ul>
                        <?php 
                            $zanrovi = wp_get_object_terms($post->ID, 'zanr', array('fields' => 'all'));
                            foreach($zanrovi as $zanr):?>
                                <?php echo '<li>'.$zanr->name.'</li>';?>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <br>
                    <li>Platforme:
                    <ul>
                    <?php
                    $konzole = wp_get_object_terms($post->ID, 'konzola', array('fields' => 'all'));
                    foreach($konzole as $konzola):?>
                    <?php echo '<li>'.$konzola->name.'</li>';?>
                    <?php endforeach;?>
                    </ul>
                    
                    </li>
                    <br>
                    <li>Cijena: <?php the_field('cijena');?></li>

                </ul>
                <button class="btn btn-outline-dark btn-lg"><a style="text-decoration:none;color:inherit;" href='http://localhost/wordpress/recenzija/<?php echo $post_slug;?>/'>RECENZIJA</a></button>
            </div>
        </div>

    </div>
    




</section>
    <?php
    get_footer();
    ?>