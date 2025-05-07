<?php
$options = get_design_plus_option();
get_header(); 
?>
      <div class="p-search-result">
        <p class="p-headline mb0"><?php the_archive_title(); ?></p>
        <ul class="p-style-list">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post();
          ?>
          <li class="p-style-list__item">
            <a href="<?php the_permalink(); ?>" class="p-style-list__item-img p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size4' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-370x500.gif" alt="">' . "\n";
              }
              ?>
            </a>
          </li>
          <?php
            endwhile;
          endif;
          ?>
        </ul>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
</main>
<?php get_footer(); ?>
