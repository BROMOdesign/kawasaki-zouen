<?php get_header(); ?>
<?php
if (have_posts()) :
  while (have_posts()) :
    the_post();
    $categories = get_the_category();
    $previous_post = get_previous_post();
    $next_post = get_next_post();
    $args = array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => 6,
    );
    $the_query = new WP_Query($args);
?>
    <article class="p-entry">
      <header>
        <h1 class="p-entry__title"><?php the_title(); ?></h1>
        <p class="p-entry__meta">
          <?php if ($options['news_show_date']) : ?><time class="p-entry__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time><?php endif; ?>
        </p>
        <?php if ($options['news_show_sns_top']) {
          get_template_part('template-parts/sns-btn-top');
        } ?>
        <?php if ($options['news_show_thumbnail'] && has_post_thumbnail()) : ?>
          <div class="p-entry__img">
            <?php the_post_thumbnail('full'); ?>
          </div>
        <?php endif; ?>
      </header>
      <?php if (! is_mobile()) {
        get_template_part('template-parts/ad-top');
      } ?>
      <div class="p-entry__body">
        <?php
        the_content();
        wp_link_pages(array(
          'before' => '<div class="p-page-links">',
          'after' => '</div>',
          'link_before' => '<span>',
          'link_after' => '</span>'
        ));
        ?>
      </div>
      <?php if ($options['news_show_sns_btm']) {
        get_template_part('template-parts/sns-btn-btm');
      } ?>
      <?php if ($options['news_show_next_post'] && ($previous_post || $next_post)) : ?>
        <ul class="p-nav01 c-nav01 u-clearfix">
          <?php if ($previous_post) : ?>
            <li class="p-nav01__item--prev p-nav01__item c-nav01__item c-nav01__item--prev">
              <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" data-prev="<?php _e('Previous post', 'tcd-w'); ?>"><span><?php echo esc_html(wp_trim_words($previous_post->post_title, 30, '...')); ?></span></a>
            </li>
          <?php endif;
          if ($next_post) : ?>
            <li class="p-nav01__item--next p-nav01__item c-nav01__item c-nav01__item--next">
              <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" data-next="<?php _e('Next post', 'tcd-w'); ?>"><span><?php echo esc_html(wp_trim_words($next_post->post_title, 30, '...')); ?></span></a>
            </li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    </article>
<?php
  endwhile;
endif;
get_template_part('template-parts/ad-btm');
?>
<?php if ($options['news_show_latest_post']) : ?>
  <div>
    <div class="p-headline p-headline--lg">
      <h2><?php echo esc_html($options['news_breadcrumb']); ?></h2>

      <a href="<?php echo get_post_type_archive_link('news'); ?>" class="p-headline__link"><?php printf(__('%s list', 'tcd-w'), esc_html($options['news_breadcrumb'])); ?></a>
    </div>
    <ul class="p-latest-news">
      <?php
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
          $the_query->the_post();
      ?>
          <li class="p-latest-news__item p-article05">
            <a href="<?php the_permalink(); ?>" class="p-hover-effect--<?php echo esc_attr($options['hover_type']); ?>">
              <div class="p-article05__img">
                <?php
                if (has_post_thumbnail()) {
                  the_post_thumbnail('size2');
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-300x300.gif" alt="">' . "\n";
                }
                ?>
              </div>
              <div class="p-article05__content">
                <h3 class="p-article05__title"><?php echo is_mobile() ? wp_trim_words(get_the_title(), 25, '...') : wp_trim_words(get_the_title(), 30, '...'); ?></h3>
                <?php if ($options['news_show_date']) : ?>
                  <time class="p-article05__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                <?php endif; ?>
              </div>
            </a>
          </li>
      <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </ul>
  </div>
<?php endif; ?>
<section class="custom_cv">
  <a href="https://lin.ee/Wk2oMn8" class="custom_cv__link">
    <picture>
      <source srcset="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/cv_link_sp.png" media="(max-width: 768px)">
      <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/cv_link_pc.png" alt="お問い合わせはLINEから お友達登録" class="custom_cv__link-image">
    </picture>
  </a>
</section>
</div>
<?php get_sidebar(); ?>
</div>
</div>
</main>
<?php get_footer(); ?>