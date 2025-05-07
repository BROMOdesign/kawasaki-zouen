<?php
$options = get_design_plus_option();
?>
    <?php if ( 'type1' === $options['contact_type'] ) : ?>
    	<?php if(wp_is_mobile() && $options['contact_tel_link']){ ?>
    <p class="p-contact__tel"><span>TEL</span><a href="tel:<?php echo esc_html( $options['contact_tel'] ); ?>"><?php echo esc_html( $options['contact_tel'] ); ?></a></p>
    	<?php }else{ ?>
    <p class="p-contact__tel"><span>TEL</span><?php echo esc_html( $options['contact_tel'] ); ?></p>
    	<?php }; ?>
    <?php else : ?>
    <a href="<?php echo esc_url( $options['contact_btn_url'] ); ?>" class="p-contact__appointment p-btn"<?php if ( $options['contact_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $options['contact_btn_label'] ); ?></a>
    <?php endif; ?>
