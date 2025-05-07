<?php
$options = get_design_plus_option();
get_header(); 
?>
      <div id="js-search" class="p-search">
        <div class="p-search__header">
          <h2 class="p-search__title"><?php echo esc_html( $options['style_search_title'] ); ?></h2>
          <p class="p-search__sub"><?php echo esc_html( $options['style_search_sub_title'] ); ?></p>
        </div>
        <form id="js-search__form" class="p-search__form" method="POST" action="<?php echo esc_url( get_post_type_archive_link( 'style' ) ); ?>">
          <div class="p-search__elem">
            <?php 
            for ( $i = 1; $i <= 6; $i++ ) : 
              // 登録済みカテゴリー（「名前」と「スラッグ」の両方登録があるもの）のうち、
              // 検索条件のチェックボックスにチェックが入っているもののみ表示する
              if ( $options['style_cat' . $i] && $options['style_cat_label' . $i] && $options['style_search_use_tax' . $i] ) :
                if ( $terms = get_terms( $options['style_cat' . $i] ) ) : 
                  $style_cat = esc_attr( $options['style_cat' . $i] );
            ?>
            <fieldset class="p-search__elem-item">
              <legend class="p-search__elem-item-title"><?php printf( __( 'Search by %s', 'tcd-w' ), esc_html( $options['style_cat_label' . $i] ) ); ?></legend>
              <ul class="p-search__elem-item-list p-search-list">
                <?php foreach ( $terms as $term ) : ?>
                <li>
                  <input type="checkbox" id="<?php echo $style_cat; ?>-<?php echo esc_attr( $term->term_id ); ?>" class="p-search-list__item-checkbox" name="search_cat<?php echo $i; ?>[]" value="<?php echo esc_attr( $term->term_id ); ?>">
                  <label class="p-search-list__item-label" for="<?php echo $style_cat; ?>-<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></label>
                </li>
                <?php endforeach; ?>
              </ul>
            </fieldset>
            <?php
                endif;
              endif; 
            endfor; 
            ?>
            <?php 
            if ( $options['style_search_use_staff'] ) : 
              $staff_label = $options['staff_breadcrumb'] ? $options['staff_breadcrumb'] : __( 'Staff', 'tcd-w' );
              $staff_args = array(
                'post_type' => 'staff',
                'post_status' => 'publish',
                'posts_per_page' => -1
              );
              $staff_query = new WP_Query( $staff_args );
            ?>
            <fieldset class="p-search__elem-item">
              <legend class="p-search__elem-item-title"><?php printf( __( 'Search by %s', 'tcd-w' ), esc_html( $staff_label ) ); ?></legend>
              <?php if ( $staff_query->have_posts() ) : ?>
              <ul class="p-search__elem-item-list p-search-list">
                <?php 
                while ( $staff_query->have_posts() ) : 
                  $staff_query->the_post();
                ?>
                <li>
                  <input type="checkbox" id="staff-<?php echo esc_attr( $post->ID ); ?>" class="p-search-list__item-checkbox" name="search_staff[]" value="<?php echo esc_attr( $post->ID ); ?>">
                  <label class="p-search-list__item-label" for="staff-<?php echo esc_attr( $post->ID ); ?>"><?php the_title(); ?></label>
                </li>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
              </ul>
              <?php endif; ?>
            </fieldset>
            <?php endif; ?>
          </div>
          <input id="js-search__submit" class="p-search__submit p-btn" type="submit" value="<?php echo esc_attr( $options['style_search_btn_label'] ); ?>">
        </form>
      </div>
      <div id="js-search-result" class="p-search-result">
        <ul class="p-style-list">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post();
          ?>
          <li class="p-style-list__item">
            <a href="<?php the_permalink(); ?>" class="p-style-list__item-img p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>"<?php if($options['style_ph_target']){ echo ' target="_blank"'; }; ?>>
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
          else :
            echo '<li>' . __( 'There is no registered posts.', 'tcd-w' ) . '</li>' . "\n";
          endif;
          ?>
        </ul>
        <section class="custom_cv">
        <a href="https://lin.ee/Wk2oMn8" class="custom_cv__link">
          <picture>
            <source srcset="<?php echo esc_url(get_theme_file_uri());?>/assets/images/cv_link_sp.png" media="(max-width: 768px)">
            <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/images/cv_link_pc.png" alt="お問い合わせはLINEから お友達登録" class="custom_cv__link-image">
          </picture>
        </a>
      </section>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
</main>
<?php get_footer(); ?>
