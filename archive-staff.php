<?php
$options = get_design_plus_option();
get_header(); 
?>
      <?php if ( have_posts() ) : ?>
      <div class="p-staff-list">
        <?php while ( have_posts() ) : the_post(); ?>
        <article class="p-staff-list__item p-article06">
          <a class="p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
            <div class="p-article06__img">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size4' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-370x500.gif" alt="">' . "\n";
              }
              ?>
            </div>
            <div class="p-article06__content">
              <?php if ( $post->staff_job_title ) : ?>
              <p class="p-article06__position"><?php echo esc_html( $post->staff_job_title ); ?></p>
              <?php endif; ?>
              <h2 class="p-article06__name"><?php the_title(); ?></h2>
              <p class="p-article06__comment"><?php echo is_mobile() ? wp_trim_words( $post->staff_comment, 22, '...' ) : wp_trim_words( $post->staff_comment, 45, '...' ); ?></p>
            </div>
          </a>
        </article>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
</main>
<?php get_footer(); ?>
