<?php 
/*
Template Name: No side
*/
__( 'No side', 'tcd-w' );
get_header(); 
?>
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
      ?>
			<article class="p-entry">
        <header>
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="p-entry__img">
            <?php the_post_thumbnail( 'full' ); ?>
          </div>
          <?php endif; ?>
        </header>
        <div class="p-entry__body">
          <?php
          the_content(); 
          wp_link_pages( array( 
            'before' => '<div class="p-page-links">', 
            'after' => '</div>', 
            'link_before' => '<span>', 
            'link_after' => '</span>' 
          ) ); 
          ?>
        </div>
      </article>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>
</main>
<?php get_footer(); ?>
