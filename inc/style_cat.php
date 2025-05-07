<?php
$options = get_design_plus_option();

// Add form fields to edit-tags.php (Add New Category)
function style_cat_add_form_fields() {
?>
<div class="form-field term-title-bg">
  <label for="title-bg"><?php _e( 'Background color of the category', 'tcd-w' ); ?></label>
  <input name="title-bg" id="title-bg" class="c-color-picker" type="text" value="#816f60" data-default-color="#816f60">
  <p><?php _e( 'The background color is used in the related style list.', 'tcd-w' ); ?></p>
</div>
<div class="form-field term-desc-bg">
  <label for="desc-bg"><?php _e( 'Background color of the description', 'tcd-w' ); ?></label>
  <input name="desc-bg" id="desc-bg" class="c-color-picker" type="text" value="#f2f0ef" data-default-color="#f2f0ef">
  <p><?php _e( 'The background color is used in the related style list.', 'tcd-w' ); ?></p>
</div>
<?php
}

// Add form fields to term.php (Edit Category)
function style_cat_edit_form_fields( $tag ) {
?>
<tr class="form-field term-title-bg-wrap">
	<th scope="row"><label for="title-bg"><?php _e( 'Background color of the category', 'tcd-w' ); ?></label></th>
  <td>
    <input name="title-bg" id="title-bg" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'title-bg', true ) ); ?>" data-default-color="#816f60">
    <p><?php _e( 'The background color is used in the related style list.', 'tcd-w' ); ?></p>
  </td>
</tr>
<tr class="form-field term-desc-bg-wrap">
	<th scope="row"><label for="desc-bg"><?php _e( 'Background color of the description', 'tcd-w' ); ?></label></th>
  <td>
    <input name="desc-bg" id="desc-bg" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'desc-bg', true ) ); ?>" data-default-color="#f2f0ef">
    <p><?php _e( 'The background color is used in the related style list.', 'tcd-w' ); ?></p>
  </td>
</tr>
<?php
}

// Save
function style_update_term_meta( $term_id ) {

  $meta_keys = array( 'title-bg', 'desc-bg' );

  foreach ( $meta_keys as $meta_key ) {

    $old = get_term_meta( $term_id, $meta_key, true );
    $new = isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : '';

    if ( $new && $new !== $old ) {
      update_term_meta( $term_id, $meta_key, $new );
    } elseif ( '' === $new && $old ) {
      delete_term_meta( $term_id, $meta_key, $old );
    }

  }
}

for ( $i = 1; $i <= 6; $i++ ) {
  if ( ! empty( $options['style_cat' . $i] ) ) {
    add_action( "{$options['style_cat' . $i]}_add_form_fields", 'style_cat_add_form_fields' );
    add_action( "{$options['style_cat' . $i]}_edit_form_fields", 'style_cat_edit_form_fields' );
    add_action( "created_{$options['style_cat' . $i]}", 'style_update_term_meta' );
    add_action( "edited_{$options['style_cat' . $i]}", 'style_update_term_meta' );
  }
}
