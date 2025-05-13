<?php
$options = get_design_plus_option();
get_header();
?>
<?php
if (have_posts()) :
  while (have_posts()) :
    the_post();

    if (has_post_thumbnail()) {
      $portrait_img = get_the_post_thumbnail_url();
    } else {
      $portrait_img = get_template_directory_uri() . '/assets/images/no-image-760x1030.gif';
    }
    $staff_data = $post->staff_data;

    $style_args = array(
      'post_type' => 'style',
      'post_status' => 'publish',
      'meta_key' => 'staff_id',
      'meta_value' => $post->ID,
      'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC')
    );
    $style_query = new WP_Query($style_args);

    if ($options['staff_display_blog']) {
      $staff_breadcrumb = $options['staff_breadcrumb'] ? $options['staff_breadcrumb'] : __('Staff', 'tcd-w');
      $blog_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'meta_key' => 'staff_id',
        'meta_value' => $post->ID,
      );
      $blog_query = new WP_Query($blog_args);
    }
?>
    <?php if (!post_password_required($post->ID)) : ?>
      <div class="p-profile">
        <div class="p-profile__upper">
          <div class="p-profile__portrait">
            <img class="p-profile__portrait-img" src="<?php echo esc_attr($portrait_img); ?>" alt="<?php the_title(); ?>">
            <div class="p-profile__portrait-info">
              <?php if ($post->staff_job_title) : ?>
                <span class="p-profile__position"><?php echo esc_html($post->staff_job_title); ?></span>
              <?php endif; ?>
              <h1 class="p-profile__name"><?php the_title(); ?></h1>
              <ul class="p-profile__social">
                <?php if ($post->staff_twitter) : ?>
                  <li class="p-profile__social-item p-profile__social-item--twitter"><a href="<?php echo esc_url($post->staff_twitter); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if ($post->staff_fb) : ?>
                  <li class="p-profile__social-item p-profile__social-item--facebook"><a href="<?php echo esc_url($post->staff_fb); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if ($post->staff_insta) : ?>
                  <li class="p-profile__social-item p-profile__social-item--instagram"><a href="<?php echo esc_url($post->staff_insta); ?>" target="_blank"></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
          <?php if (isset($staff_data['header']) && $len = count($staff_data['header'])) : ?>
            <table class="p-profile__table">
              <caption>Profile</caption>
              <?php
              for ($i = 0; $i < $len; $i++) {
                // $staff_data['data'][$i] は HTML 許可
                echo '<tr>';
                if (empty($staff_data['header'][$i]) && $staff_data['data'][$i]) {
                  echo '<td colspan="2">' . $staff_data['data'][$i] . '</td>';
                } else {
                  echo '<th>' . esc_html($staff_data['header'][$i]) . '</th>';
                  echo '<td>' . $staff_data['data'][$i] . '</td>';
                }
                echo '</tr>' . "\n";
              }
              ?>
            </table>
          <?php endif; ?>
        </div>
        <div class="p-profile__lower">
          <?php if ($post->staff_comment) : ?>
            <p class="p-profile__comment"><?php echo nl2br(esc_html($post->staff_comment)); ?></p>
          <?php endif; ?>
          <?php if ($post->staff_display_work_schedule) : ?>
            <table class="p-work-schedule">
              <caption><?php _e('Work schedule', 'tcd-w'); ?></caption>
              <?php
              $work_schedule = $post->staff_work_schedule;

              // 'header', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun' の配列を取得
              $work_schedule_keys = array_keys($work_schedule);

              // $len は表の行数
              for ($i = 0, $len = count($work_schedule['header']); $i < $len; $i++) {
                echo '<tr>';
                foreach ($work_schedule_keys as $key) {

                  // 1行目のセルは th とする
                  // $key カラムの $i 行目のセルを出力する
                  if (0 === $i) {
                    echo '<th>' . esc_html($work_schedule[$key][$i]) . '</th>';
                  } else {
                    echo '<td>' . esc_html($work_schedule[$key][$i]) . '</td>';
                  }
                }
                echo '</tr>' . "\n";
              }
              ?>
            </table>
          <?php endif; ?>
        </div>
      </div>
      <?php if ($style_query->have_posts()) : ?>
        <section class="p-portfolio">
          <h2 class="p-portfolio__headline"><?php echo esc_html($post->staff_style_list_title); ?></h2>
          <ul class="p-style-list">
            <?php
            while ($style_query->have_posts()) :
              $style_query->the_post();
            ?>
              <li class="p-style-list__item">
                <a href="<?php the_permalink(); ?>" class="p-style-list__item-img p-hover-effect--<?php echo esc_attr($options['hover_type']); ?>">
                  <?php
                  if (has_post_thumbnail()) {
                    the_post_thumbnail('size4');
                  } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-370x500.gif" alt="">' . "\n";
                  }
                  ?>
                </a>
              </li>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
          </ul>
        </section>
      <?php endif; ?>
      <?php if ($options['staff_display_blog']) : ?>
        <section class="p-staff-blog">
          <h2 class="p-staff-blog__headline"><?php printf(__('Blog list of this %s', 'tcd-w'), esc_html($staff_breadcrumb)); ?></h2>
          <ul class="p-entry__related">
            <?php
            if ($blog_query->have_posts()) :
              while ($blog_query->have_posts()) :
                $blog_query->the_post();
            ?>
                <li class="p-entry__related-item p-article04">
                  <a href="<?php the_permalink(); ?>" class="p-hover-effect--<?php echo esc_attr($options['hover_type']); ?>">
                    <div class="p-article04__img">
                      <?php
                      if (has_post_thumbnail()) {
                        the_post_thumbnail('size3');
                      } else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-430x268.gif" alt="">' . "\n";
                      }
                      ?>
                    </div>
                    <h3 class="p-article04__title"><?php echo is_mobile() ? wp_trim_words(get_the_title(), 25, '...') : wp_trim_words(get_the_title(), 30, '...'); ?></h3>
                  </a>
                </li>
            <?php
              endwhile;
              wp_reset_postdata();
            else :
              echo '<li>' . __('There is no registered posts.', 'tcd-w') . '</li>' . "\n";
            endif;
            ?>
          </ul>
        </section>
      <?php endif; ?>
    <?php
    else: // password
      echo get_the_password_form();
    endif;
    ?>
<?php
  endwhile;
endif; ?>
<section class="custom_cv">
  <a href="https://lin.ee/Wk2oMn8" class="custom_cv__link">
    <picture>
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