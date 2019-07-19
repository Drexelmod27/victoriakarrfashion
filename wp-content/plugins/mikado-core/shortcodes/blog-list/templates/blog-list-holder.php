<div <?php fleur_mikado_class_attribute($holder_classes); ?>>
	<ul class="mkd-blog-list">
		<?php if($type == 'masonry') { ?>
			<li class="mkd-blog-list-masonry-grid-sizer"></li>
			<li class="mkd-blog-list-masonry-grid-gutter"></li>
		<?php }
		$html = '';
		if($query_result->have_posts()):
			while($query_result->have_posts()) : $query_result->the_post();
				$html .= mikado_core_get_core_shortcode_template_part('templates/'.$type, 'blog-list', '', $params);
			endwhile;
			echo fleur_mikado_get_module_part($html);
		else: ?>
			<div class="mkd-blog-list-messsage">
				<p><?php esc_html_e('No posts were found.', 'mkd_core'); ?></p>
			</div>
		<?php endif;
		wp_reset_postdata();
		?>
	</ul>
</div>
