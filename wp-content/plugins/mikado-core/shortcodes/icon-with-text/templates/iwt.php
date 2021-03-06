<div <?php fleur_mikado_class_attribute($holder_classes); ?>>
	<div class="mkd-iwt-icon-holder">
		<?php if (!empty($custom_icon)) : ?>
			<span
				class="mkd-iwt-custom-icon" <?php fleur_mikado_inline_style($custom_icon_styles); ?>><?php echo wp_get_attachment_image($custom_icon, 'full'); ?></span>
		<?php else: ?>
			<?php
			if($icon_parameters['icon_pack']) {
				echo mikado_core_get_core_shortcode_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters));
			}
			?>
		<?php endif; ?>
	</div>
	<div class="mkd-iwt-content-holder" <?php fleur_mikado_inline_style($content_styles); ?>>
		<div class="mkd-iwt-title-holder">
			<<?php echo esc_attr($title_tag); ?> <?php fleur_mikado_inline_style($title_styles); ?>
			><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
	</div>
	<div class="mkd-iwt-text-holder">
		<p <?php fleur_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>

		<?php if (!empty($link) && !empty($link_text)) : ?>
			<a class="mkd-iwt-link"
			   href="<?php echo esc_url($link); ?>" <?php fleur_mikado_inline_attr($target, 'target'); ?>><?php echo esc_html($link_text); ?></a>
		<?php endif; ?>
	</div>
</div>
</div>