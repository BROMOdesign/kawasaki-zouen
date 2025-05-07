<?php

/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget(array(
	'id' => 'pb-widget-pricemenu',
	'form' => 'form_page_builder_widget_pricemenu',
	'form_rightbar' => 'form_rightbar_page_builder_widget_pricemenu',
	'save' => 'save_page_builder_repeater',
	'display' => 'display_page_builder_widget_pricemenu',
	'title' => __('Price menu', 'tcd-w'),
	'description' => '',
	'additional_class' => 'pb-repeater-widget',
	'priority' => 51
));

/**
 * フォーム
 */
function form_page_builder_widget_pricemenu($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_pricemenu_default_values', array(
		'widget_index' => '',
		'menu_color' => '#7d5833',
		'repeater' => array()
	), 'form');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);

	// リピーター行の並び
	$repeater_indexes = array();
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行 最大インデックス
	$repeater_index_max = 0;
	if ($repeater_indexes) {
		$repeater_indexes = array_map('intval', $repeater_indexes);
		$repeater_index_max = max($repeater_indexes);
	}

	echo '<div class="pb_repeater_wrap" data-rows="'.$repeater_index_max.'">'."\n";
	echo '	<div class="pb_repeater_sortable">'."\n";
  ?>
  <div class="form-field form-field-menu_color">
  	<h4><?php _e( 'Font color of menu', 'tcd-w' ); ?></h4>
    <input type="text" class="pb-input-narrow pb-wp-color-picker" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][menu_color]" data-default-color="<?php echo esc_attr( $default_values['menu_color'] ); ?>" value="<?php echo esc_attr( $values['menu_color'] ); ?>"></p>
  </div>
  <?php

	// リピーター行あり
	if ($repeater_indexes) {
		// リピーター行ループ
		foreach($repeater_indexes as $repeater_index) {
			// リピーター行データあり
			if (!empty($values['repeater'][$repeater_index])) {
				// リピーター行出力
				form_page_builder_widget_pricemenu_repeater_row(
					array(
						'widget_index' => $values['widget_index'],
						'repeater_index' => $repeater_index
					),
					$values['repeater'][$repeater_index]
				);
			}
		}
	}

	echo '	</div>'."\n"; // .pb_repeater_sortable

	// 項目の追加ボタン
	echo '<div class="form-field">';
	echo '<a href="#" class="pb_add_repeater button-primary">'.__('Add item', 'tcd-w').'</a>';
	echo '</div>'."\n";

	// 追加ボタン時に差し込むHTML
	echo '<div class="add_pb_repeater_clone hidden" style="display:none">'."\n";

	// 行出力
	form_page_builder_widget_pricemenu_repeater_row(
		array(
			'widget_index' => $values['widget_index'],
			'repeater_index' => 'pb_repeater_add_index'
		),
		array(
			'repeater_label' => __('New item', 'tcd-w')
		)
	);

	echo '</div>'."\n"; // .add_pb_repeater_clone

	echo '</div>'."\n"; // .pb_repeater_wrap
}

/**
 * リピーター行出力
 */
function form_page_builder_widget_pricemenu_repeater_row($values = array(), $row_values = array()) {
	// デフォルト値に入力値をマージ
	$values = array_merge(
		array(
			'widget_index' => '',
      'menu_color' => '#7d5833',
			'repeater_index' => ''
		),
		(array) $values
	);

	// 行デフォルト値
	$default_row_values = apply_filters('page_builder_widget_pricemenu_default_row_values', array(
		'repeater_label' => '',
		'menu' => '',
		'desc' => '',
		'price' => ''
	));

	// 行デフォルト値に行の値をマージ
	$row_values = array_merge(
		$default_row_values,
		(array) $row_values
	);

	// リピーター表示名
	if (!$row_values['repeater_label'] && $row_values['menu']) {
		$row_values['repeater_label'] = $row_values['menu'];
	} elseif (!$row_values['repeater_label']) {
		$row_values['repeater_label'] = __('New item', 'tcd-w');
	}

	// priceの円マーク対策style
	if (strtolower(get_locale()) == 'ja') {
		$input_price_style = 'style="font-family:sans-serif;"';
	} else {
		$input_price_style = '';
	}
?>
<div id="pb_pricemenu-<?php echo esc_attr($values['widget_index'].'-'.$values['repeater_index']); ?>" class="pb_repeater pb_repeater-<?php echo esc_attr($values['repeater_index']); ?>">
	<input type="hidden" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater_index][]" value="<?php echo esc_attr($values['repeater_index']); ?>" />
	<ul class="pb_repeater_button pb_repeater_cf">
		<li><span class="pb_repeater_move"><?php _e('Move', 'tcd-w'); ?></span></li>
		<li><span class="pb_repeater_delete" data-confirm="<?php _e('Are you sure you want to delete this item?', 'tcd-w'); ?>"><?php _e('Delete', 'tcd-w'); ?></span></li>
	</ul>
	<div class="pb_repeater_content">
		<h3 class="pb_repeater_headline"><span class="index_label"><?php echo esc_attr($row_values['repeater_label']); ?></span><a href="#"><?php _e('Open', 'tcd-w'); ?></a></h3>
		<div class="pb_repeater_field">
			<div class="form-field">
				<h4><?php _e('Menu', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][menu]" value="<?php echo esc_attr($row_values['menu']); ?>" class="index_label" />
			</div>
			<div class="form-field">
				<h4><?php _e('Price', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][price]" value="<?php echo htmlspecialchars($row_values['price'], ENT_QUOTES); ?>" <?php echo $input_price_style; ?> />
             <p class="pb-description"><?php _e('Please also enter unit and thousands separator.', 'tcd-w'); ?></p>
			</div>
			<div class="form-field">
				<h4><?php _e('Description', 'tcd-w'); ?></h4>
				<textarea type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][desc]"><?php echo esc_textarea( $row_values['desc'] ); ?></textarea>
			</div>
		</div>
	</div>
</div>

<?php
}

/**
 * フォーム 右サイドバー
 */
function form_rightbar_page_builder_widget_pricemenu($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_pricemenu_default_values', array(
		'widget_index' => '',
		'margin_bottom' => 30,
		'margin_bottom_mobile' => 30
	), 'form_rightbar');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);
?>

<h3><?php _e('Margin setting', 'tcd-w'); ?></h3>
<div class="form-field">
	<label><?php _e('Margin bottom', 'tcd-w'); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][margin_bottom]" value="<?php echo esc_attr($values['margin_bottom']); ?>" class="pb-input-narrow hankaku" /> px
	<p class="pb-description"><?php esc_html_e('Space below the content.<br />Default is 30px.', 'tcd-w'); ?></p>
</div>
<div class="form-field">
	<label><?php _e('Margin bottom for mobile', 'tcd-w'); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][margin_bottom_mobile]" value="<?php echo esc_attr($values['margin_bottom_mobile']); ?>" class="pb-input-narrow hankaku" /> px
	<p class="pb-description"><?php esc_html_e('Space below the content.<br />Default is 30px.', 'tcd-w'); ?></p>
</div>

<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_pricemenu($values = array(), $widget_index = null) {
	// リピーター行の並び
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行ループし、行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行がなければ終了
	if (empty($repeater_indexes)) return;

	if (!empty($values['headline'])) {
?>
<div class="pb_pricemenu_title"><?php echo esc_html($values['headline']); ?></div>
<?php
	}
?>
<div class="pb-pricemenu">
<?php
	foreach($repeater_indexes as $repeater_index) {
		$repeater_values = $values['repeater'][$repeater_index];
		echo '<dl class="pb-pricemenu__list">';
		echo '<dt class="pb-pricemenu__list-title">'.esc_html($repeater_values['menu']).'</dt>';
		echo '<dd class="pb-pricemenu__list-desc">'.esc_html($repeater_values['desc']).'</dd>';
		echo '<dd class="pb-pricemenu__list-price">'.esc_html(str_replace('\\', '&yen;', $repeater_values['price'])).'</dd>';
		echo '</dl>'."\n";
	}
?>
</div>
<?php
}

/**
 * フロント用css
 */
function page_builder_widget_pricemenu_styles() {
	wp_enqueue_style('page_builder-pricemenu', get_template_directory_uri().'/pagebuilder/assets/css/pricemenu.css', false, PAGE_BUILDER_VERSION);
}

function page_builder_widget_pricemenu_sctipts_styles() {
	if (is_singular() && is_page_builder() && page_builder_has_widget('pb-widget-pricemenu')) {
		add_action('wp_enqueue_scripts', 'page_builder_widget_pricemenu_styles', 11);
    add_action('page_builder_css', 'page_builder_widget_pricemenu_css');
	}
}
add_action('wp', 'page_builder_widget_pricemenu_sctipts_styles');

function page_builder_widget_pricemenu_css() {

	// 現記事で使用しているgoolemapコンテンツデータを取得
	$post_widgets = get_page_builder_post_widgets(get_the_ID(), 'pb-widget-pricemenu');
	if ($post_widgets) {
		foreach($post_widgets as $post_widget) {
			$values = $post_widget['widget_value'];
        echo $post_widget['css_class'] . ' .pb-pricemenu__list-title { color: ' . esc_html( $values['menu_color'] ) . '; }' . "\n";
		}
	}
}
