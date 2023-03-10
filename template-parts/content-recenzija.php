<?php if(have_posts()): while(have_posts()): the_post();?>
<?php
$fname = get_the_author_meta('first_name');
$lname = get_the_author_meta('last_name');
?>
<div class="recenzija-info">
<p>Datum objave: <?php echo get_the_date('j. F, Y.');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Objavio: <?php echo $fname;?> <?php echo $lname;?></p>
</div>

<div class="tekst">
<?php the_content();?>
</div>

<?php
$tags = get_the_tags();
if($tags):
    foreach($tags as $tag):?>
    <a href="<?php echo get_tag_link($tag->term_id);?>" class="badge badge-success">
    <?php echo $tag->name;?>
    </a>


<?php endforeach; endif;?>

<?php endwhile; else: endif;?>