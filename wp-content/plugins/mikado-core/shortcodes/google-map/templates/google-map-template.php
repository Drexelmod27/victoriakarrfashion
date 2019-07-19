<div <?php fleur_mikado_class_attribute($map_classes);?>>
	<div class="mkd-google-map" id="<?php echo esc_attr($map_id); ?>" <?php echo fleur_mikado_get_module_part($map_data); ?>></div>
	<?php if($scroll_wheel == "false") { ?>
		<div class="mkd-google-map-overlay"></div>
	<?php } ?>
</div>
