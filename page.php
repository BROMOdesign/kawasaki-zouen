<?php get_header(); ?>
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
      <section class="custom_cv">
        <a href="https://lin.ee/Wk2oMn8" class="custom_cv__link">
          <picture>
            <source srcset="<?php echo esc_url(get_theme_file_uri());?>/assets/images/cv_link_sp.png" media="(max-width: 768px)">
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
