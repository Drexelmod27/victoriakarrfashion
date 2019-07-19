<?php do_action('fleur_mikado_before_site_logo'); ?>

	<div class="mkd-logo-wrapper">
		<a href="<?php echo esc_url(home_url('/')); ?>" <?php fleur_mikado_inline_style($logo_styles); ?>>
			<img <?php echo fleur_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_attr_e('logo', 'fleur'); ?>"/>
			<?php if(!empty($logo_image_dark)) { ?>
				<img <?php echo fleur_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_attr_e('dark logo', 'fleur'); ?>"/><?php } ?>
			<?php if(!empty($logo_image_light)) { ?>
				<img <?php echo fleur_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_attr_e('light logo', 'fleur'); ?>"/><?php } ?>
		</a>
	</div>

<?php do_action('fleur_mikado_after_site_logo'); ?>