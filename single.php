<?php get_header(); ?>
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          $categories = get_the_category();
          $pagenation_type = 'type3' === $post->pagenation_type ? $options['pagenation_type'] : $post->pagenation_type;
          $previous_post = get_previous_post();
          $next_post = get_next_post();
          $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in' => array( $post->ID ),
            'category_name' => $categories[0]->slug,
            'orderby' => 'rand',
          );
          $the_query = new WP_Query( $args );
      ?>
			<article class="p-entry">
        <header>
          <h1 class="p-entry__title"><?php the_title(); ?></h1>
          <p class="p-entry__meta">
            <?php if ( $options['show_date'] ) : ?><time class="p-entry__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; if ( $options['show_category'] ) : ?><span class="p-entry__cat"><?php the_category( ', ' ); ?></span><?php endif; ?>
          </p>
          <?php if ( $options['show_sns_top'] ) { get_template_part( 'template-parts/sns-btn-top' ); } ?>
          <?php if ( $options['show_thumbnail'] && has_post_thumbnail() ) : ?>
          <div class="p-entry__img">
            <?php the_post_thumbnail( 'full' ); ?>
          </div>
          <?php endif; ?>
        </header>
        <?php if ( ! is_mobile() ) { get_template_part( 'template-parts/ad-top' ); } ?>
        <div class="p-entry__body">
          <?php
          the_content(); 
          if ( ! post_password_required() ) {
            if ( 'type2' === $pagenation_type ) {
              if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
            ?>
            <div class="p-readmore">
              <a class="p-readmore__btn p-btn" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
              <p class="p-readmore__num"><?php echo $page . ' / ' . $numpages; ?></p>
            </div>
            <?php
              endif;
            } else {
              wp_link_pages( array( 
                'before' => '<div class="p-page-links">', 
                'after' => '</div>', 
                'link_before' => '<span>', 
                'link_after' => '</span>' 
              ) ); 
            }
          }
          ?>
        </div>
        <?php if ( $options['display_staff'] && $post->staff_id ) : ?>
				<div class="p-entry__author p-author">
          <?php if ( has_post_thumbnail( $post->staff_id ) ) : ?>
          <a href="<?php echo get_permalink( $post->staff_id ); ?>" class="p-author__img p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
            <?php echo get_the_post_thumbnail( $post->staff_id, 'size8' ); ?>
          </a>
          <?php endif; ?>
          <?php if ( get_post_meta( $post->staff_id, 'staff_job_title', true ) ) : ?>
          <p class="p-author__job"><?php echo esc_html( get_post_meta( $post->staff_id, 'staff_job_title', true ) ); ?></p>
          <?php endif; ?>
          <p class="p-author__name">
            <a href="<?php echo get_permalink( $post->staff_id ); ?>"><?php echo esc_html( get_the_title( $post->staff_id ) ); ?></a>
          </p>
        </div>        
        <?php endif; ?>
        <?php if ( $options['show_sns_btm'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
        <?php if ( $options['show_author'] || $options['show_category'] || $options['show_tag'] || $options['show_comment'] ) : ?> 
				<ul class="p-entry__meta-box c-meta-box u-clearfix">
					<?php if ( $options['show_author'] ) : ?><li class="c-meta-box__item c-meta-box__item--author"><?php _e( 'Author', 'tcd-w' ); ?>: <?php the_author_posts_link(); ?></li><?php endif; if ( $options['show_category'] ) : ?><li class="c-meta-box__item c-meta-box__item--category"><?php the_category( ', ' ); ?></li><?php endif; if ( $options['show_tag'] && get_the_tags() ) : ?><li class="c-meta-box__item c-meta-box__item--tag"><?php echo get_the_tag_list( '', ', ', '' ); ?></li><?php endif; if ( $options['show_comment'] ) : ?><li class="c-meta-box__item c-meta-box__item--comment"><?php _e( 'Comments', 'tcd-w' ); ?>: <a href="#comment_headline"><?php echo get_comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
				</ul>
        <?php endif; ?>
				<?php if ( $options['show_next_post'] && ( $previous_post || $next_post ) ) : ?>
				<ul class="p-nav01 c-nav01 u-clearfix">
          <?php if ( $previous_post ) : ?>
					<li class="p-nav01__item--prev p-nav01__item c-nav01__item c-nav01__item--prev">
				    <a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $previous_post->post_title, 30, '...' ) ); ?></span></a>
					</li>
          <?php endif; if ( $next_post ) : ?>
					<li class="p-nav01__item--next p-nav01__item c-nav01__item c-nav01__item--next">
				  	<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $next_post->post_title, 30, '...' ) ); ?></span></a>
					</li>
          <?php endif; ?>
				</ul>
        <?php endif; ?>
      </article>
      <?php
        endwhile;
      endif;
      get_template_part( 'template-parts/ad-btm' );
      if ( $options['show_comment'] ) { comments_template( '', true ); }
      ?>
      <?php if ( $options['show_related_post'] ) : ?>
      <section>
        <h2 class="p-headline p-headline--lg"><?php _e( 'Related posts', 'tcd-w' ); ?></h2>
        <ul class="p-entry__related">
          <?php
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
          ?>
					<li class="p-entry__related-item p-article04">
            <a href="<?php the_permalink(); ?>" class="p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
              <div class="p-article04__img">
                <?php 
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size3' );
                } else { 
                  echo '<img src="' . get_template_directory_uri(). '/assets/images/no-image-430x268.gif" alt="">' . "\n";
                }
                ?>
              </div>
              <h3 class="p-article04__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 40, '...' ); ?></h3>
            </a>
          </li> 
          <?php
            endwhile;
            wp_reset_postdata();
          else :
            echo '<li>' . __( 'No related posts.', 'tcd-w' ) . '</li>' . "\n";
          endif;
          ?>
        </ul>
		  </section>
      <?php endif; ?>
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
