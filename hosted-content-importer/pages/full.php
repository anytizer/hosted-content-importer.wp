<?php
/*
Template Name: Qbased
# https://codex.wordpress.org/Displaying_Posts_Using_a_Custom_Select_Query
*/
?>

<?php get_header(); ?>

<div id="content" class="narrowcolumn">

<?php

 $querystr = "
    SELECT $wpdb->posts.* 
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
    AND $wpdb->postmeta.meta_key = 'tag' 
    AND $wpdb->postmeta.meta_value = 'email' 
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'post'
    AND $wpdb->posts.post_date < NOW()
    ORDER BY $wpdb->posts.post_date DESC
 ";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>
 <?php if ($pageposts): ?>
  <?php global $post; ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
      <?php the_title(); ?></a></h2>
      <small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>
      <div class="entry">
         <?php the_content('Read the rest of this entry »'); ?>
      </div>
  
      <p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  
      <?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></p>
    </div>
  <?php endforeach; ?>
  
  <?php else : ?>
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for something that isn't here.</p>
    <?php include (TEMPLATEPATH . "/searchform.php"); ?>
 <?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>