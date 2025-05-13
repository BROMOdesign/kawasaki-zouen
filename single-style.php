<?php
$options = get_design_plus_option();
$related_cat = $options['style_related_cat'];
$in_same_term = $related_cat ? true : false;
get_header(); 
?>
        <?php
        if ( have_posts() ) : 
          while ( have_posts() ) : 
            the_post(); 
            $previous_post = get_previous_post_link( '%link', __( 'Previous style', 'tcd-w' ), $in_same_term, '', $related_cat );
            $next_post = get_next_post_link( '%link', __( 'Next style', 'tcd-w' ), $in_same_term, '', $related_cat );
            $style_data = $post->style_data;
            $terms = $related_cat && get_the_terms( $post->ID, $related_cat ) ? get_the_terms( $post->ID, $related_cat ) : array();

            for ( $i = 1; $i <= 4; $i++ ) {
              if ( $slider_image_id = get_post_meta( $post->ID, 'slider' . $i . '_image', true ) ) {
                $gallery_slider[$i] = array( 
                  'slider_image' => wp_get_attachment_image_src( $slider_image_id, 'size5' ),
                  'nav_image' => wp_get_attachment_image_src( $slider_image_id, 'size6' )
                );
              } else {
                $gallery_slider[$i] = null;
              }
            }
        ?>
        <article>
          <div class="p-style">
            <div class="p-style__gallery">
              <div id="js-style-gallery-slider" class="p-style__gallery-slider">
                <?php
                  for ( $i = 1; $i <= 4; $i++ ) : 
                    if ( $gallery_slider[$i] ) :
                ?>
                <div class="p-style__gallery-slider-img">
                  <img src="<?php echo esc_attr( $gallery_slider[$i]['slider_image'][0] ); ?>" alt="">
                </div>
                <?php
                  endif;
                endfor;
                ?>
              </div>
              <div id="js-style-gallery-nav" class="p-style__gallery-nav">
                <?php
                  for ( $i = 1; $i <= 4; $i++ ) : 
                    if ( $gallery_slider[$i] ) :
                ?>
                <div class="p-style__gallery-nav-img">
                  <img src="<?php echo esc_attr( $gallery_slider[$i]['nav_image'][0] ); ?>" alt="">
                </div>
                <?php
                  endif;
                endfor;
                ?>
              </div>
            </div>
            <?php if ( $previous_post || $next_post ) : ?>
            <ul class="p-style__nav p-nav02">
              <?php if ( $previous_post ) : ?>
              <li class="p-nav02__item p-nav02__item--prev">
                <?php echo $previous_post; ?>
              </li>
              <?php endif; ?>
              <?php if ( $next_post ) : ?>
              <li class="p-nav02__item p-nav02__item--next">
                <?php echo $next_post; ?>
              </li>
              <?php endif; ?>
            </ul>
            <?php endif; ?>
            <div class="p-style__data">
              <dl class="p-style__data-item">
                <dt class="p-style__data-item-headline">Name</dt>
                <dd class="p-style__data-item-content">
                  <h1><?php the_title(); ?></h1>
                </dd>
              </dl>
              <?php if ( isset( $style_data['header'] ) && $len = count( $style_data['header'] ) ) : ?>
              <table class="p-style__table p-style__data-item">
                <caption class="p-style__data-item-headline">Data</caption>
                <?php
                for ( $i = 0; $i < $len; $i++ ) { 
                  // $style_data['data'][$i] は HTML 許可
                  echo '<tr>';
                  if ( empty( $style_data['header'][$i] ) && $style_data['data'][$i] ) {
                    echo '<td colspan="2">' . $style_data['data'][$i] . '</td>';
                  } else {
                    echo '<th>' . esc_html( $style_data['header'][$i] ) . '</th>';
                    echo '<td>' . $style_data['data'][$i] . '</td>';
                  }
                  echo '</tr>' . "\n";
                }
                ?>
              </table>
              <?php endif; ?>
              <?php if ( $post->style_point ) : ?>
              <dl class="p-style__data-item">
                <dt class="p-style__data-item-headline">Point</dt>
                <dd class="p-style__data-item-content"><?php echo nl2br( esc_html( $post->style_point ) ); ?></dd>
              </dl>
              <?php endif; ?>
            </div>
          </div>
          <?php if ( $previous_post || $next_post ) : ?>
          <ul class="p-nav02">
            <?php if ( $previous_post ) : ?>
            <li class="p-nav02__item p-nav02__item--prev">
              <?php echo $previous_post; ?>
            </li>
            <?php endif; ?>
            <?php if ( $next_post ) : ?>
            <li class="p-nav02__item p-nav02__item--next">
              <?php echo $next_post; ?>
            </li>
            <?php endif; ?>
          </ul>
          <?php endif; ?>
          <?php if ( $staff_id = $post->staff_id ) : ?>
          <div class="p-style-author">
            <?php if ( $options['style_author_headline'] ) : ?>
            <p class="p-style-author__headline"><?php echo esc_html( $options['style_author_headline'] ); ?></p>
            <?php endif; ?>
            <a href="<?php echo get_permalink( $staff_id ); ?>" class="p-style-author__body">
              <div class="p-style-author__portrait">
                <?php if ( has_post_thumbnail( $staff_id ) ) : ?>
                <div class="p-style-author__portrait-img">
                  <?php echo get_the_post_thumbnail( $staff_id, 'size7' ); ?>
                </div>
                <?php endif; ?>
                <div class="p-style-author__portrait-text">
                  <?php if ( $job_title = get_post_meta( $staff_id, 'staff_job_title', true ) ) : ?>
                  <p class="p-style-author__portrait-position"><?php echo esc_html( $job_title ); ?></p>
                  <?php endif; ?>
                  <p class="p-style-author__portrait-name"><?php echo esc_html( get_the_title( $staff_id ) ); ?></p>
                </div>
              </div>
              <?php if ( $staff_comment = get_post_meta( $staff_id, 'staff_comment', true ) ) : ?>
              <p class="p-style-author__comment"><?php echo is_mobile() ? wp_trim_words( $staff_comment, 45, '...' ) : wp_trim_words( $staff_comment, 70, '...' ); ?></p>
              <?php endif; ?>
            </a>
          </div>
          <?php endif; ?>
        </article>
        <?php
          endwhile;
        endif;
        ?>
        <?php
        foreach ( $terms as $term ) :
          $term_id = $term->term_id;
          $term_desc = $term->description;
          $args = array(
            'post_type' => 'style',
            'post_status' => 'publish',
            'post_not_in' => $post->ID,
            'posts_per_page' => -1,
            'tax_query' => array(
              array(
                'taxonomy' => $related_cat,
                'field'    => 'term_id',
                'terms' => $term_id
              )
            )
           //'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
          );
          $the_query = new WP_Query( $args );
          if ( $the_query->have_posts() ) :
            $title_bg = get_term_meta( $term_id, 'title-bg', true );
            $desc_bg = get_term_meta( $term_id, 'desc-bg', true );
        ?>
        <section class="p-related-style">
          <header class="p-related-style__header" style="background: <?php echo esc_attr( $desc_bg ); ?>;">
            <h2 class="p-related-style__title" style="background: <?php echo esc_attr( $title_bg ); ?>;"><?php echo esc_html( $term->name ); ?></h2>
            <p class="p-related-style__desc"><?php echo esc_html( $term_desc ); ?></p>
          </header>
          <ul class="p-related-style__list p-style-list">
            <?php 
            while ( $the_query->have_posts() ) : 
              $the_query->the_post();
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
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
        </section>
        <?php endif; ?>
        <?php endforeach; ?>
        <section class="custom_cv">
        <a href="https://lin.ee/Wk2oMn8" class="custom_cv__link">
          <picture>
            <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/images/cv_link_pc.png" alt="お問い合わせはLINEから お友達登録" class="custom_cv__link-image">
          </picture>
        </a>
      </section>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
