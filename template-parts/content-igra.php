<?php if(have_posts()): while(have_posts()): the_post();?>

<div class="tekst">
<?php the_content();?>
</div>

<?php
$tags = get_the_tags();
if($tags):
    foreach($tags as $tag):?>
    <h5 class="badge badge-success">
    <?php echo $tag->name;?>
    </h5>



<?php endforeach; endif;?>

<?php endwhile; else: endif;?>