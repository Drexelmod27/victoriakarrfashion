<li class="mkd-<?php echo esc_attr($name) ?>-share">
	<a class="mkd-share-link" href="#" onclick="<?php echo esc_attr($link); ?>">
		<?php if($custom_icon !== '') { ?>
			<img src="<?php echo esc_url($custom_icon); ?>" alt="<?php echo esc_attr($name); ?>"/>
		<?php } else { ?>
			<span class="mkd-social-network-icon <?php echo esc_attr($icon); ?>"></span>
		<?php } ?>
	</a>
</li>